 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0);" class="brand-link">
      <img src="<?= base_url('public/template/dashboard'); ?>/dist/img/new_log.png" alt="Logo E-Arsip" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light font-weight-bold">
        <h4>E-ARSIP</h4>
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('public/uploads/foto'); ?>/<?= session()->get('foto'); ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="javascript:void(0);" class="d-block">
            <?= ucwords(session()->get('username')); ?>
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="<?= base_url('dashboard'); ?>" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Master Setup
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('jenis'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>Jenis</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('user'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon text-warning"></i>
                  <p>User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('unit_kerja'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon text-secondary"></i>
                  <p>Unit Kerja</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('dokumen'); ?>" class="nav-link">
              <i class="nav-icon fas fa-paste"></i>
              <p>Dokumen <span class="right badge badge-danger">Penting</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-envelope-square"></i>
              <p>
                Surat
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('surat_masuk'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('surat_keluar'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>Keluar</p>
                </a>
              </li>
            </ul>
          </li>
           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('laporan'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon text-info"></i>
                  <p>Download</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('laporan/laporan_masuk'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>Surat Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('laporan/laporan_keluar'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>Surat Keluar</p>
                </a>
              </li>
            </ul>
          </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= ucwords($title); ?></h1>
          </div>
          <!-- /.col -->
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div> -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
