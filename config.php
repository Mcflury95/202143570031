<?php 
 
$server = "localhost";
$user = "id19457281_admin";
$pass = "172B0S5G|Bo[c4]{";
$database = "id19457281_mydb";
 
$conn = mysqli_connect($server, $user, $pass, $database);
 
if (!$conn) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}
 
?>