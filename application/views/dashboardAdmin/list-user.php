<div class="row layout-top-spacing layout-spacing">
	<div class="col-lg-12">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Data User</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area">
				<div class="form-group">
					<button class="btn btn-primary mb-2" data-toggle="modal" data-target="#myAddUser">Tambah Data</button>
				</div>
				<div class="table-responsive mb-4 style-1">
					<table id="user" class="table style-1 table-hover non-hover">
						<thead>
							<tr>								
								<th width="">No. </th>
								<th width="">Username</th>
								<th width="">Nama User</th>
								<th width="">Email</th>
								<th width="">Level</th>
								<th class="text-center" width="20%">Action</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="myAddUser" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times"></i>
				</button>
			</div>
			<form id="addUser" method="POST" action="#" class="form-horizontal" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label class="text-dark">Level</label>
						<select class="form-control" name="add_level" required="">
							<option value="">Pilih Level</option>
							<option value="1">Administrator</option>
							<option value="3">Kepala Perpustakaan</option>
						</select>
					</div>
					<div class="form-group">
						<label class="text-dark">Username</label>
						<input type="text" name="username" id="username" class="form-control" required="">
					</div>
					<div class="form-group">
						<label class="text-dark">Nama User</label>
						<input type="text" name="add_nama" class="form-control telp">
					</div>
					<div class="form-group">
						<label class="text-dark">Email</label>
						<input type="email" name="add_email" class="form-control">
					</div>
					<div class="form-group">
						<label class="text-dark">Password</label>
						<input type="password" name="password" id="password" class="form-control" required="">
					</div>
					<div class="form-group">
						<label class="text-dark">Konfirmasi Password</label>
						<input type="password" name="confirm" id="confirm" class="form-control" required="">
						<div class="row mt-1">
							<div class="col-md-10 text-right">
								<span>Show Password</span>
							</div>
							<div class="col-md-1 text-right">
								<label class="switch s-icons s-outline s-outline-primary">
									<input type="checkbox" id="show">
									<span class="slider"></span>
								</label>
							</div>
						</div>
					</div>
					<span class="text-danger">Note: Untuk level user <b>"anggota"</b>, ditambahkan di halaman anggota</span>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
					<button type="submit" class="btn btn-primary"><span id="addTextUser"></span></button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--  End Modal -->

<!-- Edit Modal -->
<div class="modal fade" id="myEditUser" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times"></i>
				</button>
			</div>
			<form id="editUser" method="POST" action="#" class="form-horizontal" enctype="multipart/form-data">
				<div class="modal-body">
					<input type="hidden" name="edit_id" id="edit_id" class="form-control">
					<div class="form-group">
						<label class="text-dark">Level</label>
						<select class="form-control" name="edit_level" id="edit_level" required="">
							<option value="">Pilih Level</option>
							<option value="1">Administrator</option>
							<option value="2">Anggota</option>
							<option value="3">Kepala Perpustakaan</option>
						</select>
					</div>
					<div class="form-group">
						<label class="text-dark">Username</label>
						<input type="text" name="edit_username" id="edit_username" class="form-control" required="">
					</div>
					<div class="form-group">
						<label class="text-dark">Nama User</label>
						<input type="text" name="edit_nama" id="edit_nama" class="form-control">
					</div>
					<div class="form-group">
						<label class="text-dark">Email</label>
						<input type="email" name="edit_email" id="edit_email" class="form-control">
					</div>
					<div class="form-group">
						<label class="text-dark">Password</label>
						<input type="password" name="edit_password" id="edit_password" class="form-control" required="">
					</div>
					<div class="form-group">
						<label class="text-dark">Konfirmasi Password</label>
						<input type="password" name="edit_confirm" id="edit_confirm" class="form-control" required="">
						<div class="row mt-1">
							<div class="col-md-10 text-right">
								<span>Show Password</span>
							</div>
							<div class="col-md-1 text-right">
								<label class="switch s-icons s-outline s-outline-primary">
									<input type="checkbox" id="edit_show">
									<span class="slider"></span>
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
					<button type="submit" class="btn btn-primary"><span id="editTextUser"></span></button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--  End Modal -->

