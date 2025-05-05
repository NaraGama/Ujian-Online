<?php
// Mulai session dan include koneksi ke database
session_start();
include 'assets/koneksi.php';

// Ambil data kategori dan level dari database
$query_kategori = "SELECT DISTINCT kategori FROM mata_pelajaran";
$result_kategori = $koneksi->query($query_kategori);

$query_level = "SELECT DISTINCT level FROM mata_pelajaran";
$result_level = $koneksi->query($query_level);
?>

<style>
    /* Umum */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f7fa;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 85%;
        margin: 0 auto;
        padding: 40px;
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    /* Heading Utama */
    .main-heading {
        text-align: center;
        font-size: 36px;
        color: #333333;
        margin-bottom: 40px;
        font-weight: bold;
    }

    /* Deskripsi Intro */
    .intro-text {
        font-size: 18px;
        color: #555555;
        text-align: center;
        margin-bottom: 40px;
        line-height: 1.6;
    }

    /* Section */
    .section {
        margin-bottom: 50px;
    }

    /* Judul Section */
    .section-title {
        font-size: 26px;
        color: #007bff;
        text-align: center;
        margin-bottom: 30px;
        font-weight: bold;
    }

    /* Deskripsi Section */
    .section-description {
        font-size: 16px;
        color: #777777;
        text-align: center;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    /* Tombol Kategori dan Level */
    .kategori-buttons, .level-buttons {
        display: flex;
        justify-content: center;
        gap: 30px;
        flex-wrap: wrap;
    }

    /* Tombol Kategori */
    .btn-category,
    .btn-level {
        background-color: #007bff;
        color: white;
        font-size: 20px;
        padding: 20px 40px;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        transition: transform 0.3s ease, background-color 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
    }

    /* Efek saat hover pada tombol */
    .btn-category:hover,
    .btn-level:hover {
        background-color: #0056b3;
        transform: scale(1.1);
    }

    /* Menambah efek responsif pada tombol */
    @media screen and (max-width: 768px) {
        .btn-category, .btn-level {
            font-size: 18px;
            padding: 15px 30px;
        }
    }

</style>

<body>
    <div class="container">
        <!-- Heading Beranda -->
        <h2 class="main-heading">Beranda</h2>

        <!-- Deskripsi untuk Beranda -->
        <p class="intro-text">Selamat datang di halaman Beranda. Anda dapat memilih kategori dan level soal yang sesuai untuk memulai pembelajaran. Gunakan tombol di bawah ini untuk memilih kategori dan level soal yang ingin Anda pelajari.</p>

        <!-- Tombol Besar untuk Kategori -->
        <div class="section kategori-section">
            <h3 class="section-title">Filter Berdasarkan Kategori</h3>
            <p class="section-description">Pilih kategori yang sesuai dengan topik yang ingin Anda pelajari. Setiap kategori mencakup berbagai materi pembelajaran yang dapat membantu Anda dalam mencapai tujuan belajar Anda.</p>
            <div class="kategori-buttons">
                <?php
                if ($result_kategori->num_rows > 0) {
                    while ($row = $result_kategori->fetch_assoc()) {
                        // Tombol untuk memilih kategori
                        echo "<a href='soal.php?kategori={$row['kategori']}'><button class='btn-category'>{$row['kategori']}</button></a>";
                    }
                }
                ?>
            </div>
        </div>

        <!-- Tombol Besar untuk Level -->
        <div class="section level-section">
            <h3 class="section-title">Filter Berdasarkan Level</h3>
            <p class="section-description">Pilih level soal yang sesuai dengan kemampuan Anda. Setiap level memberikan tingkat kesulitan yang berbeda, mulai dari pemula hingga mahir.</p>
            <div class="level-buttons">
                <?php
                if ($result_level->num_rows > 0) {
                    while ($row = $result_level->fetch_assoc()) {
                        // Tombol untuk memilih level
                        echo "<a href='soal.php?level={$row['level']}'><button class='btn-level'>{$row['level']}</button></a>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
