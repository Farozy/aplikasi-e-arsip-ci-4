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
</style>
<div class="container">
	<div class="card">
		<div class="card border-primary mb-3">
			<div class="card-header bg-info text-light"><?= $title; ?></div>
			<?= form_open_multipart('dokumen/save', ['class' => 'formSave']); ?>
				<div class="card-body">
					<div class="row">
						<div class="col-md-8 mx-auto">
							<div class="form-group row">
								<label for="jenis_id" class="col-form-label col-md-3 text-right">Jenis Dokumen</label>
								<div class="col-md-8">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="fab fa-elementor"></i></span>
										</div>
										<select name="jenis_id" id="jenis_id" class="form-control select2" style="width: 91%;">
											<option selected></option>
											<?php foreach($jenis as $je) : ?>
												<option value="<?= $je['id_jenis']; ?>"><?= ucwords($je['nama_jenis']); ?></option>
											<?php endforeach; ?>
										</select>
										<div class="errorjenisid">
											<div class="small pl-1 text-danger errorJenisId"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="nama_dokumen" class="col-form-label col-md-3 text-right">Nama Dokumen</label>
								<div class="col-md-8">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="fas fa-file-signature"></i></span>
										</div>
										<input type="text" name="nama_dokumen" id="nama_dokumen" class="form-control" style="width: 90%; height: 38px" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1)" value="<?= old('nama_dokumen'); ?>">
										<div class="errornamadokumen">
											<div class="small pl-1 text-danger errorNamaDokumen"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="dokumen" class="col-form-label col-md-3 text-right">Dokumen</label>
								<div class="col-md-8">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="fas fa-file-archive"></i></span>
										</div>
										<input type="file" name="dokumen" id="dokumen" class="form-control" style="width: 90%; height: 38px" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1)" value="<?= old('dokumen'); ?>">
										<div class="errordokumen">
											<div class="small pl-1 text-danger errorDokumen"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="tahun" class="col-form-label col-md-3 text-right">Tahun</label>
								<div class="col-md-8">
									<div class="input-group date" id="tahun" data-target-input="nearest">
										<div class="input-group-prepend" data-target="#tahun" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
										<input type="text" class="form-control tahun datetimepicker-input" data-target="#tahun" name="tahun" style="width: 90%;"/>
										<div class="errortahun">
											<div class="small pl-1 text-danger errorTahun"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="deskirpsi" class="col-form-label col-md-3 text-right mt-3">Deskirpsi</label>
								<div class="col-md-8">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="fas fa-sticky-note"></i></span>
										</div>
										<textarea name="deskripsi" class="form-control" id="deskripsi" style="width: 90%"></textarea>
										<div class="errordeskripsi">
											<div class="small pl-1 text-danger errorDeskripsi"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="tanggal_upload" class="col-form-label col-md-3 text-right">Tanggal Dokumen</label>
								<div class="col-md-8">
									<div class="input-group date" id="tanggal_upload" data-target-input="nearest">
										<div class="input-group-prepend" data-target="#tanggal_upload" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
										</div>
										<input type="text" class="form-control tanggal_upload datetimepicker-input" data-target="#tanggal_upload" name="tanggal_upload" style="width: 90%;"/>
										<div class="errortanggalupload">
											<div class="small pl-1 text-danger errorTanggalUpload"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group text-center">
								<button class="btn btn-primary" id="simpan">Simpan</button>
								<a href="<?= base_url('dokumen'); ?>" class="btn btn-danger">Batal</a>
							</div>
						</div>
					</div>
				</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>

