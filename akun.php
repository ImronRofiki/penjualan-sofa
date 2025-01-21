<?php
session_start();
include 'navbar.php';

// Redirect jika pengguna belum login
if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
    header('Location: https://penjualan-sofa.gunawans.web.id/login.php');
    exit();
}

// Data dari sesi
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$password = $_SESSION['password']; // Asumsikan sudah dienkripsi (hashed)

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "penjualan_sofa");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tangani perubahan data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = htmlspecialchars($_POST['username']);
    $new_email = htmlspecialchars($_POST['email']);
    $new_password = htmlspecialchars($_POST['password']);

    // Update ke database (hash password jika diubah)
    $hashed_password = $new_password === $password ? $password : password_hash($new_password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE username = ?");
    $stmt->bind_param("ssss", $new_username, $new_email, $hashed_password, $username);

    if ($stmt->execute()) {
        $success_message = "Profil berhasil diperbarui!";

        // Perbarui sesi
        $_SESSION['username'] = $new_username;
        $_SESSION['email'] = $new_email;
        $_SESSION['password'] = $hashed_password;

        // Perbarui variabel lokal
        $username = $new_username;
        $email = $new_email;
        $password = $hashed_password;
    } else {
        $error_message = "Gagal memperbarui profil: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;

        }

        .profile-container {
            max-width: 400px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-container form {
            display: flex;
            flex-direction: column;
        }

        .profile-container form label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .profile-container form input {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .profile-container form button {
            padding: 10px;
            font-size: 16px;
            background-color: #6c63ff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .profile-container form button:hover {
            background-color: #5751d1;
        }

        .success-message {
            margin-bottom: 15px;
            color: green;
            font-weight: bold;
        }

        .error-message {
            margin-bottom: 15px;
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="profile-container">
        <h2>Profile</h2>
        <?php if (isset($success_message)): ?>
            <p class="success-message"><?= $success_message; ?></p>
        <?php endif; ?>
        <?php if (isset($error_message)): ?>
            <p class="error-message"><?= $error_message; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($username); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email); ?>" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?= htmlspecialchars($password); ?>" required>

            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>

</html>