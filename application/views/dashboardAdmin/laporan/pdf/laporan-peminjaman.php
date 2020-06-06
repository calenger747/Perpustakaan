<!-- <!DOCTYPE html> -->
<!-- <html> -->
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Peminjaman</title>
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
              <h3 class="card-title">Laporan Peminjaman</h3>
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
                    <th width="16%">Tahun</th>
                    <th width="">Jan</th>
                    <th width="">Feb</th>
                    <th width="">Mar</th>
                    <th width="">Apr</th>
                    <th width="">Mei</th>
                    <th width="">Jun</th>
                    <th width="">Jul</th>
                    <th width="">Agu</th>
                    <th width="">Sep</th>
                    <th width="">Okt</th>
                    <th width="">Nop</th>
                    <th width="">Des</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $total = [
                    'jan' => 0,
                    'feb' => 0,
                    'mar' => 0,
                    'apr' => 0,
                    'mei' => 0,
                    'jun' => 0,
                    'jul' => 0,
                    'agu' => 0,
                    'sep' => 0,
                    'okt' => 0,
                    'nop' => 0,
                    'des' => 0
                  ];
                  foreach ($dataLaporan as $laporan) :
                    $total['jan'] += $laporan->jan;
                    $total['feb'] += $laporan->feb;
                    $total['mar'] += $laporan->mar;
                    $total['apr'] += $laporan->apr;
                    $total['mei'] += $laporan->mei;
                    $total['jun'] += $laporan->jun;
                    $total['jul'] += $laporan->jul;
                    $total['agu'] += $laporan->agu;
                    $total['sep'] += $laporan->sep;
                    $total['okt'] += $laporan->okt;
                    $total['nop'] += $laporan->nop;
                    $total['des'] += $laporan->des;
                    ?>
                    <tr>
                      <td><?= $laporan->tahun ?></td>
                      <td><?= $laporan->jan ?></td>
                      <td><?= $laporan->feb ?></td>
                      <td><?= $laporan->mar ?></td>
                      <td><?= $laporan->apr ?></td>
                      <td><?= $laporan->mei ?></td>
                      <td><?= $laporan->jun ?></td>
                      <td><?= $laporan->jul ?></td>
                      <td><?= $laporan->agu ?></td>
                      <td><?= $laporan->sep ?></td>
                      <td><?= $laporan->okt ?></td>
                      <td><?= $laporan->nop ?></td>
                      <td><?= $laporan->des ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th> Total </th>
                    <th><?= $total['jan'] ?></th>
                    <th><?= $total['feb'] ?></th>
                    <th><?= $total['mar'] ?></th>
                    <th><?= $total['apr'] ?></th>
                    <th><?= $total['mei'] ?></th>
                    <th><?= $total['jun'] ?></th>
                    <th><?= $total['jul'] ?></th>
                    <th><?= $total['agu'] ?></th>
                    <th><?= $total['sep'] ?></th>
                    <th><?= $total['okt'] ?></th>
                    <th><?= $total['nop'] ?></th>
                    <th><?= $total['des'] ?></th>
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