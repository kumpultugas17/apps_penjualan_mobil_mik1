<?php
require_once("../config.php");
if (isset($_POST['submit'])) {
   $id_mobil = $_REQUEST['id_mobil'];
   $nama_mobil = $_REQUEST['nama_mobil'];
   $tipe_mobil = $_REQUEST['tipe_mobil'];
   $merk_mobil = $_REQUEST['merk_mobil'];
   $deskripsi = $_REQUEST['deskripsi'];
   $stok = $_REQUEST['stok'];
   $harga = $_REQUEST['harga'];

   $query = $conn->query("UPDATE mobil SET nama_mobil='$nama_mobil', tipe_mobil='$tipe_mobil', merk_mobil='$merk_mobil', deskripsi='$deskripsi', stok='$stok', harga='$harga' WHERE id_mobil='$id_mobil'");

   if ($query) {
      header("location:index.php?alert=1");
   } else {
      header("location:index.php?alert=0");
   }
} else {
   echo "Direct ke halaman <a href='index.php'>Data Mobil</a>!";
}
