<?php
session_start();
include 'config.php';


if (isset($_SESSION['alert'])) {
    echo $_SESSION['alert'];
    unset($_SESSION['alert']);
}

$user_id = $_SESSION['id']; // ID user yang login
$query = "SELECT 
            pembelian.id,
            users.username AS user_nama,
            pembelian.penerima,
            pembelian.no_hp,
            pembelian.alamat,
            barang.nama_barang AS barang_nama,
            detail_pembelian.jumlah,
            pembelian.total_harga,
            pembelian.metode_pembayaran,
            pembelian.status,
            pembelian.tanggal_pembelian
          FROM pembelian
          JOIN users ON pembelian.user_id = users.id
          JOIN detail_pembelian ON pembelian.id = detail_pembelian.pembelian_id
          JOIN barang ON detail_pembelian.barang_id = barang.id
          WHERE pembelian.user_id = ?
          ORDER BY pembelian.tanggal_pembelian DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Pembelian</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
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
    <?php include "navbar.php"; ?>
    <div class="container mt-5">
        <h2 class="mb-4">Histori Pembelian</h2>
        <!-- Tambahkan kelas table-responsive untuk membuat tabel lebih responsif -->
        <div class="table-responsive">
            <table id="historyTable2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Penerima</th>
                        <th>Nomor HP</th>
                        <th>Alamat</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Metode Pembayaran</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php $no = 1; ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($row['penerima']); ?></td>
                                <td><?= htmlspecialchars($row['no_hp']); ?></td>
                                <td><?= htmlspecialchars($row['alamat']); ?></td>
                                <td><?= htmlspecialchars($row['barang_nama']); ?></td>
                                <td><?= htmlspecialchars($row['jumlah']); ?></td>
                                <td>Rp<?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                                <td><?= htmlspecialchars($row['metode_pembayaran']); ?></td>
                                <td><?= htmlspecialchars($row['status']); ?></td>
                                <td><?= htmlspecialchars($row['tanggal_pembelian']); ?></td>
                                <td>
                                    <?php if ($row['status'] != 'Approved' && $row['status'] != 'Cancelled'): ?>
                                        <form action="batal.php" method="GET">
                                            <input type="hidden" name="pembelian_id" value="<?= $row['id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Batal</button>
                                        </form>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-secondary btn-sm" disabled>Batal</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="11" class="text-center">Belum ada pembelian.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <footer>
            Copyright @2024 By Bintang Jaya Sofa
        </footer>
    </div>

    <!-- Tambahkan library jQuery dan DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#historyTable2').DataTable();
        });
    </script>
</body>

</html>