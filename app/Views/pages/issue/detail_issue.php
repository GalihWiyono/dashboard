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

                        <?php if ($session->get('role') === 'admin') : ?>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="user" id="detail-user" value="<?= $issue['user'] ?>" type="text" placeholder="User">
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
                                    <div class="fw-semibold"><?= htmlspecialchars($comment['name']) ?></div>
                                    <div class="text-muted small"><?= date('H:i', strtotime($comment['created_at'])) ?></div>
                                    <p class="mb-0"><?= nl2br(htmlspecialchars($comment['message'])) ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <?php if ($session->get('role') === 'Admin') : ?>
                            <div class="mt-3">
                                <textarea id="new-comment" class="form-control mb-2" rows="2" placeholder="Tulis komentar..."></textarea>
                                <button id="send-comment" class="btn btn-primary w-100">Kirim</button>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>




<?= $this->endSection() ?>

<?= $this->section('footer-script') ?>
<?php include(__DIR__ . '/../../scripts/detail_issue-script.php'); ?>
<?= $this->endSection() ?>