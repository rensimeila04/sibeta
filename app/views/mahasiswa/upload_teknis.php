<?php

$dummyDocuments = [
    [
        'id' => 1,
        'name' => 'Laporan Tugas Akhir/Skripsi',
        'upload_date' => '12 November 2024',
        'file_path' => 'assets/sample-1.pdf',
        'status' => 'pending'
    ],
    [
        'id' => 2,
        'name' => 'Buku Panduan Aplikasi',
        'upload_date' => '12 November 2024',
        'file_path' => 'assets/sample-2.pdf',
        'status' => 'pending'
    ]
];

$_SESSION['documents'] = $dummyDocuments;
$_SESSION['all_documents_completed'] = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add_document') {
        $newDocument = [
            'id' => count($_SESSION['documents']) + 1,
            'name' => $_POST['namaDokumen'],
            'upload_date' => date('d F Y'),
            'file_path' => isset($_FILES['uploadDokumen']) ? $_FILES['uploadDokumen']['name'] : 'dummy-uploaded-file.pdf',
            'status' => 'pending'
        ];

        $_SESSION['documents'][] = $newDocument;
    }

    if (isset($_POST['action']) && $_POST['action'] === 'edit_document') {
        foreach ($_SESSION['documents'] as &$doc) {
            if ($doc['id'] == $_POST['documentId']) {
                $doc['name'] = $_POST['namaDokumen'];
                // Update file path if a new file is uploaded
                if (isset($_FILES['uploadDokumen']) && $_FILES['uploadDokumen']['name'] != '') {
                    $doc['file_path'] = $_FILES['uploadDokumen']['name'];
                }
                break;
            }
        }
    }

    if (isset($_POST['action']) && $_POST['action'] === 'delete_document') {
        foreach ($_SESSION['documents'] as $key => $doc) {
            if ($doc['id'] == $_POST['documentId']) {
                unset($_SESSION['documents'][$key]);
                // Reindex the array
                $_SESSION['documents'] = array_values($_SESSION['documents']);
                break;
            }
        }
    }

    if (isset($_POST['action']) && $_POST['action'] === 'complete_documents') {
        foreach ($_SESSION['documents'] as &$doc) {
            $doc['status'] = 'completed';
        }
        $_SESSION['all_documents_completed'] = true;
    }
}

