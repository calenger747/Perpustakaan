<div class="row layout-top-spacing layout-spacing">
	<div class="col-lg-12">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Laporan Buku</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area">
				<div class="form-group">
					<a href="<?= base_url(); ?>Laporan/laporan_buku_pdf" target="_blank">
						<button class="btn btn-info mb-2">Export to PDF</button>
					</a>
				</div>
				<div class="table-responsive mb-4 style-1">
					<table id="buku" class="table style-1 table-hover non-hover" style="width: 100%">
						<thead>
							<tr>
								<th width="60%">Kategori</th>
								<th class="text-center" width="">Jumlah Buku</th>
								<th class="text-center" width="">Stok</th>	
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

		var pinjaman = $('#buku').DataTable({
			"lengthMenu": [10, 20, 50],
			"pageLength": 10,
			"serverSide": true,
			"processing": true,
			"order": [[0, "asc" ]],
			"ajax":{
				url :  base + 'DataTables/laporanBuku',
				type : 'POST',
			},
		});
	});
</script>