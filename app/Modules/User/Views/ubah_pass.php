<div class="modal fade" id="ubahPassModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h4 class="modal-title font-weight-bold text-light"><?= $title; ?></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</button>
			</div>
			<?= form_open('user/simpanUbahPassword', ['class' => 'UbahPassword']) ; ?>
			<?= csrf_field(); ?>
				<div class="modal-body">
					<div class="container">
						<input type="hidden" name="id" value="<?= $user['id_user']; ?>">
						<div class="form-group row">
							<label for="passwordLama" class="col-form-label col-md-4 text-right">Password Lama</label>
							<div class="col">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon2"><i class="fa fa-unlock"></i></span>
									</div>
									<input type="password" name="passwordLama" id="passwordLama" class="form-control" style="height: 38px">
									<div class="invalid-feedback errorPasswordLama"></div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="passwordBaru" class="col-form-label col-md-4 text-right">Password Baru</label>
							<div class="col">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon2"><i class="fa fa-lock"></i></span>
									</div>
									<input type="password" name="passwordBaru" id="passwordBaru" class="form-control" style="height: 38px">
									<div class="invalid-feedback errorPasswordBaru"></div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="passwordUlang" class="col-form-label col-md-4 text-right">Ulangi Password</label>
							<div class="col">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon2"><i class="fa fa-lock"></i></span>
									</div>
									<input type="password" name="passwordUlang" id="passwordUlang" class="form-control" style="height: 38px">
									<div class="invalid-feedback errorPasswordUlang"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" id="simpanUbahPassword">Simpan</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			<?= form_close() ?>
		</div>
	</div>
</div>

<script>
	$(function() {
		$('.UbahPassword').submit(function() {
			$.ajax({
				url: $(this).attr('action'),
				type: 'post',
				data: $(this).serialize(),
				dataType: 'json',
				beforeSend: function() {
					$('#simpanUbahPassword').html('<i class="fas fa-circle-notch fa-spin"></i>');
				},
				complete: function() {
					$('#simpanUbahPassword').html('Simpan');
				},
				success: function(response) {
					if( response.errors ) {
						if( response.errors.passwordLama ) {
							$('#passwordLama').addClass('is-invalid');
							$('.errorPasswordLama').html(response.errors.passwordLama)
						} else {
							$('#passwordLama').removeClass('is-invalid');
							$('#passwordLama').addClass('is-valid');
						}

						if( response.errors.passwordBaru ) {
							$('#passwordBaru').addClass('is-invalid');
							$('.errorPasswordBaru').html(response.errors.passwordBaru)
						} else {
							$('#passwordBaru').removeClass('is-invalid');
							$('#passwordBaru').addClass('is-valid');
						}

						if( response.errors.passwordUlang ) {
							$('#passwordUlang').addClass('is-invalid');
							$('.errorPasswordUlang').html(response.errors.passwordUlang)
						} else {
							$('#passwordUlang').removeClass('is-invalid');
							$('#passwordUlang').addClass('is-valid');
						}
					} else {
						Swal.fire({
							icon: response.data.icon,
							title: response.data.text,
							showConfirmButton: false,
							timer: 1000
						})
						$('.viewData').html(response.data.view)
						$('#ubahPassModal').modal('hide');
					}
				},
				error: function( xhr, ajaxOptions, thrownError ) {
					alert( xhr.status + "\n" + xhr.responseText + "\n" + thrownError );
				}
			})
			return false;
		})
	})
</script>
