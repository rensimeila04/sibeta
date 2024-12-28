<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIBETA</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/assets/css/dashboard.css">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_super_admin.php"; ?>

        <div class="main">
            <!-- Header -->
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_admin.php"; ?>

            <div class="p-4 dashboard">
                <div class="breadcrumbs mb-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Dokumen</span>
                </div>
                <div class="mb-3">
                    <h2>Dokumen</h2>
                </div>
            </div>

            <div class="container px-3 py-3 mx-4 my-4">
                <div class="card">
                    <!-- Search and Add Mahasiswa Buttons -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="input-group w-25" style="border-radius: 8px;">
                            <span class="input-group-text" id="basic-addon1" style="background-color: #FFFFFF;">
                                <i class="bi bi-search" style="color: #ADB5BD; font-size: 16px;"></i>
                            </span>
                            <input type="text" id="searchInput" class="form-control" placeholder="Cari ..." aria-label="Search" aria-describedby="basic-addon1" style="border-left: none;">
                            <button class="btn" id="searchButton" style="margin-left: 10px; color:#fff; background-color: #3E368C; border-radius: 4px; height: auto;">Cari</button>
                        </div>
                        <a href="/sibeta/public/index.php?page=super_admin/tambah_dokumen" class="btn btn-sm btn-custom">Tambah Dokumen</a>
                    </div>

                    <!-- Mahasiswa Table -->
                    <div class="table-container w-100">
                        <table class="table table-striped table-borderless" id="documentsTable">
                            <?php
                            $documents = [
                                [
                                    'id' => 1,
                                    'nama_dokumen' => 'Surat Pengantar Mahasiswa',
                                    'jenis' => 'Administratif'
                                ],
                                [
                                    'id' => 2,
                                    'nama_dokumen' => 'Laporan Tahunan Keuangan',
                                    'jenis' => 'Administratif'
                                ],
                                [
                                    'id' => 3,
                                    'nama_dokumen' => 'Panduan Penggunaan Sistem Informasi',
                                    'jenis' => 'Teknis'
                                ],
                                [
                                    'id' => 4,
                                    'nama_dokumen' => 'Dokumentasi Instalasi Server',
                                    'jenis' => 'Teknis'
                                ],
                                [
                                    'id' => 5,
                                    'nama_dokumen' => 'Formulir Pendaftaran',
                                    'jenis' => 'Administratif'
                                ],
                                [
                                    'id' => 6,
                                    'nama_dokumen' => 'Manual Pengguna Aplikasi',
                                    'jenis' => 'Teknis'
                                ],
                                [
                                    'id' => 7,
                                    'nama_dokumen' => 'Surat Keputusan Rapat',
                                    'jenis' => 'Administratif'
                                ],
                                [
                                    'id' => 8,
                                    'nama_dokumen' => 'Spesifikasi Hardware untuk Server',
                                    'jenis' => 'Teknis'
                                ]
                            ];
                            ?>

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jenis Dokumen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($documents as $doc): ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $doc['nama_dokumen']; ?></td>
                                        <td><?php echo $doc['jenis']; ?></td>
                                        <td>
                                            <a href="#" class="material-symbols-outlined align-items-center btn-custom" style="text-decoration: none;" target="_blank">visibility</a>
                                            <a href="#" class="material-symbols-outlined align-items-center btn-custom3" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?php echo $doc['id']; ?>">delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus dokumen ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="deleteButton">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Event listener for delete buttons
        const deleteButtons = document.querySelectorAll('.btn-custom3');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const docId = this.getAttribute('data-id');
                document.getElementById('deleteButton').setAttribute('data-id', docId);
            });
        });

        // Handle delete action
        document.getElementById('deleteButton').addEventListener('click', function() {
            const docId = this.getAttribute('data-id');
            console.log('Dokumen ID ' + docId + ' akan dihapus.');
            // Add your AJAX call or form submission logic to delete the document
            // After deletion, close the modal
            $('#deleteModal').modal('hide');
        });
    </script>
</body>

</html>
