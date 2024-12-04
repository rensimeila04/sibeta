<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../../../public/assets/css/header.css">
    <link rel="stylesheet" href="../../../public/assets/css/sidebar.css">
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet" />
    <link rel="stylesheet" href="../../../public/assets/css/dashboard.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIBETA</title>
</head>


<body>
    <div class="wrapper">
        <?php
        include '../components/sidebar_admin.html';
        ?>
        <div class="main">
            <?php
            include '../components/header_admin.html';
            ?>
            <div class="p-3 dashboard">
                <div class="breadcrumbs">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Dashboard</span>
                </div>
                <!-- Dashboard statistics -->
                <div class="statistics">
                <div class="stat-card">
                    <p>Dokumen Diajukan</p>
                    <h3 class="darkpurple">337</h3>
                </div>
                <div class="stat-card">
                    <p>Menunggu Verifikasi</p>
                    <h3 class="yellow">45</h3>
                </div>
                <div class="stat-card">
                    <p>Dokumen Terverifikasi</p>
                    <h3 class="green">256</h3>
                </div>
                <div class="stat-card">
                    <p>Dokumen Ditolak</p>
                    <h3 class="red">36</h3>
                </div>
            </div>

                <!-- Table Header -->
                <div class="table-header">
                    <h3>Daftar Pengajuan</h3>
                    <a href="#" class="lihat-semua">Lihat Semua</a>
                </div>

                <!-- Data Table -->
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Program Studi</th>
                            <th>Kelas</th>
                            <th>Tanggal Upload</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = [
                            ["1", "2341720201", "Ahmad Dzul Fadli Hannan", "D-IV Teknik Informatika", "2E", "12 November 2024"],
                            ["2", "2341720201", "Athallaric Nero M", "D-IV Teknik Informatika", "2E", "12 November 2024"],
                            ["3", "2341720201", "Esa Pratama Putri", "D-IV Teknik Informatika", "2E", "12 November 2024"],
                            ["4", "2341720201", "Evan Pariasya Adriel", "D-IV Teknik Informatika", "2E", "12 November 2024"],
                            ["5", "2341720201", "Farrel Muchammad Kafie", "D-IV Teknik Informatika", "2E", "12 November 2024"],
                            ["6", "2341720201", "Farhan Maweludin", "D-IV Teknik Informatika", "2E", "12 November 2024"],
                            ["7", "2341720201", "Rafa Fadhil Arras", "D-IV Teknik Informatika", "2E", "12 November 2024"],
                            ["8", "2341720201", "Resanditya Dafa Setiadi", "D-IV Teknik Informatika", "2E", "12 November 2024"],
                            ["9", "2341720201", "Rensi Melia Yulvinata", "D-IV Teknik Informatika", "2E", "12 November 2024"],
                            ["10", "2341720201", "Vemas Bagus Fernanda", "D-IV Teknik Informatika", "2E", "12 November 2024"],
                        ];

                        foreach ($data as $row) {
                            echo "<tr>";
                            foreach ($row as $cell) {
                                echo "<td>$cell</td>";
                            }
                            echo "<td><button class='detail-btn'>Detail</button></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- <script src="components/sidebar/script.js"></script> -->
</body>

</html>