<script>
	$(function() {
		$('#tahun').datetimepicker({
			format: "YYYY"
		});
		$('.fa-calendar').click(function() {
			$('#tahun').datetimepicker('show')
		})
		$('#tanggal_upload').datetimepicker({
			format: "DD-MM-YYYY"
		});
		$('.fa-calendar-alt').click(function() {
			$('#tanggal_upload').datetimepicker('show')
		})

		$('.select2').select2({
			placeholder: "-- Pilih --",
			tags: true,
			allowClear: true,
		})

		$('.formSave').submit(function() {
			$.ajax({
				url: $(this).attr('action'),
				type: 'post',
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				dataType: 'json',
				beforeSend: function() {
					$('#simpan').html('<i class="fas fa-circle-notch fa-spin"></i>');
				},
				complete: function() {
					$('#simpan').html('Simpan');
				},
				success: function(response) {
					if( response.errors ) {
						if( response.errors.jenis_id ) {
							$('#jenis_id').addClass('is-invalid');
							$('.errorJenisId').html(response.errors.jenis_id)
						} else {
							$('#jenis_id').removeClass('is-invalid');
							$('#jenis_id').addClass('is-valid');
						}
						if( response.errors.nama_dokumen ) {
							$('#nama_dokumen').addClass('is-invalid');
							$('.errorNamaDokumen').html(response.errors.nama_dokumen)
						} else {
							$('#nama_dokumen').removeClass('is-invalid');
							$('#nama_dokumen').addClass('is-valid');
						}
						if( response.errors.dokumen ) {
							$('#dokumen').addClass('is-invalid');
							$('.errorDokumen').html(response.errors.dokumen)
						} else {
							$('#dokumen').removeClass('is-invalid');
							$('#dokumen').addClass('is-valid');
						}
						if( response.errors.tahun ) {
							$('.tahun').addClass('is-invalid');
							$('.errorTahun').html(response.errors.tahun)
						} else {
							$('#tahun').removeClass('is-invalid');
							$('#tahun').addClass('is-valid');
						}
						if( response.errors.deskripsi ) {
							$('#deskripsi').addClass('is-invalid');
							$('.errorDeskripsi').html(response.errors.deskripsi)
						} else {
							$('#deskripsi').removeClass('is-invalid');
							$('#deskripsi').addClass('is-valid');
						}
						if( response.errors.tanggal_upload ) {
							$('.tanggal_upload').addClass('is-invalid');
							$('.errorTanggalUpload').html(response.errors.tanggal_upload)
						} else {
							$('.tanggal_upload').removeClass('is-invalid');
							$('.tanggal_upload').addClass('is-valid');
						}
						window.setTimeout(function() {
							$('.errorJenisId').fadeTo(500, 0).fadeTo(500, 0).slideUp(500, function() {
								$(this).remove()
								$('#jenis_id').removeClass('is-invalid');
								$('.errorjenisid').append(`
									<div class="small text-danger pt-1 errorJenisId"></div>
								`)
							})
							$('.errorNamaDokumen').fadeTo(500, 0).fadeTo(500, 0).slideUp(500, function() {
								$(this).remove()
								$('#nama_dokumen').removeClass('is-invalid');
								$('.errornamadokumen').append(`
									<div class="small text-danger pt-1 errorNamaDokumen"></div>
								`)
							})
							$('.errorDokumen').fadeTo(500, 0).fadeTo(500, 0).slideUp(500, function() {
								$(this).remove()
								$('#dokumen').removeClass('is-invalid');
								$('.errordokumen').append(`
									<div class="small text-danger pt-1 errorDokumen"></div>
								`)
							})
							$('.errorTahun').fadeTo(500, 0).fadeTo(500, 0).slideUp(500, function() {
								$(this).remove()
								$('.tahun').removeClass('is-invalid');
								$('.errortahun').append(`
									<div class="small text-danger pt-1 errorTahun"></div>
								`)
							})
							$('.errorDeskripsi').fadeTo(500, 0).fadeTo(500, 0).slideUp(500, function() {
								$(this).remove()
								$('#deskripsi').removeClass('is-invalid');
								$('.errordeskripsi').append(`
									<div class="small text-danger pt-1 errorDeskripsi"></div>
								`)
							})
							$('.errorTanggalUpload').fadeTo(500, 0).fadeTo(500, 0).slideUp(500, function() {
								$(this).remove()
								$('.tanggal_upload').removeClass('is-invalid');
								$('.errortanggalupload').append(`
									<div class="small text-danger pt-1 errorTanggalUpload"></div>
								`)
							})
						}, 3000);
					} else {
						Swal.fire({
							icon: 'success',
							title: 'Data berhasil disimpan',
							showConfirmButton: false,
							timer: 1500
						})
						window.location.href = '<?= base_url('dokumen'); ?>';
					}
				},
				error: function( xhr, ajaxOptions, thrownError ) {
					alert( xhr.status + "\n" + xhr.responseText + "\n" + thrownError );
				}
			})
			return false
		})
	})
</script>

<?= $this->endSection(); ?>
