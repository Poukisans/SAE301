<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel | <?= SITE_NAME ?></title>
  <base href="<?= BASE_URL ?>admin/">

  <meta name="robots" content="noindex, nofollow, noimageindex, nosnippet">

  <link rel="icon" type="image/png" href="dist/favicon/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="dist/favicon/favicon.svg" />
  <link rel="shortcut icon" href="dist/favicon/favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="./dist/favicon/apple-touch-icon.png" />
  <meta name="apple-mobile-web-app-title" content="Panel | <?= SITE_NAME ?>" />
  <link rel="manifest" href="dist/favicon/site.webmanifest" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <!-- DataTable -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap4.min.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">

  <?php
  if (isset($_SESSION['successMsg'])) {
  ?>
    <div class="alert alert-success alert-dismissible fade show position-fixed m-3 elevation-3" role="alert" style="z-index:2000; right:0%;">
      <?= $_SESSION['successMsg'] ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php
    unset($_SESSION['successMsg']);
  }

  if (isset($_SESSION['errorMsg'])) {
  ?>
    <div class="alert alert-danger alert-dismissible fade show position-fixed m-3 elevation-3" role="alert" style="z-index:2000; right:0%;">
      <?= $_SESSION['errorMsg'] ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php
    unset($_SESSION['errorMsg']);
  }

  if (isset($_SESSION['warnMsg'])) {
  ?>
    <div class="alert alert-warning alert-dismissible fade show position-fixed m-3 elevation-3" role="alert" style="z-index:2000; right:0%;">
      <?= $_SESSION['warnMsg'] ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php
    unset($_SESSION['warnMsg']);
  }
  ?>

  <div class="wrapper d-flex flex-column">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light flex-column pt-3 position-sticky fixed-top">
      <div class="d-flex container-fluid flex-row w-100 justify-content-between align-items-center flex-wrap px-2" style="gap: 20px;">
        <ol class="breadcrumb float-sm-right m-0 align-items-center justify-content-start flex-grow-0">
          <li class="mr-2">
            <a class="nav-link btn btn-light" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="breadcrumb-item"><b><a href="./">Accueil</a></b></li>
          <?php
          if (!empty($currentPage)) {
          ?>
            <li class="breadcrumb-item active"><?= $currentPage ?></li>
          <?php
          }
          ?>
        </ol>
        <div class="d-flex flex-row justify-content-end flex-grow-0">
          <a class="btn btn-outline-danger" href="./logout" role="button">Déconnexion &nbsp; <i class="fas fa-sign-out-alt"></i></a>
        </div>
      </div>

      <!-- Content Header (Page header) -->
      <div class="content-header w-100 py-4">
        <div class="container-fluid d-flex ">
          <h1 class="m-0"><b>
              <?php
              if (!empty($currentPage)) {
              ?>
                <?= $currentPage ?>
              <?php
              } else {
                echo "Accueil";
              }
              ?>
            </b>
          </h1>
        </div>
      </div>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary">
      <!-- Brand Logo -->
      <a href="./" class="brand-link">
        <img src="dist/img/logo_mini.svg" alt="e-Birbone Logo" class="brand-image">
        <span class="brand-text font-weight-light">e-Birbone</span>
      </a>


      <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info d-flex justify-space-between">
            <a href="./user" class="d-block"><i class="fas fa-user-cog"></i>&nbsp;&nbsp;
              <?= $_SESSION['prenom'] ?> <?= $_SESSION['nom'] ?></a>
          </div>
        </div>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <!-- article -->
            <li class="nav-item">
              <a href="./articles" class="nav-link <?= $currentContent == "article" ? "active" : "" ?>">
                <i class="fas fa-tshirt nav-icon"></i>
                <p>Articles</p>
              </a>
            </li>

            <!-- promotion -->
            <li class="nav-item">
              <a href="./promotions" class="nav-link <?= $currentContent == "promotion" ? "active" : "" ?>">
                <i class="fas fa-tags nav-icon"></i>
                <p>Promotions</p>
              </a>
            </li>

            <!-- commande -->
            <li class="nav-item pb-3">
              <a href="./commandes" class="nav-link <?= $currentContent == "commande" ? "active" : "" ?>">
                <i class="fas fa-truck-loading nav-icon"></i>
                <p class=" ">Commandes &nbsp;<span class="badge badge-warning p-2"><?= count($layoutContent['commandLeft']) >= 1 ? count($layoutContent['commandLeft']) : "" ?></span></p>
              </a>
            </li>

            <!-- general -->
            <li class="nav-item border-top border-dark pt-3">
              <a href="./general" class="nav-link <?= $currentContent == "general" ? "active" : "" ?>">
                <i class="fas fa-cog nav-icon"></i>
                <p>Général</p>
              </a>
            </li>

            <!-- sections -->
            <li class="nav-item">
              <a href="./sections" class="nav-link <?= $currentContent == "section" ? "active" : "" ?>">
                <i class="fas fa-window-maximize nav-icon"></i>
                <p>Sections</p>
              </a>
            </li>

            <!-- Réseaux sociaux -->
            <li class="nav-item">
              <a href="./reseaux" class="nav-link <?= $currentContent == "reseaux" ? "active" : "" ?>">
                <i class="fas fa-hashtag nav-icon"></i>
                <p>Réseaux sociaux</p>
              </a>
            </li>

            <!-- FAQ -->
            <li class="nav-item">
              <a href="./faq" class="nav-link <?= $currentContent == "faq" ? "active" : "" ?>">
                <i class="fas fa-question nav-icon"></i>
                <p>F.A.Q</p>
              </a>
            </li>

            <!-- Contact -->
            <li class="nav-item">
              <a href="./contact" class="nav-link <?= $currentContent == "contact" ? "active" : "" ?>">
                <i class="fas fa-phone-alt nav-icon"></i>
                <p>Contact</p>
              </a>
            </li>

            <!-- Mentions legales -->
            <li class="nav-item">
              <a href="./mentions-legales" class="nav-link <?= $currentContent == "mentions-legales" ? "active" : "" ?>">
                <i class="fas fa-balance-scale nav-icon"></i>
                <p>Mentions Legales</p>
              </a>
            </li>

          </ul>
        </nav>
      </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper overflow-auto px-1">

      <?= $content ?>

    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <strong>© <?= SITE_NAME ?></strong> Tous droits réservés.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap4.min.js"></script>

  <!-- Show file name for Inputs Files -->
  <script>
    document.querySelectorAll('.custom-file-input').forEach(function(input) {
      input.addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
      });
    });
  </script>


  <!-- Auto-hide alerts -->
  <script>
    // Fait disparaître les alertes success et warning après 2 secondes
    setTimeout(() => {
      $('.alert-success, .alert-warning').alert('close');
    }, 2500);
  </script>

  <!-- Retour au formulaire -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Sélectionner tous les formulaires sur la page
      const forms = document.querySelectorAll("form");

      forms.forEach(form => {
        // Ajouter un événement submit à chaque formulaire
        form.addEventListener("submit", function() {
          // Sauvegarder la position actuelle de scroll avant l'envoi du formulaire
          localStorage.setItem("scrollPosition", window.scrollY);
        });

        // Vérifier si le formulaire a un champ de type "checkbox" avec un onchange pour auto-submit
        const checkbox = form.querySelector('input[type="checkbox"][onchange="this.form.submit()"]');
        if (checkbox) {
          checkbox.addEventListener("change", function() {
            // Sauvegarder la position actuelle de scroll avant l'envoi du formulaire par changement
            localStorage.setItem("scrollPosition", window.scrollY);
          });
        }
      });

      // Restaurer la position de scroll lors du chargement de la page
      const scrollPosition = localStorage.getItem("scrollPosition");
      if (scrollPosition) {
        window.scrollTo(0, scrollPosition);
        localStorage.removeItem("scrollPosition"); // Supprimer après utilisation
      }
    });
  </script>




  <!-- Page specific script -->
  <script>
    $(function() {
      // Summernote
      $('.summernote').summernote({
        toolbar: [
          // [groupName, [list of button]]
          ['style', ['bold', 'italic', 'underline', 'paragraph']],
          ['clear', ['clear']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['order', ['ul', 'ol', 'table']],
          ['height', ['height']],
          ['media', ['link', 'video', 'hr']],
          ['misc', ['codeview', 'fullscreen']]
        ]
      });
    })
  </script>

  <script>
    $(function() {
      $("#table").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#commande_wrapper .col-md-6:eq(0)');
    });
  </script>

</html>