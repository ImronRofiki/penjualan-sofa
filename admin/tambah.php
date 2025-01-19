<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_barang = $_POST['nama_barang'];
    $kategori_id = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $jumlah_stok = $_POST['jumlah_stok'];
    $harga_barang = $_POST['harga_barang'];

    $foto_barang = $_FILES['foto_barang']['name'];
    $tmp_name = $_FILES['foto_barang']['tmp_name'];
    move_uploaded_file($tmp_name, "uploads/" . $foto_barang);

    $query = "INSERT INTO barang (nama_barang, kategori_id, deskripsi, jumlah_stok, harga_barang, foto_barang) 
              VALUES ('$nama_barang','$kategori_id', '$deskripsi', $jumlah_stok, $harga_barang, '$foto_barang')";

    if ($conn->query($query)) {
        header("Location: barang.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <style>
        /* Reset styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            color: #333;
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        /* Form Container */
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            margin-top: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 28px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            display: block;
            /* Agar label berada di atas elemen select */
            margin-bottom: 8px;
        }

        select {
            width: 100%;
            /* Menyesuaikan dengan lebar container */
            padding: 10px;
            /* Memberikan ruang di dalam elemen */
            border: 1px solid #ccc;
            /* Warna border */
            border-radius: 5px;
            /* Membuat sudut melengkung */
            font-size: 16px;
            /* Ukuran font */
            background-color: #f9f9f9;
            /* Warna background */
            transition: border-color 0.3s ease;
            /* Animasi saat fokus */
        }

        select:focus {
            border-color: #4CAF50;
            /* Warna border saat fokus */
            outline: none;
            /* Menghilangkan outline bawaan browser */
            background-color: #fff;
            /* Background berubah saat fokus */
        }

        option {
            font-size: 16px;
            /* Ukuran font untuk pilihan */
            padding: 5px;
            /* Memberikan ruang di dalam setiap opsi */
        }

        /* Tambahan untuk spacing */
        select+br {
            margin-bottom: 16px;
            /* Jarak bawah setelah elemen select */
        }


        /* Input and Textarea Styling */
        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
            background-color: #fafafa;
        }

        /* Textarea Styling */
        textarea {
            resize: vertical;
            height: 120px;
        }

        /* Button Styling */
        button[type="submit"] {
            padding: 12px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            width: 100%;
            margin-bottom: 10px;
            transition: background-color 0.3s ease;
        }

        /* Button Hover Effect */
        button[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Button Styling */
        button[type="button"] {
            padding: 12px 20px;
            background-color: rgb(27, 61, 209);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        /* Button Hover Effect */
        button[type="button"]:hover {
            background-color: rgb(36, 58, 155);
        }

        /* Input Focus Styling */
        input:focus,
        textarea:focus {
            border-color: #4CAF50;
            outline: none;
        }

        /* Error Message Styling */
        .error {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-top: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            form {
                padding: 15px;
            }

            h1 {
                font-size: 24px;
            }

            button[type="submit"] {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <h1>Tambah Barang</h1>
    <form method="post" enctype="multipart/form-data">
        <label>Nama Barang:</label>
        <input type="text" name="nama_barang" required><br>
        <label for="kategori">Kategori Barang:</label>
        <select id="kategori" name="kategori" required>
            <option value="">Pilih Kategori</option>
            <?php
            // Ambil data kategori dari database
            $query = "SELECT id, nama_kategori FROM kategori"; // Asumsikan tabel kategori memiliki kolom id dan nama_kategori
            $result = mysqli_query($conn, $query);

            // Periksa apakah data kategori tersedia
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['id']}'>{$row['nama_kategori']}</option>";
                }
            } else {
                echo "<option value='' disabled>Kategori tidak tersedia</option>";
            }
            ?>
        </select><br>
        <label>Deskripsi:</label>
        <textarea name="deskripsi" required></textarea><br>
        <label>Jumlah Stok:</label>
        <input type="number" name="jumlah_stok" required><br>
        <label>Harga Barang:</label>
        <input type="number" name="harga_barang" required><br>
        <label>Foto Barang:</label>
        <input type="file" name="foto_barang" required><br>
        <button type="submit">Simpan</button>
        <button type="button" class="back-btn" onclick="location.href='barang.php'">Kembali</button>
    </form>
</body>

</html>