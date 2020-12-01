<div class="row layout-top-spacing layout-spacing">
	<div class="col-lg-12">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Data Anggota</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area">
				<div class="form-group">
					<button class="btn btn-primary mb-2" data-toggle="modal" data-target="#myAddAnggota">Tambah Data</button>
				</div>
				<div class="table-responsive mb-4 style-1">
					<table id="anggota" class="table style-1 table-hover non-hover">
						<thead>
							<tr>								
								<th width="">No. Anggota</th>
								<th width="">No. Identitas</th>
								<th width="">Nama Anggota</th>
								<th width="">Tanggal Daftar</th>
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
<div class="modal fade" id="myAddAnggota" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Anggota</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times"></i>
				</button>
			</div>
			<form id="addAnggota" method="POST" action="#" class="form-horizontal" enctype="multipart/form-data">
				<div class="modal-body">
					<!-- <div class="form-group">
						<label class="text-dark">No. Anggota</label>
						<div class="row">
							<div class="col-md-9">
								<input type="text" name="add_no_anggota" class="form-control" id="add_no_anggota" readonly="" required="">
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-primary mt-1" id="btnNoAnggota">Generate</button>
							</div>
						</div>
					</div> -->
					<div class="form-group">
						<label class="text-dark">Tipe Identitas</label>
						<select class="form-control" name="add_tipe" required="">
							<option value="">Pilih Tipe Identitas</option>
							<option value="KTP">KTP</option>
							<option value="SIM">SIM</option>
							<option value="Paspor">Paspor</option>
							<option value="KTM">KTM</option>
						</select>
					</div>
					<div class="form-group">
						<label class="text-dark">No. Identitas</label>
						<input type="text" name="add_no_identitas" class="form-control">
					</div>
					<div class="form-group">
						<label class="text-dark">Nama Anggota</label>
						<input type="text" name="add_nama" class="form-control" required="">
					</div>
					<div class="form-group">
						<label class="text-dark">Kelas</label>
						<select class="form-control kelas" name="add_kelas" id="add_kelas" required="">
							<option value="">Pilih Kelas</option>
							<option value="-">-</option>
							<option value="Reguler 1">Reguler 1</option>
							<option value="Reguler 2">Reguler 2</option>
							<option value="Reguler 3">Reguler 3</option>
							<option value="Pascasarjana">Pascasarjana</option>
						</select>
					</div>
					<div class="form-group">
						<label class="text-dark">Fakultas</label>
						<input type="text" name="add_fakultas" id="add_fakultas" class="form-control">
					</div>
					<div class="form-group">
						<label class="text-dark">Program Studi</label>
						<input type="text" name="add_prodi" id="add_prodi" class="form-control">
					</div>
					<div class="form-group">
						<label class="text-dark">Email</label>
						<input type="email" name="add_email" class="form-control">
					</div>
					<div class="form-group">
						<label class="text-dark">No. Telp</label>
						<input type="text" name="add_telp" class="form-control">
					</div>
					<div class="form-group">
						<label class="text-dark">Alamat</label>
						<textarea name="add_alamat" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label class="text-dark">Username</label>
						<input type="text" name="username" id="username" class="form-control" required="">
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
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
					<button type="submit" class="btn btn-primary"><span id="addTextAnggota"></span></button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--  End Modal -->

