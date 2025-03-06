<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link rel="shortcut icon" type="image/jpg" href="assets/images/icon.jpg" />
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
          <div class="col-md-10 col-lg-8 col-xxl-6">
            <div class="card mb-0">
              <div class="card-body d-flex flex-column flex-md-row align-items-center justify-content-evenly">
                <div class="col-12 col-md-5 text-center mb-4 mb-md-0">
                  <a href="#" class="text-nowrap logo-img d-block py-3">
                    <img src="assets/images/logo.jpg" width="180" alt="Logo">
                  </a>
                </div>
                <div class="col-12 col-md-7">
                  <h3 class="text-center text-md-start">Register</h3>
                  <p class="text-center text-md-start">Please register to access this website.</p>
                  <form action="register" method="post" id="registerForm">
                    <?= csrf_field() ?>
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="name" id="floatingName" placeholder="Your Name">
                      <label for="floatingName">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="username" id="floatingUsername" placeholder="Username">
                      <label for="floatingUsername">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="email" class="form-control" name="email" id="floatingEmail" placeholder="name@example.com">
                      <label for="floatingEmail">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                      <label for="floatingPassword">Password</label>
                    </div>
                    <?php if (session()->has('error') || session()->has('success')) : ?>
                      <div class="alert <?= session()->has('error') ? 'alert-danger' : 'alert-primary' ?>" role="alert">
                        <?= session('error') ?? session('success') ?>
                      </div>
                    <?php endif; ?>
                    <button class="btn btn-primary w-100 py-2 fs-5 mb-2 rounded-2" type="submit">Register</button>
                    <p class="text-center">Already have an account? <a href="/">Login here.</a></p>
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