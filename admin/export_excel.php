<?php
require '../vendor/autoload.php';
include '../config.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header kolom
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'User');
$sheet->setCellValue('C1', 'Penerima');
$sheet->setCellValue('D1', 'Nomor HP');
$sheet->setCellValue('E1', 'Alamat');
$sheet->setCellValue('F1', 'Barang');
$sheet->setCellValue('G1', 'Jumlah');
$sheet->setCellValue('H1', 'Total Harga');
$sheet->setCellValue('I1', 'Metode Pembayaran');
$sheet->setCellValue('J1', 'Status');
$sheet->setCellValue('K1', 'Alasan Pembatalan');
$sheet->setCellValue('L1', 'Tanggal');

// Ambil data dari database
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

$result = $conn->query($query);
$rowNumber = 2;
$no = 1;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue("A$rowNumber", $no++);
        $sheet->setCellValue("B$rowNumber", $row['user_nama']);
        $sheet->setCellValue("C$rowNumber", $row['penerima']);
        $sheet->setCellValue("D$rowNumber", $row['no_hp']);
        $sheet->setCellValue("E$rowNumber", $row['alamat']);
        $sheet->setCellValue("F$rowNumber", $row['barang_nama']);
        $sheet->setCellValue("G$rowNumber", $row['jumlah']);
        $sheet->setCellValue("H$rowNumber", $row['total_harga']);
        $sheet->setCellValue("I$rowNumber", $row['metode_pembayaran']);
        $sheet->setCellValue("J$rowNumber", $row['status']);
        $sheet->setCellValue("K$rowNumber", $row['alasan_pembatalan']);
        $sheet->setCellValue("L$rowNumber", $row['tanggal_pembelian']);
        $rowNumber++;
    }
}

// Unduh file Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Laporan_Histori_Pembelian.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit();
?>