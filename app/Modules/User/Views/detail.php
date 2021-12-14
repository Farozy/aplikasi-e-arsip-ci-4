<div class="modal fade" id="detailModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h4 class="modal-title font-weight-bold text-light"><?= $title; ?></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-8">
						<table class="table table-bordered table-striped table-hover">
							<tr>
								<th>Nama Lengkap</th>
								<td><?= ucfirst($user['nama_lengkap']); ?></td>
							</tr>
							<tr>
								<th>Email</th>
								<td><?= ucfirst($user['email']); ?></td>
							</tr>
							<tr>
								<th>username</th>
								<td><?= ucfirst($user['username']); ?></td>
							</tr>
							<tr>
								<th>Role</th>
								<?php foreach( $role as $row ) : ?>
									<?php if( $row['id_role'] == $user['role_id'] ) : ?>
										<td><?= ucfirst($row['nama_role']); ?></td>
									<?php endif; ?>
								<?php endforeach; ?>
							</tr>
						</table>
					</div>
					<div class="col">
						<h5 class="font-weight-bold">Foto</h5>
						<img src="<?= base_url('public'); ?>/uploads/foto/<?= $user['foto']; ?>" alt="image" class="img-fluid rounded" width="170" style="height: 170px">
						<table class="table">
							<tr>
								<th class="pt-3">Status</th>
								<td>
									<?php if( $user['is_active'] != 1 ) : ?>
										<span class="mr-2 mb-2 mr-sm-0 mb-sm-0 badge badge-pill badge-danger">Tidak Aktif</span>
									<?php else : ?>
										<h5>
											<span class="mr-2 mb-2 mr-sm-0 mb-sm-0 badge badge-success">Success</span>
										</h5>
									<?php endif; ?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-primary ubah" onclick="UbahPass(<?= $user['id_user']; ?>)">Ubah Password</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<script>
	function UbahPass(id) {
		$.ajax({
			url: '<?= site_url('user/UbahPassword');?>',
			type: 'post',
			data: {
				id: id
			},
			dataType: 'json',
			beforeSend: function() {
				$('.ubah').html('<i class="fa fa-spinner fa-spin"></i>');
			},
			complete: function() {
				$('.ubah').html('Ubah Password');
			},
			success: function(response) {
				$('#detailModal').modal('hide');
				$('.modal-backdrop').hide();
				$('.viewModal').html(response.data);
				$('#ubahPassModal').modal({backdrop: "static"});
				$('#ubahPassModal').modal('show');
			},
			error: function( xhr, ajaxOptions, thrownError ) {
				alert( xhr.status + "\n" + xhr.responseText + "\n" + thrownError );
			}
		})
	}
</script>
