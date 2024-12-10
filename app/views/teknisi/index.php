<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
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
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_teknisi.php"; ?>
        <div class="main">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_admin.php"; ?>
            <div class="p-3 dashboard">
                <div class="breadcrumbs ps-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Dashboard</span>
                </div>
                <div class="container mt-4 px-4">
                    <!-- Statistic Cards -->
                    <div class="row-custom">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body-dash">
                                    <h6 class="text-secondary">Dokumen Diajukan</h6>
                                    <h1 class="text" style="color: #3E368C;"><?= $documentCounts['diajukan']; ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body-dash">
                                    <h6 class="text-secondary">Menunggu Verifikasi</h6>
                                    <h1 class="text-warning"><?= $documentCounts['diajukan']; ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body-dash">
                                    <h6 class="text-secondary">Dokumen Terverifikasi</h6>
                                    <h1 class="text-success"><?= $documentCounts['terverifikasi']; ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body-dash">
                                    <h6 class="text-secondary">Dokumen Ditolak</h6>
                                    <h1 class="text-danger"><?= $documentCounts['ditolak']; ?></h1
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
                                    <?php $no = 1; 
                                        foreach ($documents as $data){
                                            $TanggalUpload = date('d-m-Y', strtotime($data['TanggalUpload']));
                                            echo "<tr>
                                                    <th scope='row'>$no</th>
                                                    <td>$data[Nim]</td>
                                                    <td>$data[NamaMahasiswa]</td>
                                                    <td>$data[ProgramStudi]</td>
                                                    <td>$data[Kelas]</td>
                                                    <td>$TanggalUpload</td>
                                                    <td><a href='/sibeta/public/index.php?page=kelola&nim=" . $data['Nim'] . "' class='btn btn-detail btn-sm'>Detail</a></td>
                                                </tr>" ;
                                            $no++;
                                        }
                                        ?>
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