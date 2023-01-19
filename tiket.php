<?php

include "includes/config.php";

$sql = "SELECT * FROM pesanan";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <title>Tiket Wisata</title>
</head>

<body>
<a class="btn btn-primary text-light px-4 d-block mt-3 mx-auto" style="width: 8%;" href="index.php">Back</a>
  
  <div class="container mt-3">
    <div class="row">
      <?php if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        echo '<div class="col-sm-6 mb-3">';
          echo '<div class="card">';
            echo '<div class="card-body">';
              echo '<h5 class="card-title">Tiket #'.$row['id'].'</h5>';
              echo '<p class="card-text">Nama Pemesan : '.$row['nama'].'</p>';
              echo '<p class="card-text">Nomor Identitas : '.$row['noID'].'</p>';
              echo '<p class="card-text">No. HP : '.$row['noHP'].'</p>';
              echo '<p class="card-text">Tempat Wisata : '.$row['tempatWisata'].'</p>';
              echo '<p class="card-text">Pengunjung Dewasa : '.$row['pengunjungDewasa'].' orang</p>';
              echo '<p class="card-text">Pengujung Anak : '.$row['pengunjungAnak'].' orang</p>';
              echo '<p class="card-text">Total Bayar : Rp. '.$row['totalBayar'].'</p>';
            echo '</div>';
          echo '</div>';
        echo '</div>';
        } 
      } ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
    crossorigin="anonymous"></script>
  <script src="./src/js/script.js"></script>
</body>