<?php
session_start();
include 'config.php'; // File koneksi ke database

// Fungsi untuk memodifikasi keranjang
function updateKeranjang($id_barang, $action)
{
    if ($action === 'increase') {
        $_SESSION['keranjang'][$id_barang]['jumlah'] += 1;
    } elseif ($action === 'decrease' && $_SESSION['keranjang'][$id_barang]['jumlah'] > 1) {
        $_SESSION['keranjang'][$id_barang]['jumlah'] -= 1;
    } elseif ($action === 'delete') {
        unset($_SESSION['keranjang'][$id_barang]);
    }
}

// Tambahkan produk ke keranjang
if (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['id'])) {
    $id_barang = $_GET['id'];

    // Query untuk mengambil data barang
    $query = $conn->prepare("SELECT * FROM barang WHERE id = ?");
    $query->bind_param("i", $id_barang); // Ganti menjadi id jika kolomnya bernama 'id'
    $query->execute();
    $result = $query->get_result();
    $produk_db = $result->fetch_assoc();

    if ($produk_db) {
        $produk = [
            'nama' => $produk_db['nama_barang'],
            'harga' => $produk_db['harga_barang'],
            'jumlah' => 1,
            'gambar' => 'admin/uploads/' . $produk_db['foto_barang']
        ];

        // Inisialisasi keranjang jika belum ada
        if (!isset($_SESSION['keranjang'])) {
            $_SESSION['keranjang'] = [];
        }

        // Tambahkan produk ke keranjang atau tingkatkan jumlahnya
        if (isset($_SESSION['keranjang'][$id_barang])) {
            $_SESSION['keranjang'][$id_barang]['jumlah'] += 1;
        } else {
            $_SESSION['keranjang'][$id_barang] = $produk;
        }
    }

    // Redirect kembali ke halaman keranjang
    header("Location: keranjang.php");
    exit();
}

// Hapus produk dari keranjang
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    updateKeranjang($_GET['id'], 'delete');
    header("Location: keranjang.php");
    exit();
}

// Kurangi atau tambahkan jumlah produk
if (isset($_GET['action']) && isset($_GET['id'])) {
    updateKeranjang($_GET['id'], $_GET['action']);
    header("Location: keranjang.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Anda</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        main {
            padding: 20px;
            text-align: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .cart-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;
            margin-bottom: 20px;
            width: 100%;
        }

        .cart-item {
            display: flex;
            align-items: center;
            background-color: #d3d3d3;
            padding: 10px;
            width: 100%;
            border: 1px solid #333;
            flex-wrap: wrap;
            /* Tambahan untuk responsive */
            gap: 10px;
            /* Spacing antara items ketika wrap */
        }

        .product-selected,
        .product-image,
        .product-name,
        .product-price,
        .product-quantity,
        .delete-btn {
            padding: 0 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image img {
            width: 50px;
            height: auto;
            max-width: 100%;
            /* Responsive image */
        }

        .product-name {
            flex: 2;
            font-weight: bold;
            text-align: left;
            min-width: 150px;
            /* Minimum width untuk nama produk */
        }

        .product-price {
            flex: 1;
            min-width: 120px;
            /* Minimum width untuk harga */
        }

        .product-quantity {
            display: flex;
            align-items: center;
            gap: 5px;
            min-width: 100px;
            /* Minimum width untuk quantity control */
        }

        .quantity-btn {
            background-color: #000;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .quantity {
            padding: 0 10px;
            background-color: red;
            color: #fff;
        }

        .delete-btn {
            background-color: black;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            margin: 5px;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 20px;
            padding: 0 10px;
        }

        .back-btn,
        .buy-btn {
            padding: 10px 20px;
            background-color: black;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
            min-width: 120px;
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

        /* Media Queries untuk Responsive Design */
        @media screen and (max-width: 768px) {
            .cart-item {
                flex-direction: column;
                text-align: center;
                padding: 15px;
            }

            .product-name,
            .product-price {
                width: 100%;
                justify-content: center;
                text-align: center;
            }

            .product-quantity {
                margin: 10px 0;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .back-btn,
            .buy-btn {
                width: 100%;
                max-width: 200px;
            }

            main {
                padding: 10px;
                margin-bottom: 60px;
                /* Ruang untuk footer */
            }
        }

        @media screen and (max-width: 480px) {
            h1 {
                font-size: 20px;
            }

            .cart-item {
                width: 95%;
            }

            .product-image img {
                width: 40px;
            }

            footer {
                padding: 5px;
                font-size: 10px;
            }
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <main>
        <h1>KERANJANG ANDA</h1>
        <div class="cart-container">
            <?php if (!empty($_SESSION['keranjang'])): ?>
                <?php foreach ($_SESSION['keranjang'] as $id_barang => $produk): ?>
                    <div class="cart-item">
                        <div class="product-image">
                            <img src="<?= $produk['gambar']; ?>" alt="Product">
                        </div>
                        <div class="product-name"><?= $produk['nama']; ?></div>
                        <div class="product-price">Rp.<?= number_format($produk['harga'], 2, ',', '.'); ?></div>
                        <div class="product-quantity">
                            <a href="keranjang.php?action=decrease&id=<?= $id_barang; ?>" class="quantity-btn">-</a>
                            <span class="quantity"><?= $produk['jumlah']; ?></span>
                            <a href="keranjang.php?action=increase&id=<?= $id_barang; ?>" class="quantity-btn">+</a>
                        </div>
                        <a href="keranjang.php?action=delete&id=<?= $id_barang; ?>" class="delete-btn">Hapus</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Keranjang Anda kosong.</p>
            <?php endif; ?>
        </div>
        <div class="action-buttons">
            <button class="back-btn" onclick="location.href='home.php'">Kembali</button>
            <?php if (!empty($_SESSION['keranjang'])): ?>
                <form action="beli_keranjang.php" method="post" style="display:inline;">
                    <button type="submit" class="buy-btn">Beli</button>
                </form>
            <?php endif; ?>
        </div>
    </main>
    <footer>
        <p>Copyright @2024 By Bintang Jaya Sofa</p>
    </footer>
</body>

</html>