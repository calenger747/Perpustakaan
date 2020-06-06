<div class="row layout-top-spacing layout-spacing">
	<div class="col-lg-12">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Laporan Anggota</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area">
				<div class="form-group mb-4">
					<div id="toggleAccordion">
						<div class="card">
							<div class="card-header" id="headingOne1">
								<section class="mb-0 mt-0">
									<div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionOne" aria-expanded="true" aria-controls="defaultAccordionOne">
										Cetak Laporan  <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
									</div>
								</section>
							</div>

							<div id="defaultAccordionOne" class="collapse" aria-labelledby="headingOne1" data-parent="#toggleAccordion">
								<div class="card-body">
									<form method="GET" id="sliderForm" autocomplete="off" enctype="multipart/form-data">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Dari</label>
													<div class="input-group">
														<input type="text" name="tgl_awal" class="form-control date-own" id="datepicker-autoclose3" placeholder="Dari" required="">
														<div class="input-group-append">
															<span class="input-group-text"><i class="fa fa-calendar"></i></span>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Sampai</label>
													<div class="input-group">
														<input type="text" name="tgl_akhir" class="form-control date-own" id="datepicker-autoclose4" placeholder="Sampai" required="">
														<div class="input-group-append">
															<span class="input-group-text"><i class="fa fa-calendar"></i></span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="pl-lg-1">
											<div class="text-center">
												<button type="submit" class="btn btn-info mt-4" id="simpan" formaction="<?= base_url('Laporan/laporan_anggota_pdf') ?>"><span id="mitraText">Export to PDF</span></button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="table-responsive mb-4 style-1">
					<table id="anggota" class="table style-1 table-hover non-hover">
						<thead>
							<tr>
								<th rowspan="2" width="" class="text-center">Tahun</th>
								<th rowspan="2" width="" class="text-center">Total</th>								
								<th colspan="4" width="" class="text-center">Tanda Pengenal</th>
								<th colspan="5" width="" class="text-center">Kelas</th>
							</tr>
							<tr>
								<th width="">KTP</th>
								<th width="">SIM</th>
								<th width="">Paspor</th>
								<th width="">KTM</th>
								<th width="">Reg 1</th>
								<th width="">Reg 2</th>
								<th width="">Reg 3</th>
								<th width="">Pascasarjana</th>
								<th width="">Umum</th>
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

		var pinjaman = $('#anggota').DataTable({
			"lengthMenu": [10, 20, 50],
			"pageLength": 10,
			"serverSide": true,
			"processing": true,
			"order": [[0, "asc" ]],
			"ajax":{
				url :  base + 'DataTables/laporanAnggota',
				type : 'POST',
			},
		});

		$('.date-own').datepicker({
			minViewMode: 2,
			format: 'yyyy',
			autoclose: true
		});
	});
</script>