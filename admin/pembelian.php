<?php
include '../config.php';

if (isset($_POST['action']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $status = $_POST['action'] === 'approve' ? 'Approved' : 'Rejected';

    if ($status === 'Approved') {
        // Ambil detail barang dan jumlah dari pembelian
        $query = "SELECT detail_pembelian.barang_id, detail_pembelian.jumlah 
                  FROM detail_pembelian 
                  WHERE detail_pembelian.pembelian_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Proses setiap barang yang dibeli
        while ($row = $result->fetch_assoc()) {
            $barang_id = $row['barang_id'];
            $jumlah = $row['jumlah'];

            // Periksa stok barang
            $stokQuery = "SELECT jumlah_stok FROM barang WHERE id = ?";
            $stokStmt = $conn->prepare($stokQuery);
            $stokStmt->bind_param("i", $barang_id);
            $stokStmt->execute();
            $stokResult = $stokStmt->get_result();
            $stokData = $stokResult->fetch_assoc();

            if ($stokData['jumlah_stok'] >= $jumlah) {
                // Kurangi stok barang
                $updateStokQuery = "UPDATE barang SET jumlah_stok = jumlah_stok - ? WHERE id = ?";
                $updateStokStmt = $conn->prepare($updateStokQuery);
                $updateStokStmt->bind_param("ii", $jumlah, $barang_id);
                $updateStokStmt->execute();
            } else {
                // Jika stok tidak cukup
                echo "Stok barang tidak mencukupi untuk barang ID: $barang_id";
                exit();
            }
        }
    }

    // Update status pembelian
    $stmt = $conn->prepare("UPDATE pembelian SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();

    // Redirect kembali ke halaman pembelian
    header("Location: pembelian.php");
    exit();
}

// Mengambil data pembelian
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
          ORDER BY pembelian.tanggal_pembelian DESC";
$result = $conn->query($query);
include 'sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pembelian</title>

    <!-- Tambahkan link ke Bootstrap CSS dan DataTables -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 10px;
        }

        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }

            .btn {
                width: 100%;
                margin-bottom: 5px;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Pembelian</h2>
        <div class="table-responsive">
            <table id="pembelianTable" class="table table-striped table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Alamat</th>
                        <th>Tanggal Pembelian</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $row['user_nama']; ?></td>
                            <td><?= $row['barang_nama']; ?></td>
                            <td><?= htmlspecialchars($row['jumlah']); ?></td>
                            <td>Rp<?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                            <td><?= $row['alamat']; ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($row['tanggal_pembelian'])); ?></td>
                            <td><?= $row['status']; ?></td>
                            <td>
                                <?php if ($row['status'] === 'Pending') { ?>
                                    <form method="POST" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                        <button type="submit" name="action" value="approve"
                                            class="btn btn-success btn-sm">Setuju</button>
                                    </form>
                                    <form method="POST" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                        <button type="submit" name="action" value="reject"
                                            class="btn btn-danger btn-sm">Tolak</button>
                                    </form>
                                <?php } else { ?>
                                    <?= $row['status']; ?>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script untuk inisialisasi DataTables -->
    <script>
        $(document).ready(function () {
            $('#pembelianTable').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50, 100],
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada data yang tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "paginate": {
                        "first": "Awal",
                        "last": "Akhir",
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        });
    </script>
</body>

</html>