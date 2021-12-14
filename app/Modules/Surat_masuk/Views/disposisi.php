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
<div class="modal fade" id="disModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h6 class="modal-title font-weight-bold text-light"><?= ucwords($title); ?> No : <?= $masuk['no_surat']; ?></h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('surat_masuk/simpan_disposisi', ['class' => 'formSave'], ['id' => $masuk['id_surat_masuk']]); ?>
			<?= csrf_field(); ?>
			<div class="modal-body">
				<div class="form-group row">
					<table class="table table-bordered">
						<tr>
							<th>Perihal</th>
							<td><?= ucfirst($masuk['perihal']); ?></td>
						</tr>
						<tr>
							<th>Dari Bagian</th>
							<td>Administrasi</td>
						</tr>
						<tr>
							<th>Disposisi Kepada</th>
							<td>
								<select name="unit_kerja_id" id="unit_kerja_id" class="form-control select2">
									<option selected></option>
									<?php foreach( $unit as $un ) : ?>
										<option value="<?= $un['id_unit_kerja']; ?>"><?= ucwords($un['nama_unit_kerja']); ?></option>
									<?php endforeach; ?>
								</select>
								<div class="errorunitkerjaid">
									<div class="small pl-1 text-danger errorUnitKerjaId"></div>
								</div>
							</td>
						</tr>
						<tr>
							<th>Isi Disposisi</th>
							<td>
								<textarea name="isi_disposisi" class="form-control" id="isi_disposisi"></textarea>
								<div class="errorisidisposisi">
									<div class="small pl-1 text-danger errorIsiDisposisi"></div>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-primary" id="kirim">Kirim</button>
			</div>
			<?= form_close(); ?>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<script>
	$(document).ready(function() {
		$('.select2').select2({
			placeholder: "-- Pilih --",
			tags: true,
			allowClear: true,
		})

		$('.formSave').submit(function() {
			$.ajax({
				url: $(this).attr('action'),
				type: 'post',
				data: $(this).serialize(),
				dataType: 'json',
				beforeSend: function() {
					$('#kirim').html('<i class="fas fa-circle-notch fa-spin"></i>');
				},
				complete: function() {
					$('#kirim').html('Kirim');
				},
				success: function(response) {
					if( response.error ) {
						if( response.error.unit_kerja_id ) {
							$('#unit_kerja_id').addClass('is-invalid');
							$('.errorUnitKerjaId').html(response.error.unit_kerja_id)
						} else {
							$('#unit_kerja_id').removeClass('is-invalid');
							$('#unit_kerja_id').addClass('is-valid');
						}
						if( response.error.isi_disposisi ) {
							$('#isi_disposisi').addClass('is-invalid');
							$('.errorIsiDisposisi').html(response.error.isi_disposisi)
						} else {
							$('#isi_disposisi').removeClass('is-invalid');
							$('#isi_disposisi').addClass('is-valid');
						}
						window.setTimeout(function() {
							$('.errorUnitKerjaId').fadeTo(500, 0).fadeTo(500, 0).slideUp(500, function() {
								$(this).remove();
								$('#nama_jenis').removeClass('is-invalid');
								$('.errorunitkerjaid').append(`
									<div class="errorUnitKerjaId small text-danger"></div>
								`);
							})
							$('.errorIsiDisposisi').fadeTo(500, 0).fadeTo(500, 0).slideUp(500, function() {
								$(this).remove();
								$('#isi_disposisi').removeClass('is-invalid');
								$('.errorisidisposisi').append(`
									<div class="errorIsiDisposisi small text-danger"></div>
								`);
							})
						}, 3000);
					} else {
						Swal.fire({
							icon: 'success',
							title: 'Data berhasil disimpan',
							showConfirmButton: false,
							timer: 1500
						})
						$('#disModal').modal('hide');
						$('.viewData').html(response.data);
					}
				},
				error: function( xhr, ajaxOptions, thrownError ) {
					alert( xhr.status + "\n" + xhr.responseText + "\n" + thrownError );
				}
			});
			return false;
		})
	})
</script>
