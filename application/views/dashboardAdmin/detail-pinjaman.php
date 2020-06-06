<div class="row layout-top-spacing layout-spacing">
	<div class="col-lg-12">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Detail Peminjaman</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area">
				<center>
					<div class="table-responsive mb-3 ">
						<table class="table table-hover">
							<tr>
								<th width="30%">No Pinjaman</th>
								<td><?= $pinjaman->no_pinjaman; ?></td>
							</tr>
							<tr>
								<th width="30%">Nama Anggota</th>
								<td><?= $pinjaman->no_anggota; ?> - <?= $pinjaman->nama_anggota; ?></td>
							</tr>
							<tr>
								<th width="30%">Tanggal Pinjam</th>
								<td><?= date('d M Y H:i:s', strtotime($pinjaman->tgl_pinjam)); ?></td>
							</tr>
							<tr>
								<th width="30%">Total Pinjam</th>
								<td><?= $pinjaman->total_pinjam; ?></td>
							</tr>
							<tr>
								<th width="30%">Status</th>
								<td>
									<?php 
									if ($pinjaman->status == 'Dipinjam' || $pinjaman->status == 'Dikembalikan') {
										echo '<span class="badge badge-primary"> '.$pinjaman->status.' </span>';
									} else if ($pinjaman->status == 'Pending') {
										echo '<span class="badge badge-warning"> '.$pinjaman->status.' </span>';
									} else if ($pinjaman->status == 'Cancel by Admin' || $pinjaman->status == 'Dibatalkan') {
										echo '<span class="badge badge-danger"> '.$pinjaman->status.' </span>';
									} else if ($pinjaman->status == 'Process') {
										echo '<span class="badge badge-info"> '.$pinjaman->status.' </span>';
									} else if ($pinjaman->status == 'Approve by Admin') {
										echo '<span class="badge badge-success"> '.$pinjaman->status.' </span>';
									}?>
								</td>
							</tr>
						</table>
					</div>
				</center>
				<hr>
				<div class="table-responsive mb-4 style-1">
					<h6>Data Buku</h6>
					<table id="buku" class="table style-1 table-hover">
						<thead>
							<tr>								
								<th width="">Kode Buku</th>
								<th width="">Nama Buku</th>
								<th width="">Kategori</th>
								<th width="">QTY</th>
								<th width="">Tanggal Kembali</th>
								<th width="">Status</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$date = date('Y-m-d');
							foreach ($detail as $row) { ?>
								<?php 
								if ($row->status_detail == 'Batal' || $row->status_detail == 'Kembali') {
									echo '<tr>';
								} else {
									if ($date >= $row->expired_date) {
										echo '<tr style="background-color: red; text-color:white;">';
									} else  { 
										echo '<tr>';
									}
								}?>
								<td><?= $row->kode_buku; ?></td>
								<td><?= $row->nama_buku; ?></td>
								<td><?= $row->nama_kategori; ?></td>
								<td><?= $row->qty; ?></td>
								<td><?= date('d M Y', strtotime($row->expired_date)); ?></td>
								<td><?= $row->status_detail; ?></td>
							</tr>
							<?php 
						} ?>
					</tbody>
				</table>
			</div>
			<hr>
			<div class="form-group text-right">
				<a href="javascript:history.back()">
					<button type="button" class="btn btn-warning">Kembali</button>
				</a>
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var base = '<?= base_url(); ?>';

		var buku = $('#buku').DataTable({
			"lengthMenu": [10, 20, 50],
			"pageLength": 10,
			"order": [[0, "asc" ]],
		});
	});
</script>