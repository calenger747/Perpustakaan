<!-- <!DOCTYPE html> -->
<!-- <html> -->
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Buku</title>
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

    .text-right {
      text-align: right!important;
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
              <h3 class="card-title">Laporan Buku</h3>
            </div>
          </div>
          <div class="card-body">
            <div class="datatable-wrapper table-responsive">
              <table class="table table-condensed">
                <thead>
                  <tr>
                    <th width="60%">Nama Kategori</th>
                    <th class="text-right" width="">Jumlah Buku</th>
                    <th class="text-right" width="">Stok</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $total = [
                    'jumlah_buku' => 0,
                    'stok' => 0
                  ];
                  foreach ($dataLaporan as $laporan) :
                    $total['jumlah_buku'] += $laporan->jumlah_buku;
                    $total['stok'] += $laporan->stok;
                    ?>
                    <tr>
                      <td><?= $laporan->nama_kategori ?></td>
                      <td class="text-right"><?= $laporan->jumlah_buku ?></td>
                      <td class="text-right"><?= $laporan->stok ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th> Total </th>
                    <th class="text-right"><?= $total['jumlah_buku'] ?></th>
                    <th class="text-right"><?= $total['stok'] ?></th>
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