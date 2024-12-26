<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Dokumen</title>
</head>

<body>
    <div class="wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_teknisi.php"; ?>
        <!-- Modal -->
        <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/sibeta/public/index.php?page=verifikasi&id=<?= $id ?>&aksi=reject" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="rejectModalLabel">Konfirmasi Penolakan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin menolak Surat Bebas Kompen?</p>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Komentar</label>
                                <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Tambahkan komentar" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" id="rejectButton">Tolak Dokumen</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="verifyModal" tabindex="-1" aria-labelledby="verifyModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verifyModalLabel">Konfirmasi Verifikasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin menyetujui Surat Bebas Kompen?</p>
                    </div>
                    <div class="modal-footer">
                        <a href="/sibeta/public/index.php?page=verifikasi&id=<?= $id ?>&aksi=verify" type="button" class="btn btn-primary" id="verifyButton">Setujui Dokumen</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="main">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_admin.php"; ?>
            <div class="p-4 dashboard">
                <div class="breadcrumbs mb-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="/sibeta/public/index.php?page=<?php echo $role; ?>">SIBETA</a>
                    <span class="separator">/</span>
                    <a href="/sibeta/public/index.php?page=kelola">Kelola Dokumen</a>
                    <span class="separator">/</span>
                    <a href="/sibeta/public/index.php?page=detail-mahasiswa&nim=<?= $documentsMahasiswa[0]['Nim'] ?>">Detail Mahasiswa</a>
                    <span class="separator">/</span>
                    <span>Detail Dokumen</span>
                </div>

                <div class="card card-body">
                    <div class="p-3">
                        <h3 class="mb-4">Detail Dokumen</h3>
                        <div class="d-flex flex-column gap-2">
                            <div class="info-row">
                                <span class="label">Nama Dokumen</span>
                                <span class="value"><?= $documentsMahasiswa[0]['NamaDokumen'] ?></span>
                            </div>
                            <div class="info-row">
                                <span class="label">Jenis Dokumen</span>
                                <span class="value"><?= $documentsMahasiswa[0]['Tipe'] ?></span>
                            </div>
                            <div class="info-row">
                                <span class="label">Tanggal Upload</span>
                                <span class="value">
                                    <?php
                                    echo (new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE))
                                        ->format(strtotime($documentsMahasiswa[0]['TanggalUpload']));
                                    ?>



                                </span>
                            </div>
                            <div class="info-row">
                                <span class="label">Dokumen</span>
                                <span class="value">
                                    <?php
                                    $file = basename($documentsMahasiswa[0]['FilePath']);
                                    echo $file;
                                    ?>
                                    <a href="<?php echo '../app' . $documentsMahasiswa[0]['FilePath']; ?>" class="material-symbols-outlined align-items-center btn-custom" target="_blank">
                                        visibility
                                    </a>
                                </span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-3">
                            <button
                                class="btn btn-outline-danger btn-sm d-flex align-items-center"
                                data-bs-toggle="modal"
                                data-bs-target="#rejectModal"
                                <?= (($documentsMahasiswa[0]['Status'] === 'Diverifikasi' || $documentsMahasiswa[0]['Status'] === 'Ditolak') || ($documentsMahasiswa[0]['Status'] === 'Diajukan' && $documentsMahasiswa[0]['IsSaved'] == '0')) ? 'disabled' : '' ?>>
                                <span class="material-symbols-outlined me-2">close</span>Tolak
                            </button>
                            <button
                                class="btn btn-success btn-sm d-flex align-items-center"
                                data-bs-toggle="modal"
                                data-bs-target="#verifyModal"
                                <?= (($documentsMahasiswa[0]['Status'] === 'Diverifikasi' || $documentsMahasiswa[0]['Status'] === 'Ditolak') || ($documentsMahasiswa[0]['Status'] === 'Diajukan' && $documentsMahasiswa[0]['IsSaved'] == '0')) ? 'disabled' : '' ?>>
                                <span class="material-symbols-outlined me-2">done_all</span>Verifikasi
                            </button>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</body>

</html>