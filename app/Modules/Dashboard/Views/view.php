<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<div class="viewData">
	<?= $this->include('App\Modules\Dashboard/Views/adminn'); ?>
</div>
<div class="viewModal"></div>

<?= $this->endSection(); ?>
