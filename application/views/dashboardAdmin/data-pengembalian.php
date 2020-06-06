<div class="row layout-top-spacing layout-spacing">
	<div class="col-lg-12">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Data Pengembalian</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area">
				<div class="form-group">
					<a href="<?= base_url(); ?>Dashboard_Admin/tambahPengembalian">
						<button class="btn btn-primary mb-2">Tambah Data</button>
					</a>
				</div>
				<div class="table-responsive mb-4 style-1">
					<table id="pinjaman" class="table style-1 table-hover non-hover">
						<thead>
							<tr>
								<th width="">No. Pengembalian</th>
								<th width="">Nama Anggota</th>								
								<th width="">No. Peminjaman</th>
								<th width="">Tanggal Kembali</th>
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
				url :  base + 'DataTables/showPengembalian',
				type : 'POST',
			},
			"columnDefs": [
			{ 
			        "targets": [ 5 ], //first column / numbering column
			        "orderable": false, //set not orderable
			    },
			    ],
			});
	});
</script>