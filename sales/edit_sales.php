<?php
require_once("../config.php");
$id_sales = $_GET['id'];
$query = $conn->query("SELECT * FROM sales WHERE id_sales = '$id_sales'");
$result = mysqli_fetch_assoc($query);
?>


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
                  <a class="nav-link" href="#">Transaksi</a>
               </li>
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Data Master
                  </a>
                  <ul class="dropdown-menu">
                     <li><a class="dropdown-item" href="index.php">Data Mobil</a></li>
                     <li><a class="dropdown-item" href="../sales/index.php">Data Sales</a></li>
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
            <div class="alert alert-dark py-2">
               EDIT MOBIL
            </div>
            <a href="index.php" class="btn btn-sm btn-secondary mb-2 float-end">Kembali</a>
         </div>
         <div class="row justify-content-center">
            <div class="col-md-6">
               <div class="card">
                  <div class="card-body">
                     <form action="act_edit.php" method="post">
                        <div class="mb-2">
                           <input type="hidden" name="id_sales" value="<?= $id_sales; ?>">
                           <label for="nama_sales" class="form-label">Nama Sales</label>
                           <input type="text" name="nama_sales" id="nama_sales" class="form-control" value=<?= $result['nama_sales'] ?> required>
                        </div>
                        <div class="mb-2">
                           <label for="alamat" class="form-label">Alamat</label>
                           <textarea name="alamat" id="alamat" rows="4" class="form-control">
                              <?= $result['alamat'] ?>
                           </textarea>
                        </div>
                        <div class="mb-2">
                           <label for="telepon" class="form-label">Telepon</label>
                           <input type="number" name="telepon" id="telepon" class="form-control" value=<?= $result['telepon'] ?> required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-sm btn-primary mt-2">Submit</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <script src="../assets_bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>