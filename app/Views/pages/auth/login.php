<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link rel="shortcut icon" type="image/jpg" href="assets/images/icon.jpg" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script>
    function onSubmit() {
      document.getElementById("loginForm").submit();
    }
  </script>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="assets/images/logo-mi.png" width="180" alt="">
                </a>
                <p class="text-center">Event - Content Management System</p>
                <form action="auth" method="post" id="loginForm">
                  <?= csrf_field() ?>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="username" required>
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                  </div>
                  <!-- <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remeber this Device
                      </label>
                    </div>
                    <a class="text-primary fw-bold" href="#">Forgot Password ?</a>
                  </div> -->
                  <?php if (session()->has('error')) : ?>
                    <div class="error-message alert alert-danger hide" role="alert">
                      <?= session('error') ?>
                    </div>
                  <?php endif; ?>
                  <button class="g-recaptcha btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" data-sitekey="6LfDcj4pAAAAAGBdAbGUbl-_Fe8eZqggIhHm4Qxx" data-callback="onSubmit">Login</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<script>
  function submitForm(params) {
    document.getElementById('loginForm').submit();
  }
</script>

</html>