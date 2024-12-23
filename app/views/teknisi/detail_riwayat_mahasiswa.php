<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa</title>
</head>

<body>
    <div class="wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_teknisi.php"; ?>
        <div class="main">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_admin.php"; ?>
            <div class="p-4">
                <div class="breadcrumbs mb-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="/sibeta/public/index.php?page=<?php echo $role; ?>">SIBETA</a>
                    <span class="separator">/</span>
                    <a href="/sibeta/public/index.php?page=riwayat_staff">Riwayat Pengajuan</a>
                    <span class="separator">/</span>
                    <span>Detail Mahasiswa</span>
                </div>

                <div class="card my-4">
                    <div class="card-body p-4">
                        <div class="d-flex flex-column justify-content-between mb-3 gap-2">
                            <div class="fw-semibold fs-3">Detail Mahasiswa</div>
                            <div class="d-flex flex-column gap-1">
                                <p class="text-muted">Detail mahasiswa yang telah mengajukan dokumen</p>

                            </div>
                        </div>
                        <div class="py-3">
                            <div class="detail-desc mb-5 gap-1 w-50">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th>NIM</th>
                                            <td><?php echo $mahasiswa['NIM']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td><?php echo $mahasiswa['NamaMahasiswa']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Program Studi</th>
                                            <td><?php echo $mahasiswa['ProgramStudi']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kelas</th>
                                            <td><?php echo $mahasiswa['Kelas']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <table class="table table-striped table-borderless table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Dokumen</th>
                                        <th>Tanggal Upload</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($documentsMahasiswa as $doc):
                                        $TanggalUpload = date('d F Y', strtotime($doc['TanggalUpload'])); ?>
                                        <tr>
                                            <td class="fw-bold"><?php echo $no++; ?></td>
                                            <td><?php echo $doc['NamaDokumen']; ?></td>
                                            <td><?php echo $TanggalUpload; ?></td>
                                            <td>
                                                <p class="<?php
                                                            // Apply different classes based on the status
                                                            if ($doc['Status'] == 'Diverifikasi') {
                                                                echo 'status-diverifikasi';
                                                            } elseif ($doc['Status'] == 'Diajukan') {
                                                                echo 'status-diajukan';
                                                            } elseif ($doc['Status'] == 'Ditolak') {
                                                                echo 'status-ditolak';
                                                            }
                                                            ?> fw-semibold px-4">
                                                    <?php echo $doc['Status']; ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo '../app' . $doc['FilePath']; ?>" class="material-symbols-outlined align-items-center btn-custom" target="_blank">
                                                    visibility
                                                </a>
                                                <a href="<?php echo '../app' . $doc['FilePath']; ?>" class="material-symbols-outlined align-items-center btn-custom2" download>
                                                    download
                                                </a>
                                            </td>
                                            <?php
                                            $buttonClass = ($doc['Status'] === 'Terverifikasi') ? 'btn-disabled d-flex align-items-center' : 'btn-custom d-flex align-items-center';
                                            ?>
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
</body>

</html>