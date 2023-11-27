<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Aplikasi Penjualan Mobil - Transaksi</title>
   <!-- Import CSS Bootstrap -->
   <link rel="stylesheet" href="../assets_bootstrap/css/bootstrap.min.css">
</head>

<body onload="window.print()">
   <?php
   if (isset($_GET['kata_kunci'])) {
      $kata_kunci = $_GET['kata_kunci'];
   ?>

      <div class="text-center">
         <h3>LAPORAN TRANSAKSI</h3>
         <h4>PT. SUKSES BERSAMA</h4>
         <h6>Jl. Cilik Riwut Km 1,5 Kota Palangka Raya, Kalimantan Tengah</h6>
      </div>

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

   <script src="../assets_bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>