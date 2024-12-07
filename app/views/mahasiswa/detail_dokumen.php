<!DOCTYPE html>
<html lang="en">

<head>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
        crossorigin="anonymous">
    <link rel="stylesheet" href="../../../public/assets/css/sidebar.css">
    <link rel="stylesheet" href="../../../public/assets/css/header.css">
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
    <link rel="stylesheet" href="../../../public/assets/css/detail_dokumen.css">
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
                    <span class="separator">/</span>
                    <span>Detail Dokumen</span>
                </div>

                <div class="py-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Detail Dokumen</h5>
                                <button class="button-edit">
                                    <span class="material-symbols-outlined me-2">
                                        edit
                                    </span>
                                    Edit Dokumen
                                </button>
                            </div>
                            <table class="table table-borderless mb-0 text-start">
                                <tbody>
                                    <tr class="custom-width">
                                        <th scope="row" class="w-25">Nama Dokumen</th>
                                        <td>Surat Bebas Kompen</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Jenis Dokumen</th>
                                        <td>Administratif</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Status Dokumen</th>
                                        <td>
                                            <div class="status-badge status-ditolak">Ditolak</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Komentar</th>
                                        <td>
                                            Dokumen salah, upload ulang dokumen
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Dokumen</th>
                                        <td>
                                            Surat_Kompen_Nero.pdf   
                                            <button class="btn-view">
                                            <span class="material-symbols-outlined">
                                                visibility
                                            </span>    
                                            Lihat</button>
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