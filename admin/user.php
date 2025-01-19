<?php
// Include koneksi ke database dan sidebar
include '../config.php';

// Query untuk mengambil data user
$query = "SELECT username, email, role FROM users";
$result = $conn->query($query);

if (!$result) {
    die("Error: " . $conn->error);
}
include 'sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User</title>

    <!-- Menambahkan CSS dan JS DataTables dari CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 10px;
            margin-top: 10px
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .empty-message {
            text-align: center;
            font-size: 18px;
            color: #666;
            margin: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Daftar User</h1>
        <table class="datatable">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Cek jika ada data
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Proses sensor email
                        $email = htmlspecialchars($row['email']);
                        $email_parts = explode("@", $email);
                        $username_part = substr($email_parts[0], 0, 2) . str_repeat("*", max(0, strlen($email_parts[0]) - 2));
                        $domain_part = $email_parts[1];
                        $masked_email = $username_part . "@" . $domain_part;

                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                        echo "<td>" . $masked_email . "</td>";
                        echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='empty-message'>Belum ada user yang terdaftar.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Inisialisasi DataTable -->
    <script>
        $(document).ready(function () {
            $('.datatable').DataTable(); // Mengaktifkan DataTables
        });
    </script>
</body>

</html>

<?php
// Tutup koneksi database
$conn->close();
?>