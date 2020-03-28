<?php
$server="localhost";
$db="blogappdb";
$user="user";
$password="12345";

$con = mysqli_connect($server,$user,$password,$db);

if(mysqli_connect_errno())
{
    die("Connection failed: ".mysqli_connect_error());
}
?>