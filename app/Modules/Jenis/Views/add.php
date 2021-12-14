<div class="modal fade" id="addModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h6 class="modal-title font-weight-bold text-light h4"><?= $title; ?></h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('jenis/save', ['class' => 'formSave']); ?>
			<?= csrf_field(); ?>
			<div class="modal-body">
				<div class="form-group row">
					<label for="nama_jenis" class="col-form-label col-md-4 text-right">Jenis Dokumen</label>
					<div class="col-md-7">
						<input class="form-control" id="nama_jenis" name="nama_jenis" value="<?= old('nama_jenis'); ?>" style="height: 38px" onkeyup="this.value = this.value.replace (/\w\S*/g, function(txt) { return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase(); });">
						<div class="errornamajenis">
							<div class="errorNamaJenis small text-danger"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
			</div>
			<?= form_close(); ?>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<script>
	$(document).ready(function() {
		$('.formSave').submit(function() {
			$.ajax({
				url: $(this).attr('action'),
				type: 'post',
				data: $(this).serialize(),
				dataType: 'json',
				beforeSend: function() {
					$('#simpan').html('<i class="fas fa-circle-notch fa-spin"></i>');
				},
				complete: function() {
					$('#simpan').html('Simpan');
				},
				success: function(response) {
					if( response.error ) {
						if( response.error.nama_jenis ) {
							$('#nama_jenis').addClass('is-invalid');
							$('.errorNamaJenis').addClass('fa fa-times form-control-feedback pr-2')
							$('.errorNamaJenis').html(response.error.nama_jenis)
						} else {
							$('#nama_jenis').removeClass('is-invalid');
							$('#nama_jenis').addClass('is-valid');
						}
						window.setTimeout(function() {
							$('.errorNamaJenis').fadeTo(500, 0).fadeTo(500, 0).slideUp(500, function() {
								$(this).remove();
								$('#nama_jenis').removeClass('is-invalid');
								$('.errornamajenis').append(`
									<div class="errorNamaJenis small text-danger"></div>
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
						$('#addModal').modal('hide');
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
