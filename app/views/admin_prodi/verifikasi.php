<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../components/sidebar_admin.html">
    <link rel="stylesheet" href="../components/header_admin.html">
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Dokumen</title>
</head>

<body>
    <div class="wrapper">
        <?php
        include '../components/sidebar_admin.html';
        ?>
        <!-- Modal -->
        <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectModalLabel">Konfirmasi Penolakan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin menolak Surat Bebas Kompen?</p>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Komentar</label>
                            <textarea class="form-control" id="comment" rows="3" placeholder="Tambahkan komentar"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="rejectButton">Tolak Dokumen</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
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
                            <button class="btn btn-outline-danger btn-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#rejectModal">
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