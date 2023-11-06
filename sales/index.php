<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Aplikasi Penjualan Mobil - Data Mobil</title>
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
                     <li><a class="dropdown-item" href="index.php">Data Sales</a></li>
                  </ul>
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
                  DATA SALES
               </div>
            <?php } ?>
            <a href="tambah_sales.php" class="btn btn-sm btn-primary mb-2 float-end">Tambah</a>
            <table class="table table-striped">
               <thead class="table-light">
                  <tr>
                     <th>No</th>
                     <th>Nama Sales</th>
                     <th>Alamat</th>
                     <th>Telepon</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  require_once('../config.php');
                  $no = 1;
                  $query = $conn->query("SELECT * FROM sales ORDER BY id_sales DESC");
                  foreach ($query as $data) :
                  ?>
                     <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['nama_sales'] ?></td>
                        <td><?= $data['alamat'] ?></td>
                        <td><?= $data['telepon'] ?></td>
                        <td>
                           <a href="edit_sales.php?id=<?= $data['id_sales'] ?>" class="btn btn-sm btn-warning">Edit</a>
                           <a href="act_hapus.php?id=<?= $data['id_sales'] ?>" onclick="return confirm('Yakin data akan dihapus?')" class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                     </tr>
                  <?php
                  endforeach
                  ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>

   <script src="../assets_bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>