<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<style type="text/css">
	.nav-tabs {
		margin-left: 1%;
	}
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        border-top: #FFFFFF;
        border-right: #FFFFFF;
        border-left: #FFFFFF;
        border-bottom: 3px solid #4e73df;
    }
    .disposisi {
    	text-align: right;
    }
    .back {
    	margin-left: 67.8%;
    }

    @media screen and (max-width: 780px) {
    	.disposisi {
    		text-align: left;
    	}
    	.back {
    	margin-left: 12.8%;
    }
    }
</style>

<div class="row">
	<div class="col-md-10 mx-auto">
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="surat_masuk-tab" data-toggle="tab" href="#surat_masuk" role="tab" aria-controls="surat_masuk" aria-selected="true"><i class="fas fa-envelope"></i>Surat Masuk</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="disposisi-tab" data-toggle="tab" href="#disposisi" role="tab" aria-controls="disposisi" aria-selected="false">Disposisi</a>
			</li>
			<li class="back">
				<a href="<?= base_url('surat_masuk'); ?>" class="btn btn-light btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
			</li>
		</ul>
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane container fade show active" id="surat_masuk" role="tabpanel" aria-labelledby="surat_masuk-tab">
				<div class="card border-primary bg-white">
					<div class="card-body pt-5">
						<div class="row">
							<div class="col-md-4 text-center">
								<?php if( $masuk['file'] == null ) : ?>
									<a href="javascript:void(0)" class="text-left" data-toggle="tooltip" title="Tidak ada file terupload"><img src="<?= base_url('public/uploads/surat_masuk'); ?>/n_upload.png" alt="" style="width: 120px; height: 90px; margin-bottom: 20px; padding: .2em 1em; "></a>
									<p><a href="javascript:void()" style="padding: .2em 1em; border: 2px solid rgba(0, 0, 0, .1);"><?= $masuk['no_surat']; ?></a></p>
								<?php else: ?>
									<a href="<?= base_url('public/uploads/surat_masuk'); ?>/<?= $masuk['file']; ?>" data-toggle="tooltip" title="Download" class="text-left"><img src="<?= base_url('public/uploads/surat_masuk'); ?>/upload.png" alt="" style="width: 120px; height: 90px; margin-bottom: 20px; padding: .2em 1em; "></a>
									<p><a href="javascript:void()" style="padding: .2em 1em; border: 2px solid rgba(0, 0, 0, .1);"><?= $masuk['no_surat']; ?></a></p>
								<?php endif; ?>
							</div>
							<div class="col-md-auto">
								<table class="table table-responsive">
									<tr>
										<td>Detail Surat Masuk</td>
										<td>
											<h4><?= $masuk['no_surat']; ?></h4>
										</td>
									</tr>
									<tr>
										<td>Tanggal & Jam</td>
										<td>
											<i class="fas fa-calendar"></i> <?= $masuk['updated_date'] == null ? date("d-m-Y", strtotime($masuk['tanggal'])) . ' / ' .  date('H:i:s', strtotime($masuk['created_date'])) : date("d-m-Y", strtotime($masuk['tanggal'])) . ' / ' . date('H:i:s', strtotime($masuk['updated_date'])); ?>
										</td>
									</tr>
									<tr>
										<td>Tanggal Surat</td>
										<td>
											<i class="fas fa-calendar-alt"></i> <?= $masuk['tanggal']; ?>
										</td>
									</tr>
									<tr>
										<td>Pengirim</td>
										<td>
											<?= ucwords($masuk['pengirim']); ?>
										</td>
									</tr>
									<tr>
										<td>Sifat Surat</td>
										<td>
											<?= ucwords($masuk['sifat_surat']); ?>
										</td>
									</tr>
									<tr>
										<td>Perihal</td>
										<td>
											<?= ucwords($masuk['perihal']) ?>
										</td>
									</tr>
									<tr>
										<td>Isi Surat</td>
										<td>
											<?= ucfirst($masuk['isi_surat']); ?>
										</td>
									</tr>
									<tr>
										<td>Disposisi Awal</td>
									</tr>
									<tr>
										<td>Status</td>
									</tr>
									<tr>
										<th>Aksi File</th>
										<td>
											<button class="btn btn-primary" id="upload"><i class="fas fa-upload"> </i> Upload File</button>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane container fade" id="disposisi" role="tabpanel" aria-labelledby="disposisi-tab">
				<div class="card border-primary bg-white">
					<div class="card-header pt-5">
						<h4><i class="fa fa-envelope"></i> No. Surat : <?= $masuk['no_surat']; ?></h4>
					</div>
					<div class="card-body pt-5" style="margin-top: -2em;">
						<div class="row py-4 px-3" style="background-color: rgba(0, 0, 0, .1);">
							<div class="col-md-3">
								<address>
									<strong>Tanggal</strong><br>
									<?= date('d-m-Y', strtotime($masuk['tanggal'])); ?>
								</address>
								<address>
									<strong>Sifat Surat</strong><br>
									<?= ucfirst($masuk['sifat_surat']); ?>
								</address>
							</div>
							<div class="col-md-3">
								<address>
									<strong>Asal Surat</strong><br>
									<?= ucwords($masuk['pengirim']); ?>
								</address>
								<address>
									<strong>Perihal</strong><br>
									<?= ucfirst($masuk['perihal']); ?>
								</address>
							</div>
							<div class="col-md-6 disposisi">
								<address>
									<strong>Disposisi saat ini</strong><br>
									<?php if( $masuk['unit_kerja_id'] != 0 ) : ?>
										<?php foreach( $unit as $un ) : ?>
											<?php if( $un['id_unit_kerja'] == $masuk['unit_kerja_id'] ) : ?>
												<?= ucwords($un['nama_unit_kerja']); ?>
											<?php endif; ?>
										<?php endforeach; ?>
									<?php else: ?>
										<div class="mr-5">-</div>
									<?php endif; ?>
								</address>
								<br>
								<address >
									<strong>Isi Ringkas</strong><br>
									<?= ucfirst($masuk['isi_surat']); ?>
								</address>
							</div>
						</div>
						<h6 class="mt-4">Riwayat Disposisi</h6>
						<div class="table-responsive">
							<table class="table table-invoice table-bordered table-striped">
								<thead>
									<tr>
										<th width="4%">No</th>
										<th>Tanggal</th>
										<th>Dari</th>
										<th>Instruksi / Informasi</th>
										<th>Diteruskan Ke</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<?php if( $masuk['unit_kerja_id'] != 0 ) : ?>
											<?php $no = 1;
											foreach( $unit as $un ) : ?>
												<?php if( $un['id_unit_kerja'] == $masuk['unit_kerja_id'] ) : ?>
													<td><?= $no++; ?></td>
													<td><?= date('d-m-Y', strtotime($masuk['tanggal'])); ?></td>
													<td>Administrasi</td>
													<td><?= ucfirst($masuk['isi_disposisi']); ?></td>
													<td><?= ucwords($un['nama_unit_kerja']); ?></td>
												<?php endif; ?>
											<?php endforeach; ?>
										<?php else: ?>
											<td colspan="5" class="text-center">Belum ada disposisi</td>
										<?php endif; ?>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="text-center mt-3">
							<?php if( $masuk['unit_kerja_id'] != 0 ) : ?>
								<small>SELAMAT BERTUGAS</small>
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="addModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h6 class="modal-title font-weight-bold text-light h4">Upload File</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('surat_masuk/upload_save', ['class' => 'formSave'], ['id' => $masuk['id_surat_masuk'], 'fileLama' => $masuk['file']]); ?>
			<?= csrf_field(); ?>
			<div class="modal-body">
				<div class="form-group row">
					<label for="file" class="col-form-label col-md-3 text-right">File</label>
					<div class="col-md-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1"><i class="fas fa-file-archive"></i></span>
							</div>
							<input type="file" name="file" id="file" class="form-control" style="width: 85%">
							<div class="errorfile">
								<div class="small pl-1 text-danger errorFile"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-primary" id="simpan">Upload</button>
			</div>
			<?= form_close(); ?>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<script>
	$(function() {
		$('#upload').click(function() {
			$('#addModal').modal('show');
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
					$('#simpan').html('Upload');
				},
				success: function(response) {
					if( response.errors ) {
						if( response.errors.file ) {
							$('#file').addClass('is-invalid');
							$('.errorFile').html(response.errors.file)
						} else {
							$('#file').removeClass('is-invalid');
							$('#file').addClass('is-valid');
						}
						window.setTimeout(function() {
							$('.errorFile').fadeTo(500, 0).fadeTo(500, 0).slideUp(500, function() {
								$(this).remove()
								$('#file').removeClass('is-invalid');
								$('.errorfile').append(`
									<div class="small text-danger pt-1 errorFile"></div>
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
						$('addModal').modal('hide');
						location.reload();
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
