<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link rel="shortcut icon" type="image/jpg" href="assets/images/logo.jpg" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script>
    function onSubmit() {
      document.getElementById("loginForm").submit();
    }
  </script> -->
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-6 col-xxl-6">
            <div class="card">
              <div class="card-body d-md-flex flex-md-row flex-column align-items-center justify-content-evenly">
                <div class="col-12 col-md-5 text-center mb-3 mb-md-0">
                  <a href="#" class="text-nowrap logo-img d-block py-3">
                    <img src="assets/images/logo.jpg" width="180" alt="Logo">
                  </a>
                </div>
                <div class="col-12 col-md-7">
                  <h3 class="text-center text-md-start">Login</h3>
                  <p class="text-center text-md-start">Please login with registered account.</p>
                  <form action="login" method="post" id="loginForm">
                    <?= csrf_field() ?>
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="identity" id="floatingInput" placeholder="name@example.com">
                      <label for="floatingInput">Email or Username</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                      <label for="floatingPassword">Password</label>
                    </div>
                    <?php if (session()->has('error')) : ?>
                      <div class="error-message alert alert-danger" role="alert">
                        <?= session('error') ?>
                      </div>
                    <?php endif; ?>
                    <button class="btn btn-primary w-100 py-2 fs-5 mb-2 rounded-2" type="submit">Login</button>
                    <p class="text-center">Don't have an account? <a href="register">Register here.</a></p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

<script>
  // function submitForm(params) {
  //   document.getElementById('loginForm').submit();
  // }
</script>

</html>