<?php
require_once("../config.php");
if ($_GET['action'] == "simpan") {
   if (isset($_POST['submit'])) {
      $tgl_transaksi = $_REQUEST['tgl_transaksi'];
      $nama_sales = $_REQUEST['nama_sales'];
      $nama_mobil = $_REQUEST['nama_mobil'];
      $jumlah = $_REQUEST['jumlah'];

      $query = $conn->query("INSERT INTO transaksi (tgl_transaksi, sales_id, mobil_id, jual) VALUES ('$tgl_transaksi', '$nama_sales', '$nama_mobil', '$jumlah')");

      if ($query) {
         header("location:index.php?alert=1");
      } else {
         header("location:index.php?alert=0");
      }
   }
} elseif ($_GET['action'] == "edit") {
   if (isset($_POST['submit'])) {
      $id_transaksi = $_REQUEST['id_transaksi'];
      $tgl_transaksi = $_REQUEST['tgl_transaksi'];
      $nama_sales = $_REQUEST['nama_sales'];
      $nama_mobil = $_REQUEST['nama_mobil'];
      $jumlah = $_REQUEST['jumlah'];

      $query = $conn->query("UPDATE transaksi SET tgl_transaksi = '$tgl_transaksi', sales_id = '$nama_sales', mobil_id = '$nama_mobil', jual = '$jumlah' WHERE id_transaksi = '$id_transaksi'");

      if ($query) {
         header("location:index.php?alert=1");
      } else {
         header("location:index.php?alert=0");
      }
   }
} elseif ($_GET['action'] == "hapus") {
   if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $query = $conn->query("DELETE FROM transaksi WHERE id_transaksi = '$id'");
      if ($query) {
         header("location:index.php?alert=1");
      } else {
         header("location:index.php?alert=0");
      }
   }
} else {
   echo "Lalukan transaksi! <a href='index.php'>Kembali</a>";
}
