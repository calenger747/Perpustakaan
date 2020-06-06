<div class="row layout-top-spacing layout-spacing">
	<div class="col-lg-6">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Pengaturan Profil</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area">
				<form id="editUser" method="POST" action="#" class="form-horizontal" enctype="multipart/form-data">
					<input type="hidden" name="edit_id"  value="<?= $profile->id_user; ?>" id="edit_id" class="form-control">
					<div class="form-group">
						<label class="text-dark">Username</label>
						<input type="text" name="edit_username" value="<?= $profile->username; ?>" class="form-control" required="">
					</div>
					<div class="form-group">
						<label class="text-dark">Nama</label>
						<input type="text" name="edit_nama" value="<?= $profile->nama; ?>" class="form-control" required="">
					</div>
					<div class="form-group">
						<label class="text-dark">Email</label>
						<input type="email" name="edit_email" value="<?= $profile->email; ?>" class="form-control" required="">
					</div>
					<div class="form-group pull-right">
						<button type="submit" class="btn btn-primary"><span id="editTextUser"></span></button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Ubah Password</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area">
				<form id="editPassword" method="POST" action="#" class="form-horizontal" enctype="multipart/form-data">
					<input type="hidden" name="edit_id"  value="<?= $profile->id_user; ?>" id="edit_id" class="form-control">
					<div class="form-group">
						<label class="text-dark">Password Lama</label>
						<input type="password" name="old_password" id="old_password" class="form-control" required="">
					</div>
					<div class="form-group">
						<label class="text-dark">Password Baru</label>
						<input type="password" name="new_password" id="new_password" class="form-control" required="">
					</div>
					<div class="form-group">
						<label class="text-dark">Konfirmasi Password Baru</label>
						<input type="password" name="confirm_new" id="confirm_new" class="form-control" required="">
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
					<div class="form-group pull-right">
						<button type="submit" class="btn btn-primary"><span id="editTextPassword"></span></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var base = '<?= base_url(); ?>';

		$('#show').change(function(){
			if (this.checked) {
				$('#old_password').prop("type", "text");
				$('#new_password').prop("type", "text");
				$('#confirm_new').prop("type", "text");
			} else {
				$('#old_password').prop("type", "password");
				$('#new_password').prop("type", "password");
				$('#confirm_new').prop("type", "password");
			}
		});

		$("#new_password").keyup(function(){

			var confirm = $("#confirm_new").val();
			var password = $(this).val();

			if (confirm == password) {
				$("#confirm_new").css("border-color", "green");
				$("#new_password").css("border-color", "green");
			} else {
				$("#confirm_new").css("border-color", "red");
				$("#new_password").css("border-color", "red");
			}
		});

		$("#confirm_new").keyup(function(){

			var password = $("#new_password").val();
			var confirm = $(this).val();

			if (confirm == password) {
				$("#confirm_new").css("border-color", "green");
				$("#new_password").css("border-color", "green");
			} else {
				$("#confirm_new").css("border-color", "red");
				$("#new_password").css("border-color", "red");
			}
		});

		// Edit Profile
		$('#editTextUser').html('Save');
		$('#editUser').on('submit', function(e){  
			e.preventDefault(); 

			$('#editTextUser').html('<div class="spinner-border text-white align-self-center loader-sm "></div>');
			$.ajax({  
				url: base + "Laporan/editProfile",   
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
				}  
			});
		});

		// Edit User
		$('#editTextPassword').html('Save');
		$('#editPassword').on('submit', function(e){  
			e.preventDefault(); 

			$('#editTextPassword').html('<div class="spinner-border text-white align-self-center loader-sm "></div>');
			var password = $("#new_password").val();
			var confirm = $("#confirm_new").val();

			if (confirm == password) {
				$.ajax({  
					url: base + "Laporan/editPassword",   
					method:"POST",  
					data:new FormData(this),  
					contentType: false,  
					cache: false,  
					processData:false,  
					dataType: "json",
					success:function(res)  
					{  
						console.log(res.error);
						$('#editTextPassword').html('Save');
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
						$('#editPassword')[0].reset();
					}  
				});
			} else {
				swal({
					title: "Failed!",
					text: "Konfirmasi Password Tidak Sama!",
					type: "error",
				});
				$('#editTextPassword').html('Save');
			}
		});
	});
</script>