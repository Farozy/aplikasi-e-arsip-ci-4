<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<div class="container">
	<div class="card">
		<div class="card-header bg-white">
			<div class="card-title">
				<h3 class="font-weight-bold text-center">
					<?= $title; ?>
				</h3>
			</div>
		</div>
		<div class="card-body">
			<div class="mx-auto">
				<div class="alert alert-info" role="alert">
					<i class="fas fa-bell"></i><span class="font-weight-bold"> Informasi</span>
					<div class="text-left">
						Jumlah Data Pengguna : <?= count($user); ?>
					</div>
				</div>
			</div>
			<?= form_open_multipart('user/save', ['class' => 'formSAve']); ?>
			<?= csrf_field(); ?>
			<div class="row">
				<div class="col-md-9">
					<div class="form-group row">
						<label for="nama_lengkap" class="col-form-label col-md-3 text-right">Nama Lengkap</label>
						<div class="col">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon2"><i class="fas fa-sticky-note"></i></span>
								</div>
								<input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control <?= $validation->hasError('nama_lengkap') ? 'is-invalid' : ''; ?>" style="height: 38px" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1)">
								<div class="<?= $validation->hasError('nama_lengkap') ? 'invalid-feedback' : ''; ?>">
									<?= $validation->getError('nama_lengkap'); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="email" class="col-form-label col-md-3 text-right">Email</label>
						<div class="col">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon2"><i class="fas fa-at"></i></span>
								</div>
								<input type="text" name="email" id="email" class="form-control <?= $validation->hasError('email') ? 'is-invalid' : ''; ?>" style="height: 38px" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1)">
								<div class="<?= $validation->hasError('email') ? 'invalid-feedback' : ''; ?>">
									<?= $validation->getError('email'); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="username" class="col-form-label col-md-3 text-right">Username</label>
						<div class="col">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon2"><i class="fas fa-file-signature"></i></span>
								</div>
								<input type="text" name="username" id="username" class="form-control <?= $validation->hasError('username') ? 'is-invalid' : ''; ?>" style="height: 38px" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1)">
								<div class="<?= $validation->hasError('username') ? 'invalid-feedback' : ''; ?>">
									<?= $validation->getError('username'); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="password" class="col-form-label col-md-3 text-right">password</label>
						<div class="col">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon2"><i class="fas fa-key"></i></span>
								</div>
								<input type="password" name="password" id="password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : ''; ?>" style="height: 38px">
								<div class="<?= $validation->hasError('password') ? 'invalid-feedback' : ''; ?>">
									<?= $validation->getError('password'); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="password2" class="col-form-label col-md-3 text-right">Ulangi Password</label>
						<div class="col">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon2"><i class="fas fa-key"></i></span>
								</div>
								<input type="password" name="password2" id="password2" class="form-control <?= $validation->hasError('password2') ? 'is-invalid' : ''; ?>" style="height: 38px">
								<div class="<?= $validation->hasError('password2') ? 'invalid-feedback' : ''; ?>">
									<?= $validation->getError('password2'); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
					<label for="role_id" class="col-form-label col-md-3 text-right">Role</label>
					<div class="col">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1"><i class="fas fa-users-cog"></i></span>
							</div>
							<select name="role_id" id="role_id" class="form-control <?= $validation->hasError('role_id') ? 'is-invalid' : ''; ?>" style="width: 92%;">
								<option selected></option>
								<?php foreach( $role as $row ) : ?>
									<option value="<?= $row['id_role']; ?>"><?= ucfirst($row['nama_role']); ?></option>
								<?php endforeach; ?>
							</select>
							<div class="<?= $validation->hasError('role_id') ? 'invalid-feedback' : ''; ?>">
								<?= $validation->getError('role_id'); ?>
							</div>
						</div>
					</div>
				</div>
				</div>
				<div class="col">
					<h5 class="header-title font-weight-bold">Foto</h5>
					<div class="text-center">
						<img id="previewFoto" src="<?= base_url('public'); ?>/uploads/foto/default.png" alt="image" class="img-fluid rounded" width="170" style="height: 150px" alt="Preview Gambar">
					</div>
					<div class="form-group">
						<label for="inputZip" class="col-form-label">Upload Foto</label>
						<input type="file" class="form-control" id="buttonFoto" name="foto">
					</div>
					<div class="form-group row">
						<label for="is_active" class="col-form-label col-md-3 text-right"><small style="font-size: 15px">Status</small></label>
						<div class="col">
							<div class="form-check mt-2" style="margin-left: -20px">
								<div class="custom-control custom-radio custom-control-inline">
									<input class="form-check-input custom-control-input is_active <?= $validation->hasError('is_active') ? 'is-invalid' : ''; ?>" type="radio" name="is_active" id="aktif" value="1">
									<label class="custom-control-label aktif" for="aktif"><small style="font-size: 14px">Aktif</small></label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input class="form-check-input custom-control-input is_active <?= $validation->hasError('is_active') ? 'is-invalid' : ''; ?>" type="radio" name="is_active" id="tidak_aktif" value="0">
									<label class="custom-control-label tidak_aktif" for="tidak_aktif"><small style="font-size: 13px">Tidak Aktif</small></label>
								</div>
							</div>
							<div class="small text-danger errorStatusSsiswa"></div>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-block btn-primary">SIMPAN</button>
						<a href="<?= base_url('user'); ?>" class="btn btn-block btn-danger">BATAL</a>
					</div>
				</div>
			</div>
			<?php form_close(); ?>
		</div>
	</div>
</div>

<script>
	$('#role_id').select2({
		placeholder: "Pilih Role",
		maximumSelectionLength: 2,
		tags: true,
		allowClear: true,
	})	
</script>

<?= $this->endSection(); ?>
