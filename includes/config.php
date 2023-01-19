<?php

function dbConnect() {
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $database = "pesanan_tiket";

  $conn = mysqli_connect($hostname, $username, $password, $database);
  return $conn;
}

$conn = dbConnect();

?>