
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= ucwords($title); ?></title>

  <link href="<?= base_url('public/template/dashboard'); ?>/dist/img/favicon.png" rel="shortcut icon" type="image/png">

  <link rel="stylesheet" href="<?= base_url('public/template/dashboard'); ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('public/template/dashboard'); ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('public/template/dashboard'); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('public/template/dashboard'); ?>/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('public/template/dashboard'); ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('public/template/dashboard'); ?>/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('public/template/dashboard'); ?>/plugins/summernote/summernote-bs4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('public/template/dashboard'); ?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url('public/template/dashboard'); ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('public/template/dashboard'); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('public/template/dashboard'); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('public/template/dashboard'); ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <script src="<?= base_url('public/template/dashboard'); ?>/plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url('public/template/dashboard'); ?>/plugins/moment/moment.min.js"></script>
  <script src="<?= base_url('public/library'); ?>/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <script src="<?= base_url('public/template/dashboard'); ?>/plugins/select2/js/select2.full.min.js"></script>
  <script src="<?= base_url('public/template/dashboard'); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="<?= base_url('public/template/dashboard'); ?>/plugins/chart.js/Chart.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('public/template/dashboard'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="<?= base_url('public/template/dashboard'); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('public/template/dashboard'); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url('public/template/dashboard'); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url('public/template/dashboard'); ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url('public/template/dashboard'); ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url('public/template/dashboard'); ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url('public/template/dashboard'); ?>/plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url('public/template/dashboard'); ?>/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url('public/template/dashboard'); ?>/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url('public/template/dashboard'); ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url('public/template/dashboard'); ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url('public/template/dashboard'); ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
    body {
        font-family: 'Roboto', sans-serif;
        font-size: 13px;
    }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <!-- <img class="animation__shake" src="<?= base_url('public/template/dashboard'); ?>/dist/img/preloader.gif" alt="AdminLTELogo" height="60" width="60"> -->
    <img src="<?= base_url('public/template/dashboard'); ?>/dist/img/preloader.gif" alt="Loading...">
  </div>
