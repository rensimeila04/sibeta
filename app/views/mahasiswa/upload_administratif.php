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
                    <span>Administrasi</span>
                </div>

                <h5 class="mt-3">Unggah Dokumen Administratif</h5>

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
                                                        <option selected>Pilih Dokumen</option>
                                                        <option value="Tanda Terima Penyerahan Laporan Tugas Akhir/Skripsi ke
                                                            Ruang Baca">Tanda Terima Penyerahan Laporan Tugas Akhir/Skripsi ke
                                                            Ruang Baca</option>
                                                        <option value="Tanda Terima Penyerahan Laporan PKL/Magang ke Ruang
                                                            Baca">Tanda Terima Penyerahan Laporan PKL/Magang ke Ruang
                                                            Baca</option>
                                                        <option value="Surat Bebas Kompen">Surat Bebas Kompen</option>
                                                        <option value="Scan TOEIC">Scan TOEIC</option>
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
                            <!-- Modal Edit-->
                            <div class="modal fade" id="editDokumen" tabindex="-1" aria-labelledby="#editDokumenLabel" aria-hidden="true">
                                <form class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="editDokumenLabel">Edit Dokumen</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="namaDokumen" class="form-label">Nama Dokumen</label>
                                                <select class="form-select" aria-label="Default select example">
                                                    <option>Pilih Dokumen</option>
                                                    <option selected value="Tanda Terima Penyerahan Laporan Tugas Akhir/Skripsi ke
                                                            Ruang Baca">Tanda Terima Penyerahan Laporan Tugas Akhir/Skripsi ke
                                                        Ruang Baca</option>
                                                    <option value="Tanda Terima Penyerahan Laporan PKL/Magang ke Ruang
                                                            Baca">Tanda Terima Penyerahan Laporan PKL/Magang ke Ruang
                                                        Baca</option>
                                                    <option value="Surat Bebas Kompen">Surat Bebas Kompen</option>
                                                    <option value="Scan TOEIC">Scan TOEIC</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="uploadDokumen" class="form-label">Upload Dokumen</label>
                                                <input class="form-control" type="file" id="uploadDokumen" value="assets/sample-1.pdf">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn" style="color:#fff; background-color: #3E368C;">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Modal Delete -->
                            <div class="modal fade" id="hapusDokumen" tabindex="-1" aria-labelledby="#hapusDokumenLabel" aria-hidden="true">
                                <form class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="hapusDokumenLabel">Hapus Dokumen</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus <b>Tanda Terima Penyerahan Laporan Tugas Akhir/Skripsi ke Ruang Baca</b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn" style="color:#fff; background-color: #DC3545;">Hapus Dokumen</button>
                                        </div>
                                    </div>
                                </form>
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
                                        <td class=" text-truncate" style="max-width: 50px;">Tanda Terima Penyerahan Laporan Tugas Akhir/Skripsi ke Ruang Baca</td>
                                        <td>12 November 2024</td>
                                        <td><!-- Button trigger modal -->
                                            <div class="aksi">
                                                <a href="assets/sample-1.pdf" target="_blank" style="text-decoration: none;">
                                                    <button type="button" class="btn" style="color:#FFFFFF; background-color: #3E368C;">
                                                        <span class="material-symbols-outlined" style="color:#FFFFFF; font-size: 18px; padding:5px;">
                                                            visibility
                                                        </span>
                                                    </button>
                                                </a>
                                                <button type="button" class="btn" style="background-color: #F7BE1A;" data-bs-toggle="modal" data-bs-target="#editDokumen">
                                                    <span class="material-symbols-outlined" style="color:#FFFFFF; font-size: 18px; padding:5px;">
                                                        edit
                                                    </span>
                                                </button>
                                                <button type="button" class="btn" style="background-color: #DC3545;" data-bs-toggle="modal" data-bs-target="#hapusDokumen">
                                                    <span class="material-symbols-outlined" style="color:#FFFFFF; font-size: 18px; padding:5px;">
                                                        delete
                                                    </span>
                                                </button>
                                            </div>


                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td class=" text-truncate" style="max-width: 50px;">Tanda Terima Penyerahan Laporan Tugas Akhir/Skripsi ke Ruang Baca</td>
                                        <td>12 November 2024</td>
                                        <td><!-- Button trigger modal -->
                                            <div class="aksi">
                                                <a href="assets/sample-1.pdf" target="_blank" style="text-decoration: none;">
                                                    <button type="button" class="btn" style="color:#FFFFFF; background-color: #3E368C;">
                                                        <span class="material-symbols-outlined" style="color:#FFFFFF; font-size: 18px; padding:5px;">
                                                            visibility
                                                        </span>
                                                    </button>
                                                </a>
                                                <button type="button" class="btn" style="background-color: #F7BE1A;" data-bs-toggle="modal" data-bs-target="#editDokumen">
                                                    <span class="material-symbols-outlined" style="color:#FFFFFF; font-size: 18px; padding:5px;">
                                                        edit
                                                    </span>
                                                </button>
                                                <button type="button" class="btn" style="background-color: #DC3545;" data-bs-toggle="modal" data-bs-target="#hapusDokumen">
                                                    <span class="material-symbols-outlined" style="color:#FFFFFF; font-size: 18px; padding:5px;">
                                                        delete
                                                    </span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td class=" text-truncate" style="max-width: 50px;">Laporan Tugas/Akhir Skripsi</td>
                                        <td>12 November 2024</td>
                                        <td><!-- Button trigger modal -->
                                            <div class="aksi">
                                                <a href="assets/sample-1.pdf" target="_blank" style="text-decoration: none;">
                                                    <button type="button" class="btn" style="color:#FFFFFF; background-color: #3E368C;">
                                                        <span class="material-symbols-outlined" style="color:#FFFFFF; font-size: 18px; padding:5px;">
                                                            visibility
                                                        </span>
                                                    </button>
                                                </a>
                                                <button type="button" class="btn" style="background-color: #F7BE1A;" data-bs-toggle="modal" data-bs-target="#editDokumen">
                                                    <span class="material-symbols-outlined" style="color:#FFFFFF; font-size: 18px; padding:5px;">
                                                        edit
                                                    </span>
                                                </button>
                                                <button type="button" class="btn" style="background-color: #DC3545;" data-bs-toggle="modal" data-bs-target="#hapusDokumen">
                                                    <span class="material-symbols-outlined" style="color:#FFFFFF; font-size: 18px; padding:5px;">
                                                        delete
                                                    </span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                <a href="#" class="btn" style="color:#fff; background-color: #3E368C;">Simpan</a>
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