<script type="text/javascript">
	$(document).ready(function(){
		var base = '<?= base_url(); ?>';
		var sesi = '<?= $this->session->userdata('id_user') ?>';

		var user = $('#user').DataTable({
			"lengthMenu": [10, 20, 50],
			"pageLength": 10,
			"serverSide": true,
			"processing": true,
			"order": [[0, "asc" ]],
			"ajax":{
				url :  base + 'DataTables/showUser',
				type : 'POST',
				data: {
					id_user: sesi,
				}
			},
			"columnDefs": [
			{ 
		        "targets": [ 5 ], //first column / numbering column
		        "orderable": false, //set not orderable
		    },
		    ],
		});

		$('#show').change(function(){
			if (this.checked) {
				$('#password').prop("type", "text");
				$('#confirm').prop("type", "text");
			} else {
				$('#password').prop("type", "password");
				$('#confirm').prop("type", "password");
			}
		});

		$('#edit_show').change(function(){
			if (this.checked) {
				$('#edit_password').prop("type", "text");
				$('#edit_confirm').prop("type", "text");
			} else {
				$('#edit_password').prop("type", "password");
				$('#edit_confirm').prop("type", "password");
			}
		});


		$("#password").keyup(function(){

			var confirm = $("#confirm").val();
			var password = $(this).val();

			if (confirm == password) {
				$("#confirm").css("border-color", "green");
				$("#password").css("border-color", "green");
			} else {
				$("#confirm").css("border-color", "red");
				$("#password").css("border-color", "red");
			}
		});

		$("#edit_password").keyup(function(){

			var confirm = $("#edit_confirm").val();
			var password = $(this).val();

			if (confirm == password) {
				$("#edit_confirm").css("border-color", "green");
				$("#edit_password").css("border-color", "green");
			} else {
				$("#edit_confirm").css("border-color", "red");
				$("#edit_password").css("border-color", "red");
			}
		});

		$("#confirm").keyup(function(){

			var password = $("#password").val();
			var confirm = $(this).val();

			if (confirm == password) {
				$("#confirm").css("border-color", "green");
				$("#password").css("border-color", "green");
			} else {
				$("#confirm").css("border-color", "red");
				$("#password").css("border-color", "red");
			}
		});

		$("#edit_confirm").keyup(function(){

			var password = $("#edit_password").val();
			var confirm = $(this).val();

			if (confirm == password) {
				$("#edit_confirm").css("border-color", "green");
				$("#edit_password").css("border-color", "green");
			} else {
				$("#edit_confirm").css("border-color", "red");
				$("#edit_password").css("border-color", "red");
			}
		});

		// Untuk sunting User
		$('#myEditUser').on('show.bs.modal', function(event) {
		    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
		    var modal = $(this)
		    var level = div.data('level');

		    // Isi nilai pada field

		    modal.find('#edit_id').attr("value", div.data('id_user'));
		    $('#edit_level option[value="'+level+'"]').attr('selected','selected');
		    modal.find('#edit_username').attr("value", div.data('username'));
		    modal.find('#edit_nama').attr("value", div.data('nama_user'));

		    modal.find('#edit_email').attr("value", div.data('email'));
		    modal.find('#edit_password').attr("value", div.data('password'));
		    
		    
		});

		// Add User
		$('#addTextUser').html('Save');
		$('#addUser').on('submit', function(e){  
			e.preventDefault(); 

			$('#addTextUser').html('<div class="spinner-border text-white align-self-center loader-sm "></div>');
			var password = $("#password").val();
			var confirm = $("#confirm").val();

			if (confirm == password) {
				$.ajax({  
					url: base + "Dashboard_Admin/addUser",   
					method:"POST",  
					data:new FormData(this),  
					contentType: false,  
					cache: false,  
					processData:false,  
					dataType: "json",
					success:function(res)  
					{  
						console.log(res.error);
						$('#addTextUser').html('Save');
						if(res.error == false){  
							swal({
								title: "Success!",
								text: res.message,
								type: "success",
								timer: 1000,
								button: false,
							});
						}
						else if(res.error == true){
							swal({
								title: "Failed!",
								text: res.message,
								type: "error",
							});
						}
						$('#addUser')[0].reset();
						$('#myAddUser').modal('hide');
						user.ajax.reload();
					}  
				});
			} else {
				swal({
					title: "Failed!",
					text: "Konfirmasi Password Tidak Sama!",
					type: "error",
				});
				$('#addTextUser').html('Save');
			}
		});

		// Edit User
		$('#editTextUser').html('Save');
		$('#editUser').on('submit', function(e){  
			e.preventDefault(); 

			$('#editTextUser').html('<div class="spinner-border text-white align-self-center loader-sm "></div>');
			var password = $("#edit_password").val();
			var confirm = $("#edit_confirm").val();

			if (confirm == password) {
				$.ajax({  
					url: base + "Dashboard_Admin/editUser",   
					method:"POST",  
					data:new FormData(this),  
					contentType: false,  
					cache: false,  
					processData:false,  
					dataType: "json",
					success:function(res)  
					{  
						console.log(res.error);
						$('#editTextUser').html('Save');
						if(res.error == false){  
							swal({
								title: "Success!",
								text: res.message,
								type: "success",
								timer: 1000,
								button: false,
							});
						}
						else if(res.error == true){
							swal({
								title: "Failed!",
								text: res.message,
								type: "error",
							});
						}
						$('#editUser')[0].reset();
						$('#myEditUser').modal('hide');
						user.ajax.reload();
					}  
				});
			} else {
				swal({
					title: "Failed!",
					text: "Konfirmasi Password Tidak Sama!",
					type: "error",
				});
				$('#editTextUser').html('Save');
			}
		});

		// Delete User
		$('#user').on('click','.hapus-user', function(){
			var id =  $(this).data('id_user');
			swal({
				title: "Apa anda yakin?",
				text: "Setelah dihapus, Anda tidak dapat mengembalikan data kembali!",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: 'Delete',
			}).then(function(result) {
				if (result.value) {
					$.ajax({
						url: base + "Dashboard_Admin/deleteUser/" + id,  
						method: "GET",
						beforeSend :function() {
							swal({
								title: 'Please Wait',
								html: 'Deleting data',
								onOpen: () => {
									swal.showLoading()
								}
							})      
						},
						success:function(data){
							swal({
								title: "Deleted!",
								type: "success",
								text: "Data has been deleted!",
								timer: 1000,
								buttons: false,
							});
							user.ajax.reload();
						}
					});
				}
			})
		});
	});
</script>