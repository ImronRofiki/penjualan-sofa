<?php
include "../config.php";
session_start();
if (empty($_SESSION['username'])) {
    header("location:admin.php");
}
if (isset($_SESSION['alert'])) {
    echo $_SESSION['alert'];
    unset($_SESSION['alert']);
}

// Ambil jumlah barang
$sql_barang = "SELECT COUNT(*) AS jumlah_barang FROM barang";
$result_barang = $conn->query($sql_barang);
$row_barang = $result_barang->fetch_assoc();
$jumlah_barang = $row_barang["jumlah_barang"];

// Ambil jumlah pengguna dengan role "user"
$sql_users = "SELECT COUNT(*) AS jumlah_users FROM users WHERE role = 'user'";
$result_users = $conn->query($sql_users);
$row_users = $result_users->fetch_assoc();
$jumlah_users = $row_users["jumlah_users"];

include "sidebar.php";
// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            font-size: 2rem;
            color: #333;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .card {
            background-color: #b1f0f7;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            flex: 1 1 calc(25% - 40px);
            max-width: 200px;
            height: auto;
            transition: transform 0.3s ease;

            /* Tambahan */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 150px;
            /* Sama untuk semua */
        }


        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 a {
            text-decoration: none;
            color: #333;
            font-size: 1.2rem;
        }

        .card h3 a:hover {
            color: #007bff;
        }

        .card p {
            font-size: 1.5rem;
            color: #555;
            margin-top: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card {
                flex: 1 1 calc(50% - 20px);
                max-width: none;
            }
        }

        @media (max-width: 480px) {
            .card {
                flex: 1 1 100%;
                max-width: none;
            }

            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <h1>Dashboard Admin</h1>
    <div class="container">
        <div class="card">
            <h3><a href="barang.php">JUMLAH BARANG</a></h3>
            <p><?php echo $jumlah_barang; ?></p>
        </div>
        <div class="card">
            <h3><a href="user.php">JUMLAH PENGGUNA</a></h3>
            <p><?php echo $jumlah_users; ?></p>
        </div>
    </div>
</body>

</html>