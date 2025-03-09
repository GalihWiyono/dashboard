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
                <h5 class="card-title fw-semibold mb-4">All Users</h5>
                <form action="<?= site_url('users') ?>" method="GET" class="d-flex gap-2">
                    <input type="text" id="searchInput" name="search" class="form-control rounded-2" placeholder="Search users..." value="<?= esc($search) ?>">
                    <button type="submit" class="btn btn-primary bg-primary rounded-2 fw-semibold">
                        <i class="ti ti-search"></i>
                    </button>
                </form>
                <!-- <button type="button" class="btn btn-primary bg-primary rounded-3 fw-semibold" data-bs-toggle="modal" data-bs-target="#tambahEventModal"><i class="ti ti-search"></i></button> -->
            </div>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle text-center w-100">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
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
                                    <td><?= esc($user['role']) ?></td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm btn-edit" data-id="<?= $user['id'] ?>">Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $user['id'] ?>" data-name="<?= $user['name'] ?>">Delete</a>
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

<!-- Modal Tambah -->
<!-- <div class="modal fade" id="tambahEventModal" tabindex="-1" aria-labelledby="tambahEventLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= base_url('users') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahEventLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input class="form-control" name="name" id="name" type="text" placeholder="Name" />
                        <label for="ID">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" name="username" id="username" type="text" placeholder="Username" />
                        <label for="ID">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" name="email" id="email" type="email" placeholder="Email" />
                        <label for="ID">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" name="password" id="password" type="password" placeholder="Password" />
                        <label for="ID">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="status" id="status_edit" required>
                            <option value="approved">Approved</option>
                            <option value="pending">Pending</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        <label for="status">Approval Status</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
<!-- Modal Tambah -->

<!-- Modal Edit -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editEventLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" id="editForm">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="editEventLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="form-floating mb-3">
                        <input class="form-control" name="name" id="edit-name" type="text" placeholder="nama" />
                        <label for="ID">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" name="username" id="edit-username" type="text" placeholder="username" />
                        <label for="ID">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" name="email" id="edit-email" type="email" placeholder="email" />
                        <label for="ID">Email</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit -->

<!-- Modal Delete -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteEventLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" id="deleteForm">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <div class="icon round-40 d-flex align-items-center justify-content-center bg-light-danger text-danger me-2 rounded-circle">
                        <i class="ti ti-trash fs-6"></i>
                    </div>
                    <h5 class="modal-title" id="deleteEventLabel">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0"> Are you sure you want to delete <strong id="deleteUserName"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Delete -->

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
<?php include(__DIR__ . '/../../scripts/users-script.php'); ?>
<?= $this->endSection() ?>