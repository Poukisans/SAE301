<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Connexion | <?=SITE_NAME?></title>
  <base href="<?=BASE_URL?>admin/">

  <meta name="robots" content="noindex, nofollow, noimageindex, nosnippet">

  <link rel="icon" type="image/png" href="./dist/favicon/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="./dist/favicon/favicon.svg" />
  <link rel="shortcut icon" href="./dist/favicon/favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="./dist/favicon/apple-touch-icon.png" />
  <meta name="apple-mobile-web-app-title" content="Panel | <?=SITE_NAME?>" />
  <link rel="manifest" href="./dist/favicon/site.webmanifest" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="../"><img src="dist/img/logo_mezzanotte34.svg" alt=""></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">

        <form action="login" method="post">
          <div class="input-group mb-3">
            <input type="text" name="pseudo" class="form-control" placeholder="Identifiant">
            <div class="input-group-append">
              <div class="input-group-text">
                <i class="fas fa-at"></i>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Mot de passe">
            <div class="input-group-append">
              <div class="input-group-text">
                <i class="fas fa-ellipsis-h"></i>
              </div>
            </div>
          </div>
          <div class="row">
            <button type="submit" class="btn btn-success btn-block">Connexion</button>
          </div>
          <div class="row d-flex align-items-center">
            <?php
            if (isset($this->error)) {
              echo "<p>" . $this->error . "</p>";
            }
            ?>
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>