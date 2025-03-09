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
            <div class="d-flex justify-content-between mb-2">
                <h5 class="card-title fw-semibold mb-4">Pending Users</h5>
                <form action="<?= site_url('pending-users') ?>" method="GET" class="d-flex gap-2">
                    <input type="text" id="searchInput" name="search" class="form-control rounded-2" placeholder="Search users..." value="<?= esc($search) ?>">
                    <button type="submit" class="btn btn-primary bg-primary rounded-2 fw-semibold">
                        <i class="ti ti-search"></i>
                    </button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle text-center w-100">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Created Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($users)) : ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">Data not found</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($users as $index => $user) : ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= esc($user['name']) ?></td>
                                    <td><?= esc($user['username']) ?></td>
                                    <td><?= esc($user['email']) ?></td>
                                    <td><?= esc($user['created_at']) ?></td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-success btn-sm btn-approve"
                                            data-id="<?= $user['id'] ?>" data-name="<?= $user['name'] ?>">
                                            Approve
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-danger btn-sm btn-reject"
                                            data-id="<?= $user['id'] ?>" data-name="<?= $user['name'] ?>">
                                            Reject
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

<!-- Modal Approve -->
<div class="modal fade" id="approveUserModal" tabindex="-1" aria-labelledby="deleteEventLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" id="approveForm">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <div class="icon round-40 d-flex align-items-center justify-content-center bg-light-danger text-danger me-2 rounded-circle">
                        <i class="ti ti-trash fs-6"></i>
                    </div>
                    <h5 class="modal-title" id="deleteEventLabel">Approve User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0"> Are you sure you want to approve <strong id="approveUserName"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Approve</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Approve -->

<!-- Modal Reject -->
<div class="modal fade" id="rejectUserModal" tabindex="-1" aria-labelledby="deleteEventLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" id="rejectForm">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <div class="icon round-40 d-flex align-items-center justify-content-center bg-light-danger text-danger me-2 rounded-circle">
                        <i class="ti ti-trash fs-6"></i>
                    </div>
                    <h5 class="modal-title" id="deleteEventLabel">Reject User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0"> Are you sure you want to reject <strong id="rejectUserName"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Reject -->

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
<?php include(__DIR__ . '/../../scripts/pending_users-script.php'); ?>
<?= $this->endSection() ?>