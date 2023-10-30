<?php
require_once("../config.php");
$id_mobil = $_GET['id'];

$query = $conn->query("DELETE FROM mobil WHERE id_mobil = '$id_mobil'");

if ($query) {
   header("location:index.php?alert=1");
} else {
   header("location:index.php?alert=0");
}