<!-- Edit Modal -->
<div class="modal fade" id="myEditAnggota" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Anggota</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times"></i>
				</button>
			</div>
			<form id="editAnggota" method="POST" action="#" class="form-horizontal" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label class="text-dark">No. Anggota</label>
						<input type="text" name="edit_no_anggota" class="form-control" id="edit_no_anggota" readonly="" required="">
					</div>
					<div class="form-group">
						<label class="text-dark" id="x">Tipe Identitas</label>
						<select class="form-control" name="edit_tipe" id="edit_tipe" required="">
							<option value="">Pilih Tipe Identitas</option>
							<option value="KTP">KTP</option>
							<option value="SIM">SIM</option>
							<option value="Paspor">Paspor</option>
							<option value="KTM">KTM</option>
						</select>
					</div>
					<div class="form-group">
						<label class="text-dark">No. Identitas</label>
						<input type="text" name="edit_no_identitas" id="edit_no_identitas" class="form-control">
					</div>
					<div class="form-group">
						<label class="text-dark">Nama Anggota</label>
						<input type="text" name="edit_nama" id="edit_nama" class="form-control">
					</div>
					<div class="form-group">
						<label class="text-dark">Kelas</label>
						<select class="form-control kelas" name="edit_kelas" id="edit_kelas" required="">
							<option value="">Pilih Kelas</option>
							<option value="-">-</option>
							<option value="Reguler 1">Reguler 1</option>
							<option value="Reguler 2">Reguler 2</option>
							<option value="Reguler 3">Reguler 3</option>
							<option value="Pascasarjana">Pascasarjana</option>
						</select>
					</div>
					<div class="form-group">
						<label class="text-dark">Fakultas</label>
						<input type="text" name="edit_fakultas" id="edit_fakultas" class="form-control">
					</div>
					<div class="form-group">
						<label class="text-dark">Program Studi</label>
						<input type="text" name="edit_prodi" id="edit_prodi" class="form-control">
					</div>
					<div class="form-group">
						<label class="text-dark">Alamat</label>
						<textarea name="edit_alamat" id="edit_alamat" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
					<button type="submit" class="btn btn-primary"><span id="editTextAnggota"></span></button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--  End Modal -->


