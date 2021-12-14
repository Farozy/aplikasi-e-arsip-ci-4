<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<style>
	.select2-selection__rendered {
	    line-height: 31px !important;
	}
	.select2-container .select2-selection--single {
	    height: 40px !important;
	}
	.select2-selection__arrow {
	    height: 40px !important;
	}

	#pengirim {
		width: 100%;
	}
</style>
<div class="container">
	<div class="card">
		<div class="card-header">
			<div class="card-title h2 font-weight-bold"><?= $title; ?></div>
		</div>
		<?= form_open('laporan/get_masuk', ['class' => 'formMasuk']) ?>
		<div class="card-body">
			<div class="container">
				<div class="row bg-info text-light py-2 rounded">
					<div class="col">
						<div class="font-weight-bold align-middle"><i class="fas fa-file"></i> Laporan <?= strtolower($title); ?></div>
					</div>
				</div>
				<div class="row justify-content-md-center">
					<div class="col-md-auto">
						<div class="form-inline mt-3">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend" data-toggle="datetimepicker" data-target="#dari_tanggal" id="dTanggal">
										<span class="input-group-text" id="basic-addon2"><i class="fas fa-calendar"></i></span>
									</div>
									<input type="text" id="dari_tanggal" class="form-control datetimepicker-input" autocomplete="off" name="dari_tanggal" style="height: 38px" placeholder="Dari Tanggal" required oninvalid="this.setCustomValidity('Dari tanggal belum dipilih')" oninput="setCustomValidity('')">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-auto">
						<div class="form-inline mt-3">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend" data-toggle="datetimepicker" data-target="#sampai_tanggal" id="sTanggal">
										<span class="input-group-text" id="basic-addon2"><i class="fas fa-calendar-alt"></i></span>
									</div>
									<input type="text" id="sampai_tanggal" class="form-control datetimepicker-input" autocomplete="off" name="sampai_tanggal" style="height: 38px" placeholder="Sampai Tanggal" required oninvalid="this.setCustomValidity('Sampai tanggal belum dipilih')" oninput="setCustomValidity('')">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-auto">
						<div class="form-inline mt-3">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
									</div>
									<select name="pengirim" id="pengirim" class="form-control select2">
										<option selected></option>
										<?php foreach( $unit as $un ) : ?>
											<option value="<?= $un['id_unit_kerja']; ?>"><?= ucwords($un['nama_unit_kerja']); ?></option>
										<?php endforeach; ?>
									</select>
									<div class="errorpengirim">
										<div class="small pl-1 text-danger errorPengirim"></div>
									</div>
								</div>
							</div>
							<div class="form-group ml-3" id="getMasuk">
								<button class="btn btn-primary" id="get_masuk" data-toggle="tooltip" title="Proses"><i class="fas fa-search"></i></button>
							</div>
							<div class="form-group ml-3" id="cetakMasuk">
								<button class="btn btn-primary" id="cetakPemasukan" data-toggle="tooltip" title="Print"><i class="fas fa-print"></i></button>
							</div>
							<div class="form-group ml-2" id="excelMasuk">
								<a href="<?= base_url('laporan/export_masuk'); ?>" target="_blank" data-toggle="tooltip" class="btn btn-success" id="exportExcel" title="Export Surat Masuk"><i class="fas fa-file-excel"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="showMasuk"></div>
		<?= form_close(); ?>
	</div>
</div>

<script>
	$(function() {
		$('[data-toggle="tooltip"]').tooltip();
		$('#excelMasuk').hide();
		$('#cetakMasuk').hide();

		$('#dari_tanggal').datetimepicker({
			format: "DD-MM-YYYY",
			useCurrent: false
		})

		$('.fa-calendar').click(function() {
			$('#dari_tanggal').datetimepicker('show')
		})

		$('#sampai_tanggal').datetimepicker({
			format: "DD-MM-YYYY",
			useCurrent: false
		})

		$('.fa-calendar-alt').click(function() {
			$('#sampai_tanggal').datetimepicker('show')
		})

		$('.select2').select2({
			placeholder: "Semua Unit Kerja / Bagian",
			tags: true,
			allowClear: true,
		})

		$('.formMasuk').submit(function() {
			$('#getMasuk').show();
			$('#excelMasuk').show();
			$.ajax({
				url: $(this).attr('action'),
				type: 'post',
				data: $(this).serialize(),
				dataType: 'json',
				beforeSend: function() {
					$('#get_masuk').html('<i class="fas fa-circle-notch fa-spin"></i>');
				},
				complete: function() {
					$('#get_masuk').html('<i class="fas fa-search"></i>');
				},
				success: function(response) {
					$('.showMasuk').html(response.data)
				},
				error: function( xhr, ajaxOptions, thrownError ) {
					alert( xhr.status + "\n" + xhr.responseText + "\n" + thrownError );
				}
			})
			return false;
		})
	})
</script>

<?= $this->endSection(); ?>
