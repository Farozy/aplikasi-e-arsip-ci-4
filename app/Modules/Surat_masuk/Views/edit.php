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

<div class="card">
	<div class="card border-primary mb-3">
		<div class="card-header bg-info text-light">Edit <?= $title; ?></div>
		<?= form_open('surat_masuk/update', ['class' => 'formUpdate'], ['id' => $masuk['id_surat_masuk'], 'created_date' => $masuk['created_date'], 'unit_kerja_id' => $masuk['unit_kerja_id'], 'isi_disposisi' => $masuk['isi_disposisi']]); ?>
			<div class="card-body">
				<div class="row">
					<div class="col-md-8 mx-auto">
						<div class="form-group row">
							<label for="no_surat" class="col-form-label col-md-3 text-right">Nomer Surat</label>
							<div class="col-md-8">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fas fa-file-signature"></i></span>
									</div>
									<input type="text" name="no_surat" id="no_surat" class="form-control" style="width: 89%; height: 38px" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1)" value="<?= $masuk['no_surat'] ?>">
									<div class="errornosurat">
										<div class="small pl-1 text-danger errorNoSurat"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row" style="margin-top: -1em">
							<label for="tanggal" class="col-form-label col-md-3 text-right">Tanggal Surat</label>
							<div class="col-md-8">
								<div class="input-group date" id="tanggal" data-target-input="nearest">
									<div class="input-group-prepend" data-target="#tanggal" data-toggle="datetimepicker">
										<div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
									</div>
									<input type="text" class="form-control tanggal datetimepicker-input" data-target="#tanggal" name="tanggal" style="width: 90%;" value="<?= date('d-m-Y', strtotime($masuk['tanggal'])); ?>" />
									<div class="errortanggalsurat">
										<div class="small pl-1 text-danger errorTanggalSurat"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row" >
							<label for="sifat_surat" class="col-form-label col-md-3 text-right">Sifat Surat</label>
							<div class="col-md-8">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fas fa-file-medical-alt"></i></span>
									</div>
									<select name="sifat_surat" id="sifat_surat" class="form-control select2" style="width: 91%;">
										<option selected></option>
										<option <?= ($masuk['sifat_surat'] == 'segera' ? 'selected' : ''); ?> value="segera">Segera</option>
										<option <?= ($masuk['sifat_surat'] == 'penting' ? 'selected' : ''); ?> value="penting">Penting</option>
										<option <?= ($masuk['sifat_surat'] == 'rahasia' ? 'selected' : ''); ?> value="rahasia">Rahasia</option>
										<option <?= ($masuk['sifat_surat'] == 'biasa' ? 'selected' : ''); ?> value="biasa">Biasa</option>
									</select>
									<div class="errorsifatsurat">
										<div class="small pl-1 text-danger errorSifatSurat"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row" style="margin-top: -1em">
							<label for="pengirim" class="col-form-label col-md-3 text-right">Pengirim</label>
							<div class="col-md-8">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
									</div>
									<input type="text" name="pengirim" id="pengirim" class="form-control" style="width: 90%; height: 38px" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1)" value="<?= ucwords($masuk['pengirim']) ?>">
									<div class="errorpengirim">
										<div class="small pl-1 text-danger errorPengirim"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row" style="margin-top: -1em">
							<label for="perihal" class="col-form-label col-md-3 text-right">Perihal</label>
							<div class="col-md-8">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fas fa-file-signature"></i></span>
									</div>
									<input type="text" name="perihal" id="perihal" class="form-control" style="width: 90%; height: 38px" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1)" value="<?= $masuk['perihal'] ?>">
									<div class="errorperihal">
										<div class="small pl-1 text-danger errorPerihal"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row" style="margin-top: -1em">
							<label for="isi_surat" class="col-form-label col-md-3 text-right mt-3">Isi Surat Ringkas</label>
							<div class="col-md-8">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fas fa-sticky-note"></i></span>
									</div>
									<textarea name="isi_surat" class="form-control" id="isi_surat" style="width: 90%"><?= ucfirst($masuk['isi_surat']); ?></textarea>
									<div class="errorisisurat">
										<div class="small pl-1 text-danger errorIsiSurat"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center">
							<button class="btn btn-warning" id="update">Update</button>
							<a href="<?= base_url('surat_masuk'); ?>" class="btn btn-danger">Batal</a>
						</div>
					</div>
				</div>
			</div>
		<?= form_close(); ?>
	</div>
</div>

