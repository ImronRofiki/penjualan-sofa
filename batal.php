<?php
session_start();
include 'config.php';

// Cek apakah ada pembelian_id di URL
if (isset($_GET['pembelian_id'])) {
    $pembelian_id = $_GET['pembelian_id'];

    // Ambil data pembelian berdasarkan pembelian_id
    $query = "SELECT * FROM pembelian WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $pembelian_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $pembelian = $result->fetch_assoc();

        // Tampilkan form alasan pembatalan jika status belum dibatalkan
        if ($pembelian['status'] != 'Cancelled') {
            include 'navbar.php';
            ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Pembatalan Pesanan</title>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <style>
                    /* Styling umum untuk halaman batal */
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f9f9f9;
                        padding: 20px;
                    }

                    /* Styling container untuk form pembatalan */
                    form {
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 8px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                        width: 50%;
                        margin: 0 auto;
                    }

                    /* Label dan textarea untuk alasan pembatalan */
                    label {
                        font-size: 16px;
                        font-weight: bold;
                        margin-bottom: 10px;
                        display: block;
                    }

                    textarea {
                        width: 100%;
                        padding: 10px;
                        font-size: 14px;
                        border: 1px solid #ddd;
                        border-radius: 5px;
                        margin-bottom: 15px;
                        resize: vertical;
                    }

                    /* Wrapper untuk form */
                    form {
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        gap: 20px;
                        /* Memberikan jarak antar elemen dalam form */
                        margin-top: 80px;
                    }

                    /* Wrapper untuk tombol */
                    .button-wrapper {
                        display: flex;
                        gap: 10px;
                        /* Memberikan jarak horizontal antara tombol */
                        flex-wrap: wrap;
                        /* Membuat tombol turun ke baris baru jika layar terlalu sempit */
                        justify-content: center;
                        /* Membuat tombol berada di tengah */
                    }

                    /* Tombol batal */
                    .btn-batal {
                        background-color: #DC3545;
                        /* Merah untuk batal */
                        color: #fff;
                        border: none;
                        padding: 10px 20px;
                        border-radius: 5px;
                        cursor: pointer;
                        font-size: 16px;
                        transition: background-color 0.3s, transform 0.2s;
                    }

                    .btn-batal:hover {
                        background-color: #C82333;
                        /* Warna lebih gelap saat hover */
                        transform: scale(1.05);
                        /* Sedikit membesar saat hover */
                    }

                    .btn-batal:active {
                        background-color: rgb(161, 36, 48);
                        /* Warna lebih gelap saat aktif */
                        transform: scale(0.95);
                        /* Sedikit mengecil saat ditekan */
                    }

                    /* Tombol kembali */
                    .back-btn {
                        background-color: #007BFF;
                        /* Biru */
                        color: #fff;
                        border: none;
                        padding: 10px 20px;
                        border-radius: 5px;
                        cursor: pointer;
                        font-size: 16px;
                        transition: background-color 0.3s, transform 0.2s;
                    }

                    .back-btn:hover {
                        background-color: #0056b3;
                        /* Biru gelap saat hover */
                        transform: scale(1.05);
                        /* Sedikit membesar saat hover */
                    }

                    .back-btn:active {
                        background-color: #004494;
                        /* Biru lebih gelap saat aktif */
                        transform: scale(0.95);
                        /* Sedikit mengecil saat ditekan */
                    }


                    /* Styling untuk pesan pembatalan jika sudah dibatalkan */
                    p {
                        font-size: 18px;
                        text-align: center;
                        color: #007bff;
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
                </style>
            </head>

            <body>
                <form action="batal.php" method="POST">
                    <label for="alasan">Alasan Pembatalan:</label><br>
                    <textarea name="alasan" id="alasan" rows="4" cols="50" required></textarea><br><br>
                    <input type="hidden" name="pembelian_id" value="<?= $pembelian_id; ?>">

                    <!-- Wrapper untuk tombol -->
                    <div class="button-wrapper">
                        <button type="submit" class="btn-batal">Kirim</button>
                        <button type="button" class="back-btn" onclick="location.href='histori.php'">Kembali</button>
                    </div>
                </form>
            </body>

            </html>

            <?php
        } else {
            echo "Pembelian sudah dibatalkan.";
        }
    } else {
        echo "Pembelian tidak ditemukan.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pembelian_id = $_POST['pembelian_id'];
    $alasan = $_POST['alasan'];

    // Update status menjadi "Cancelled" dan simpan alasan pembatalan
    $update_query = "UPDATE pembelian SET status = 'Cancelled', alasan_pembatalan = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("si", $alasan, $pembelian_id);
    $stmt->execute();

    // SweetAlert2 tampilkan pesan
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                title: 'Pembatalan Berhasil',
                text: 'Pesanan Anda telah dibatalkan.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'histori.php';
                }
            });
        </script>
    </body>
    </html>";
    exit(); // Hentikan eksekusi lebih lanjut
} else {
    echo "ID pembelian tidak valid.";
}
?>