<div class="modal fade" id="uploadModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title font-weight-bold text-light"><?= $title; ?> : <?= strtoupper($dok['no_dokumen']); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</button>
			</div>
			<?= form_open_multipart('dokumen/upload_save', ['class' => 'formUpload'], ['id' => $dok['id_dokumen'], 'dokumenLama' => $dok['dokumen'], 'ukuranLama' => $dok['ukuran']]); ?>
			<div class="modal-body">
				<div class="form-group row">
					<label for="dokumen" class="col-form-label col-md-3 text-right">Dokumen</label>
					<div class="col-md-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1"><i class="fas fa-file-pdf"></i></span>
							</div>
							<input type="file" name="dokumen" id="dokumen" class="form-control" style="width: 87%; height: 38px">
							<div class="errordokumen">
								<div class="small pl-1 text-danger errorDokumen"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button class="btn btn-primary" id="upload">Uplaod</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
			<?= form_close(); ?>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<script>
	$(document).ready(function() {
		$('.formUpload').submit(function() {
			$.ajax({
				url: $(this).attr('action'),
				type: 'post',
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				dataType: 'json',
				beforeSend: function() {
					$('#upload').html('<i class="fas fa-circle-notch fa-spin"></i>');
				},
				complete: function() {
					$('#upload').html('Upload');
				},
				success: function(response) {
					if( response.errors ) {
						if( response.errors.dokumen ) {
							$('#dokumen').addClass('is-invalid');
							$('.errorDokumen').html(response.errors.dokumen)
						} else {
							$('#dokumen').removeClass('is-invalid');
							$('#dokumen').addClass('is-valid');
						}
						window.setTimeout(function() {
							$('.errorDokumen').fadeTo(500, 0).fadeTo(500, 0).slideUp(500, function() {
								$(this).remove()
								$('#dokumen').removeClass('is-invalid');
								$('.errordokumen').append(`
									<div class="small text-danger pt-1 errorDokumen"></div>
								`)
							})
						}, 3000);
					} else {
						Swal.fire({
							icon: 'success',
							title: 'Data berhasil diupload',
							showConfirmButton: false,
							timer: 1500
						})
						$('#uploadModal').modal('hide');
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
