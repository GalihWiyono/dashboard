<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link rel="shortcut icon" type="image/jpg" href="<?= base_url('assets/images/logos/favicon.jpg') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/styles.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/datatables.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/highcharts.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/datagrid.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/dashboards.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/select2.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
  <meta name="csrf-token" content="<?= csrf_hash() ?>">
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

    <!-- Sidebar Start -->
    <?php include('sidebar.php'); ?>
    <!--  Sidebar End -->

    <!--  Main wrapper -->
    <div class="body-wrapper">

      <!--  Header Start -->
      <?php include('header.php'); ?>
      <!--  Header End -->

      <!--  Body -->
      <div class="container-fluid">
        <?= $this->renderSection('content') ?>
      </div>
      <!--  Body End -->

    </div>
  </div>
  <script src="<?= base_url('assets/libs/jquery/dist/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/sidebarmenu.js') ?>"></script>
  <script src="<?= base_url('assets/js/app.min.js') ?>"></script>
  <script src="<?= base_url('assets/libs/apexcharts/dist/apexcharts.min.js') ?>"></script>
  <script src="<?= base_url('assets/libs/simplebar/dist/simplebar.js') ?>"></script>
  <script src="<?= base_url('assets/js/dashboard.js') ?>"></script>
  <script src="<?= base_url('assets/js/datatables.js') ?>"></script>
  <script src="<?= base_url('assets/js/dashboards.src.js') ?>"></script>
  <script src="<?= base_url('assets/js/highcharts.src.js') ?>"></script>
  <script src="<?= base_url('assets/js/accessibility.src.js') ?>"></script>
  <script src="<?= base_url('assets/js/dashboards-plugin.src.js') ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
  <!-- <script src="<?= base_url('assets/js/select2.full.js') ?>"></script> -->
  <?= $this->renderSection('footer-script') ?>
</body>

</html>