<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet" />
    <link rel="stylesheet" href="../../../public/assets/css/dashboard.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas - SIBETA</title>
</head>


<body>
    <div class="wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_super_admin.php"; ?>
        <div class="main">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_admin.php"; ?>
            <div class="p-4 dashboard">
                <div class="breadcrumbs mb-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="/sibeta/public/index.php?page=<?php echo $role; ?>">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Kelas</span>
                </div>
                <div class="mb-3">
                    <h2>Kelas</h2>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3 w-100">
                    <div class="input-group" style="width: auto; max-width: 400px;">
                        <span class="input-group-text" id="basic-addon1" style="background-color: #FFFFFF; border-right: none;">
                            <i class="bi bi-search" style="color: #ADB5BD; font-size: 16px;"></i>
                        </span>
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari..." aria-label="Search"
                            aria-describedby="basic-addon1" style="border-left: none; border-radius: 0 4px 4px 0;">
                        <div class="ms-3">
                            <button class="btn" id="searchButton" style="color: #fff; background-color: #3E368C; border-radius: 4px;">Cari</button>
                        </div>
                    </div>
                    <div class="ms-3 align-items-end">
                        <button class="btn" id="tambahButton" data-bs-toggle="modal" data-bs-target="#tambahKelasModal" style="color: #fff; background-color: #3E368C; border-radius: 4px;">Tambah Kelas</button>
                    </div>
                </div>

                <div class="table-container w-100">
                    <?php if (!empty($kelas)): ?>
                        <table class="table table-striped table-borderless table-hover" id="documentsTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Program Studi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kelas as $index => $data): ?>
                                    <tr>
                                        <td><?= $index + 1; ?></td>
                                        <td><?= $data['nama']; ?></td>
                                        <td><?= $data['program_studi']; ?></td>
                                        <td>
                                            <a href="?page=kelas&action=delete&id=<?= $data['id']; ?>">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="pagination justify-content-center mt-5 text-center">
                            <p>Page <?= $page ?> of <?= $totalPages ?></p>
                        </div>
                    <?php else: ?>
                        <p class="text-center">Data kelas tidak ditemukan.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahKelasModal" tabindex="-1" aria-labelledby="tambahKelasModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahKelasModalLabel">Tambahkan Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="namaKelas" class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" id="namaKelas" placeholder="Nama Kelas">
                        </div>
                        <div class="mb-3">
                            <label for="programStudi" class="form-label">Program Studi</label>
                            <select class="form-select" id="programStudi">
                                <option selected>Pilih Program Studi</option>
                                <option value="1">Teknik Informatika</option>
                                <option value="2">Sistem Informasi Bisnis</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn" style="background-color: #3E368C; color: #fff;">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Hapus kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus <strong>Kelas 1A</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Hapus</button>
                </div>
            </div>
        </div>
    </div>


</body>