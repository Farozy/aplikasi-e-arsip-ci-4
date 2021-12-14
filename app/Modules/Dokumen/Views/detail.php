<div class="modal fade" id="detailModal">
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
			<div class="modal-body">
				<table class="table table hover table-bordered">
					<tr>
						<th>Jenis Dokumen</th>
						<td>
							<?php foreach( $jenis as $jen ) : ?>
								<?php if( $jen['id_jenis'] == $dok['jenis_id'] ) : ?>
									<?= ucwords($jen['nama_jenis']); ?>
								<?php endif; ?>
							<?php endforeach; ?>
						</td>
						<tr>
							<th>Nomer Dokumen</th>
							<td>
								<?= strtoupper($dok['no_dokumen']); ?>
							</td>
						</tr>
						<tr>
							<th>Tahun</th>
							<td>
								<?= $dok['tahun']; ?>
							</td>
						</tr>
						<tr>
							<th>Nama Dokumen</th>
							<td>
								<?= strtoupper($dok['nama_dokumen']); ?>
							</td>
						</tr>
						<tr>
							<th>Deskripsi</th>
							<td>
								<?= ucfirst($dok['deskripsi']); ?>
							</td>
						</tr>
						<tr>
							<th>Tanggal Dokumen</th>
							<td>
								<?= date('d-m-Y', strtotime($dok['tanggal_upload'])); ?>
							</td>
						</tr>
						<tr>
							<th>Ukuran Dokumen</th>
							<td>
								<?= $dok['ukuran']; ?> KB
							</td>
						</tr>
						<tr>
							<th>Tanggal Upload</th>
							<td>
								<?= date('d-m-Y', strtotime($dok['tanggal_upload'])); ?>
							</td>
						</tr>
						<tr>
							<th>Jumlah Download</th>
							<td>
								<?= $dok['download']; ?>
							</td>
						</tr>
					</tr>
				</table>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
