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
                  <a class="nav-link" href="index.php">Transaksi</a>
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
                  <a class="nav-link" href="../laporan/index.php">Laporan</a>
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
            <?php if (isset($_GET['alert']) and $_GET['alert'] == 1) { ?>
               <div class="alert alert-success py-2">
                  Data baru berhasil ditambahkan!
               </div>
            <?php } else { ?>
               <div class="alert alert-dark py-2">
                  DATA TRANSAKSI
               </div>
            <?php } ?>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#tambah">
               Tambah
            </button>

            <table class="table table-striped">
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
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  require_once('../config.php');
                  $no = 1;
                  $query = $conn->query("SELECT * FROM transaksi t INNER JOIN sales s ON t.sales_id = s.id_sales INNER JOIN mobil m ON t.mobil_id = m.id_mobil ORDER BY id_transaksi DESC");
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
                        <td>
                           <button data-bs-toggle="modal" data-bs-target="#edit<?= $data['id_transaksi'] ?>" class="btn btn-sm btn-warning">Edit</button>
                           <a href="proses.php?action=hapus&id=<?= $data['id_transaksi'] ?>" onclick="return confirm('Yakin data akan dihapus?')" class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                     </tr>

                     <!-- Modal Edit-->
                     <div class="modal fade" id="edit<?= $data['id_transaksi'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Transaksi</h1>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="proses.php?action=edit" method="post">
                                 <input type="hidden" name="id_transaksi" value="<?= $data['id_transaksi'] ?>">
                                 <div class="modal-body">
                                    <div class="mb-3">
                                       <label for="tgl_transaksi" class="form-label">Tgl. Transksi</label>
                                       <input type="date" id="tgl_transaksi" class="form-control" name="tgl_transaksi" value="<?= $data['tgl_transaksi'] ?>">
                                    </div>
                                    <div class="mb-3">
                                       <label for="nama_sales" class="form-label">Nama Sales</label>
                                       <select name="nama_sales" id="nama_sales" class="form-select">
                                          <option selected disabled>Pilih Nama Sales</option>
                                          <?php
                                          require_once "../config.php";
                                          $query = $conn->query("SELECT id_sales, nama_sales FROM sales");
                                          foreach ($query as $sls) :
                                          ?>
                                             <option value="<?= $sls['id_sales'] ?>" <?= $sls['id_sales'] == $data['sales_id'] ? 'selected' : ''; ?>><?= $sls['nama_sales'] ?></option>
                                          <?php
                                          endforeach
                                          ?>
                                       </select>
                                    </div>
                                    <div class="mb-3">
                                       <label for="nama_mobil" class="form-label">Nama Mobil</label>
                                       <select name="nama_mobil" id="nama_mobil" class="form-select">
                                          <option selected disabled>Pilih Nama Mobil</option>
                                          <?php
                                          require_once "../config.php";
                                          $query = $conn->query("SELECT id_mobil, nama_mobil FROM mobil");
                                          foreach ($query as $mbl) :
                                          ?>
                                             <option value="<?= $mbl['id_mobil'] ?>" <?= $mbl['id_mobil'] == $data['mobil_id'] ? 'selected' : ''; ?>><?= $mbl['nama_mobil'] ?></option>
                                          <?php
                                          endforeach
                                          ?>
                                       </select>
                                    </div>
                                    <div class="mb-3">
                                       <label for="jumlah" class="form-label">Terjual</label>
                                       <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $data['jual'] ?>">
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  <?php
                  endforeach
                  ?>
                  <tr>
                     <td colspan="7"><span class="float-end">Grand Total </span></td>
                     <td colspan="2" class="fw-bold">Rp. <?= number_format($grand_total, 0, ',', '.') ?></td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>

   <script src="../assets_bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<!-- Modal -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Transaksi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form action="proses.php?action=simpan" method="post">
            <div class="modal-body">
               <div class="mb-3">
                  <label for="" class="form-label">Tgl. Transksi</label>
                  <input type="date" class="form-control" name="tgl_transaksi">
               </div>
               <div class="mb-3">
                  <label for="nama_sales" class="form-label">Nama Sales</label>
                  <select name="nama_sales" id="nama_sales" class="form-select">
                     <option selected disabled>Pilih Nama Sales</option>
                     <?php
                     require_once "../config.php";
                     $query = $conn->query("SELECT id_sales, nama_sales FROM sales");
                     foreach ($query as $data) :
                     ?>
                        <option value="<?= $data['id_sales'] ?>"><?= $data['nama_sales'] ?></option>
                     <?php
                     endforeach
                     ?>
                  </select>
               </div>
               <div class="mb-3">
                  <label for="nama_mobil" class="form-label">Nama Mobil</label>
                  <select name="nama_mobil" id="nama_mobil" class="form-select">
                     <option selected disabled>Pilih Nama Mobil</option>
                     <?php
                     require_once "../config.php";
                     $query = $conn->query("SELECT id_mobil, nama_mobil FROM mobil");
                     foreach ($query as $data) :
                     ?>
                        <option value="<?= $data['id_mobil'] ?>"><?= $data['nama_mobil'] ?></option>
                     <?php
                     endforeach
                     ?>
                  </select>
               </div>
               <div class="mb-3">
                  <label for="jumlah" class="form-label">Terjual</label>
                  <input type="number" class="form-control" id="jumlah" name="jumlah">
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>