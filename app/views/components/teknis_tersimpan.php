<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../../../public/assets/css/sidebar.css">
    <link rel="stylesheet" href="../../../public/assets/css/header.css">
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrasi - SIBETA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=home" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <?php
        include 'sidebar_mahasiswa.html';
        ?>
        <div class="main">
            <?php
            include 'header_mahasiswa.html';
            ?>
            <div class="administrasi p-3">
                <div class="breadcrumbs">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Unggah Dokumen</span>
                    <span class="separator">/</span>
                    <span>Teknis</span>
                </div>

                <h5 class="mt-3">Unggah Dokumen Teknis</h5>

                <div class="py-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div class="input-group w-25">
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
                                        <th scope="col" class="col-tanggal">Tanggal Upload</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td class=" text-truncate" style="max-width: 50px;">Laporan Tugas Akhir/Skripsi</td>
                                        <td>12 November 2024</td>
                                        <td><!-- Button trigger modal -->
                                            <a href="assets/sample-1.pdf" target="_blank" style="text-decoration: none;">
                                                <button type="button" class="btn d-flex justify-content-between gap-2" style="color:#FFFFFF; background-color: #3E368C;">
                                                    <span class="material-symbols-outlined" style="font-size: 18px; display: flex; align-items: center; padding-top: 5px;">
                                                        visibility
                                                    </span>
                                                    Lihat
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td class=" text-truncate" style="max-width: 50px;">Buku Panduan Aplikasi</td>
                                        <td>12 November 2024</td>
                                        <td><!-- Button trigger modal -->
                                            <a href="assets/sample-1.pdf" target="_blank" style="text-decoration: none;">
                                                <button type="button" class="btn d-flex justify-content-between gap-2" style="color:#FFFFFF; background-color: #3E368C;">
                                                    <span class="material-symbols-outlined" style="font-size: 18px; display: flex; align-items: center; padding-top: 5px;">
                                                        visibility
                                                    </span>
                                                    Lihat
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td class=" text-truncate" style="max-width: 50px;">Surat Pernyataan Publikasi</td>
                                        <td>12 November 2024</td>
                                        <td><!-- Button trigger modal -->
                                            <a href="assets/sample-1.pdf" target="_blank" style="text-decoration: none;">
                                                <button type="button" class="btn d-flex justify-content-between gap-2" style="color:#FFFFFF; background-color: #3E368C;">
                                                    <span class="material-symbols-outlined" style="font-size: 18px; display: flex; align-items: center; padding-top: 5px;">
                                                        visibility
                                                    </span>
                                                    Lihat
                                                </button>
                                            </a>
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