<?php
include 'data.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa - KSI 2025</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">KSI 2025</a>
        </div>
    </nav>

    <!-- Content -->
    <div class="container my-5">
        <h2 class="text-center mb-4 text-primary fw-bold">Data Mahasiswa</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center shadow">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Program Studi</th>
                        <th>Angkatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($mahasiswa as $mhs) {
                        echo "<tr>
                                <td>{$no}</td>
                                <td>{$mhs['nama']}</td>
                                <td>{$mhs['nim']}</td>
                                <td>{$mhs['prodi']}</td>
                                <td>{$mhs['angkatan']}</td>
                              </tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">© 2025 KSI Project | PHP Native + Bootstrap</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
