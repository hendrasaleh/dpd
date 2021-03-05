
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
        	<div class="col-lg-6">
          		<?php if (validation_errors()) : ?>
          			<div class="alert alert-danger" role="alert">
          				<?= validation_errors(); ?>
          			</div>
          		<?php endif; ?>
          		<div class="card">
					<div class="card-header">
					Kelola SPU
					</div>
					<div class="card-body">
						
						<form action="<?= base_url('kaderisasi/tambahspu/'); ?>" method="post">
					      <div class="modal-body">
						  	<div class="form-group row">
								<label for="nama_spu" class="col-sm-4 col-form-label">Nama SPU</label>
								<div class="col-sm-8">
							    	<input type="text" class="form-control" id="nama_spu" name="nama_spu" placeholder="Misal: SPU 1" required>
							    </div>
						  	</div>
							<div class="form-group row">
								<label for="ketua_spu" class="col-sm-4 col-form-label">Ketua SPU</label>
								<div class="col-sm-8">
							    	<input type="text" class="form-control" id="ketua_spu" name="ketua_spu" placeholder="Misal: Ahmad" required>
							    </div>
						  	</div>
						  	<div class="form-group row">
								<label for="kabupaten" class="col-sm-4 col-form-label">Kabupaten</label>
								<div class="col-sm-8">
									<select name="kabupaten" id="kabupaten" class="form-control">
										<option value="">--Pilih Kabupaten--</option>
										<?php foreach ($kabupaten AS $kab) : ?>
											<option value="<?= $kab['id']; ?>"><?= $kab['name']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
					      </div>
						<a href="<?= base_url('kaderisasi'); ?>" class="btn btn-secondary">Cancel</a>
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

