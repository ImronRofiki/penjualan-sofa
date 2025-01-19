<?php
include '../config.php';

$id = $_GET['id'];
$query = "DELETE FROM barang WHERE id = $id";

if ($conn->query($query)) {
    header("Location: barang.php");
} else {
    echo "Error: " . $conn->error;
}
?>