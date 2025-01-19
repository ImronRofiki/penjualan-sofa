<?php
include '../config.php';

$query = "
SELECT 
    barang.id,
    barang.nama_barang,
    kategori.nama_kategori,
    barang.deskripsi,
    barang.jumlah_stok,
    barang.harga_barang,
    barang.foto_barang
FROM barang
JOIN kategori ON barang.kategori_id = kategori.id
";
$result = $conn->query($query);

include 'sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <!-- Tambahkan link ke DataTables CSS dan JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        table {
            margin: 20px auto;
            width: 90%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 10px;
        }

        th {
            background-color: #4caf50;
            color: white;
            font-size: 16px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9e9e9;
        }

        img {
            max-width: 100px;
            border-radius: 5px;
        }

        td a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        td a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .blue-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin: 20px 0;
            text-align: center;
        }

        .blue-button:hover {
            background-color: #0056b3;
        }

        /* Responsif */
        @media (max-width: 768px) {
            table {
                width: 100%;
            }

            th,
            td {
                font-size: 12px;
                padding: 8px;
            }

            .blue-button {
                font-size: 14px;
                padding: 8px 15px;
            }
        }

        @media (max-width: 576px) {
            .blue-button {
                font-size: 12px;
                padding: 5px 10px;
            }

            table {
                overflow-x: auto;
                display: block;
                white-space: nowrap;
            }
        }
    </style>
</head>

<body>
    <div style="text-align: center; margin-bottom: 20px;">
        <h1>Daftar Barang</h1>
    </div>
    <div style="text-align: center; margin: 20px;">
        <a href="tambah.php" class="blue-button">Tambah Barang</a>
    </div>
    <div style="overflow-x: auto;">
        <table id="barangTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kategori Barang</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Stok</th>
                    <th>Harga Barang</th>
                    <th>Foto Barang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama_barang']; ?></td>
                        <td><?= $row['nama_kategori']; ?></td>
                        <td><?= $row['deskripsi']; ?></td>
                        <td><?= $row['jumlah_stok']; ?></td>
                        <td>Rp. <?= number_format($row['harga_barang'], 0, ',', '.'); ?></td>
                        <td><img src="uploads/<?= $row['foto_barang']; ?>" alt="Foto"></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id']; ?>">Edit</a> |
                            <a href="hapus.php?id=<?= $row['id']; ?>"
                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function () {
            $('#barangTable').DataTable({
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