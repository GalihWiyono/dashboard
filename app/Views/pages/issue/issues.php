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

<div class="col-lg d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="row align-items-center mb-3">
                <div class="col-12 col-md-auto flex-grow-1">
                    <h5 class="card-title fw-semibold mb-0">All Issues</h5>
                </div>
                <div class="col-12 col-md-auto">
                    <a href="<?= site_url('issue/create') ?>" class="btn btn-secondary rounded-2 fw-semibold">
                        <i class="ti ti-plus"></i> Add Issue
                    </a>
                </div>
                <div class="col-12 col-md-auto">
                    <form action="<?= site_url('issue') ?>" method="GET" class="row gx-2 align-items-center">
                        <div class="col mt-2 mt-md-0">
                            <input type="text" id="searchInput" name="search" class="form-control rounded-2"
                                placeholder="Search issue..." value="<?= esc($search) ?>">
                        </div>
                        <div class="col-auto mt-2 mt-md-0">
                            <button type="submit" class="btn btn-primary rounded-2 fw-semibold">
                                <i class="ti ti-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>


            <?php $session = session(); ?>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle text-center w-100">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Message</th>
                            <th>Issue</th>
                            <?php if ($session->get('role') === 'admin') : ?>
                                <th>User</th>
                            <?php endif; ?>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($issues)) : ?>
                            <tr>
                                <td colspan="<?= $session->get('role') === 'Admin' ? 6 : 5 ?>" class="text-center text-muted">Data not found</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($issues as $index => $issue) : ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= esc($issue['title']) ?></td>
                                    <td><?= esc($issue['message']) ?></td>
                                    <td><?= esc($issue['issue']) ?></td>
                                    <?php if ($session->get('role') === 'Admin') : ?>
                                        <td><?= esc($issue['name']) ?></td>
                                    <?php endif; ?>
                                    <td>
                                        <a href="<?= site_url('issue/detail/' . $issue['id']) ?>" class="btn btn-success btn-sm">
                                            Detail
                                        </a>
                                        <a href="<?= site_url('issue/edit/' . $issue['id']) ?>" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>


            <div class="d-flex justify-content-end mt-3">
                <?= $pager->links('users', 'bootstrap5') ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Issue -->
<div class="modal fade" id="detailIssueModal" tabindex="-1" aria-labelledby="detailIssueModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon round-40 d-flex align-items-center justify-content-center bg-light-danger text-danger me-2 rounded-circle">
                    <i class="ti ti-trash fs-6"></i>
                </div>
                <h5 class="modal-title" id="addIssueModal">Detail Issue</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <!-- Bagian Kiri: Data Issue -->
                    <div class="col-lg-7">
                        <div class="form-floating mb-3">
                            <input class="form-control" name="title" id="detail-title" type="text" placeholder="Title" />
                            <label for="detail-title">Title</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="message" id="detail-message" placeholder="Message"></textarea>
                            <label for="detail-message">Message</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="issue" id="detail-issue" placeholder="Issue"></textarea>
                            <label for="detail-issue">Issue</label>
                        </div>

                        <?php if ($session->get('role') === 'Admin') : ?>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="user" id="detail-user" type="text" placeholder="User">
                                <label for="detail-user">User</label>
                            </div>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Photo</label>
                                <div class="w-100" style="height: 250px; overflow: hidden;">
                                    <img id="detail-photo" src="" class="img-fluid rounded w-100 h-100"
                                        style="object-fit: cover; display: none;">
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Video</label>
                                <video id="detail-video" class="w-100 rounded" controls style="display: none; height: 250px;">
                                    <source src="" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
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
                        <h5 class="fw-bold">Komentar</h5>
                        <div id="comment-section" class="border rounded p-3" style="height: 500px; overflow-y: auto;">
                            <!-- Tempat menampilkan komentar -->
                        </div>

                        <div class="mt-3">
                            <textarea id="new-comment" class="form-control mb-2" rows="2" placeholder="Tulis komentar..."></textarea>
                            <button id="send-comment" class="btn btn-primary w-100">Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Issue -->

<!-- Modal Error -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0" id="errorMessage">Error Message</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Error -->

<?= $this->endSection() ?>

<?= $this->section('footer-script') ?>
<?php include(__DIR__ . '/../../scripts/issues-script.php'); ?>
<?= $this->endSection() ?>