<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>YBG | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('LTE') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('LTE') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('LTE') ?>/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="bg-overlay"></div>
<div class="login-box">
    <div class="login-logo">
      <a href="https://www.ybg.co.id/">
        <span id="typewriter"></span>
      </a>
    </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <?php if ($this->session->flashdata('error')): ?>
        <p style="color: red;"> <?= $this->session->flashdata('error'); ?> </p>
    <?php endif; ?>

    <form action="<?= site_url('login/authenticate'); ?>" method="post" >
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Username" id="Username" name="username" required>
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
      </div>
      <div class="input-group mb-3">
        <input type="password" class="form-control" placeholder="Password" id="Password" name="password" required>
        <div class="input-group-append">
          <div class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
            <span id="togglePasswordIcon" class="fas fa-eye"></span>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-8">
        </div>
        <div class="col-4">
          <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </div>
      </div>
    </form>



   
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url('LTE') ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('LTE') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('LTE') ?>dist/js/adminlte.min.js"></script>
<script>
  function togglePassword() {
    var passwordInput = document.getElementById("Password");
    var icon = document.getElementById("togglePasswordIcon");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      passwordInput.type = "password";
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
  }

  document.addEventListener("DOMContentLoaded", function () {
  const text = "YBG Login";
  const el = document.getElementById("typewriter");
  let i = 0;

  function typeWriter() {
    if (i < text.length) {
      if (i < 3) {
        // 3 huruf pertama (YBG) berwarna kuning
        el.innerHTML += `<b class="bold-font">${text.charAt(i)}</b>`;
      } else {
        el.innerHTML += text.charAt(i);
      }
      i++;
      setTimeout(typeWriter, 300); // kecepatan ketik
    }
  }

  typeWriter();
});

</script>

</body>
</html>
