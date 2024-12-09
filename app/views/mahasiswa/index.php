<?php
$nim = $_SESSION['nim']; 
$mahasiswaController = new MahasiswaController($conn);

$documentCounts = $mahasiswaController->getDocumentCounts($nim);

$documents = $mahasiswaController->getDocuments($nim);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIBETA</title>
</head>

<body>
    <div class="wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_mahasiswa.php"; ?>
        <div class="main">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_mahasiswa.php"; ?>
            <div class="p-3 dashboard">
                <div class="breadcrumbs">
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
                                <div class="card-body">
                                    <h6 class="text-secondary">Dokumen Diajukan</h6>
                                    <h1 class="text" style="color: #3E368C;"><?php echo $documentCounts['diajukan']; ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="text-secondary">Menunggu Verifikasi</h6>
                                    <h1 class="text-warning"><?php echo $documentCounts['diajukan']; ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="text-secondary">Dokumen Terverifikasi</h6>
                                    <h1 class="text-success"><?php echo $documentCounts['terverifikasi']; ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="text-secondary">Dokumen Ditolak</h6>
                                    <h1 class="text-danger"><?php echo $documentCounts['ditolak']; ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Download Section -->
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <h5>Download Template Surat</h5>
                                <p class="text-muted">Download template surat yang anda butuhkan melalui Google Drive yang telah disediakan oleh Admin</p>
                                <a href="https://intip.in/BerkasTI" target="_blank" class="btn" style="color:#fff; background-color: #3E368C;">Download Template</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container p-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="fw-semibold fs-3">Dokumen Anda</div>
                            <a href="#" class="btn" style="color:#fff; background-color: #3E368C;">Lihat Semua</a>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Dokumen</th>
                                    <th scope="col">Jenis Dokumen</th>
                                    <th scope="col">Tanggal Upload</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($documents as $document) {
                                    $tanggalUpload = date('d F Y', strtotime($document['TanggalUpload']));
                                    echo "<tr>
                                            <th scope='row'>{$no}</th>
                                            <td class='text-truncate' style='max-width: 50px;'>{$document['NamaDokumen']}</td>
                                            <td>{$document['Tipe']}</td>
                                            <td>{$tanggalUpload}</td>
                                            <td><span class='badge text-bg-" . ($document['Status'] == 'Diverifikasi' ? 'success' : ($document['Status'] == 'Diajukan' ? 'warning' : 'danger')) . "'>{$document['Status']}</span></td>
                                        </tr>";
                                    $no++;
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>