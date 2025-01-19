<?php
include '../config.php';

$id = $_GET['id'];
$query = "SELECT * FROM barang WHERE id = $id";
$result = $conn->query($query);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_barang = $_POST['nama_barang'];
    $deskripsi = $_POST['deskripsi'];
    $jumlah_stok = $_POST['jumlah_stok'];
    $harga_barang = $_POST['harga_barang'];

    if (!empty($_FILES['foto_barang']['name'])) {
        $foto_barang = $_FILES['foto_barang']['name'];
        $tmp_name = $_FILES['foto_barang']['tmp_name'];
        move_uploaded_file($tmp_name, "uploads/" . $foto_barang);
    } else {
        $foto_barang = $row['foto_barang'];
    }

    $query = "UPDATE barang SET 
              nama_barang = '$nama_barang', 
              deskripsi = '$deskripsi', 
              jumlah_stok = $jumlah_stok, 
              harga_barang = $harga_barang, 
              foto_barang = '$foto_barang'
              WHERE id = $id";

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
    <title>Edit Barang</title>
    <style>
        /* Reset styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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

        /* Label Styling */
        label {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
            display: block;
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
    </style>
</head>

<body>
    <h1>Edit Barang</h1>
    <form method="post" enctype="multipart/form-data">
        <label>Nama Barang:</label>
        <input type="text" name="nama_barang" value="<?= $row['nama_barang']; ?>" required><br>
        <label>Deskripsi:</label>
        <textarea name="deskripsi" required><?= $row['deskripsi']; ?></textarea><br>
        <label>Jumlah Stok:</label>
        <input type="number" name="jumlah_stok" value="<?= $row['jumlah_stok']; ?>" required><br>
        <label>Harga Barang:</label>
        <input type="number" name="harga_barang" value="<?= $row['harga_barang']; ?>" required><br>
        <label>Foto Barang:</label>
        <input type="file" name="foto_barang"><br>
        <button type="submit">Simpan</button>
        <button type="button" class="back-btn" onclick="location.href='barang.php'">Kembali</button>
    </form>
</body>

</html>