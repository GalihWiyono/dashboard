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

<div class="container mt-4">
    <h2 class="mb-4">Dashboard</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Issues</h5>
                    <p class="card-text display-4" id="issueCount">0</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Comments</h5>
                    <p class="card-text display-4" id="commentCount">0</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text display-4" id="userCount">0</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-8">
            <div id="container-chart"></div>
        </div>
    </div>
</div>

<!-- <div class="row">
    <div id="container-pendaftaran" class="highcharts-light col-6"></div>
    <div id="container-peserta" class="highcharts-light col-6"></div>
</div>

<div id="container-total-penjualan" class="highcharts-light"></div> -->

<?= $this->endSection() ?>

<?= $this->section('footer-script') ?>
<?php include(__DIR__ . '/../scripts/dashboard-script.php'); ?>
<?= $this->endSection() ?>