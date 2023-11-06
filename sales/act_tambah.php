<?php
require_once("../config.php");
if (isset($_POST['submit'])) {
   $nama_sales = $_REQUEST['nama_sales'];
   $alamat = $_REQUEST['alamat'];
   $telepon = $_REQUEST['telepon'];

   $query = $conn->query("INSERT INTO sales (nama_sales, alamat, telepon) VALUES ('$nama_sales', '$alamat', '$telepon')");

   if ($query) {
      header("location:index.php?alert=1");
   } else {
      header("location:index.php?alert=0");
   }
} else {
   echo "Silahkan isi form terlebih dahulu! <a href='tambah_sales.php'>Form Sales</a>";
}
