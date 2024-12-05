<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../../../public/assets/css/sidebar.css">
    <link rel="stylesheet" href="../../../public/assets/css/header.css">
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen - SIBETA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=home" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <?php
        include '../components/sidebar_mahasiswa.html';
        ?>
        <div class="main">
            <?php
            include '../components/header_mahasiswa.html';
            ?>
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
                                        <span class="material-symbols-outlined">
                                            search
                                        </span>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Cari dokumen..." aria-label="Sarch" aria-describedby="basic-addon1" style="border-left: none;">
                                    <button class="btn" style="margin-left: 10px; color:#fff; background-color: #3E368C; border-radius: 4px; height: 35px;">Cari</button>
                                </div>

                            </div>

                            <table class="table table-striped">
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
                                    <tr>
                                        <th scope="row">1</th>
                                        <td class=" text-truncate" style="max-width: 50px;">Tanda Terima Penyerahan Laporan Tugas Akhir/Skripsi ke Ruang Baca</td>
                                        <td scope="row">Administratif</td>
                                        <td>12 November 2024</td>
                                        <td>
                                            <span class="badge bg-success" style="border-radius: 16px; font-size: 16px; height: 35px; font-weight: 400; padding-top: 7px">Terverifikasi</span>
                                        </td>
                                        <td><!-- Button trigger modal -->
                                            <div class="aksi">
                                                <a href="detail_dokumen.php" style="text-decoration: none;">
                                                    <button type="button" class="btn" style="color:#FFFFFF; background-color: #3E368C;">
                                                        Detail
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    <th scope="row">2</th>
                                        <td class=" text-truncate" style="max-width: 50px;">Tanda Terima Penyerahan Laporan PKL/Magang ke Ruang Baca</td>
                                        <td scope="row">Administratif</td>
                                        <td>12 November 2024</td>
                                        <td><span class="badge bg-warning" style="border-radius: 16px; font-size: 16px; height: 35px; font-weight: 400; padding-top: 7px; width: 105px;">Diajukan</span></td>
                                        <td><!-- Button trigger modal -->
                                            <div class="aksi">
                                                <a href="detail_dokumen.php" style="text-decoration: none;">
                                                    <button type="button" class="btn" style="color:#FFFFFF; background-color: #3E368C;">
                                                        Detail
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    <th scope="row">3</th>
                                        <td class=" text-truncate" style="max-width: 50px;">Surat Bebas Kompen</td>
                                        <td scope="row">Administratif</td>
                                        <td>12 November 2024</td>
                                        <td><span class="badge bg-danger" style="border-radius: 16px; font-size: 16px; height: 35px; font-weight: 400; padding-top: 7px; width: 105px;">Ditolak</span></td>
                                        <td><!-- Button trigger modal -->
                                            <div class="aksi">
                                                <a href="detail_dokumen.php" style="text-decoration: none;">
                                                    <button type="button" class="btn" style="color:#FFFFFF; background-color: #3E368C;">
                                                        Detail
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    <th scope="row">4</th>
                                        <td class=" text-truncate" style="max-width: 50px;">Scan TOEIC</td>
                                        <td scope="row">Administratif</td>
                                        <td>12 November 2024</td>
                                        <td><span class="badge bg-warning" style="border-radius: 16px; font-size: 16px; height: 35px; font-weight: 400; padding-top: 7px; width: 105px;">Diajukan</span></td>
                                        <td><!-- Button trigger modal -->
                                            <div class="aksi">
                                                <a href="detail_dokumen.php"  style="text-decoration: none;">
                                                    <button type="button" class="btn" style="color:#FFFFFF; background-color: #3E368C;">
                                                        Detail
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    <th scope="row">5</th>
                                        <td class=" text-truncate" style="max-width: 50px;">Laporan Tugas Akhir/Skripsi</td>
                                        <td scope="row">Teknis</td>
                                        <td>12 November 2024</td>
                                        <td><span class="badge bg-warning" style="border-radius: 16px; font-size: 16px; height: 35px; font-weight: 400; padding-top: 7px; width: 105px;">Diajukan</span></td>
                                        <td><!-- Button trigger modal -->
                                            <div class="aksi">
                                                <a href="detail_dokumen.php"  style="text-decoration: none;">
                                                    <button type="button" class="btn" style="color:#FFFFFF; background-color: #3E368C;">
                                                        Detail
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    <th scope="row">6</th>
                                        <td class=" text-truncate" style="max-width: 50px;">Buku Panduan Aplikasi</td>
                                        <td scope="row">Teknis</td>
                                        <td>12 November 2024</td>
                                        <td><span class="badge bg-warning" style="border-radius: 16px; font-size: 16px; height: 35px; font-weight: 400; padding-top: 7px; width: 105px;">Diajukan</span></td>
                                        <td><!-- Button trigger modal -->
                                            <div class="aksi">
                                                <a href="detail_dokumen.php"  style="text-decoration: none;">
                                                    <button type="button" class="btn" style="color:#FFFFFF; background-color: #3E368C;">
                                                        Detail
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    <th scope="row">7</th>
                                        <td class=" text-truncate" style="max-width: 50px;">Surat Pernyataan Publikasi</td>
                                        <td scope="row">Teknis</td>
                                        <td>12 November 2024</td>
                                        <td><span class="badge bg-warning" style="border-radius: 16px; font-size: 16px; height: 35px; font-weight: 400; padding-top: 7px; width: 105px;">Diajukan</span></td>
                                        <td><!-- Button trigger modal -->
                                            <div class="aksi">
                                                <a href="detail_dokumen.php"  style="text-decoration: none;">
                                                    <button type="button" class="btn" style="color:#FFFFFF; background-color: #3E368C;">
                                                        Detail
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
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