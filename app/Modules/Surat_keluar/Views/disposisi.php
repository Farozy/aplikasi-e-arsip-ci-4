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
				<h6 class="modal-title font-weight-bold text-light"><?= ucwords($title); ?> No : <?= $keluar['no_surat']; ?></h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('surat_keluar/simpan_disposisi', ['class' => 'formSave'], ['id' => $keluar['id_surat_keluar']]); ?>
			<?= csrf_field(); ?>
			<div class="modal-body">
				<div class="form-group row">
					<table class="table table-bordered">
						<tr>
							<th>Perihal</th>
							<td><?= ucfirst($keluar['perihal']); ?></td>
						</tr>
						<tr>
							<th>Disposisi</th>
							<td>
								<input type="text" name="disposisi" id="disposisi" class="form-control" style="height: 38px" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1)" value="<?= old('disposisi'); ?>">
								<div class="errordisposisi">
									<div class="small pl-1 text-danger errorDisposisi"></div>
								</div>
							</td>
						</tr>
						<tr>
							<th>Tanggal Disposisi</th>
							<td>
								<div class="input-group date" id="tanggal_disposisi" data-target-input="nearest">
									<input type="text" class="form-control tanggal datetimepicker-input" data-target="#tanggal_disposisi" name="tanggal_disposisi" style="width: 90%;"/>
									<div class="input-group-append" data-target="#tanggal_disposisi" data-toggle="datetimepicker">
										<div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
									</div>
								</div>
								<div class="errortanggaldisposisi">
									<div class="small pl-1 text-danger errorTanggalDisposisi"></div>
								</div>
							</td>
						</tr>
						<tr>
							<th>Keterangan Disposisi</th>
							<td>
								<textarea name="ket_disposisi" class="form-control" id="ket_disposisi"></textarea>
								<div class="errorketdisposisi">
									<div class="small pl-1 text-danger errorKetDisposisi"></div>
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
		$('#tanggal_disposisi').datetimepicker({
			format: "DD-MM-YYYY"
		});
		$('.fa-calendar-alt').click(function() {
			$('#tanggal_disposisi').datetimepicker('show')
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
						if( response.error.disposisi ) {
							$('#disposisi').addClass('is-invalid');
							$('.errorDisposisi').html(response.error.disposisi)
						} else {
							$('#disposisi').removeClass('is-invalid');
							$('#disposisi').addClass('is-valid');
						}
						if( response.error.tanggal_disposisi ) {
							$('.tanggal').addClass('is-invalid');
							$('.errorTanggalDisposisi').html(response.error.tanggal_disposisi)
						} else {
							$('.tanggal').removeClass('is-invalid');
							$('.tanggal').addClass('is-valid');
						}
						if( response.error.ket_disposisi ) {
							$('#ket_disposisi').addClass('is-invalid');
							$('.errorKetDisposisi').html(response.error.ket_disposisi)
						} else {
							$('#ket_disposisi').removeClass('is-invalid');
							$('#ket_disposisi').addClass('is-valid');
						}
						window.setTimeout(function() {
							$('.errorDisposisi').fadeTo(500, 0).fadeTo(500, 0).slideUp(500, function() {
								$(this).remove();
								$('#disposisi').removeClass('is-invalid');
								$('.errordisposisi').append(`
									<div class="errorDisposisi small text-danger"></div>
								`);
							})
							$('.errorTanggalDisposisi').fadeTo(500, 0).fadeTo(500, 0).slideUp(500, function() {
								$(this).remove();
								$('.tanggal').removeClass('is-invalid');
								$('.errortanggaldisposisi').append(`
									<div class="errorTanggalDisposisi small text-danger"></div>
								`);
							})
							$('.errorKetDisposisi').fadeTo(500, 0).fadeTo(500, 0).slideUp(500, function() {
								$(this).remove();
								$('#ket_disposisi').removeClass('is-invalid');
								$('.errorketdisposisi').append(`
									<div class="errorKetDisposisi small text-danger"></div>
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
