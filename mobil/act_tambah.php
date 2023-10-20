<?php
require_once("../config.php");
if (isset($_POST['submit'])) {
   $nama_mobil = $_REQUEST['nama_mobil'];
   $tipe_mobil = $_REQUEST['tipe_mobil'];
   $merk_mobil = $_REQUEST['merk_mobil'];
   $deskripsi = $_REQUEST['deskripsi'];
   $stok = $_REQUEST['stok'];
   $harga = $_REQUEST['harga'];

   $query = $conn->query("INSERT INTO mobil (nama_mobil, tipe_mobil, merk_mobil, deskripsi, stok, harga) VALUES ('$nama_mobil', '$tipe_mobil', '$merk_mobil', '$deskripsi', '$stok', '$harga')");

   if ($query) {
      header("location:index.php?alert=1");
   } else {
      header("location:index.php?alert=0");
   }
} else {
   echo "Silahkan isi form terlebih dahulu! <a href='tambah_mobil.php'>Form Mobil</a>";
}
