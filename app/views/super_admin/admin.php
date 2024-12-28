<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIBETA</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/assets/css/dashboard.css">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_super_admin.php"; ?>

        <div class="main">
            <!-- Header -->
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_admin.php"; ?>

            <div class="p-4 dashboard">
                <div class="breadcrumbs mb-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Pengguna</span>
                    <span class="separator">/</span>
                    <span>Admin</span>
                </div>
                <div class="mb-3">
                    <h2>Admin</h2>
                </div>


            </div>

            

            <div class="container">
                <div class="card">
                    <!-- Search and Add Mahasiswa Buttons -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="input-group w-25" style="border-radius: 8px;">
                            <span class="input-group-text" id="basic-addon1" style="background-color: #FFFFFF;">
                                <i class="bi bi-search" style="color: #ADB5BD; font-size: 16px;"></i>
                            </span>
                            <input type="text" id="searchInput" class="form-control" placeholder="Cari ..." aria-label="Search" aria-describedby="basic-addon1" style="border-left: none;">
                            <button class="btn" id="searchButton" style="margin-left: 10px; color:#fff; background-color: #3E368C; border-radius: 4px; height: auto;">Cari</button>
                        </div>
                        <a href="#" class="btn btn-primary" style="background-color: #3E368C; color: #fff; border-radius: 4px; height: auto; line-height: 1.5; margin: 20px;">Tambah Admin</a>
                    </div>

                    <!-- Mahasiswa Table -->
                    <div class="table-container w-100">
                        <table class="table table-striped table-borderless" id="documentsTable">
                            <?php
                            $mahasiswa = [
                                ['nim' => '123456789', 'nama' => 'John Doe', 'program_studi' => 'D-IV Teknik Informatika', 'kelas' => '4E', 'tanggal_upload' => '22 November 2024'],
                                ['nim' => '987654321', 'nama' => 'Jane Smith', 'program_studi' => 'D-IV Teknik Informatika', 'kelas' => '4E', 'tanggal_upload' => '25 November 2024'],
                                ['nim' => '234567890', 'nama' => 'Michael Johnson', 'program_studi' => 'D-IV Sistem Informasi', 'kelas' => '4E', 'tanggal_upload' => '28 November 2024'],
                                ['nim' => '345678901', 'nama' => 'Emily Brown', 'program_studi' => 'D-IV Teknik Informatika', 'kelas' => '4F', 'tanggal_upload' => '01 Desember 2024'],
                                ['nim' => '456789012', 'nama' => 'David Lee', 'program_studi' => 'D-IV Sistem Informasi', 'kelas' => '4F', 'tanggal_upload' => '05 Desember 2024'],
                                ['nim' => '567890123', 'nama' => 'Olivia Taylor', 'program_studi' => 'D-IV Teknik Informatika', 'kelas' => '4E', 'tanggal_upload' => '10 Desember 2024']
                            ];
                            ?>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($mahasiswa as $mhs): ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $mhs['nim']; ?></td>
                                        <td><?php echo $mhs['nama']; ?></td>
                                        <td>
                                            <a href="/sibeta/public/index.php?page=super_admin/detail_admin" class="material-symbols-outlined align-items-center btn-custom" style="text-decoration: none;" target="_blank">visibility</a>
                                            <a href="#" class="material-symbols-outlined align-items-center btn-custom3" style="text-decoration: none;">delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="pagination mt-5">
                            <span>Total 10 items</span>
                            <div class="pagination-nav">
                                <a href="#" class="arrow">&laquo;</a>
                                <a href="#" class="active">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#">4</a>
                                <a href="#">5</a>
                                <a href="#">6</a>
                                <span>...</span>
                                <a href="#">20</a>
                                <a href="#" class="arrow">&raquo;</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
