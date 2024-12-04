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
                                <a href="#" class="btn" style="color:#fff; background-color: #3E368C;" data-bs-toggle="modal" data-bs-target="#tambahDokumen">Tambah Dokumen</a>

                                <div class="modal fade" id="tambahDokumen" tabindex="-1" aria-labelledby="#tambahDokumenLabel" aria-hidden="true">
                                    <form class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="tambahDokumenLabel">Tambahkan Dokumen</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="namaDokumen" class="form-label">Nama Dokumen</label>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option>Pilih Dokumen</option>
                                                        <option selected value="Laporan Tugas Akhir/Skripsi
                                                            ">Laporan Tugas Akhir/Skripsi</option>
                                                        <option value="Buku Panduan Aplikasi">
                                                            Buku Panduan Aplikasi</option>
                                                        <option value="Surat Pernyataan Publikasi">Surat Pernyataan Publikasi</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="uploadDokumen" class="form-label">Upload Dokumen</label>
                                                    <input class="form-control" type="file" id="uploadDokumen">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn" style="color:#fff; background-color: #3E368C;">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center py-5">
                                Tidak ada file untuk ditampilkan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <!-- <script src="components/sidebar/script.js"></script> -->
</body>

</html>