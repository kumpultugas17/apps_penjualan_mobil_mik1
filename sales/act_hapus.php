<?php
require_once("../config.php");
$id_sales = $_GET['id'];

$query = $conn->query("DELETE FROM sales WHERE id_sales = '$id_sales'");

if ($query) {
   header("location:index.php?alert=1");
} else {
   header("location:index.php?alert=0");
}
