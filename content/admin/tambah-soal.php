<?php
session_start();  // Memulai sesi (session), digunakan untuk menyimpan informasi pengguna
include '../assets/koneksi.php'; // Menyertakan file koneksi.php yang berisi pengaturan koneksi ke database

// Deklarasikan variabel error dan uploadOk
// uploadOk digunakan untuk mengontrol apakah file yang diupload valid atau tidak
// error digunakan untuk menyimpan pesan kesalahan
$uploadOk = 1;  
$error = '';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  // Mengecek apakah form disubmit dengan metode POST
    // Ambil data form
    $soal = $_POST['soal'];  // Menyimpan input soal
    $pilihan_a = $_POST['pilihan_a'];  // Menyimpan pilihan A
    $pilihan_b = $_POST['pilihan_b'];  // Menyimpan pilihan B
    $pilihan_c = $_POST['pilihan_c'];  // Menyimpan pilihan C
    $pilihan_d = $_POST['pilihan_d'];  // Menyimpan pilihan D
    $jawaban_benar = $_POST['jawaban_benar'];  // Menyimpan jawaban benar
    $alasan_jawaban = $_POST['alasan_jawaban'];  // Menyimpan alasan jawaban
    $kategori = $_POST['kategori'];  // Menyimpan kategori soal
    $level = $_POST['level'];  // Menyimpan level soal (Mudah, Menengah, Sulit)

    // Handle upload foto jika ada (file foto opsional)
    $foto = NULL; // Defaultkan foto menjadi NULL
    if ($_FILES['foto']['name']) {  // Mengecek jika ada file foto yang diupload
        $target_dir = "../assets/img/";  // Tentukan folder tujuan untuk menyimpan foto
        $target_file = $target_dir . basename($_FILES['foto']['name']);  // Membuat path lengkap untuk file yang diupload
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));  // Mendapatkan ekstensi file gambar dan membuatnya menjadi huruf kecil

        // Cek apakah file gambar
        if (getimagesize($_FILES['foto']['tmp_name']) === false) {  // Memeriksa apakah file yang diupload adalah gambar
            $error = "File yang diupload bukan gambar.";  // Menyimpan pesan error jika bukan gambar
            $uploadOk = 0;  // Menetapkan uploadOk menjadi 0, artinya file tidak valid
        }

        // Cek ukuran file (maksimum 5MB)
        if ($_FILES['foto']['size'] > 5000000) {  // Memeriksa apakah ukuran file lebih besar dari 5MB
            $error = "File terlalu besar.";  // Menyimpan pesan error jika ukuran file terlalu besar
            $uploadOk = 0;  // Menetapkan uploadOk menjadi 0
        }

        // Cek apakah file sudah ada
        if (file_exists($target_file)) {  // Memeriksa apakah file dengan nama yang sama sudah ada di folder tujuan
            $error = "File sudah ada.";  // Menyimpan pesan error jika file sudah ada
            $uploadOk = 0;  // Menetapkan uploadOk menjadi 0
        }

        // Cek format file
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {  // Memeriksa apakah ekstensi file bukan JPG, PNG, JPEG, atau GIF
            $error = "Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";  // Menyimpan pesan error jika ekstensi file tidak sesuai
            $uploadOk = 0;  // Menetapkan uploadOk menjadi 0
        }

        // Jika semua pengecekan berhasil, upload gambar
        if ($uploadOk == 1) {  // Jika semua pengecekan berhasil (uploadOk masih 1)
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {  // Memindahkan file yang diupload ke folder tujuan
                $foto = basename($_FILES['foto']['name']);  // Menyimpan nama file foto untuk disimpan ke database
            } else {
                $error = "Terjadi kesalahan saat mengupload file.";  // Menyimpan pesan error jika gagal memindahkan file
                $uploadOk = 0;  // Menetapkan uploadOk menjadi 0 jika gagal upload
            }
        }
    }

    // Insert data soal ke database jika tidak ada kesalahan dalam upload
    if ($uploadOk == 1) {  // Jika upload foto berhasil atau tidak ada foto yang diupload
        // Menyiapkan query untuk memasukkan data ke tabel mata_pelajaran
        $stmt = $koneksi->prepare("INSERT INTO mata_pelajaran (soal, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban_benar, alasan_jawaban, kategori, level, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $soal, $pilihan_a, $pilihan_b, $pilihan_c, $pilihan_d, $jawaban_benar, $alasan_jawaban, $kategori, $level, $foto);  // Mengikat parameter untuk query
        $stmt->execute();  // Menjalankan query untuk memasukkan data ke database
        $stmt->close();  // Menutup statement

        echo "Soal berhasil diupload!";  // Menampilkan pesan berhasil jika data berhasil disimpan
    } else {
        echo $error;  // Menampilkan pesan error jika terjadi kesalahan (misalnya upload foto gagal)
    }
}
?>

<a href="index">Kembali</a>

