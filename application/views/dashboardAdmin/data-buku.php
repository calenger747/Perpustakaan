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
					<button class="btn btn-primary mb-2" data-toggle="modal" data-target="#myAddBuku">Tambah Data</button>
				</div>
				<div class="table-responsive mb-4 style-1">
					<table id="buku" class="table style-1 table-hover non-hover">
						<thead>
							<tr>
								<th width="10%">No. </th>
								<th width="">Gambar</th>
								<th width="">Nama Buku</th>
								<th width="">Kategori</th>
								<th width="">Pengarang</th>
								<th width="">Tahun Terbit</th>
								<th width="">Stok</th>
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
<div class="modal fade" id="myAddBuku" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times"></i>
				</button>
			</div>
			<form id="addBuku" method="POST" action="#" class="form-horizontal" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label class="text-dark">Kode Buku</label>
								<input type="text" name="add_kode" class="form-control" id="add_kode">
							</div>
							<div class="col-md-6">
								<label class="text-dark">Nama Buku</label>
								<input type="text" name="add_nama" class="form-control" id="add_nama">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label class="text-dark">Kategori</label>
								<select class="form-control selectpicker" name="add_kategori" id="add_kategori"  data-live-search="true" size="5" required="">
									<option value="">Pilih Kategori</option>
									<?php foreach ($kategori as $row) { ?>
										<option value="<?= $row->id_kategori; ?>"><?= $row->nama_kategori; ?></option>
										<?php
									}?>
								</select>
							</div>
							<div class="col-md-6">
								<label class="text-dark">Pengarang</label>
								<input type="text" name="add_pengarang" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-12">
								<label class="text-dark">Deskripsi</label>
								<textarea name="add_deskripsi" id="editor1" class="form-control"></textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label class="text-dark">Tahun Terbit</label>
								<div class="row">
									<div class="col-md-12">
										<input id="tahun_terbit" name="add_tahun" value="" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Year..">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<label class="text-dark">Gambar</label>
								<input type="file" name="file" class="form-control gambar" accept="image/*" required="">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label class="text-dark">Stok</label>
								<input type="number" name="add_stok" class="form-control">
							</div>
							<div class="col-md-6">
								<label class="text-dark">Nama Supplier</label>
								<select class="form-control selectpicker" name="add_supplier" id="add_supplier"data-live-search="true" size="5" required="">
									<option value="">Pilih Supplier</option>
									<?php foreach ($supplier as $row) { ?>
										<option value="<?= $row->id_supplier; ?>"><?= $row->nama_supplier; ?></option>
										<?php
									}?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
					<button type="submit" class="btn btn-primary"><span id="addTextBuku"></span></button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--  End Modal -->

<!-- Edit Modal -->
<div class="modal fade" id="myEditBuku" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Buku "<span id="judul"></span>"</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times"></i>
				</button>
			</div>
			<form id="editBuku" method="POST" action="#" class="form-horizontal">
				<div class="modal-body">
					<input type="hidden" name="edit_id" class="form-control" id="edit_id">
					<div class="form-group text-center">
						<img id="foto" alt="gallery-img" width="55%">
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label class="text-dark">Kode Buku</label>
								<input type="text" name="edit_kode" class="form-control" id="edit_kode">
							</div>
							<div class="col-md-6">
								<label class="text-dark">Nama Buku</label>
								<input type="text" name="edit_nama" class="form-control" id="edit_nama">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6 1">
								<label class="text-dark">Kategori</label>
								<select class="form-control selectpicker" name="edit_kategori" data-live-search="true" size="5" id="edit_kategori" required="">
									<option value="">Pilih Kategori</option>
									<?php foreach ($kategori as $row) { ?>
										<option value="<?= $row->id_kategori; ?>"><?= $row->nama_kategori; ?></option>
										<?php
									}?>
								</select>
							</div>
							<div class="col-md-6">
								<label class="text-dark">Pengarang</label>
								<input type="text" name="edit_pengarang" id="edit_pengarang" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-12">
								<label class="text-dark">Deskripsi</label>
								<textarea name="edit_deskripsi" id="edit_deskripsi" class="form-control"></textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label class="text-dark">Tahun Terbit</label>
								<div class="input-group">
									<input type="text" name="edit_tahun" class="form-control date-own" id="edit_tahun" placeholder="Select Year" required="">
								</div>
								<!-- <div class="row">
									<div class="col-md-12">
										<input id="edit_tahun" name="edit_tahun" value="" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Year..">
									</div>
								</div>	 -->							
							</div>
							<div class="col-md-6">
								<label class="text-dark">Gambar</label>
								<input type="file" name="file" class="form-control gambar" accept="image/*">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label class="text-dark">Stok</label>
								<input type="number" name="edit_stok" id="edit_stok" class="form-control">
							</div>
							<div class="col-md-6 2">
								<label class="text-dark">Nama Supplier</label>
								<select class="form-control selectpicker" name="edit_supplier" data-live-search="true" size="5" id="edit_supplier" required="">
									<option value="">Pilih Supplier</option>
									<?php foreach ($supplier as $row) { ?>
										<option value="<?= $row->id_supplier; ?>"><?= $row->nama_supplier; ?></option>
										<?php
									}?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
					<button type="submit" class="btn btn-primary"><span id="editTextBuku"></span></button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--  End Modal -->
