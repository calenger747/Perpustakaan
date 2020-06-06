<div class="row layout-top-spacing layout-spacing">
	<div class="col-lg-12">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Data Supplier</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area">
				<div class="form-group">
					<button class="btn btn-primary mb-2" data-toggle="modal" data-target="#myAddSupplier">Tambah Data</button>
				</div>
				<div class="table-responsive mb-4 style-1">
					<table id="supplier" class="table style-1 table-hover non-hover">
						<thead>
							<tr>								
								<th width="">No. </th>
								<th width="">Nama Supplier</th>
								<th width="">Email</th>
								<th width="">Telp/Fax</th>
								<th width="">Alamat</th>
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
<div class="modal fade" id="myAddSupplier" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Supplier</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times"></i>
				</button>
			</div>
			<form id="addSupplier" method="POST" action="#" class="form-horizontal" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label class="text-dark">Nama Supplier</label>
						<input type="text" name="add_nama" class="form-control">
					</div>
					<div class="form-group">
						<label class="text-dark">Email</label>
						<input type="text" name="add_email" class="form-control">
					</div>
					<div class="form-group">
						<label class="text-dark">No. Telp</label>
						<input type="text" name="add_telp" class="form-control telp">
					</div>
					<div class="form-group">
						<label class="text-dark">Fax</label>
						<input type="text" name="add_fax" id="add_fax" class="form-control">
					</div>
					<div class="form-group">
						<label class="text-dark">Alamat</label>
						<textarea name="add_alamat" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
					<button type="submit" class="btn btn-primary"><span id="addTextSupplier"></span></button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--  End Modal -->

<!-- Edit Modal -->
<div class="modal fade" id="myEditSupplier" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times"></i>
				</button>
			</div>
			<form id="editSupplier" method="POST" action="#" class="form-horizontal" enctype="multipart/form-data">
				<div class="modal-body">
					<input type="hidden" name="edit_id" id="edit_id" class="form-control">
					<div class="form-group">
						<label class="text-dark">Nama Supplier</label>
						<input type="text" name="edit_nama" id="edit_nama" class="form-control">
					</div>
					<div class="form-group">
						<label class="text-dark">Email</label>
						<input type="text" name="edit_email" id="edit_email" class="form-control">
					</div>
					<div class="form-group">
						<label class="text-dark">No. Telp</label>
						<input type="text" name="edit_telp" id="edit_telp" class="form-control">
					</div>
					<div class="form-group">
						<label class="text-dark">Fax</label>
						<input type="text" name="edit_fax" id="edit_fax" class="form-control">
					</div>
					<div class="form-group">
						<label class="text-dark">Alamat</label>
						<textarea name="edit_alamat" id="edit_alamat" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
					<button type="submit" class="btn btn-primary"><span id="editTextSupplier"></span></button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--  End Modal -->

<script type="text/javascript">
	$(document).ready(function(){

		var base = '<?= base_url(); ?>';

		var supplier = $('#supplier').DataTable({
			"lengthMenu": [10, 20, 50],
			"pageLength": 10,
			"serverSide": true,
			"processing": true,
			"order": [[0, "asc" ]],
			"ajax":{
				url :  base + 'DataTables/showSupplier',
				type : 'POST'
			},
			"columnDefs": [
			{ 
		        "targets": [ 5 ], //first column / numbering column
		        "orderable": false, //set not orderable
		    },
		    ],
		});

		$('#myEditSupplier').on('show.bs.modal', function(event) {
		    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
		    var modal = $(this)
		    var no_telp = div.data('no_telp');

		    // Isi nilai pada field

		    modal.find('#edit_id').attr("value", div.data('id_supplier'));
		    modal.find('#edit_nama').attr("value", div.data('nama_supplier'));
		    modal.find('#edit_email').attr("value", div.data('email'));
		    modal.find('#edit_telp').attr("value", no_telp);
		    modal.find('#edit_fax').attr("value", div.data('fax'));

		    modal.find('#edit_alamat').html(div.data('alamat'));
		    
		});

		// Add Anggota
		$('#addTextSupplier').html('Save');
		$('#addSupplier').on('submit', function(e){  
			e.preventDefault(); 

			$('#addTextSupplier').html('<div class="spinner-border text-white align-self-center loader-sm "></div>');

			$.ajax({  
				url: base + "Dashboard_Admin/addSupplier",   
				method:"POST",  
				data:new FormData(this),  
				contentType: false,  
				cache: false,  
				processData:false,  
				dataType: "json",
				success:function(res)  
				{  
					console.log(res.error);
					$('#addTextSupplier').html('Save');
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
					$('#addSupplier')[0].reset();
					$('#myAddSupplier').modal('hide');
					supplier.ajax.reload();
				}  
			});  
		});

		// Edit Anggota
		$('#editTextSupplier').html('Save');
		$('#editSupplier').on('submit', function(e){  
			e.preventDefault(); 

			$('#editTextSupplier').html('<div class="spinner-border text-white align-self-center loader-sm "></div>');

			$.ajax({  
				url: base + "Dashboard_Admin/editSupplier",   
				method:"POST",  
				data:new FormData(this),  
				contentType: false,  
				cache: false,  
				processData:false,  
				dataType: "json",
				success:function(res)  
				{  
					console.log(res.error);
					$('#editTextSupplier').html('Save');
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
					$('#editSupplier')[0].reset();
					$('#myEditSupplier').modal('hide');
					supplier.ajax.reload();
				}  
			});  
		});

		// Delete Supplier
		$('#supplier').on('click','.hapus-supplier', function(){
			var id =  $(this).data('id_supplier');
			swal({
				title: "Apa anda yakin?",
				text: "Setelah dihapus, Anda tidak dapat mengembalikan data kembali!",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: 'Delete',
			}).then(function(result) {
				if (result.value) {
					$.ajax({
						url: base + "Dashboard_Admin/deleteSupplier/" + id,  
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
							supplier.ajax.reload();
						}
					});
				}
			})
		});
	});
</script>