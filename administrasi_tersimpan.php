<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="components/sidebar/style.css">
    <link rel="stylesheet" href="components/header/style.css">
    <link rel="stylesheet" href="css/administrasi.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrasi - SIBETA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=home" />
</head>

<body>
    <div class="wrapper">
        <?php
        include 'components/sidebar/index.html';
        ?>
        <div class="main">
            <?php
            include 'components/header/index.html';
            ?>
            <div class="administrasi p-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <i class="breadcrumb-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 18V15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M10.07 2.81997L3.14002 8.36997C2.36002 8.98997 1.86002 10.3 2.03002 11.28L3.36002 19.24C3.60002 20.66 4.96002 21.81 6.40002 21.81H17.6C19.03 21.81 20.4 20.65 20.64 19.24L21.97 11.28C22.13 10.3 21.63 8.98997 20.86 8.36997L13.93 2.82997C12.86 1.96997 11.13 1.96997 10.07 2.81997Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg></i>
                            <a class="breadcrumb-link" href="#">SIBETA</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Unggah Dokumen</li>
                        <li class="breadcrumb-item active" aria-current="page">Administrasi</li>
                    </ol>
                </nav>

                <h5>Unggah Dokumen Administratif</h5>

                <div class="py-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div class="input-group w-25">
                                    <span class="input-group-text" id="basic-addon1" style="background-color: #FFFFFF;">
                                        <img src="assets/icon/search.png" alt="search" style="width: 20px;">
                                    </span>
                                    <input type="text" class="form-control" placeholder="Search" aria-label="Sarch" aria-describedby="basic-addon1" style="border-left: none;">
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
                                        <td class=" text-truncate" style="max-width: 50px;">Tanda Terima Penyerahan Laporan Tugas Akhir/Skripsi ke Ruang Baca</td>
                                        <td>12 November 2024</td>
                                        <td><!-- Button trigger modal -->
                                            <a href="assets/sample-1.pdf" target="_blank" style="text-decoration: none;">
                                                <button type="button" class="btn" style="color:#FFFFFF; background-color: #3E368C;">
                                                    <img src="assets/icon/eye.png" alt="eye" style="width: 18px;">
                                                    Lihat
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td class=" text-truncate" style="max-width: 50px;">Tanda Terima Penyerahan Laporan Tugas Akhir/Skripsi ke Ruang Baca</td>
                                        <td>12 November 2024</td>
                                        <td><!-- Button trigger modal -->
                                            <a href="assets/sample-1.pdf" target="_blank" style="text-decoration: none;">
                                                <button type="button" class="btn" style="color:#FFFFFF; background-color: #3E368C;">
                                                    <img src="assets/icon/eye.png" alt="eye" style="width: 18px;">
                                                    Lihat
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td class=" text-truncate" style="max-width: 50px;">Laporan Tugas/Akhir Skripsi</td>
                                        <td>12 November 2024</td>
                                        <td><!-- Button trigger modal -->
                                            <a href="assets/sample-1.pdf" target="_blank" style="text-decoration: none;">
                                                <button type="button" class="btn" style="color:#FFFFFF; background-color: #3E368C;">
                                                    <img src="assets/icon/eye.png" alt="eye" style="width: 18px;">
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