<script>
	$(function() {
		$('#tanggal').datetimepicker({
			format: "DD-MM-YYYY"
		});
		$('.fa-calendar-alt').click(function() {
			$('#tanggal').datetimepicker('show')
		})

		$('.select2').select2({
			placeholder: "-- Pilih --",
			tags: true,
			allowClear: true,
		})

		$('.formUpdate').submit(function() {
			$.ajax({
				url: $(this).attr('action'),
				type: 'post',
				data: $(this).serialize(),
				dataType: 'json',
				beforeSend: function() {
					$('#update').html('<i class="fas fa-circle-notch fa-spin"></i>');
				},
				complete: function() {
					$('#update').html('Update');
				},
				success: function(response) {
					if( response.errors ) {
						if( response.errors.no_surat ) {
							$('#no_surat').addClass('is-invalid');
							$('.errorNoSurat').html(response.errors.no_surat)
						} else {
							$('#no_surat').removeClass('is-invalid');
							$('#no_surat').addClass('is-valid');
						}
						if( response.errors.tanggal ) {
							$('.tanggal').addClass('is-invalid');
							$('.errorTanggalSurat').html(response.errors.tanggal)
						} else {
							$('.tanggal').removeClass('is-invalid');
							$('.tanggal').addClass('is-valid');
						}
						if( response.errors.sifat_surat ) {
							$('#sifat_surat').addClass('is-invalid');
							$('.errorSifatSurat').html(response.errors.sifat_surat)
						} else {
							$('#sifat_surat').removeClass('is-invalid');
							$('#sifat_surat').addClass('is-valid');
						}
						if( response.errors.pengirim ) {
							$('#pengirim').addClass('is-invalid');
							$('.errorPengirim').html(response.errors.pengirim)
						} else {
							$('#pengirim').removeClass('is-invalid');
							$('#pengirim').addClass('is-valid');
						}
						if( response.errors.perihal ) {
							$('#perihal').addClass('is-invalid');
							$('.errorPerihal').html(response.errors.perihal)
						} else {
							$('#perihal').removeClass('is-invalid');
							$('#perihal').addClass('is-valid');
						}
						if( response.errors.isi_surat ) {
							$('#isi_surat').addClass('is-invalid');
							$('.errorIsiSurat').html(response.errors.isi_surat)
						} else {
							$('#isi_surat').removeClass('is-invalid');
							$('#isi_surat').addClass('is-valid');
						}
						window.setTimeout(function() {
							$('.errorNoSurat').fadeTo(500, 0).fadeTo(500, 0).slideUp(500, function() {
								$(this).remove()
								$('#no_surat').removeClass('is-invalid');
								$('.errornosurat').append(`
									<div class="small text-danger pt-1 errorNoSurat"></div>
								`)
							})
							$('.errorTanggalSurat').fadeTo(500, 0).fadeTo(500, 0).slideUp(500, function() {
								$(this).remove()
								$('.tanggal').removeClass('is-invalid');
								$('.errortanggalsurat').append(`
									<div class="small text-danger pt-1 errorTanggalSurat"></div>
								`)
							})
							$('.errorSifatSurat').fadeTo(500, 0).fadeTo(500, 0).slideUp(500, function() {
								$(this).remove()
								$('#sifat_surat').removeClass('is-invalid');
								$('.errorsifatsurat').append(`
									<div class="small text-danger pt-1 errorSifatSurat"></div>
								`)
							})
							$('.errorPengirim').fadeTo(500, 0).fadeTo(500, 0).slideUp(500, function() {
								$(this).remove()
								$('#pengirim').removeClass('is-invalid');
								$('.errorpengirim').append(`
									<div class="small text-danger pt-1 errorPengirim"></div>
								`)
							})
							$('.errorPerihal').fadeTo(500, 0).fadeTo(500, 0).slideUp(500, function() {
								$(this).remove()
								$('#perihal').removeClass('is-invalid');
								$('.errorperihal').append(`
									<div class="small text-danger pt-1 errorPerihal"></div>
								`)
							})
							$('.errorIsiSurat').fadeTo(500, 0).fadeTo(500, 0).slideUp(500, function() {
								$(this).remove()
								$('#isi_surat').removeClass('is-invalid');
								$('.errorisisurat').append(`
									<div class="small text-danger pt-1 errorIsiSurat"></div>
								`)
							})				
						}, 3000);
					} else {
						Swal.fire({
							icon: 'success',
							title: 'Data berhasil diupdate',
							showConfirmButton: false,
							timer: 1500
						})
						window.location.href = '<?= base_url('surat_masuk'); ?>';
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
