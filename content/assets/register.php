<?php
session_start(); // Mulai session

include 'koneksi.php'; // Include koneksi ke database

// Cek apakah form sudah disubmit via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username']; // Ambil username dari form
    $password = $_POST['password']; // Ambil password dari form
    $confirm_password = $_POST['confirm_password']; // Ambil konfirmasi password dari form

    // Validasi agar password dan konfirmasi password cocok
    if ($password !== $confirm_password) {
        $error = "Password dan Konfirmasi Password tidak cocok!";
    } else {
        // Periksa apakah username sudah ada di database
        $stmt = $koneksi->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Jika username sudah ada
        if ($result->num_rows > 0) {
            $error = "Username sudah digunakan!";
        } else {
            // Masukkan data baru ke dalam database
            $stmt = $koneksi->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
            $role = 'user'; // Default role untuk user baru
            $stmt->bind_param("sss", $username, $password, $role); // Menyiapkan query untuk insert data
            if ($stmt->execute()) {
                // Redirect ke halaman login setelah registrasi berhasil
                header("Location: login");
                exit();
            } else {
                $error = "Gagal mendaftar. Coba lagi!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
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
        .register-container {
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

        /* Gaya untuk tombol register */
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

        /* Gaya untuk link ke login */
        .login-link {
            text-align: center;
            margin-top: 10px;
        }

        .login-link a {
            color: #4CAF50; /* Warna link */
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline; /* Efek underline saat hover */
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Form Register</h2>

        <!-- Tampilkan error jika ada -->
        <?php if (isset($error)) : ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <!-- Form register -->
        <form action="" method="post">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
            <button type="submit">Register</button>
        </form>

        <!-- Link untuk menuju halaman login -->
        <div class="login-link">
            <p>Sudah punya akun? <a href="login">Login di sini</a></p>
        </div>
    </div>
</body>
</html>
