<div class="row layout-top-spacing layout-spacing">
	<div class="col-lg-12">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Data Buku</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area">
				<div class="form-group">
					<button class="btn btn-primary mb-2" data-toggle="modal" data-target="#myAddkategori">Tambah Data</button>
				</div>
				<div class="table-responsive mb-4 style-1">
					<table id="kategori_buku" class="table style-1 table-hover non-hover">
						<thead>
							<tr>
								<th width="10%">No. </th>
								<th width="70%">Nama Kategori</th>
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
<div class="modal fade" id="myAddkategori" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Kategori Buku</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times"></i>
				</button>
			</div>
			<form id="addKategori" method="POST" action="#" class="form-horizontal">
				<div class="modal-body">
					<div class="form-group mb-3">
						<label class="text-dark">Nama Kategori</label>
						<input type="text" name="add_nama_kategori" class="form-control" id="add_nama">
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
					<button type="submit" class="btn btn-primary"><span id="addTextKategori"></span></button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--  End Modal -->

<!-- Edit Modal -->
<div class="modal fade" id="myEditKategori" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Kategori Buku</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times"></i>
				</button>
			</div>
			<form id="editKategori" method="POST" action="#" class="form-horizontal">
				<div class="modal-body">
					<input type="hidden" name="edit_id" class="form-control" id="edit_id">
					<div class="form-group mb-3">
						<label class="text-dark">Nama Kategori</label>
						<input type="text" name="edit_nama_kategori" class="form-control" id="edit_nama">
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
					<button type="submit" class="btn btn-primary"><span id="editTextKategori"></span></button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--  End Modal -->

<script type="text/javascript">
	$(document).ready(function(){
		var base = '<?= base_url(); ?>';
		
		var kategori = $('#kategori_buku').DataTable({
			"lengthMenu": [10, 20, 50],
			"pageLength": 10,
			"serverSide": true,
			"processing": true,
			"order": [[1, "asc" ]],
			"ajax":{
				url :  base + 'DataTables/showKategori',
				type : 'POST'
			},
			"columnDefs": [
			{ 
	        "targets": [ 0 ], //first column / numbering column
	        "orderable": false, //set not orderable
	    },
	    { 
	        "targets": [ 2 ], //first column / numbering column
	        "orderable": false, //set not orderable
	    }],
	});

	// Untuk sunting Kategori
	$('#myEditKategori').on('show.bs.modal', function(event) {
	    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
	    var modal = $(this)

	    // Isi nilai pada field
	    modal.find('#edit_id').attr("value", div.data('id_kategori'));
	    modal.find('#edit_nama').attr("value", div.data('nama'));
	    // modal.find('#edit_remarks').attr("value", div.data('remarks'));
	    // modal.find('#edit_payment').attr("value", div.data('payment'));
	    // modal.find('#edit_date').attr("value", div.data('date'));
	    // modal.find('#email').attr("value", div.data('email'));
	    // modal.find('#no_telp').attr("value", div.data('no_telepon'));
	    // $('.select2_single option[value="'+level+'"]').attr('selected','selected');
	});

	// Add Kategori
	$('#addTextKategori').html('Save');
	$('#addKategori').on('submit', function(e){  
		e.preventDefault();  
		$('#addTextKategori').html('<div class="spinner-border text-white align-self-center loader-sm "></div>');

		$.ajax({  
			url: base + "Dashboard_Admin/addKategori",   
			method:"POST",  
			data:new FormData(this),  
			contentType: false,  
			cache: false,  
			processData:false,  
			dataType: "json",
			success:function(res)  
			{  
				console.log(res.error);
				$('#addTextKategori').html('Save');
				if(res.error == false){  
					swal({
						title: "Success!",
						text: res.message,
						type: "success",
						timer: 1000,
						buttons: false,
					});
				}
				else if(res.error == true){
					swal({
						title: "Failed!",
						text: res.message,
						type: "error",
					});
				}
				$('#addKategori')[0].reset();
				$('#myAddkategori').modal('hide');
				kategori.ajax.reload();
			}  
		});  
	});

	// Edit Kategori
	$('#editTextKategori').html('Save');
	$('#editKategori').on('submit', function(e){  
		e.preventDefault();  
		$('#editTextKategori').html('<div class="spinner-border text-white align-self-center loader-sm "></div>');

		$.ajax({  
			url: base + "Dashboard_Admin/editKategori",   
			method:"POST",  
			data:new FormData(this),  
			contentType: false,  
			cache: false,  
			processData:false,  
			dataType: "json",
			success:function(res)  
			{  
				console.log(res.error);
				$('#editTextKategori').html('Save');
				if(res.error == false){  
					swal({
						title: "Success!",
						text: res.message,
						type: "success",
						timer: 1000,
						buttons: false,
					});
				}
				else if(res.error == true){
					swal({
						title: "Failed!",
						text: res.message,
						type: "error",
					});
				}
				$('#editKategori')[0].reset();
				$('#myEditKategori').modal('hide');
				kategori.ajax.reload();
			}  
		});  
	});

	// Delete Kategori
	$('#kategori_buku').on('click','.hapus-kategori', function(){
		var id =  $(this).data('id_kategori');
		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this data!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Delete',
		}).then(function(result) {
			if (result.value) {
				$.ajax({
					url: base + "Dashboard_Admin/deleteKategori/" + id,  
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
						kategori.ajax.reload();
					}
				});
			}
		})
	});
});
</script>