<script type="text/javascript">
	$(document).ready(function(){
		var base = '<?= base_url(); ?>';

		var anggota = $('#anggota').DataTable({
			"lengthMenu": [10, 20, 50],
			"pageLength": 10,
			"serverSide": true,
			"processing": true,
			"order": [[0, "asc" ]],
			"ajax":{
				url :  base + 'DataTables/showAnggota',
				type : 'POST'
			},
			"columnDefs": [
			{ 
		        "targets": [ 4 ], //first column / numbering column
		        "orderable": false, //set not orderable
		    },
		    ],
		});

		// $('#btnNoAnggota').click(function(){
		// 	$.ajax({
		// 		type    : 'POST',
		// 		url     :  base + 'Dashboard_Admin/kodeAnggota',
		// 		datatype: 'json',
		// 		success : function(response){
		// 			response = response.replace(/^\s*[\r\n]/gm, "");
		// 			response = JSON.parse(response);
		// 			$("#add_no_anggota").val(response);
		// 		}
		// 	});
		// });

		$('#show').change(function(){
			if (this.checked) {
				$('#password').prop("type", "text");
				$('#confirm').prop("type", "text");
			} else {
				$('#password').prop("type", "password");
				$('#confirm').prop("type", "password");
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

		$('#add_fakultas').val("");
		$('#add_prodi').val("");
		$('#add_fakultas').prop("readonly", true);
		$('#add_prodi').prop("readonly", true);
		$('#add_kelas').change(function(){
			var kelas = $(this).val();

			if (kelas == '-' || kelas == '') {
				$('#add_fakultas').val("");
				$('#add_prodi').val("");
				$('#add_fakultas').prop("readonly", true);
				$('#add_prodi').prop("readonly", true);
			} else {
				$('#add_fakultas').prop("readonly", false);
				$('#add_prodi').prop("readonly", false);
			}
		});

		$('#edit_kelas').change(function(){
			var kelas = $(this).val();

			if (kelas == '-' || kelas == '') {
				$('#edit_fakultas').val("");
				$('#edit_prodi').val("");
				$('#edit_fakultas').prop("readonly", true);
				$('#edit_prodi').prop("readonly", true);
			} else {
				$('#edit_fakultas').prop("readonly", false);
				$('#edit_prodi').prop("readonly", false);
			}
		});

		// Untuk sunting Anggota
		$('#myEditAnggota').on('show.bs.modal', function(event) {
		    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
		    var modal = $(this)
		    var tanda_pengenal = div.data('tanda_pengenal');
		    var kelas = div.data('kelas');

		    // Isi nilai pada field

		    modal.find('#edit_no_anggota').attr("value", div.data('no_anggota'));
		    $("#edit_tipe").val(tanda_pengenal).trigger("change");
		    // $('#edit_tipe option[value="'+tanda_pengenal+'"]').attr('selected','selected');
		    modal.find('#edit_no_identitas').attr("value", div.data('no_identitas'));
		    modal.find('#edit_nama').attr("value", div.data('nama_anggota'));
		    

		    // $('#edit_kelas option[value="'+kelas+'"]').attr('selected','selected');
		    $("#edit_kelas").val(kelas).trigger("change");
		    modal.find('#edit_alamat').html(div.data('alamat'));

		    var select_kelas = $('#edit_kelas').val();
		    if (kelas == '-' || kelas == '') {
		    	$('#edit_fakultas').val("");
		    	$('#edit_prodi').val("");
		    	$('#edit_fakultas').prop("readonly", true);
		    	$('#edit_prodi').prop("readonly", true);
		    } else {
		    	$('#edit_fakultas').prop("readonly", false);
		    	$('#edit_prodi').prop("readonly", false);
		    	modal.find('#edit_fakultas').attr("value", div.data('fakultas'));
		    	modal.find('#edit_prodi').attr("value", div.data('prodi'));
		    }
		    
		});

		// Add Anggota
		$('#addTextAnggota').html('Save');
		$('#addAnggota').on('submit', function(e){  
			e.preventDefault(); 

			$('#addTextAnggota').html('<div class="spinner-border text-white align-self-center loader-sm "></div>');
			var password = $("#password").val();
			var confirm = $("#confirm").val();

			if (confirm == password) {
				$.ajax({  
					url: base + "Dashboard_Admin/addAnggota",   
					method:"POST",  
					data:new FormData(this),  
					contentType: false,  
					cache: false,  
					processData:false,  
					dataType: "json",
					success:function(res)  
					{  
						console.log(res.error);
						$('#addTextAnggota').html('Save');
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
						$('#addAnggota')[0].reset();
						$('#myAddAnggota').modal('hide');
						anggota.ajax.reload();
					}  
				});
			} else {
				swal({
					title: "Failed!",
					text: "Konfirmasi Password Tidak Sama!",
					type: "error",
				});
				$('#addTextAnggota').html('Save');
			}
		});

		// Edit Anggota
		$('#editTextAnggota').html('Save');
		$('#editAnggota').on('submit', function(e){  
			e.preventDefault(); 

			$('#editTextAnggota').html('<div class="spinner-border text-white align-self-center loader-sm "></div>');

			$.ajax({  
				url: base + "Dashboard_Admin/editAnggota",   
				method:"POST",  
				data:new FormData(this),  
				contentType: false,  
				cache: false,  
				processData:false,  
				dataType: "json",
				success:function(res)  
				{  
					console.log(res.error);
					$('#editTextAnggota').html('Save');
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
					$('#editAnggota')[0].reset();
					$('#myEditAnggota').modal('hide');
					anggota.ajax.reload();
				}  
			});  
		});

		// Delete Anggota
		$('#anggota').on('click','.hapus-anggota', function(){
			var id =  $(this).data('no_anggota');
			swal({
				title: "Apa anda yakin?",
				text: "Setelah dihapus, Anda tidak dapat mengembalikan data kembali!",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: 'Delete',
			}).then(function(result) {
				if (result.value) {
					$.ajax({
						url: base + "Dashboard_Admin/deleteAnggota/" + id,  
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
							anggota.ajax.reload();
						}
					});
				}
			})
		});
	});
</script>