<script type="text/javascript">
	var f1 = flatpickr(document.getElementById('tahun_terbit'), {
		dateFormat: "Y",
		static : true,
	});

	// var f2 = flatpickr(document.getElementById('edit_tahun'), {
	// 	dateFormat: "Y",
	// 	static : true,
	// });

	$('.date-own').datepicker({
			minViewMode: 2,
			format: 'yyyy',
			autoclose: true
		});

	CKEDITOR.replace('editor1', {
		height: 150,
		baseFloatZIndex: 10005,
	});

	CKEDITOR.replace('edit_deskripsi', {
		height: 150,
		baseFloatZIndex: 10005,
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){

		var base = '<?= base_url(); ?>';

		var buku = $('#buku').DataTable({
			"lengthMenu": [10, 20, 50],
			"pageLength": 10,
			"serverSide": true,
			"processing": true,
			"order": [[2, "asc" ]],
			"ajax":{
				url :  base + 'DataTables/showBuku',
				type : 'POST'
			},
			"columnDefs": [
			{ 
		        "targets": [ 0 ], //first column / numbering column
		        "orderable": false, //set not orderable
		    },
		    { 
		        "targets": [ 1 ], //first column / numbering column
		        "orderable": false, //set not orderable
		    },
		    { 
		        "targets": [ 7 ], //first column / numbering column
		        "orderable": false, //set not orderable
		    },
		    ],
		});

		// Validasi file upload
		$(".gambar").change(function() {
			if (this.files && this.files[0] && this.files[0].name.match(/\.(jpg|jpeg|png|JPG|JPEG|PNG)$/) ) {
				if(this.files[0].size>10485760) {
					$('.gambar').val('');
					alert('Batas Maximal Ukuran File 10MB !');
				}
				else {
					var reader = new FileReader();
					reader.readAsDataURL(this.files[0]);
				}
			} else{
				$('.gambar').val('');
				alert('Hanya File jpg/png Yang Diizinkan !');
			}
		});

		// Untuk sunting Kategori
		$('#myEditBuku').on('show.bs.modal', function(event) {
		    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
		    var modal = $(this)
		    var kategori = div.data('kategori');
		    var supplier = div.data('id_supplier');
		    var dokumen = div.data('gambar');

		    // Isi nilai pada field
		    modal.find('#judul').html(div.data('nama'));

		    modal.find('#edit_id').attr("value", div.data('id_buku'));
		    modal.find('#edit_kode').attr("value", div.data('kode'));
		    modal.find('#edit_nama').attr("value", div.data('nama'));
		    modal.find('#edit_pengarang').attr("value", div.data('pengarang'));
		    modal.find('#edit_tahun').attr("value", div.data('tahun_terbit'));

		    var b = modal.find('#edit_deskripsi').val(div.data('deskripsi'));
		    CKEDITOR.instances['edit_deskripsi'].setData(b);

		    // modal.find('#edit_kategori').val(kategori);
		    $("#edit_kategori").val(kategori).trigger("change");
		    // modal.find('#edit_supplier').val(supplier);
		    $("#edit_supplier").val(supplier).trigger("change");

		    var text = $("select[name=edit_kategori] option[value='"+kategori+"']").text();
		    $('.1 .bootstrap-select .filter-option').text(text);
			//Check the selected attribute for the real select
			$('select[name=edit_kategori]').val(kategori);
		    $('#edit_kategori option[value="'+kategori+'"]').attr('selected','selected');

		    var text2 = $("select[name=edit_supplier] option[value='"+supplier+"']").text();
		    $('.2 .bootstrap-select .filter-option').text(text2);
			//Check the selected attribute for the real select
			$('select[name=edit_supplier]').val(supplier);
		    $('#edit_supplier option[value="'+supplier+'"]').attr('selected','selected');

		    modal.find('#foto').attr("src", "<?php echo base_url(); ?>app-assets/upload/" + dokumen);
		    modal.find('#edit_stok').attr("value", div.data('stok'));
		    
		});

		// Add Kategori
		$('#addTextBuku').html('Save');
		$('#addBuku').on('submit', function(e){  
			e.preventDefault(); 
			for (instance in CKEDITOR.instances) {
				CKEDITOR.instances[instance].updateElement();
			}

			$('#addTextBuku').html('<div class="spinner-border text-white align-self-center loader-sm "></div>');

			$.ajax({  
				url: base + "Dashboard_Admin/addBuku",   
				method:"POST",  
				data:new FormData(this),  
				contentType: false,  
				cache: false,  
				processData:false,  
				dataType: "json",
				success:function(res)  
				{  
					console.log(res.error);
					$('#addTextBuku').html('Save');
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
					$('#addBuku')[0].reset();
					$('#myAddBuku').modal('hide');
					buku.ajax.reload();
				}  
			});  
		});

		// Edit Kategori
		$('#editTextBuku').html('Save');
		$('#editBuku').on('submit', function(e){  
			e.preventDefault();  

			for (instance in CKEDITOR.instances) {
				CKEDITOR.instances[instance].updateElement();
			}
			$('#editTextKategori').html('<div class="spinner-border text-white align-self-center loader-sm "></div>');

			$.ajax({  
				url: base + "Dashboard_Admin/editBuku",   
				method:"POST",  
				data:new FormData(this),  
				contentType: false,  
				cache: false,  
				processData:false,  
				dataType: "json",
				success:function(res)  
				{  
					console.log(res.error);
					$('#editTextBuku').html('Save');
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
					$('#editBuku')[0].reset();
					$('#myEditBuku').modal('hide');
					buku.ajax.reload();
				}  
			});  
		});

		// Delete Kategori
		$('#buku').on('click','.hapus-buku', function(){
			var id =  $(this).data('id_buku');
			swal({
				title: "Apa anda yakin?",
				text: "Setelah dihapus, Anda tidak dapat mengembalikan data kembali!",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: 'Delete',
			}).then(function(result) {
				if (result.value) {
					$.ajax({
						url: base + "Dashboard_Admin/deleteBuku/" + id,  
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
							buku.ajax.reload();
						}
					});
				}
			})
		});
	});
</script>