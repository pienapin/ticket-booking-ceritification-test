// Deklarasi variabel
let total;
let dewasa;
let anak;
let tempat;
let harga;

// Fungsi untuk menampilkan total harga
function tampilTotal() {
  anak = parseInt(document.getElementById("pengunjungAnak").value);
  dewasa = parseInt(document.getElementById("pengunjungDewasa").value);
  tempat = parseInt(document.getElementById("tempatWisata").value);
  switch (tempat) {
    case 1:
      harga = 25000;
      break;
    case 2:
      harga = 10000;
      break;
    case 3:
      harga = 20000;
      break;  
    default:
      break;
  }
  total = (dewasa * harga)+(anak * (harga/2));
  document.getElementById("hargaTiket").innerHTML = `Rp ${harga}`;
  document.getElementById("totalBayar").innerHTML = `Rp ${total}`;
};

function tampilHarga() {
  tempat = parseInt(document.getElementById("tempatWisata").value);
  switch (tempat) {
    case 1:
      harga = 25000;
      break;
    case 2:
      harga = 10000;
      break;
    case 3:
      harga = 20000;
      break;  
    default:
      break;
  }
  document.getElementById("hargaTiket").innerHTML = `Rp ${harga}`;
};