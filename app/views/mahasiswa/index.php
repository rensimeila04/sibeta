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

                <!-- Statistic Cards -->
                <div class="row-custom">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body-dash">
                                <h6 class="text-secondary">Dokumen Diajukan</h6>
                                <?php $totalDokumen = $documentCounts['diajukan'] + $documentCounts['terverifikasi'] + $documentCounts['ditolak'];  ?>
                                <h1 class="text" style="color: #3E368C;"><?php echo $totalDokumen; ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body-dash">
                                <h6 class="text-secondary">Menunggu Verifikasi</h6>
                                <h1 class="text-warning"><?php echo $documentCounts['diajukan']; ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body-dash">
                                <h6 class="text-secondary">Dokumen Terverifikasi</h6>
                                <h1 class="text-success"><?php echo $documentCounts['terverifikasi']; ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body-dash">
                                <h6 class="text-secondary">Dokumen Ditolak</h6>
                                <h1 class="text-danger"><?php echo $documentCounts['ditolak']; ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Download Section -->
                <div class="card py-3">
                    <div class="card-body">
                        <div class="text-center">
                            <h5>Download Template Surat</h5>
                            <p class="text-muted">Download template surat yang anda butuhkan melalui Google Drive yang telah disediakan oleh Admin</p>
                            <a href="https://intip.in/BerkasTI" target="_blank" class="btn-custom px-3 py-2 align-content-center" style="text-decoration: none;">Download Template</a>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h2 class="fw-semibold fs-3">Dokumen Anda</h2>
                            <a href="#" class="btn-custom align-content-center" style="text-decoration: none;">Lihat Semua</a>
                        </div>
                        <table class="table table-striped table-borderless table-hover">
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
                                    $badgeClass = '';
                                    switch ($document['Status']) {
                                        case 'Diverifikasi':
                                            $badgeClass = 'bg-success';
                                            break;
                                        case 'Diajukan':
                                            $badgeClass = 'bg-warning';
                                            break;
                                        case 'Ditolak':
                                            $badgeClass = 'bg-danger';
                                            break;
                                    }
                                    echo "<tr>
                                            <th scope='row'>{$no}</th>
                                            <td class='text-truncate' style='max-width: 50px;'>{$document['NamaDokumen']}</td>
                                            <td>{$document['Tipe']}</td>
                                            <td>{$tanggalUpload}</td>
                                            <td>
                                                <span class='badge {$badgeClass}' style='border-radius: 16px; font-size: 16px; height: 35px; width: 126px; font-weight: 400; padding-top: 7px;'>
                                                    {$document['Status']}
                                                </span>
                                            </td>
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