$showView = 'default';
if (count($_SESSION['documents']) > 0) {
    $showView = 'with_files';
}
if (isset($_SESSION['all_documents_completed']) && $_SESSION['all_documents_completed']) {
    $showView = 'completed';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teknis - SIBETA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=home" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_mahasiswa.php"; ?>
        <div class="main">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_mahasiswa.php"; ?>
            <div class="p-3">
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
                            <div class="modal fade" id="tambahDokumen" tabindex="-1" aria-labelledby="#tambahDokumenLabel" aria-hidden="true">
                                <form method="POST" enctype="multipart/form-data" class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="tambahDokumenLabel">Tambahkan Dokumen</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="namaDokumen" class="form-label">Nama Dokumen</label>
                                                <select name="namaDokumen" class="form-select" required>
                                                    <option selected>Pilih Dokumen</option>
                                                    <option value="Laporan Tugas Akhir/Skripsi">Laporan Tugas Akhir/Skripsi</option>
                                                    <option value="Buku Panduan Aplikasi">Buku Panduan Aplikasi</option>
                                                    <option value="Surat Pernyataan Publikasi">Surat Pernyataan Publikasi</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="uploadDokumen" class="form-label">Upload Dokumen</label>
                                                <input name="uploadDokumen" class="form-control" type="file" id="uploadDokumen" required>
                                            </div>
                                            <input type="hidden" name="action" value="add_document">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn" style="color:#fff; background-color: #3E368C;">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Buttons and Search Section -->
                            <?php if ($showView !== 'completed'): ?>
                                <div class="d-flex justify-content-between mb-3">
                                    <div class="input-group w-25" style="border-radius: 8px;">
                                        <span class="input-group-text" id="basic-addon1" style="background-color: #FFFFFF;">
                                            <i class="bi bi-search" style="color: #ADB5BD; font-size: 16px;"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Cari dokumen..." aria-label="Sarch" aria-describedby="basic-addon1" style="border-left: none;">
                                        <button class="btn" style="margin-left: 10px; color:#fff; background-color: #3E368C; border-radius: 4px; height: auto;">Cari</button>
                                    </div>
                                    <a href="#" class="btn" style="color:#fff; background-color: #3E368C;" data-bs-toggle="modal" data-bs-target="#tambahDokumen">Tambah Dokumen</a>
                                </div>
                            <?php endif; ?>

                            <?php if ($showView === 'default'): ?>
                                <div class="d-flex justify-content-center py-5">
                                    Tidak ada file untuk ditampilkan
                                </div>
                            <?php elseif ($showView === 'completed'): ?>
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
                                        <?php foreach ($_SESSION['documents'] as $document): ?>
                                            <tr>
                                                <th scope="row"><?php echo $document['id']; ?></th>
                                                <td class="text-truncate" style="max-width: 50px;"><?php echo $document['name']; ?></td>
                                                <td><?php echo $document['upload_date']; ?></td>
                                                <td>
                                                    <a href="<?php echo $document['file_path']; ?>" target="_blank" style="text-decoration: none;">
                                                        <button type="button" class="btn d-flex justify-content-between gap-2" style="color:#FFFFFF; background-color: #3E368C;">
                                                            <span class="material-symbols-outlined" style="font-size: 18px; display: flex; align-items: center; padding-top: 5px;">visibility</span>
                                                            Lihat
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>

                            <?php if ($showView === 'with_files'): ?>
                                <form method="POST">
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
                                            <?php foreach ($_SESSION['documents'] as $document): ?>
                                                <tr>
                                                    <th scope="row"><?php echo $document['id']; ?></th>
                                                    <td class="text-truncate" style="max-width: 50px;"><?php echo $document['name']; ?></td>
                                                    <td><?php echo $document['upload_date']; ?></td>
                                                    <td>
                                                        <div class="aksi">
                                                            <a href="<?php echo $document['file_path']; ?>" target="_blank" style="text-decoration: none;">
                                                                <button type="button" class="btn" style="color:#FFFFFF; background-color: #3E368C;">
                                                                    <span class="material-symbols-outlined" style="color:#FFFFFF; font-size: 18px; padding:5px;">visibility</span>
                                                                </button>
                                                            </a>
                                                            <button type="button" class="btn" style="background-color: #F7BE1A;"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editDokumen"
                                                                data-document-id="<?php echo $document['id']; ?>"
                                                                data-document-name="<?php echo $document['name']; ?>"
                                                                data-document-path="<?php echo $document['file_path']; ?>">
                                                                <span class="material-symbols-outlined" style="color:#FFFFFF; font-size: 18px; padding:5px;">edit</span>
                                                            </button>
                                                            <button type="button" class="btn" style="background-color: #DC3545;"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#hapusDokumen"
                                                                data-document-id="<?php echo $document['id']; ?>"
                                                                data-document-name="<?php echo $document['name']; ?>">
                                                                <span class="material-symbols-outlined" style="color:#FFFFFF; font-size: 18px; padding:5px;">delete</span>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" name="action" value="complete_documents" class="btn" style="color:#fff; background-color: #3E368C;">Simpan</button>
                                    </div>
                                </form>
                            <?php endif; ?>

                            <!-- Edit Document Modal -->
                            <div class="modal fade" id="editDokumen" tabindex="-1" aria-labelledby="editDokumenLabel" aria-hidden="true">
                                <form method="POST" enctype="multipart/form-data" class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="editDokumenLabel">Edit Dokumen</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="action" value="edit_document">
                                            <input type="hidden" name="documentId" id="editDocumentId">
                                            <div class="mb-3">
                                                <label for="namaDokumen" class="form-label">Nama Dokumen</label>
                                                <select name="namaDokumen" class="form-select" id="editNamaDokumen" required>
                                                    <option>Pilih Dokumen</option>
                                                    <option value="Laporan Tugas Akhir/Skripsi">Laporan Tugas Akhir/Skripsi</option>
                                                    <option value="Buku Panduan Aplikasi">Buku Panduan Aplikasi</option>
                                                    <option value="Surat Pernyataan Publikasi">Surat Pernyataan Publikasi</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="uploadDokumen" class="form-label">Upload Dokumen</label>
                                                <input name="uploadDokumen" class="form-control" type="file" id="uploadDokumen">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn" style="color:#fff; background-color: #3E368C;">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Delete Document Modal -->
                            <div class="modal fade" id="hapusDokumen" tabindex="-1" aria-labelledby="hapusDokumenLabel" aria-hidden="true">
                                <form method="POST" class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="hapusDokumenLabel">Hapus Dokumen</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="action" value="delete_document">
                                            <input type="hidden" name="documentId" id="deleteDocumentId">
                                            Apakah Anda yakin ingin menghapus <b id="deleteDocumentName"></b>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn" style="color:#fff; background-color: #DC3545;">Hapus Dokumen</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script to populate edit and delete modals
        document.addEventListener('DOMContentLoaded', function() {
            var editModal = document.getElementById('editDokumen');
            var deleteModal = document.getElementById('hapusDokumen');

            editModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var documentId = button.getAttribute('data-document-id');
                var documentName = button.getAttribute('data-document-name');

                var modalDocumentId = editModal.querySelector('#editDocumentId');
                var modalNamaDokumen = editModal.querySelector('#editNamaDokumen');

                modalDocumentId.value = documentId;
                modalNamaDokumen.value = documentName;
            });

            deleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var documentId = button.getAttribute('data-document-id');
                var documentName = button.getAttribute('data-document-name');

                var modalDocumentId = deleteModal.querySelector('#deleteDocumentId');
                var modalDocumentName = deleteModal.querySelector('#deleteDocumentName');

                modalDocumentId.value = documentId;
                modalDocumentName.textContent = documentName;
            });
        });
    </script>
</body>

</html>