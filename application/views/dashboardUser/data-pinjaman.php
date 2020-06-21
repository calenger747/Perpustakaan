<div class="row layout-top-spacing">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
			<span class="text-white"><marquee><strong>Untuk Transaksi Pengembalian, Silahkan Langsung Mendatangi Perpustakaan Bertemu Dengan Admin Dan Membawa Bukti Peminjaman!</strong></marquee></span>
		</div> 
	</div>
</div>

<div class="row layout-spacing">
	<div class="col-lg-12">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Data Peminjaman</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area">
				<div class="form-group">
					<a href="<?= base_url(); ?>Dashboard_User/myCart">
						<button class="btn btn-primary mb-2">Keranjang Saya</button>
					</a>
				</div>
				<div class="table-responsive mb-4 style-1">
					<table id="pinjaman" class="table style-1 table-hover non-hover">
						<thead>
							<tr>								
								<th width="">No. Peminjaman</th>
								<th width="">Nama Anggota</th>
								<th width="">Total</th>
								<th width="">Tanggal Pinjam</th>
								<th width="">Status</th>
								<th class="text-center" width="25%">Action</th>
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

<script type="text/javascript">
	$(document).ready(function(){
		var base = '<?= base_url(); ?>';

		var no_anggota = '<?= $this->session->userdata('no_anggota'); ?>';

		var pinjaman = $('#pinjaman').DataTable({
			"lengthMenu": [10, 20, 50],
			"pageLength": 10,
			"serverSide": true,
			"processing": true,
			"order": [[0, "asc" ]],
			"ajax":{
				url :  base + 'DataTables/showPinjamanUser',
				type : 'POST',
				data : {
					no_anggota: no_anggota,
				}
			},
			"columnDefs": [
			{ 
		        "targets": [ 5 ], //first column / numbering column
		        "orderable": false, //set not orderable
		    },
		    ],
		});

		// Batal Pinjaman
		$('#pinjaman').on('click','.batal-pinjaman', function(){
			var id =  $(this).data('no_pinjaman');
			swal({
				title: "Apa anda yakin?",
				text: "Setelah dibatalkan, Anda tidak dapat melanjutkan transaksi dengan nomor transaksi ini!",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: 'Yes',
			}).then(function(result) {
				if (result.value) {
					$.ajax({
						url: base + "Dashboard_User/batalPinjaman/" + id,  
						method: "GET",
						beforeSend :function() {
							swal({
								title: 'Please Wait',
								html: 'Membatalkan pinjaman',
								onOpen: () => {
									swal.showLoading()
								}
							})      
						},
						success:function(data){
							swal({
								title: "Deleted!",
								type: "success",
								text: "Pinjaman Berhasil Dibatalkan!",
								timer: 1000,
								buttons: false,
							});
							pinjaman.ajax.reload();
						}
					});
				}
			})
		});
	});
</script>