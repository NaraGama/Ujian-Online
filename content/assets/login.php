<?php
session_start(); // Mulai session

include 'koneksi.php'; // Include file koneksi

// Cek apakah form sudah disubmit via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username']; // Ambil username dari form
    $password = $_POST['password']; // Ambil password dari form

    // Prepared statement untuk menghindari SQL injection
    $stmt = $koneksi->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username); // Bind parameter untuk username
    $stmt->execute(); // Jalankan query

    // Ambil hasil query
    $result = $stmt->get_result();

    // Jika user ditemukan
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc(); // Ambil data user

        // Verifikasi password (tanpa hash untuk sekarang)
        if ($password === $data['password']) {
            // Jika password cocok, simpan data ke session
            $_SESSION['username'] = $data['username'];
            $_SESSION['role'] = $data['role'];
            $_SESSION['login'] = true;

            // Redirect ke halaman berdasarkan role
            if ($_SESSION['role'] == 'admin') {
                header("Location: ../admin/index"); // Jika admin, redirect ke admin.index.php
            } else {
                header("Location: ../beranda"); // Jika user, redirect ke beranda.php
            }
            exit();
        } else {
            // Jika password tidak cocok
            $error = "Username atau Password salah!";
        }
    } else {
        // Jika user tidak ditemukan
        $error = "Username atau Password salah!";
    }

    // Tutup statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        /* Gaya untuk body dan layout keseluruhan */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center; /* Posisikan form di tengah */
            align-items: center;
            height: 100vh; /* Full height viewport */
            margin: 0;
            background-color: #f4f4f9; /* Warna latar belakang */
        }

        /* Gaya untuk container form */
        .login-container {
            background-color: #ffffff; /* Warna latar belakang form */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Bayangan untuk kesan elegan */
            width: 100%;
            max-width: 400px; /* Lebar maksimal form */
        }

        /* Gaya judul form */
        h2 {
            text-align: center;
            color: #333; /* Warna teks */
        }

        /* Gaya untuk input form */
        input {
            width: 100%; /* Lebar penuh */
            padding: 10px;
            margin: 10px 0; /* Jarak antar input */
            border: 1px solid #ccc; /* Border abu-abu */
            border-radius: 5px; /* Sudut melengkung */
            box-sizing: border-box; /* Agar padding dan border tidak merusak layout */
        }

        /* Gaya untuk tombol login */
        button {
            width: 100%; /* Lebar penuh */
            padding: 10px;
            background-color: #4CAF50; /* Warna latar belakang tombol */
            color: white; /* Warna teks tombol */
            border: none;
            border-radius: 5px;
            cursor: pointer; /* Menampilkan pointer saat dihover */
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049; /* Warna lebih gelap saat hover */
        }

        /* Gaya untuk pesan error */
        .error {
            color: red; /* Warna merah untuk error */
            font-size: 14px;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Form Login</h2>

        <!-- Tampilkan error jika ada -->
        <?php if (isset($error)) : ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <!-- Form login -->
        <form action="" method="post">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
        <div class="link-register">
            <a href="register">Belum Punya Akun? Buat Sekarang!!</a>
        </div>
    </div>
</body>
</html>
