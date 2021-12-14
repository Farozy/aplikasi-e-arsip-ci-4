<div class="modal fade" id="editModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h6 class="modal-title font-weight-bold text-light h4"><?= ucwords($title); ?></h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('jenis/update', ['class' => 'formUpdate'], ['id' => $jenis['id_jenis'], 'created_date' => $jenis['created_date'], 'status_jenis' => $jenis['status_jenis']]); ?>
			<?= csrf_field(); ?>
			<div class="modal-body">
				<div class="form-group row">
					<label for="nama_jenis" class="col-form-label col-md-4 text-right">Jenis Dokumen</label>
					<div class="col-md-7">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1"><i class="fa fa-file-text-o"></i></span>
							</div>
							<input class="form-control" id="nama_jenis" name="nama_jenis" value="<?= ucwords($jenis['nama_jenis']) ?>" style="height: 38px" onkeyup="this.value = this.value.replace (/\w\S*/g, function(txt) { return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase(); });">
						</div>
						<div class="errornamajenis">
							<div class="errorNamaJenis small text-danger"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-warning" id="update">Update</button>
			</div>
			<?= form_close(); ?>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<script>
	$(document).ready(function() {
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
							title: 'Data berhasil diupdate',
							showConfirmButton: false,
							timer: 1500
						})
						$('#editModal').modal('hide');
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
