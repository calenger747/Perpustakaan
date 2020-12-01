<div class="row layout-top-spacing layout-spacing">
	<div class="col-lg-12">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Tambah Pengembalian</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area">
				<form id="formTambah" method="POST" action="#" class="mb-4">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">No. Pengembalian</label>
								<input type="text" name="no_kembali" id="no_kembali" class="form-control" value="<?= $no_kembali; ?>" readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group 1">
								<label class="control-label">No. Pinjaman</label>
								<select name="no_pinjaman" class="form-control selectpicker" id="no_pinjaman" data-live-search="true" size="5" required="">
									<option value="">Nomor Pinjam</option>
									<?php foreach ($pinjaman as $row) { ?>
										<option value="<?= $row->no_pinjaman; ?>"><?= $row->no_pinjaman; ?></option>
										<?php
									}?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-4">
								<label class="control-label">Nama Anggota</label>
								<input type="text" name="nama_anggota" id="nama_anggota" class="form-control" readonly>
								<input type="hidden" id="no_anggota" name="">
							</div>
							<div class="col-md-4">
								<label class="control-label">Tanggal Pinjam</label>
								<input type="text" name="tgl_pinjam" id="tgl_pinjam" class="form-control" readonly>
							</div>
							<div class="col-md-4">
								<label class="control-label">Total Pinjam</label>
								<input type="number" name="total_pinjam" id="total_pinjam" min="1" max="3" class="form-control" readonly="">
							</div>
						</div>
					</div>
					<hr>
					<div class="table-responsive mb-4 style-1">
						<table id="buku" class="table style-1 table-hover non-hover">
							<thead>
								<tr>								
									<th width="">Kode Buku</th>
									<th width="">Nama Buku</th>
									<th width="">Kategori</th>
									<th width="">QTY</th>
									<th width="">Exp Date</th>
									<th width="">Status</th>
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
		var no_pinjaman = $('#no_pinjaman').val();

		var buku = $('#buku').DataTable({
			"lengthMenu": [10, 20, 50],
			"pageLength": 10,
			"serverSide": true,
			"processing": true,
			"order": [[0, "asc" ]],
			"ajax":{
				url :  base + 'DataTables/showDetailKembali',
				type : 'POST',
				data : function ( data ) {
					data.no_pinjam = $('#no_pinjaman').val();
				}
			},
			"columnDefs": [
			{ 
		        "targets": [ 5 ], //first column / numbering column
		        "orderable": false, //set not orderable
		    }
		    ],
		});

		$('#no_pinjaman').change(function(){
			var no_pinjaman = $(this).val();
			if (no_pinjaman == '') {
				$('#nama_anggota').val('');
				$('#tgl_pinjam').val('');
				$('#no_anggota').val('');
				$('#total_pinjam').val('');
				buku.ajax.reload();
			} else {
				$.ajax({  
					url: base + "Dashboard_Admin/getNamaPeminjam",   
					method:"POST",  
					data: {
						no_pinjaman : no_pinjaman,
					},  
					dataType: "json",
					success:function(data)  
					{  
						$('#nama_anggota').val(data.nama_anggota);
						$('#tgl_pinjam').val(data.tgl_pinjam);
						$('#no_anggota').val(data.no_anggota);
						$('#total_pinjam').val(data.total_pinjam);

						buku.ajax.reload();
					}  
				});
			}
		});

		$('#addTextSimpan').html('Simpan');
		$('#btnSimpan').click(function(){
			var no_kembali = $('#no_kembali').val();
			var no_pinjaman = $('#no_pinjaman').val();
			var tgl_pinjam = $('#tgl_pinjam').val();
			var no_anggota = $('#no_anggota').val();
			var kembali = $('#total_pinjam').val();

			$('#addTextSimpan').html('<div class="spinner-border text-white align-self-center loader-sm "></div>');
			$.ajax({  
				url: base + "Dashboard_Admin/addPengembalian",   
				method:"POST",  
				data: {
					no_pinjaman : no_pinjaman,
					no_kembali : no_kembali,
					kembali : kembali,
					tgl_pinjam : tgl_pinjam,
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

					$('#no_kembali').val('');

					var text1 = $("select[name=no_pinjaman] option[value='default']").text();
				    $('.1 .bootstrap-select .filter-option').text(text1);
					//Check the selected attribute for the real select
					$('select[name=no_pinjaman]').val('default');
				    $('#no_pinjaman option[value="default"]').attr('selected','selected');

					$('#nama_anggota').val('');
					$('#tgl_pinjam').val('');
					$('#total_pinjam').val('');

					$.ajax({  
						url: base + "Dashboard_Admin/kodeKembali",   
						method:"POST", 
						success:function(kembali)  
						{  
							$('#no_kembali').val(kembali);
						}  
					});

					buku.ajax.reload();
				}  
			});
		});
	});
</script>