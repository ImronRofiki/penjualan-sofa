<?php
session_start();
include 'config.php'; // Koneksi ke database


// Proses pembelian jika ada permintaan
if (isset($_POST['beli'])) {
    // Ambil data dari form
    $user_id = $_SESSION['id'];
    $penerima = $_POST['penerima'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $barang_id = $_GET['id'];
    $jumlah = $_POST['jumlah'];
    $metode_pembayaran = $_POST['metode_pembayaran'];

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Query untuk mengambil data barang dari database
        $query = $conn->prepare("SELECT harga_barang, jumlah_stok FROM barang WHERE id = ?");
        $query->bind_param("i", $barang_id);
        $query->execute();
        $result = $query->get_result();
        $barang = $result->fetch_assoc();

        // Periksa apakah stok mencukupi
        if ($barang['jumlah_stok'] < $jumlah) {
            throw new Exception("Stok barang tidak mencukupi");
        }

        $harga = $barang['harga_barang'];
        $subtotal_harga = $harga * $jumlah;
        $status = "Pending";
        $tanggal_pembelian = date("Y-m-d H:i:s");

        // Masukkan data ke tabel pembelian
        $insert_pembelian = $conn->prepare("INSERT INTO pembelian (user_id, penerima, no_hp, alamat, total_harga, metode_pembayaran, status, tanggal_pembelian) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_pembelian->bind_param("isssdsss", $user_id, $penerima, $no_hp, $alamat, $subtotal_harga, $metode_pembayaran, $status, $tanggal_pembelian);
        $insert_pembelian->execute();
        $pembelian_id = $conn->insert_id;

        // Masukkan data ke tabel detail_pembelian
        $insert_detail = $conn->prepare("INSERT INTO detail_pembelian (pembelian_id, barang_id, jumlah, subtotal_harga) VALUES (?, ?, ?, ?)");
        $insert_detail->bind_param("iiid", $pembelian_id, $barang_id, $jumlah, $subtotal_harga);
        $insert_detail->execute();

        // Commit transaksi
        $conn->commit();

        // Notifikasi sukses
        $_SESSION['alert'] = "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        $_SESSION['alert'] .= "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Pembelian berhasil dilakukan!',
                    showConfirmButton: true,
                    timer: 3000
                });
            });
        </script>";

    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        $conn->rollback();

        // Notifikasi error
        $_SESSION['alert'] = "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        $_SESSION['alert'] .= "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Pembelian gagal: " . $e->getMessage() . "',
                    showConfirmButton: true
                });
            });
        </script>";
    }

    // Redirect ke halaman histori
    header("Location: histori.php");
    exit();
}
include 'navbar.php'; // Navbar
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Halaman Pembelian</title>
    <style>
        /* Gaya CSS untuk tampilan halaman pembelian */
        h2 {
            text-align: center;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: auto;
        }

        .back-btn {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h2>Halaman Pembelian</h2>

    <form method="post" action="">
        <label for="penerima">Penerima:</label>
        <input type="text" id="penerima" name="penerima" required placeholder="masukan nama lengkap penerima">

        <label for="no_hp">No. HP:</label>
        <input type="text" id="no_hp" name="no_hp" required placeholder="+62" maxlength="15">

        <label for="lokasi">Lokasi:</label>
        <select id="lokasi" name="lokasi" required>
            <option value="">Pilih Lokasi</option>
            <option value="madura">Madura</option>
            <option value="luar_madura" disabled>Luar Madura</option>
        </select>

        <label for="jumlah">Jumlah Pesan:</label>
        <input type="number" id="jumlah" name="jumlah" required>

        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" required placeholder="masukan alamat tujuan">

        <label for="metode_pembayaran">Metode Pembayaran:</label>
        <select id="metode_pembayaran" name="metode_pembayaran" required>
            <option value="">Pilih Metode Pembayaran</option>
            <option value="cod">COD</option>
            <option value="e-banking" disabled>E-Banking (Belum Tersedia)</option>
            <option value="e-wallet" disabled>E-Wallet (Belum Tersedia)</option>
        </select>

        <button type="submit" name="beli">Beli</button>
        <button type="button" class="back-btn" onclick="location.href='home.php'">Kembali</button>
    </form>

    <script>
        const input = document.getElementById('no_hp');

        input.addEventListener('input', function (event) {
            let value = input.value;

            // Pastikan input diawali dengan +62
            if (!value.startsWith('+62')) {
                value = '+62' + value.replace(/^\+62|^0+/, '');
            }

            // Hanya izinkan angka setelah +62
            value = value.replace(/[^+0-9]/g, '');

            // Hapus angka nol di awal setelah +62
            value = value.replace(/^(\+62)0+/, '$1');

            // Set kembali nilai input
            input.value = value;
        });
    </script>

</body>

</html>