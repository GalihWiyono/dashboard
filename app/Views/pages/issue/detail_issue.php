<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php if (session()->has('flash')) : ?>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
        <div id="toastNotification" class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
            <div id="toast-header" class="toast-header <?= (session('flash.status') ? "bg-success" : "bg-danger") ?>">
                <strong class="me-auto text-black">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?= session('flash.message') ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php $session = session(); ?>
<div class="col-lg d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="row align-items-center  mb-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title fw-semibold mb-0">Detail Issue</h5>
                    <a href="<?= site_url('issue') ?>" class="btn btn-secondary rounded-2 fw-semibold">
                        <i class="ti ti-arrow-left"></i> Back
                    </a>
                </div>

                <div class="row">
                    <!-- Bagian Kiri: Detail Issue -->
                    <div class="col-lg-7">
                        <h5 class="fw-bold">Issue Data</h5>
                        <div class="form-floating mb-3">
                            <input class="form-control" name="title" id="detail-title" type="text" value="<?= $issue['title'] ?>" placeholder="Title" disabled />
                            <label for="detail-title">Title</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="message" id="detail-message" rows="3" placeholder="Message" disabled><?= esc($issue['message']) ?></textarea>
                            <label for="detail-message">Message</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="issue" id="detail-issue" rows="3" placeholder="Issue" disabled><?= esc($issue['issue']) ?></textarea>
                            <label for="detail-issue">Issue</label>
                        </div>

                        <?php if ($session->get('role') === 'Admin') : ?>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="user" id="detail-user" value="<?= $issue['name'] ?>" type="text" placeholder="User" disabled>
                                <label for="detail-user">User</label>
                            </div>
                        <?php endif; ?>

                        <div class="row">
                            <?php if (!empty($issue['path_photo'])) : ?>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Photo</label>
                                    <div class="w-100 mt-2" style="height: 250px; overflow: hidden;">
                                        <img id="detail-photo" src="<?= $issue['path_photo'] ?>" class="img-fluid rounded w-100 h-100"
                                            style="object-fit: cover;">
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($issue['path_video'])) : ?>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Video</label>
                                    <div class="w-100 mt-2" style="height: 250px; overflow: hidden;">
                                        <video id="detail-video" class="w-100 h-100 rounded" controls style="object-fit: cover;">
                                            <source src="<?= $issue['path_video'] ?>" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>

                        <?php if ($session->get('role') === 'Admin') : ?>
                            <div class="mb-3">
                                <label class="form-label">Location:</label>
                                <div id="map" style="height: 300px; border-radius: 8px;"></div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Bagian Kanan: Komentar -->
                    <div class="col-lg-5">
                        <h5 class="fw-bold">Comments</h5>
                        <div id="comment-section" class="border rounded p-3">
                            <?php foreach ($comments as $comment) : ?>
                                <div class="comment-box border-bottom pb-2 mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-semibold"><?= ucwords(strtolower(htmlspecialchars($comment['name']))) ?></span>
                                        <div class="d-flex align-items-center">
                                            <span class="text-muted small me-2"><?= date('d/m/Y, H:i', strtotime($comment['updated_at'])) ?></span>
                                            <?php if ($session->get('role') === 'Admin' && $comment['user_id'] === $session->get('user_id')) : ?>
                                                <button class="btn btn-sm btn-outline-secondary me-2 edit-comment" data-id="<?= $comment['id'] ?>">
                                                    <i class="ti ti-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger delete-comment" data-id="<?= $comment['id'] ?>">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <p class="mb-0"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <?php if ($session->get('role') === 'Admin') : ?>
                            <form action="<?= base_url('issue/' . $issue['id'] . '/comments')?>" method="POST" id="comment-form" class="mt-3">
                                <input type="hidden" id="issue-id" name="issue_id" value="<?= htmlspecialchars($issue['id']) ?>">
                                <textarea id="new-comment" name="comment" class="form-control mb-2" rows="3" placeholder="Write your comment here..." required></textarea>
                                <button type="submit" id="send-comment" class="btn btn-primary w-100">Submit</button>
                            </form>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Commentar -->
<form id="edit-comment-form" method="post">
    <div class="modal fade" id="editCommentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-comment-id" name="comment_id">
                    <textarea id="edit-comment-text" name="comment" class="form-control" rows="6"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="save-comment" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal Delete Commentar -->

<div class="modal fade" id="deleteCommentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="delete-comment-form" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this comment?</p>
                    <input type="hidden" id="delete-comment-id" name="comment_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>




<?= $this->endSection() ?>

<?= $this->section('footer-script') ?>
<?php include(__DIR__ . '/../../scripts/detail_issue-script.php'); ?>
<?= $this->endSection() ?>