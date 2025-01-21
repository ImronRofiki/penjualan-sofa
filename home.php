<?php
session_start();
if (empty($_SESSION['username'])) {
    header("location:home.php");
}
if (isset($_SESSION['alert'])) {
    echo $_SESSION['alert'];
    unset($_SESSION['alert']);
}
include 'config.php'; // Pastikan file config.php ada dan berisi koneksi ke database
include 'navbar.php'; //

// Ambil keyword pencarian (jika ada)
$keyword = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';

// Query untuk menampilkan produk
if (!empty($keyword)) {
    $query = "SELECT * FROM barang WHERE nama_barang LIKE '%$keyword%'";
} else {
    $query = "SELECT * FROM barang"; // Jika tidak ada keyword, tampilkan semua produk
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Bintang Jaya Sofa</title>
    <style>
        .hero {
            background-color: #0000ff;
            /* Warna biru sesuai gambar */
            color: white;
            text-align: center;
            padding: 50px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .hero h1 {
            font-size: 24px;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .hero h2 {
            font-size: 18px;
            margin: 10px 0 20px;
            font-weight: bold;
        }

        .search-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .search-bar input[type="text"] {
            padding: 10px 15px;
            width: 300px;
            border: none;
            border-radius: 20px;
            outline: none;
            font-size: 14px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .search-bar button {
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            background-color: white;
            color: black;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .search-bar button:hover {
            background-color: #ddd;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .product-card {
            background-color: #e0e0e0;
            border-radius: 8px;
            width: 200px;
            padding: 10px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .product-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-card h3 {
            margin: 10px 0 5px;
            font-size: 16px;
            font-weight: bold;
        }

        .product-card p {
            margin: 0;
            color: #555;
            font-size: 14px;
        }

        .product-card button {
            margin: 5px;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-view {
            background-color: #007bff;
            color: #fff;
        }

        .btn-cart {
            background-color: #28a745;
            color: #fff;
        }

        .btn-buy {
            background-color: #ffc107;
            color: #fff;
        }

        footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #e0e0e0;
            padding: 10px;
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <div class="hero">
        <h1>SELAMAT DATANG DI TOKO BINTANG JAYA SOFA...</h1>
        <h2>SILAHKAN BERBELANJA</h2>
        <form class="search-bar" action="https://penjualan-sofa.gunawans.web.id/home.php" method="GET">
            <input type="text" name="q" placeholder="Cari produk..."
                value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
            <button type="submit">Cari</button>
        </form>
    </div>

    <!-- Product Container -->
    <div class="product-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="product-card">
                    <img src="admin/uploads/' . htmlspecialchars($row['foto_barang']) . '" alt="' . htmlspecialchars($row['nama_barang']) . '">
                    <h3>' . htmlspecialchars($row['nama_barang']) . '</h3>
                    <p>Rp. ' . number_format($row['harga_barang'], 2, ',', '.') . '</p>
                    <a href="https://penjualan-sofa.gunawans.web.id/detail-produk.php?id=' . $row['id'] . '">
                        <button class="btn-view">Lihat</button>
                    </a>
                </div>
                ';
            }
        } else {
            echo '<p>Tidak ada produk yang sesuai dengan pencarian.</p>';
        }
        ?>
    </div>

    <!-- Footer -->
    <footer>
        Copyright @2024 By Bintang Jaya Sofa
    </footer>

</body>

</html>