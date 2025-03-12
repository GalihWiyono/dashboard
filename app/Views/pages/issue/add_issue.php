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
            <div class="row align-items-center  mb-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title fw-semibold mb-0">Add Issue</h5>
                    <a href="<?= site_url('issue') ?>" class="btn btn-secondary rounded-2 fw-semibold">
                        <i class="ti ti-arrow-left"></i> Back
                    </a>
                </div>

                <form action="<?= site_url('issue/store') ?>" method="POST" enctype="multipart/form-data" id="issueForm">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Title</label>
                        <input type="text" id="title" name="title" class="form-control" value="<?= old('title') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label fw-semibold">Message</label>
                        <textarea id="message" name="message" class="form-control" rows="3" required><?= old('message') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="issue" class="form-label fw-semibold">Issue</label>
                        <textarea id="issue" name="issue" class="form-control" rows="3" required><?= old('issue') ?></textarea>
                    </div>

                    <!-- Upload Photo -->
                    <div class="mb-3">
                        <label for="photo" class="form-label fw-semibold">Photo</label>
                        <input type="file" id="photo" name="photo" class="form-control" accept="image/*" onchange="previewImage(event)">
                        <div id="photoPreviewContainer" class="mt-2" style="display: none;">
                            <img id="photoPreview" src="" alt="Photo Preview" class="img-thumbnail" style="max-width: 250px;">
                        </div>
                    </div>

                    <!-- Upload Video -->
                    <div class="mb-3">
                        <label for="video" class="form-label fw-semibold">Video</label>
                        <input type="file" id="video" name="video" class="form-control" accept="video/*" onchange="previewVideo(event)">
                        <div id="videoPreviewContainer" class="mt-2" style="display: none;">
                            <video id="videoPreview" controls style="height: auto;">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>

                    <!-- Input Hidden untuk Latitude & Longitude -->
                    <input type="hidden" id="latitude" name="latitude" value="<?= old('latitude') ?>">
                    <input type="hidden" id="longitude" name="longitude" value="<?= old('longitude') ?>">

                    <div class="d-flex justify-content-end">
                        <a href="<?= site_url('issue') ?>" class="btn btn-light ms-2 me-2 fw-semibold">Cancel</a>
                        <button type="submit" id="submitBtn" class="btn btn-primary fw-semibold" disabled>
                            <i class="ti ti-save"></i> Submit
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="locationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="red" class="me-2">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M17 3.34a10 10 0 1 1 -15 8.66l.005 -.324a10 10 0 0 1 14.995 -8.336m-5 11.66a1 1 0 0 0 -1 1v.01a1 1 0 0 0 2 0v-.01a1 1 0 0 0 -1 -1m0 -7a1 1 0 0 0 -1 1v4a1 1 0 0 0 2 0v-4a1 1 0 0 0 -1 -1" />
                    </svg>
                    Location Required
                </h5>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <p>Untuk mengisi form ini, Anda harus mengaktifkan lokasi. Ikuti langkah-langkah berikut sesuai dengan perangkat yang Anda gunakan:</p>

                <h6 class="fw-semibold mt-3">📱 Android (Chrome)</h6>
                <ul>
                    <li>Buka <strong>Setelan</strong> di perangkat Anda.</li>
                    <li>Pilih <strong>Lokasi</strong> dan pastikan dalam keadaan aktif.</li>
                    <li>Buka <strong>Chrome</strong>, ketuk ikon <i class="ti ti-dots"></i> (titik tiga) di kanan atas.</li>
                    <li>Pilih <strong>Setelan</strong> > <strong>Situs</strong> > <strong>Lokasi</strong>.</li>
                    <li>Pastikan izin lokasi diaktifkan untuk situs ini.</li>
                </ul>

                <h6 class="fw-semibold mt-3">🍏 iPhone (Safari)</h6>
                <ul>
                    <li>Buka <strong>Pengaturan</strong> di iPhone Anda.</li>
                    <li>Gulir ke bawah dan pilih <strong>Safari</strong>.</li>
                    <li>Pilih <strong>Lokasi</strong> dan setel ke <strong>Selalu Izinkan</strong> atau <strong>Minta Setiap Kali</strong>.</li>
                </ul>

                <h6 class="fw-semibold mt-3">🖥️ Laptop/PC (Chrome & Edge)</h6>
                <ul>
                    <li>Klik ikon 🔒 (gembok) di kiri atas bilah alamat.</li>
                    <li>Pilih <strong>Izin Lokasi</strong> dan ubah ke <strong>Izinkan</strong>.</li>
                    <li>Jika tidak ada opsi, buka <strong>chrome://settings/content/location</strong> di Chrome.</li>
                    <li>Tambahkan situs ini ke daftar yang diizinkan.</li>
                </ul>

                <p class="mt-3">Setelah mengaktifkan lokasi, tekan tombol di bawah untuk memuat ulang halaman.</p>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer border-top">
                <button class="btn btn-primary" onclick="window.location.reload()">Refresh</button>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('footer-script') ?>
<?php include(__DIR__ . '/../../scripts/add_issue-script.php'); ?>
<?= $this->endSection() ?>