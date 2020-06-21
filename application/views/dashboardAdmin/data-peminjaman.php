<div class="row layout-top-spacing layout-spacing">
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
					<a href="<?= base_url(); ?>Dashboard_Admin/tambahPinjaman">
						<button class="btn btn-primary mb-2">Tambah Data</button>
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

		var pinjaman = $('#pinjaman').DataTable({
			"lengthMenu": [10, 20, 50],
			"pageLength": 10,
			"serverSide": true,
			"processing": true,
			"order": [[0, "asc" ]],
			"ajax":{
				url :  base + 'DataTables/showPinjaman',
				type : 'POST',
			},
			"columnDefs": [
			{ 
		        "targets": [ 5 ], //first column / numbering column
		        "orderable": false, //set not orderable
		    },
		    ],
		});

		// Approve Pinjaman
		$('#pinjaman').on('click','.approve-pinjaman', function(){
			var id =  $(this).data('no_pinjaman');
			var total_pinjam =  $(this).data('total_pinjam');
			swal({
				title: "Apa anda yakin?",
				text: "Setelah disetujui, Tidak dapat menambah jumlah buku!",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: 'Approve',
			}).then(function(result) {
				if (result.value) {
					if (total_pinjam == 0) {
						swal({
							title: "Failed!",
							type: "error",
							text: "Tidak ada buku yang di daftarkan!",
						});
					} else {
						$.ajax({
							url: base + "Dashboard_Admin/approvePinjaman/" + id,  
							method: "GET",
							beforeSend :function() {
								swal({
									title: 'Please Wait',
									html: 'Approving data',
									onOpen: () => {
										swal.showLoading()
									}
								})      
							},
							success:function(data){
								swal({
									title: "Deleted!",
									type: "success",
									text: "Pinjaman Berhasil di Approve!",
									timer: 1000,
									buttons: false,
								});
								pinjaman.ajax.reload();
							}
						});
					}
				}
			})
		});

		// Cancel Pinjaman
		$('#pinjaman').on('click','.cancel-pinjaman', function(){
			var id =  $(this).data('no_pinjaman');
			var total_pinjam =  $(this).data('total_pinjam');
			swal({
				title: "Apa anda yakin?",
				text: "Setelah dicancel, Anda tidak dapat melanjutkan transaksi dengan nomor transaksi ini!",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: 'Yes',
			}).then(function(result) {
				if (result.value) {
					$.ajax({
						url: base + "Dashboard_Admin/cancelPinjaman/" + id,  
						method: "GET",
						beforeSend :function() {
							swal({
								title: 'Please Wait',
								html: 'Cancel pinjaman',
								onOpen: () => {
									swal.showLoading()
								}
							})      
						},
						success:function(data){
							swal({
								title: "Deleted!",
								type: "success",
								text: "Pinjaman Berhasil di Cancel!",
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