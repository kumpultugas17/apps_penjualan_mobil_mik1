<?php
require_once("../config.php");
if (isset($_POST['submit'])) {
   $id_sales = $_REQUEST['id_sales'];
   $nama_sales = $_REQUEST['nama_sales'];
   $alamat = $_REQUEST['alamat'];
   $telepon = $_REQUEST['telepon'];

   $query = $conn->query("UPDATE sales SET nama_sales='$nama_sales', alamat='$alamat', telepon='$telepon' WHERE id_sales='$id_sales'");

   if ($query) {
      header("location:index.php?alert=1");
   } else {
      header("location:index.php?alert=0");
   }
} else {
   echo "Direct ke halaman <a href='index.php'>Data Mobil</a>!";
}
