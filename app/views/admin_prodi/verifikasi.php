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
                    <a href="#">Detal Mahasiswa</a>
                    <span class="separator">/</span>
                    <span>Detail Dokumen</span>
                </div>

                <div class="detail-dokumen-card">
                <h2 class="title">Detail Dokumen</h2>
                <div class="dokumen-info">
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
                            <a href="#" class="btn-view">
                                <i class="bi bi-eye"></i> Lihat
                            </a>
                        </span>
                    </div>
                </div>
                <div class="dokumen-actions">
                    <button class="btn btn-danger">✖ Tolak</button>
                    <button class="btn btn-success">✔ Verifikasi</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>