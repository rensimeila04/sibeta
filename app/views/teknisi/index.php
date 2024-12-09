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
                <div class="breadcrumbs ps-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Dashboard</span>
                </div>
                <div class="container mt-4">
                    <!-- Statistic Cards -->
                    <div class="row text-center mb-4">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body-dash">
                                    <h6 class="text-secondary">Dokumen Diajukan</h6>
                                    <h1 class="text" style="color: #3E368C;">12</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body-dash">
                                    <h6 class="text-secondary">Menunggu Verifikasi</h6>
                                    <h1 class="text-warning">5</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body-dash">
                                    <h6 class="text-secondary">Dokumen Terverifikasi</h6>
                                    <h1 class="text-success">4</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body-dash">
                                    <h6 class="text-secondary">Dokumen Ditolak</h6>
                                    <h1 class="text-danger">3</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container px-4 mt-4">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between mb-3">
                                <div class="fw-semibold fs-3">Daftar Pengajuan</div>
                                <button class="btn btn-detail btn-sm">Lihat Semua</button>
                            </div>
                            <div class="py-3">
                                <table class="table table-striped table-borderless table-hover">
                                    <?php
                                    $mahasiswa = [
                                        [
                                            'nim' => '123456789',
                                            'nama' => 'John Doe',
                                            'program_studi' => 'D-IV Teknik Informatika',
                                            'kelas' => '4E',
                                            'tanggal_upload' => '22 November 2024'
                                        ],
                                        [
                                            'nim' => '987654321',
                                            'nama' => 'Jane Smith',
                                            'program_studi' => 'D-IV Teknik Informatika',
                                            'kelas' => '4E',
                                            'tanggal_upload' => '25 November 2024'
                                        ],
                                        [
                                            'nim' => '234567890',
                                            'nama' => 'Michael Johnson',
                                            'program_studi' => 'D-IV Sistem Informasi',
                                            'kelas' => '4E',
                                            'tanggal_upload' => '28 November 2024'
                                        ],
                                        [
                                            'nim' => '345678901',
                                            'nama' => 'Emily Brown',
                                            'program_studi' => 'D-IV Teknik Informatika',
                                            'kelas' => '4F',
                                            'tanggal_upload' => '01 Desember 2024'
                                        ],
                                        [
                                            'nim' => '456789012',
                                            'nama' => 'David Lee',
                                            'program_studi'  => 'D-IV Sistem Informasi',
                                            'kelas' => '4F',
                                            'tanggal_upload' => '05 Desember 2024'
                                        ],
                                        [
                                            'nim' => '567890123',
                                            'nama' => 'Olivia Taylor',
                                            'program_studi' => 'D-IV Teknik Informatika',
                                            'kelas' => '4E',
                                            'tanggal_upload' => '10 Desember 2024'
                                        ]
                                    ];
                                    ?>
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
                                        <?php $no = 1; ?>
                                        <?php foreach ($mahasiswa as $index => $mhs): ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $mhs['nim']; ?></td>
                                                <td><?php echo $mhs['nama']; ?></td>
                                                <td><?php echo $mhs['program_studi']; ?></td>
                                                <td><?php echo $mhs['kelas']; ?></td>
                                                <td><?php echo $mhs['tanggal_upload']; ?></td>
                                                <td><a href="detail_mahasiswa.php?index=<?= $index ?>"
                                                        class="btn btn-detail btn-sm">Detail</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

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

        </div>
    </div>
    </div>
</body>

</html>