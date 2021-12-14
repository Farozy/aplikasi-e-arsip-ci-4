<?= $this->include('layout/header'); ?>

<?= $this->include('layout/navbar'); ?>

<?= $this->include('layout/sidebar'); ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php if( $title == 'dashboard' ) : ?>
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?= count($jenis); ?></h3>

                  <p>Jenis Dokumen</p>
                </div>
                <div class="icon">
                  <i class="far fa-folder-open"></i>
                </div>
                <a href="javascript:void(0)" class="small-box-footer">Total Jenis Dokumen</a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?= count($dok); ?></h3>

                  <p>Dokumen</p>
                </div>
                <div class="icon">
                  <i class="far fa-folder"></i>
                </div>
                <a href="javascript:void(0)" class="small-box-footer">Total Dokumen</a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?= count($masuk); ?></h3>

                  <p>Surat Masuk</p>
                </div>
                <div class="icon">
                  <i class="far fa-envelope"></i>
                </div>
                <a href="javascript:void(0)" class="small-box-footer">Total Surat Masuk</a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>
                    <?= count($keluar); ?>
                  </h3>
                  <p>Surat Keluar</p>
                </div>
                <div class="icon">
                  <i class="far fa-envelope-open"></i>
                </div>
                <a href="#" class="small-box-footer">Total Surat Keluar</a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <?= $this->renderSection('content'); ?>
        <?php else: ?>
          <?= $this->renderSection('content'); ?>
        <?php endif; ?>
      </div>
    </section>
    <!-- /.content -->

 <?= $this->include('layout/footer'); ?>
