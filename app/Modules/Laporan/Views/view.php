<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<div class="viewData">
	<?= $this->include('App\Modules\Laporan\Views/data'); ?>
</div>
<div class="viewModal"></div>

<?= $this->endSection(); ?>
