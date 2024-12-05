<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../components/sidebar_admin.html">
    <link rel="stylesheet" href="../components/header_admin.html">
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>

<body>
    <div class="wrapper">
        <?php
        include '../components/sidebar_admin.html';
        ?>
        <div class="main">
            <?php
            include '../components/header_admin.html';
            ?>
            <div class="p-4 dashboard">
                <div class="breadcrumbs mb-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <a href="#">Kelola Dokumen</a>
                    <span class="separator">/</span>
                    <a href="#">Detail Mahasiswa</a>
                    <span class="separator">/</span>
                    <span>Detail Dokumen</span>
                </div>

                <div class="card card-body">
                    <div class="p-3">
                        <h3 class="mb-4">Detail Dokumen</h3>
                        <div class="d-flex flex-column gap-2">
                            <div class="info-row">
                                <span class="label">Nama Dokumen</span>
                                <span class="value">Surat Bebas Kompen</span>
                            </div>
                            <div class="info-row">
                                <span class="label">Jenis Dokumen</span>
                                <span class="value">Administratif</span>
                            </div>
                            <div class="info-row">
                                <span class="label">Tanggal Upload</span>
                                <span class="value">12 November 2024</span>
                            </div>
                            <div class="info-row">
                                <span class="label">Dokumen</span>
                                <span class="value">Surat_Kompen_Rensi.pdf
                                    <a href="#" class="btn btn-detail btn-sm ms-3">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                </span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-3">
                            <button class="btn btn-outline-danger btn-sm d-flex align-items-center">
                                <span class="material-symbols-outlined me-2">close</span>Tolak
                            </button>
                            <button class="btn btn-success btn-sm d-flex align-items-center">
                                <span class="material-symbols-outlined me-2">done_all</span>Verifikasi
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</body>

</html>