<!-- Form untuk memasukkan soal -->
<form action="" method="post" enctype="multipart/form-data">
    <label for="soal">Soal:</label>
    <textarea name="soal" required></textarea><br>

    <label for="pilihan_a">Pilihan A:</label>
    <input type="text" name="pilihan_a" required><br>

    <label for="pilihan_b">Pilihan B:</label>
    <input type="text" name="pilihan_b" required><br>

    <label for="pilihan_c">Pilihan C:</label>
    <input type="text" name="pilihan_c" required><br>

    <label for="pilihan_d">Pilihan D:</label>
    <input type="text" name="pilihan_d" required><br>

    <label for="jawaban_benar">Jawaban Benar:</label>
    <input type="text" name="jawaban_benar" required><br>

    <label for="alasan_jawaban">Alasan Jawaban:</label>
    <textarea name="alasan_jawaban"></textarea><br>

    <label for="kategori">Kategori:</label>
    <input type="text" name="kategori" value="Umum"><br>

    <label for="level">Level:</label>
    <select name="level">
        <option value="Mudah">Mudah</option>
        <option value="Menengah">Menengah</option>
        <option value="Sulit">Sulit</option>
    </select><br>

    <label for="foto">Foto (Opsional):</label>
    <input type="file" name="foto"><br>

    <button type="submit">Upload</button>
</form>

<style>
    /* Style Umum untuk Halaman */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Menggunakan font modern yang mudah dibaca */
    background-color: #f4f7fc; /* Warna latar belakang halaman, memberikan kesan bersih dan profesional */
    margin: 0; /* Menghilangkan margin default */
    padding: 0; /* Menghilangkan padding default */
}

/* Mengatur Tampilan Container Form */
.container {
    width: 80%; /* Lebar container form adalah 80% dari lebar layar */
    max-width: 600px; /* Batas lebar maksimum untuk container form */
    margin: 50px auto; /* Memberikan jarak atas 50px dan membuat form berada di tengah secara horizontal */
    background-color: #fff; /* Warna latar belakang form putih */
    padding: 20px; /* Memberikan padding di sekitar konten form agar tidak terlalu rapat */
    border-radius: 8px; /* Membuat sudut form lebih bulat */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Memberikan bayangan halus di sekitar form */
}

/* Judul Form */
h2 {
    text-align: center; /* Menengahkan teks judul */
    color: #333; /* Warna teks gelap agar kontras dengan latar belakang */
    margin-bottom: 20px; /* Memberikan jarak bawah untuk judul agar tidak terlalu rapat dengan form */
    font-size: 24px; /* Ukuran font yang lebih besar untuk judul */
}

/* Label untuk Input Form */
label {
    display: block; /* Menampilkan label dalam satu baris */
    margin-bottom: 8px; /* Memberikan jarak bawah agar tidak terlalu rapat dengan input */
    font-size: 16px; /* Ukuran font untuk label */
    color: #555; /* Warna teks label yang lebih terang dari warna teks input */
}

/* Style untuk Input Text dan Textarea */
input[type="text"], input[type="file"], textarea, select {
    width: 100%; /* Input dan textarea mengisi seluruh lebar container */
    padding: 12px; /* Memberikan padding di dalam input agar teks tidak menempel pada tepi */
    margin: 8px 0 20px 0; /* Memberikan margin atas dan bawah agar ada jarak antar elemen */
    border: 1px solid #ddd; /* Memberikan border tipis dengan warna abu-abu muda */
    border-radius: 6px; /* Membuat sudut input lebih melengkung */
    font-size: 16px; /* Ukuran font pada input agar mudah dibaca */
    color: #555; /* Warna teks di dalam input */
    background-color: #fafafa; /* Warna latar belakang input yang terang */
}

/* Efek Fokus pada Input */
input[type="text"]:focus, input[type="file"]:focus, textarea:focus, select:focus {
    border-color: #007bff; /* Mengubah warna border menjadi biru ketika input mendapat fokus */
    outline: none; /* Menghilangkan outline default saat input mendapat fokus */
    background-color: #fff; /* Mengubah latar belakang menjadi putih saat fokus */
}

/* Style untuk Tombol Submit */
button[type="submit"] {
    width: 100%; /* Tombol akan mengisi seluruh lebar container */
    padding: 14px; /* Memberikan padding besar untuk membuat tombol lebih besar dan mudah diklik */
    background-color: #28a745; /* Warna hijau terang pada tombol */
    color: #fff; /* Warna teks tombol putih agar kontras dengan latar belakang tombol */
    font-size: 18px; /* Ukuran font lebih besar agar teks tombol mudah dibaca */
    border: none; /* Menghapus border default tombol */
    border-radius: 6px; /* Membuat sudut tombol lebih melengkung */
    cursor: pointer; /* Menunjukkan bahwa tombol bisa diklik */
    transition: background-color 0.3s; /* Menambahkan efek transisi untuk perubahan warna background */
}

/* Efek Hover pada Tombol */
button[type="submit"]:hover {
    background-color: #218838; /* Mengubah warna tombol menjadi hijau gelap saat kursor berada di atas tombol */
}

/* Menampilkan Pesan Error dengan Warna Merah */
.error {
    color: #e74c3c; /* Warna merah terang untuk menunjukkan pesan error */
    font-size: 16px; /* Ukuran font pesan error */
    text-align: center; /* Menengahkan pesan error di tengah */
    margin-top: 10px; /* Memberikan jarak atas agar tidak terlalu rapat dengan elemen lain */
}

/* Memberikan Padding pada Form */
form {
    padding: 20px; /* Memberikan padding di dalam form agar elemen tidak menempel pada tepi */
}

/* Menambahkan Margin pada Setiap Elemen di dalam Form */
form > * {
    margin-bottom: 15px; /* Memberikan jarak antar elemen dalam form */
}

/* Menambahkan Border Bawah pada Input */
input[type="text"], textarea, select {
    border-bottom: 2px solid #ddd; /* Memberikan border bawah untuk tampilan lebih modern */
    border-radius: 0; /* Menghilangkan border-radius agar hanya ada border bawah */
}

</style>