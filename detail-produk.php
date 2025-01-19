<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "penjualan_sofa");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

include 'navbar.php';
// Ambil ID produk dari URL
$id_produk = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query produk berdasarkan ID
$sql = "SELECT * FROM barang WHERE id = $id_produk";
$result = $conn->query($sql);

// Cek apakah produk ditemukan
if ($result && $result->num_rows > 0) {
    $produk = $result->fetch_assoc();
} else {
    echo "<p>Produk tidak ditemukan!</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .product-detail {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: center;
        }

        .product-image img {
            width: 100%;
            max-width: 300px;
            height: auto;
            border-radius: 8px;
            background-color: #e0e0e0;
        }

        .product-info {
            flex: 1;
        }

        .product-info h1 {
            font-size: 24px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .product-info p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .product-info h2 {
            font-size: 20px;
            font-weight: bold;
            color: #000;
            margin-bottom: 20px;
        }

        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            background-color: #ccc;
            color: black;
            font-size: 14px;
            text-align: center;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #bbb;
        }

        footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #e0e0e0;
            padding: 10px;
            text-align: center;
            font-size: 12px;
        }

        @media (max-width: 600px) {
            .product-detail {
                flex-direction: column;
                align-items: flex-start;
            }

            .product-image img {
                width: 100%;
                max-width: none;
            }

            .product-info h1 {
                font-size: 20px;
            }

            .product-info p {
                font-size: 14px;
            }

            .product-info h2 {
                font-size: 18px;
            }

            .action-buttons {
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                padding: 10px;
                font-size: 14px;
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="product-detail">
            <div class="product-image">
                <img src="admin/uploads/<?php echo isset($produk['foto_barang']) ? $produk['foto_barang'] : 'default.jpg'; ?>"
                    alt="<?php echo isset($produk['nama_barang']) ? $produk['nama_barang'] : 'Gambar tidak tersedia'; ?>">
            </div>
            <div class="product-info">
                <h1><?php echo isset($produk['nama_barang']) ? $produk['nama_barang'] : 'Nama produk tidak tersedia'; ?>
                </h1>
                <p><?php echo isset($produk['deskripsi']) ? $produk['deskripsi'] : 'Deskripsi tidak tersedia'; ?></p>
                <p>Stok <?php echo isset($produk['jumlah_stok']) ? $produk['jumlah_stok'] : 'Stok tidak tersedia'; ?>
                </p>
                <h2>Rp.
                    <?php echo isset($produk['harga_barang']) ? number_format($produk['harga_barang'], 2, ',', '.') : '0,00'; ?>
                </h2>
                <div class="action-buttons">
                    <a href="index.php" class="btn">Kembali</a>
                    <a href="keranjang.php?action=add&id=<?php echo $produk['id']; ?>" class="btn">Tambah Keranjang</a>
                    <a href="beli.php?id=<?php echo $produk['id']; ?>" class="btn">Beli</a>
                </div>
            </div>
        </div>
    </div>
    <footer>
        Copyright @2024 By Bintang Jaya Sofa
    </footer>
</body>

</html>