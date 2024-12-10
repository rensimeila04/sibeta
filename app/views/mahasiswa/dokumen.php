<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen - SIBETA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=home" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_mahasiswa.php"; ?>
        <div class="main">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_mahasiswa.php"; ?>
            <div class="dokumen p-3">
                <div class="breadcrumbs">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Dokumen</span>
                </div>

                <h5 class="mt-3">Riwayat Pengajuan Dokumen</h5>

                <div class="py-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div class="input-group w-25" style="border-radius: 8px;">
                                    <span class="input-group-text" id="basic-addon1" style="background-color: #FFFFFF;">
                                        <i class="bi bi-search" style="color: #ADB5BD; font-size: 16px;"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Cari dokumen..." aria-label="Sarch" aria-describedby="basic-addon1" style="border-left: none;">
                                    <button class="btn" style="margin-left: 10px; color:#fff; background-color: #3E368C; border-radius: 4px; height: 35px;">Cari</button>
                                </div>
                            </div>

                            <table class="table table-striped table-borderless table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col" class="col-nama-dokumen">Nama Dokumen</th>
                                        <th scope="col">Jenis Dokumen</th>
                                        <th scope="col" class="col-tanggal">Tanggal Upload</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $documents = [
                                        [
                                            'name' => 'Tanda Terima Penyerahan Laporan Tugas Akhir/Skripsi ke Ruang Baca',
                                            'type' => 'Administratif',
                                            'date' => '12 November 2024',
                                            'status' => 'Ditolak'
                                        ],
                                        [
                                            'name' => 'Tanda Terima Penyerahan Laporan PKL/Magang ke Ruang Baca',
                                            'type' => 'Administratif',
                                            'date' => '12 November 2024',
                                            'status' => 'Diajukan'
                                        ],
                                        [
                                            'name' => 'Surat Bebas Kompen',
                                            'type' => 'Administratif',
                                            'date' => '12 November 2024',
                                            'status' => 'Ditolak'
                                        ],
                                    ];
                                    foreach ($documents as $index => $document) {
                                        $badgeClass = '';
                                        switch ($document['status']) {
                                            case 'Terverifikasi':
                                                $badgeClass = 'bg-success';
                                                break;
                                            case 'Diajukan':
                                                $badgeClass = 'bg-warning';
                                                break;
                                            case 'Ditolak':
                                                $badgeClass = 'bg-danger';
                                                break;
                                        }
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $index + 1; ?></th>
                                            <td class="text-truncate" style="max-width: 50px;"><?php echo $document['name']; ?></td>
                                            <td scope="row"><?php echo $document['type']; ?></td>
                                            <td><?php echo $document['date']; ?></td>
                                            <td>
                                                <span class="badge <?php echo $badgeClass; ?>" style="border-radius: 16px; font-size: 16px; height: 35px; width: 126px; font-weight: 400; padding-top: 7px;">
                                                    <?php echo $document['status']; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="aksi">
                                                    <a href="detail_dokumen.php" style="text-decoration: none;">
                                                        <button type="button" class="btn-custom">
                                                            Detail
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="components/sidebar/script.js"></script> -->
</body>

</html>