<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aplikasi Penjualan Mobil - Transaksi</title>
  <!-- Import CSS Bootstrap -->
  <link rel="stylesheet" href="../assets_bootstrap/css/bootstrap.min.css">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary bg-black navbar-dark shadow sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../transaksi/index.php">Transaksi</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Data Master
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../mobil/index.php">Data Mobil</a></li>
              <li><a class="dropdown-item" href="../sales/index.php">Data Sales</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Laporan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Content -->
  <div class="container">
    <div class="row mt-3">
      <div class="col-12">
        <div class="alert alert-primary py-2 fw-bold">
          LAPORAN PENJUALAN
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="col-sm-12 pt-3">
                  <form action="" method="get" class="row g-3">
                    <div class="col-auto">
                      <label for="staticEmail2" class="visually-hidden"></label>
                      <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Cari Nama Sales">
                    </div>
                    <div class="col-auto">
                      <label for="nama_sales" class="visually-hidden"></label>
                      <input type="text" class="form-control" id="nama_sales" name="kata_kunci" placeholder="Masukkan kata kunci">
                    </div>
                    <div class="col">
                      <button type="submit" class="btn btn-primary mb-3">Cari Data</button>
                      <a class="btn btn-success mb-3 float-end" href="">Print (Coming Soon)</a>
                    </div>
                  </form>
                </div>
              </div>
              <div class="card-body">
                <?php
                if (isset($_GET['kata_kunci'])) {
                ?>
                  <table class="table table-bordered">
                    <thead class="table-light">
                      <tr>
                        <th>No</th>
                        <th>Tgl. Transaksi</th>
                        <th>Nama Sales</th>
                        <th>Nama Mobil</th>
                        <th>Merk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      require_once('../config.php');
                      $no = 1;
                      if (isset($_GET['kata_kunci'])) {
                        $kata_kunci = $_GET['kata_kunci'];
                        $query = $conn->query("SELECT * FROM transaksi t INNER JOIN sales s ON t.sales_id = s.id_sales INNER JOIN mobil m ON t.mobil_id = m.id_mobil WHERE s.nama_sales LIKE '%$kata_kunci%' ORDER BY id_transaksi DESC");
                      } else {
                        $query = $conn->query("SELECT * FROM transaksi t INNER JOIN sales s ON t.sales_id = s.id_sales INNER JOIN mobil m ON t.mobil_id = m.id_mobil ORDER BY id_transaksi DESC");
                      }

                      foreach ($query as $data) :
                        $total = $data['harga'] * $data['jual'];
                        $hitung_gt[] = $data['harga'] * $data['jual'];
                        $grand_total = array_sum($hitung_gt);
                      ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $data['tgl_transaksi'] ?></td>
                          <td><?= $data['nama_sales'] ?></td>
                          <td><?= $data['nama_mobil'] ?></td>
                          <td><?= $data['merk_mobil'] ?></td>
                          <td>Rp. <?= number_format($data['harga'], 0, ',', '.') ?></td>
                          <td><?= $data['jual'] ?></td>
                          <td>Rp. <?= number_format($total, 0, ',', '.'); ?></td>
                        </tr>
                      <?php
                      endforeach
                      ?>
                      <tr>
                        <td colspan="7"><span class="float-end">Grand Total </span></td>
                        <td colspan="2" class="fw-bold">Rp. <?= number_format($grand_total, 0, ',', '.') ?></td>
                      </tr>
                    </tbody>
                  </table>
                <?php
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="../assets_bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>