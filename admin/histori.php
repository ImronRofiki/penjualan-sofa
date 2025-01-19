<?php
session_start();
include '../config.php';

if (isset($_SESSION['alert'])) {
    echo $_SESSION['alert'];
    unset($_SESSION['alert']);
}

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
            pembelian.alasan_pembatalan,
            pembelian.tanggal_pembelian
          FROM pembelian
          JOIN users ON pembelian.user_id = users.id
          JOIN detail_pembelian ON pembelian.id = detail_pembelian.pembelian_id
          JOIN barang ON detail_pembelian.barang_id = barang.id
          ORDER BY pembelian.tanggal_pembelian DESC";

$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

include 'sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Pembelian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Link CSS untuk DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <style>
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .table-container {
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            h2 {
                font-size: 1.5rem;
            }
        }
    </style>

    <!-- Link JS untuk jQuery dan DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center my-4">
            <h2></h2>
            <a href="export_excel.php" class="btn btn-success">
                <i class="bi bi-download"></i> Unduh Laporan
            </a>
        </div>

        <h2>Histori Pembelian User</h2>
        <div class="table-container">
            <div class="table-responsive">
                <table id="historyTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Penerima</th>
                            <th>Nomor HP</th>
                            <th>Alamat</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Metode Pembayaran</th>
                            <th>Status</th>
                            <th>Alasan Pembatalan</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php $no = 1; ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($row['user_nama'] ?? ''); ?></td>
                                    <td><?= htmlspecialchars($row['penerima'] ?? ''); ?></td>
                                    <td><?= htmlspecialchars($row['no_hp'] ?? ''); ?></td>
                                    <td><?= htmlspecialchars($row['alamat'] ?? ''); ?></td>
                                    <td><?= htmlspecialchars($row['barang_nama'] ?? ''); ?></td>
                                    <td><?= htmlspecialchars($row['jumlah'] ?? ''); ?></td>
                                    <td>Rp<?= number_format($row['total_harga'] ?? 0, 0, ',', '.'); ?></td>
                                    <td><?= htmlspecialchars($row['metode_pembayaran'] ?? ''); ?></td>
                                    <td><?= htmlspecialchars($row['status'] ?? ''); ?></td>
                                    <td><?= htmlspecialchars($row['alasan_pembatalan'] ?? ''); ?></td>
                                    <td><?= htmlspecialchars($row['tanggal_pembelian'] ?? ''); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="12" class="text-center">Belum ada pembelian.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Inisialisasi DataTables -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#historyTable').DataTable();
        });
    </script>
</body>

</html>