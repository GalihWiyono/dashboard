<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?= session()->getFlashdata('error') ?>

<div class="row">
    <div id="container-pendaftaran" class="highcharts-light col-6"></div>
    <div id="container-peserta" class="highcharts-light col-6"></div>
</div>

<div id="container-total-penjualan" class="highcharts-light"></div>

<?= $this->endSection() ?>

<?= $this->section('footer-script') ?>
<?php include(__DIR__ . '/../scripts/dashboard-script.php'); ?>
<?= $this->endSection() ?>