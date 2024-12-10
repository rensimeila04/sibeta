<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLlSwoa9G6QBuxRSFc9qHHzpOQy8OP6cULrhlQ/3p+utUg4IYbm9URuTb4yVZ9dOELGGPr1Q==" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>

<body>
    <div class="wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_teknisi.php"; ?>
        <div class="main">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_admin.php"; ?>
            <div class="p-4 dashboard">
                <div class="breadcrumbs mb-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Kelola Dokumen</span>
                </div>

                <div class="container">
                    <div class="d-flex flex-column mb-3">
                        <h2>Detail Mahasiswa</h2>
                        <br><br>
                        <div class="d-flex align-items-center mb-3">
                            <p class="fw-bold me-3">Nama:</p>
                            <p><?= $documentsMahasiswa[0]['NamaMahasiswa'] ?></p>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <p class="fw-bold me-3">NIM:</p>
                            <p><?= $documentsMahasiswa[0]['Nim'] ?></p>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <p class="fw-bold me-3">Program Studi:</p>
                            <p><?= $documentsMahasiswa[0]['ProgramStudi'] ?></p>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <p class="fw-bold me-3">Kelas:</p>
                            <p><?= $documentsMahasiswa[0]['Kelas'] ?></p>
                        </div>

                    </div>


                    <div class="table-container w-100">
                        <table class="table table-striped table-borderless">
                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Dokumen</th>
                                        <th scope="col">Tanggal Upload</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                        <th scope="col">Verifikasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($documentsMahasiswa as $data) {
                                        $TanggalUpload = date('d-m-Y', strtotime($data['TanggalUpload']));
                                        echo "<tr>
                                                    <th scope='row'>$no</th>
                                                    <td>$data[NamaDokumen]</td>
                                                    <td>$data[TanggalUpload]</td>
                                                    <td><p class='" . ($data['Status'] === 'Diverifikasi' ? 'status-diverifikasi' : ($data['Status'] === 'Diajukan' ? 'status-diajukan' : ($data['Status'] === 'Ditolak' ? 'status-ditolak' : 'status-unknown'))) .
                                                        "' fw-semibold px-4>" . htmlspecialchars($data['Status']) . "</p>
                                                    </td>
                                                    <td>
                                                    <a href='/sibeta/public/index.php?page=detail' class='btn btn-preview'><span class='material-symbols-outlined '>visibility</span></a>
                                                    <a href='/sibeta/public/index.php?page=download' class='btn btn-custom2 btn-sm '><span class='material-symbols-outlined'>download_2</span></a>
                                                    </td>
                                                    <td>
                                                        <a href='/sibeta/public/index.php?page=verifikasi' 
                                                            class='btn btn-custom btn-sm d-flex justify-content-center" .
                                                            (($data['Status'] === 'Terverifikasi' || $data['Status'] === 'Ditolak') ? " disabled" : "") .
                                                            "' style='" .
                                                            (($data['Status'] === 'Terverifikasi' || $data['Status'] === 'Ditolak') ? "pointer-events: none; opacity: 0.5;" : "") .
                                                            "'>
                                                            <span class='material-symbols-outlined' style='font-size: 18px; padding-top:2px'>done_all</span>
                                                            Verifikasi
                                                        </a>
                                                    </td>
                                                </tr>";
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>