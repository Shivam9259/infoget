<?php include('layout/AdminLayout/Header.php'); ?>

<?php
$id = $_GET['id'];
$query = "DELETE FROM blogs WHERE id=$id";
mysqli_query($con, $query);
header('Location:dashboard.php');
?>

<?php include('layout/AdminLayout/Footer.php'); ?>