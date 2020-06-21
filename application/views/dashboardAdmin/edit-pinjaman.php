<div class="row layout-top-spacing layout-spacing">
	<div class="col-lg-12">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Proses Peminjaman</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area">
				<form id="formTambah" method="POST" action="#" class="mb-4">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">No. Pinjaman</label>
								<input type="text" name="no_pinjaman" id="no_pinjam" class="form-control" value="<?= $pinjaman->no_pinjaman; ?>" readonly>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Nama Anggota</label>
								<input type="text" name="no_anggota" id="no_anggota" class="form-control" value="<?= $pinjaman->no_anggota; ?>" readonly>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Nama Anggota</label>
								<input type="text" name="nama_anggota" id="nama_anggota" class="form-control" value="<?= $pinjaman->nama_anggota; ?>" readonly>
							</div>
						</div>
					</div>
					<!-- <div class="form-group">
						<div class="row">
							<div class="col-md-4">
								<label class="control-label">Kode Buku</label>
								<select name="kode_buku" class="form-control selectpicker" id="kode_buku" data-live-search="true" size="5" required="">
									<option value="">Kode Buku</option>
									<?php foreach ($buku as $row) { ?>
										<option value="<?= $row->id_buku; ?>"><?= $row->kode_buku; ?></option>
										<?php
									}?>
								</select>
							</div>
							<div class="col-md-4">
								<label class="control-label">Nama Buku</label>
								<input type="text" name="nama_buku" id="nama_buku" class="form-control" readonly>
								<input type="hidden" id="stok" name="">
							</div>
							<div class="col-md-2">
								<label class="control-label">Jumlah</label>
								<input type="number" name="jumlah" id="jumlah" min="1" max="3" class="form-control">
							</div>
							<div class="col-md-2">
								<br>
								<button type="button" id="btnBuku" class="btn btn-info mt-3"><span id="addTextBuku"></span></button>
							</div>
						</div>
					</div> -->
					<hr>
					<div class="table-responsive mb-4 style-1">
						<h6>Detail Buku</h6>
						<table id="buku" class="table style-1 table-hover non-hover">
							<thead>
								<tr>								
									<th width="">Kode Buku</th>
									<th width="">Nama Buku</th>
									<th width="">Kategori</th>
									<th width="">Pengarang</th>
									<th width="20%">QTY</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
					<hr>
					<div class="form-group text-right">
						<a href="javascript:history.back()">
							<button type="button" class="btn btn-warning">Kembali</button>
						</a>
						<button type="button" id="btnSimpan" class="btn btn-primary"><span id="addTextSimpan"></span></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){

		var base = '<?= base_url(); ?>';
		var no_anggota = $('#no_anggota').val();

		var buku = $('#buku').DataTable({
			"lengthMenu": [10, 20, 50],
			"pageLength": 10,
			"serverSide": true,
			"processing": true,
			"order": [[0, "asc" ]],
			"ajax":{
				url :  base + 'DataTables/showDetailPinjaman',
				type : 'POST',
				data : function ( data ) {
					data.no_pinjam = $('#no_pinjam').val();
				}
			},
		});

		$('#kode_buku').change(function(){
			var id_buku = $(this).val();

			$.ajax({  
				url: base + "Dashboard_Admin/getNamaBuku",   
				method:"POST",  
				data: {
					id_buku : id_buku,
				},  
				dataType: "json",
				success:function(data)  
				{  
					$('#nama_buku').val(data.nama);
					$('#stok').val(data.stok);
					$('#jumlah').val('1');
				}  
			});
		});

		$('#addTextBuku').html('Tambah');
		$('#btnBuku').click(function(){
			var no_pinjaman = $('#no_pinjam').val();
			var no_anggota = $('#no_anggota').val();
			var id_buku = $('#kode_buku').val();
			var qty = $('#jumlah').val();
			var stok = $('#stok').val();

			if (no_anggota == '') {
				$('#no_anggota').css("border-color", "red");
			} else if (id_buku == '') {
				$('#kode_buku').css("border-color", "red");
			} else if (qty == '') {
				$('#jumlah').css("border-color", "red");
			} else if (stok < qty) {
				swal({
					title: "Failed!",
					text: "Stok Buku Ini Hanya " + stok + "!",
					type: "error",
				});
				$('#jumlah').val('1');
			} else {
				$('#addTextBuku').html('<div class="spinner-border text-white align-self-center loader-sm "></div>');
				$.ajax({  
					url: base + "Dashboard_Admin/addDetail",   
					method:"POST",  
					data: {
						id_buku : id_buku,
						no_pinjaman : no_pinjaman,
						qty : qty,
						stok : stok,
					},    
					dataType: "json",
					success:function(res)  
					{  
						console.log(res.error);
						$('#addTextBuku').html('Tambah');
						if(res.error == false){  
							// swal({
							// 	title: "Success!",
							// 	text: res.message,
							// 	type: "success",
							// 	timer: 1000,
							// 	buttons: false,
							// });
							$('#kode_buku').val('');
							$('#nama_buku').val('');
							$('#jumlah').val('');
						}
						else if(res.error == true){
							swal({
								title: "Failed!",
								text: res.message,
								type: "error",
							});
							$('#jumlah').val('1');
						}
						buku.ajax.reload();
					}  
				});
			}
		});

		// Ubah Cart
		$('#buku').on('input','.edit-qty', function(){
			var id_detail =  $(this).data('id_detail');
			var no_pinjaman =  $(this).data('no_pinjaman');
			var id_buku =  $(this).data('id_buku');
			var stok =  $(this).data('stok');
			var qty_lama =  $(this).data('qty');
			var qty = $(this).val();
			$.ajax({  
				url: base + "Dashboard_Admin/updateDetail",   
				method:"POST",  
				data: {
					id_detail : id_detail,
					id_buku : id_buku,
					no_pinjaman : no_pinjaman,
					qty : qty,
					qty_lama : qty_lama,
					stok : stok,
				},    
				dataType: "json",
				success:function(res)  
				{  
					console.log(res.error);
					if(res.error == true){
						swal({
							title: "Failed!",
							text: res.message,
							type: "error",
						});
					}
					buku.ajax.reload();
				}  
			});
		});

		// Delete Cart
		$('#buku').on('click','.hapus-keranjang', function(){
			var id =  $(this).data('id_detail');
			swal({
				title: "Apa anda yakin?",
				text: "Setelah dihapus, Anda tidak dapat mengembalikan data kembali!",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: 'Delete',
			}).then(function(result) {
				if (result.value) {
					$.ajax({
						url: base + "Dashboard_Admin/deleteDetail/" + id,  
						method: "GET",
						success:function(data){
							// swal({
							// 	title: "Deleted!",
							// 	type: "success",
							// 	text: "Data has been deleted!",
							// 	timer: 1000,
							// 	buttons: false,
							// });
							buku.ajax.reload();
						}
					});
				}
			})
		});

		$('#addTextSimpan').html('Simpan');
		$('#btnSimpan').click(function(){
			var no_pinjam = $('#no_pinjam').val();
			var no_anggota = $('#no_anggota').val();

			$('#addTextSimpan').html('<div class="spinner-border text-white align-self-center loader-sm "></div>');
			$.ajax({  
				url: base + "Dashboard_Admin/updatePinjaman",   
				method:"POST",  
				data: {
					no_pinjam : no_pinjam,
					no_anggota : no_anggota,
				},    
				dataType: "json",
				success:function(res)  
				{  
					console.log(res.error);
					$('#addTextSimpan').html('Simpan');
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

					buku.ajax.reload();
				}  
			});
		});
	});
</script>