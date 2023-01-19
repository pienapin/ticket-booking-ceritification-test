<?php

include "includes/config.php";

if (isset($_POST["pesan"])) {
  $nama = mysqli_real_escape_string($conn, $_POST["namaLengkap"]);
  $id = mysqli_real_escape_string($conn, $_POST["noID"]);
  $hp = mysqli_real_escape_string($conn, $_POST["noHP"]);
  $tempat = $_POST["tempatWisata"];
  $tanggalKunjungan = $_POST['tanggalKunjungan'];
  $date = DateTime::createFromFormat('d/m/Y',$tanggalKunjungan);
  $tanggal = $date->format("Y-m-d");
  $dewasa = $_POST["pengunjungDewasa"];
  $anak = $_POST["pengunjungAnak"];
  switch ($tempat) {
    case 1:
      $harga = 25000;
      $namaTempat = "Museum Sang Nila Utama";
      break;
    case 2:
      $harga = 10000;
      $namaTempat = "Taman Wisata Alam Mayang";
      break;
    case 3:
      $harga = 20000;
      $namaTempat = "Kebun Binatang Kasang Kulim";
      break;
    default:
      break;
  }
  $total = ($dewasa * $harga) + ($anak * ($harga/2));
  $sql = "INSERT INTO pesanan (nama, noID, noHP, tempatWisata, tanggal, pengunjungDewasa, pengunjungAnak, totalBayar) VALUES ('$nama','$id','$hp','$namaTempat','$tanggal','$dewasa','$anak','$total')";
  $res = mysqli_query($conn, $sql);
  if ($res) {
    $_POST["namaLengkap"] = "";
    $_POST["noID"] = "";
    $_POST["noHP"] = "";
    $_POST["tempatWisata"] = "";
    $_POST["tanggalKunjungan"] = "";
    $_POST["pengunjungDewasa"] = "";
    $_POST["pengunjungAnak"] = "";
    header("Location: index.php");
    }
}
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
    $( function() {
      $( "#datepicker" ).datepicker({
        dateFormat: "dd/mm/yy"
      });
    });
  </script>
  <title>Tiket Wisata</title>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg py-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Aplikasi Pesan Tiket Wisata</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav text-center ms-auto">
          <a class="nav-link active me-2" aria-current="page" href="#">Home</a>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Tempat Wisata
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalMuseum">Museum Sang
                  Nila Utama Riau</a></li>
              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalTaman">Taman Wisata Alam Mayang</a></li>
              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalKebun">Kebun Binatang Kasang Kulim</a></li>
            </ul>
          </li>
          <a class="nav-link me-2" href="#" data-bs-toggle="modal" data-bs-target="#modalHarga">Daftar Harga</a>
          <a class="nav-link me-2" href="tiket.php">Daftar Tiket</a>
          <a class="nav-link btn btn-success text-light px-3" data-bs-toggle="modal" data-bs-target="#modalPesanTiket" href="#">Pesan Tiket</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Tampilan Home -->

  <!-- Carousel -->
  <div id="carouselTempatWisata" class="carousel slide bg-light py-4" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="https://awsimages.detik.net.id/community/media/visual/2022/10/13/museum_169.jpeg?w=700&q=90"
          class="d-block mx-auto rounded-3" height="640" alt="Museum Sang Nila Utama">
      </div>
      <div class="carousel-item">
        <img src="https://smarttourism.pekanbaru.go.id/storage/destinations/47275-taman-rekrasi-alam-mayang.jpg"
          class="d-block mx-auto rounded-3" height="640" alt="Taman Wisata Alam Mayang">
      </div>
      <div class="carousel-item">
        <img src="https://t-2.tstatic.net/tribunnewswiki/foto/bank/images/Kebun-Binatang-Kasang-Kulim.jpg"
          class="d-block mx-auto rounded-3" height="640" alt="Kebun Binatang Kasang Kulim">
      </div>
    </div>
    <h1 class="text-center mt-3 fw-semibold">Aplikasi Pemesanan Tiket Wisata</h1>
  </div>


  <!-- Jargon -->
  <section class="text-center py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="d-flex"><i class="bi m-auto text-primary">
                              <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                                <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                              </svg>
                            </i></div>
                            <h3>Murah!</h3>
                            <p class="lead mb-0">Aplikasi ini menyediakan tiket dengan harga yang terjangkau.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="d-flex"><i class="bi m-auto text-primary">
                              <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-cloud-fog2" viewBox="0 0 16 16">
                                <path d="M8.5 4a4.002 4.002 0 0 0-3.8 2.745.5.5 0 1 1-.949-.313 5.002 5.002 0 0 1 9.654.595A3 3 0 0 1 13 13H.5a.5.5 0 0 1 0-1H13a2 2 0 0 0 .001-4h-.026a.5.5 0 0 1-.5-.445A4 4 0 0 0 8.5 4zM0 8.5A.5.5 0 0 1 .5 8h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5z"/>
                              </svg>
                            </i></div>
                            <h3>Cepat!</h3>
                            <p class="lead mb-0">Tiket langsung terpesan hanya dengan mengisi form dan sekali klik tombol</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mx-auto mb-0 mb-lg-3">
                            <div class="d-flex"><i class="bi fs-1 m-auto text-primary">
                              <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                                <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
                              </svg>
                            </i></div>
                            <h3>Terpercaya!</h3>
                            <p class="lead mb-0">Aplikasi ini sudah digunakan selama bertahun-tahun oleh berbagai pihak.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Footer -->
        <footer class="footer bg-dark py-3">
            <div class="container">
                <div class="row">
                    <p class="text-light text-center small mb-4 mb-lg-0">&copy; Alvien Cenna 2022. All Rights Reserved.</p>
                </div>
            </div>
        </footer>

  <!-- Tampilan Home -->


  <!-- Kumpulan Modal -->

  <!-- Modal Museum Sang Nila Utama -->
  <div class="modal fade" id="modalMuseum" tabindex="-1" aria-labelledby="MuseumSangNilaUtama" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Museum Sang Nila Utama</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="carouselMuseum" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <iframe height="320" width="480" src="https://www.youtube.com/embed/Tsh8ekX-hKI"></iframe>
              </div>
              <div class="carousel-item">
                <img src="https://awsimages.detik.net.id/community/media/visual/2022/10/13/museum_169.jpeg?w=700&q=90"
                  class="d-block mx-auto rounded-3" height="320" alt="Museum Sang Nila Utama 1">
              </div>
              <div class="carousel-item">
                <img src="https://upload.wikimedia.org/wikipedia/commons/0/01/Museum_Sang_Nila_Utama.jpg"
                  class="d-block mx-auto rounded-3" height="320" alt="Museum Sang Nila Utama 2">
              </div>
              <div class="carousel-item">
                <img
                  src="https://awsimages.detik.net.id/community/media/visual/2021/10/10/koleksi-museum-sang-nila-utama-foto-raja-adildetikcom-2_169.jpeg?w=1200"
                  class="d-block mx-auto rounded-3" height="320" alt="Museum Sang Nila Utama 3">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselMuseum" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselMuseum" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Taman Wisata Alam Mayang -->
  <div class="modal fade" id="modalTaman" tabindex="-1" aria-labelledby="TamanWisataAlamMayang" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Taman Wisata Alam Mayang</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="carouselTaman" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <iframe height="320" width="480" src="https://www.youtube.com/embed/Ejhxv2vXOhE"></iframe>
              </div>
              <div class="carousel-item">
                <img src="https://smarttourism.pekanbaru.go.id/storage/destinations/47275-taman-rekrasi-alam-mayang.jpg"
                  class="d-block mx-auto rounded-3" height="320" alt="Taman Wisata Alam Mayang 1">
              </div>
              <div class="carousel-item">
                <img
                  src="https://www.itrip.id/wp-content/uploads/2021/11/Daya-Tarik-Taman-Wisata-Alam-Mayang.jpg"
                  class="d-block mx-auto rounded-3" height="320" alt="Taman Wisata Alam Mayang 2">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselTaman" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselTaman" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Kebun Binatang Kasang Kulim -->
  <div class="modal fade" id="modalKebun" tabindex="-1" aria-labelledby="KebunBinatangKasangKulim" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Kebun Binatang Kasang Kulim</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="carouselKebun" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <iframe height="320" width="480" src="https://www.youtube.com/embed/mtdMBuzvDPs"></iframe>
              </div>
              <div class="carousel-item">
                <img src="https://t-2.tstatic.net/tribunnewswiki/foto/bank/images/Kebun-Binatang-Kasang-Kulim.jpg"
                  class="d-block mx-auto rounded-3" height="320" alt="Kebun Binatang Kasang Kulim 1">
              </div>
              <div class="carousel-item">
                <img
                  src="https://www.melayupedia.com/foto_berita/2021/12/2021-12-07-kasang-kulim-satu-satunya-kebun-binatang-di-riau.jpg"
                  class="d-block mx-auto rounded-3" height="320" alt="Kebun Binatang Kasang Kulim 2">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselKebun" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselKebun" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Daftar Harga -->
  <div class="modal fade" id="modalHarga" tabindex="-1" aria-labelledby="DaftarHarga" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Daftar Harga</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="col-7">
                <p>Museum Sang Nila Utama : </p>
              </div>
              <div class="col-5">
                <p>Rp 25.000</p>
              </div>
            </div>
            <div class="row">
              <div class="col-7">
                <p>Taman Wisata Alam Mayang : </p>
              </div>
              <div class="col-5">
                <p>Rp 10.000</p>
              </div>
            </div>
            <div class="row">
              <div class="col-7">
                <p>Kebun Binatang Kasang Kulim : </p>
              </div>
              <div class="col-5">
                <p>Rp 20.000</p>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal Form Pesan Tiket -->
  <div class="modal fade" id="modalPesanTiket" tabindex="-1" aria-labelledby="PesanTiket" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Form Pemesanan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form Pemesanan -->
          <form action="" method="POST">
            <div class="mb-3">
              <label for="namaLengkap" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" name="namaLengkap" aria-describedby="namaHelp">
            </div>
            <div class="mb-3">
              <label for="noID" class="form-label">Nomor Identitas</label>
              <input type="text" class="form-control" name="noID">
            </div>
            <div class="mb-3">
              <label for="noHP" class="form-label">No. HP</label>
              <input type="tel" class="form-control" name="noHP">
            </div>
            <div class="mb-3">
              <label for="tempatWisata" class="form-label">Tempat Wisata</label>
              <select class="form-select" id="tempatWisata" name="tempatWisata" aria-label="Default select example" onchange="tampilHarga()">
                <option selected>Tempat Wisata</option>
                <option value="1">Museum Sang Nila Utama</option>
                <option value="2">Taman Wisata Alam Mayang</option>
                <option value="3">Kebun Binatang Kasang Kulim</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="tanggalKunjungan" class="form-label">Tanggal Kunjungan</label>
              <input type="text" class="form-control" id="datepicker" name="tanggalKunjungan" placeholder="dd/mm/yy">
            </div>
            <div class="mb-3">
              <label for="pengunjungDewasa" class="form-label">Jumlah Pengunjung Dewasa</label>
              <input type="number" class="form-control" id="pengunjungDewasa" name="pengunjungDewasa" min="0">
            </div>
            <div class="mb-3">
              <label for="pengunjungAnak" class="form-label mb-0">Jumlah Pengunjung Anak-Anak</label>
              <div class="form-text mt-0 mb-1">Usia di bawah 12 tahun</div>
              <input type="number" class="form-control" id="pengunjungAnak" name="pengunjungAnak" min="0">
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Saya dan/atau rombongan tela membaca, memahami, dan setuju berdasarkan syarat dan ketentuan yang telah ditetapkan</label>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-3">
                  <p>Harga Tiket</p>
                </div>
                <div class="col-5">
                  <p id="hargaTiket">Rp 0</p>
                </div>
              </div>
              <div class="row">
                <div class="col-3">
                  <p>Total Bayar</p>
                </div>
                <div class="col-5">
                  <p id="totalBayar">Rp 0</p>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer d-flex">
            <button name="hitungTotal" type="button" class="btn btn-secondary" onclick="tampilTotal()">Hitung Total Bayar</button>
            <button name="pesan" type="submit" class="btn btn-primary" onclick="pesanTiket()">Pesan Tiket</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Kumpulan Modal -->


  <!-- JavaScript Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
    crossorigin="anonymous"></script>
  <script src="./src/js/script.js"></script>
</body>

</html>