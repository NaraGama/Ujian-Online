<?php
// Baris ini menjalankan fungsi rand() untuk menghasilkan angka acak antara 1 hingga 3 detik
$delay = rand(1, 3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Mengatur karakter encoding ke UTF-8 -->
    <title>Loading...</title>

    <!-- Meta refresh: Mengarahkan otomatis ke content/beranda.php setelah delay acak (1–3 detik) -->
    <meta http-equiv="refresh" content="<?php echo $delay; ?>;url=content/assets/login">

    <style>
        /* Styling untuk body agar konten berada di tengah layar */
        body {
            display: flex;                  /* Mengaktifkan Flexbox */
            justify-content: center;       /* Pusat secara horizontal */
            align-items: center;           /* Pusat secara vertikal */
            height: 100vh;                 /* Tinggi viewport 100% */
            background-color: #f7f7f7;     /* Warna latar belakang abu terang */
            margin: 0;                     /* Menghilangkan margin default */
        }

        /* Styling untuk teks loading */
        p {
            font-size: 24px;               /* Ukuran font */
            font-weight: bold;             /* Teks tebal */
            font-family: Arial, sans-serif;/* Jenis font */
            color: #555;                   /* Warna teks abu tua */
        }

        /* Menambahkan animasi titik-titik setelah kata "Loading" */
        p::after {
            content: ".";                              /* Konten awal titik */
            animation: dots 1s steps(5, end) infinite;  /* Animasi berjalan terus-menerus */
        }

        /* Keyframes animasi: mengubah jumlah titik */
        @keyframes dots {
            0%   { content: "."; }      /* Titik 1 */
            25%  { content: ".."; }     /* Titik 2 */
            50%  { content: "..."; }    /* Titik 3 */
            75%  { content: "...."; }   /* Titik 4 */
            100% { content: "....."; }  /* Titik 5 */
        }
    </style>
</head>
<body>
    <!-- Elemen paragraf tempat teks loading ditampilkan -->
    <p>Loading</p>
</body>
</html>
