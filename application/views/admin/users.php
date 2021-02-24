
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
		    <div class="col-lg">

		  		<?= $this->session->flashdata('message'); ?>

		  		<table class="table table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Email</th>
				      <th scope="col">Name</th>
				      <th scope="col">Role</th>
				      <th scope="col">Active</th>
				      <th scope="col">Date Modified</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
				  		$i = 1;
				  		foreach ($users as $user) :
				  	?>
				    <tr>
				      <th scope="row"><?= $i; ?></th>
				      <td><?= $user['email']; ?></td>
				      <td><?= $user['name']; ?></td>
				      <td><?= $user['role']; ?></td>
				      <td><?= $user['is_active'] == 1 ? 'Yes' : 'No'; ?></td>
				      <td><?= date('d-M-Y', $user['date_modified']);?></td>
				      <td>
				      		<a href="manageuser/<?= $user['id']; ?>" class="badge badge-success">edit</a>
				      		<a href="javascript:hapusData(<?= $user['id']; ?>)" class="badge badge-danger">delete</a>
				      </td>
				    </tr>
					<?php
						$i++;
						endforeach;
					?>
				  </tbody>
				</table>
		  	</div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



<script language="JavaScript" type="text/javascript">
	function hapusData(id){
		if (confirm("Apakah anda yakin akan menghapus data ini?")){
		  	window.location.href = 'deleteuser/' + id;
		}
	}
</script>



