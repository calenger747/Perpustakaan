<!-- <!DOCTYPE html> -->
<!-- <html> -->
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Anggota</title>
  <style>
    table{
      border-collapse: collapse;
      border-spacing: 0;
      width: 100%;
      border: 1px solid #ddd;
    }

    .table-condensed td{
      padding: 13px 15px;
      border-top : 1px solid #999999;
    }

    .table-condensed thead tr th {
      border: 1px solid #999999;
      padding: 10px;
    }
    .table-condensed tfoot tr th {
      border: 1px solid #999999;
      padding: 10px;
      text-align: left;
    }

    .table-condensed tbody tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    .text-center {
      text-align: center!important;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="card card-statistics">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div class="card-heading" style="text-align:center;">
              <h3 class="card-title">Laporan Anggota</h3>
            </div>
          </div>
          <div class="card-body">
            <div class="datatable-wrapper table-responsive" style="margin-top:20px; margin-bottom:30px;">
              <table class="table table-condensed">
                <thead>
                  <tr>
                    <td><strong>Periode Tahun: </strong></td>
                    <td>
                      <strong>
                        <?php if (!empty($tgl_awal)) {
                          echo $this->input->get("tgl_awal");
                        }?>
                      </strong>
                    </td>
                    <td><strong>Sampai : </strong></td>
                    <td>
                      <strong>
                        <?php if (!empty($tgl_akhir)) {
                          echo $this->input->get("tgl_akhir");
                        }?>
                      </strong>
                    </td>
                  </tr>
                </thead>
              </table>
            </div>
            <div class="datatable-wrapper table-responsive">
              <table class="table table-condensed">
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
                  <?php
                  $total = [
                    'total' => 0,
                    'ktp' => 0,
                    'sim' => 0,
                    'paspor' => 0,
                    'ktm' => 0,
                    'reg_1' => 0,
                    'reg_2' => 0,
                    'reg_3' => 0,
                    'pascasarjana' => 0,
                    'umum' => 0
                  ];
                  foreach ($dataLaporan as $laporan) :
                    $total['total'] += $laporan->total;
                    $total['ktp'] += $laporan->ktp;
                    $total['sim'] += $laporan->sim;
                    $total['paspor'] += $laporan->paspor;
                    $total['ktm'] += $laporan->ktm;
                    $total['reg_1'] += $laporan->reg_1;
                    $total['reg_2'] += $laporan->reg_2;
                    $total['reg_3'] += $laporan->reg_3;
                    $total['pascasarjana'] += $laporan->pascasarjana;
                    $total['umum'] += $laporan->umum;
                    ?>
                    <tr>
                      <td><?= $laporan->tahun ?></td>
                      <td><?= $laporan->total ?></td>
                      <td><?= $laporan->ktp ?></td>
                      <td><?= $laporan->sim ?></td>
                      <td><?= $laporan->paspor ?></td>
                      <td><?= $laporan->ktm ?></td>
                      <td><?= $laporan->reg_1 ?></td>
                      <td><?= $laporan->reg_2 ?></td>
                      <td><?= $laporan->reg_3 ?></td>
                      <td><?= $laporan->pascasarjana ?></td>
                      <td><?= $laporan->umum ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th> Total </th>
                    <th><?= $total['total'] ?></th>
                    <th><?= $total['ktp'] ?></th>
                    <th><?= $total['sim'] ?></th>
                    <th><?= $total['paspor'] ?></th>
                    <th><?= $total['ktm'] ?></th>
                    <th><?= $total['reg_1'] ?></th>
                    <th><?= $total['reg_2'] ?></th>
                    <th><?= $total['reg_3'] ?></th>
                    <th><?= $total['pascasarjana'] ?></th>
                    <th><?= $total['umum'] ?></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</body>
</html>