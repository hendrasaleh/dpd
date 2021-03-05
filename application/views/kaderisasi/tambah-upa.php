
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $title; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?= $title; ?></li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-body">
        	<div class="col-lg-7">
          		<?php if (validation_errors()) : ?>
          			<div class="alert alert-danger" role="alert">
          				<?= validation_errors(); ?>
          			</div>
          		<?php endif; ?>
          		<div class="card">
					<div class="card-header">
					Kelola UPA
					</div>
					<div class="card-body">
						
						<form action="<?= base_url('kaderisasi/tambahupa/'); ?>" method="post">
					      <div class="modal-body">
						  	<div class="form-group row">
								<label for="spu_id" class="col-sm-4 col-form-label">Nama SPU</label>
								<div class="col-sm-8">
									<select name="spu_id" id="spu_id" class="form-control select2">
										<?php foreach ($spu AS $spu) : ?>
											<option value="<?= $spu['id']; ?>"><?= $spu['nama_spu']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="level_id" class="col-sm-4 col-form-label">Level Anggota</label>
								<div class="col-sm-8">
									<select name="level_id" id="level_id" class="form-control select2">
										<?php foreach ($level AS $lev) : ?>
											<option value="<?= $lev['id']; ?>"><?= $lev['nama_level']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="jenis_kelamin" class="col-sm-4 col-form-label">Kelompok (Ikhwan/Akhwat)</label>
								<div class="col-sm-8">
									<select name="jenis_kelamin" id="jenis_kelamin" class="form-control select2">
										<option value="1">Ikhwan</option>
										<option value="0">Akhwat</option>
									</select>
								</div>
							</div>
						  	<div class="form-group row">
								<label for="nama_ketua" class="col-sm-4 col-form-label">Ketua UPA</label>
								<div class="col-sm-8">
							    	<input type="text" class="form-control" id="nama_ketua" name="nama_ketua" placeholder="Misal: Ahmad" required>
							    </div>
						  	</div>
							<div class="form-group row">
								<label for="nama_upa" class="col-sm-4 col-form-label">Nama Grup</label>
								<div class="col-sm-8">
							    	<input type="text" class="form-control" id="nama_upa" name="nama_upa" placeholder="Misal: Grup Jalaksana 1" required>
							    </div>
						  	</div>
					      </div>
						<a href="<?= base_url('kaderisasi/upa'); ?>" class="btn btn-secondary">Cancel</a>
						<button type="submit" class="btn btn-primary">Save</button>
						</form>
						
					</div>
				</div>
          	</div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

