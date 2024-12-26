<?php
$nim = $_SESSION['nim'];

$mahasiswaController = new MahasiswaController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_document') {
    $jenisDokumenID = $_POST['namaDokumen'];
    $file = $_FILES['uploadDokumen'];

    // Memanggil fungsi uploadDocument dari controller
    $uploadResult = $mahasiswaController->uploadDocument($nim, $jenisDokumenID, $file);
    $uploadStatus = $uploadResult['status'];
    $uploadMessage = $uploadResult['message'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_document') {
    $dokumenID = $_POST['documentId'];
    $nim = $_SESSION['nim'];

    // Memanggil fungsi deleteDocument dari controller
    try {
        $mahasiswaController->deleteDocument($dokumenID, $nim);
        // Redirect atau beri pesan sukses
        header('Location: ' . '/sibeta/public/index.php?page=upload-administratif');
        exit();
    } catch (Exception $e) {
        // Tangani error jika gagal menghapus
        echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save_document') {
    try {
        $updatedRows = $mahasiswaController->updateIsSavedByType($nim, 'Administratif');
        if ($updatedRows > 0) {
            header('Location: ' . '/sibeta/public/index.php?page=upload-administratif&status=saved');
            exit();
        }
    } catch (Exception $e) {
        echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit_document') {
    $dokumenID = $_POST['documentId'];
    $jenisDokumenID = $_POST['namaDokumen'];
    $file = $_FILES['uploadDokumen'];

    try {
        // Check if a file was uploaded
        if ($file['error'] === UPLOAD_ERR_OK) {
            // Generate unique filename
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/uploads/administratif/";
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $uniqueFilename = $nim . '_' . $dokumenID . '_' . time() . '.' . $fileExtension;
            $filePath = "uploads/administratif/" . $uniqueFilename;
            $fullPath = $uploadDir . $uniqueFilename;

            // Create directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Move uploaded file
            if (move_uploaded_file($file['tmp_name'], $fullPath)) {
                // Update document in database
                $updateResult = $mahasiswaController->updateDocument($dokumenID, $jenisDokumenID, $filePath);

                if ($updateResult) {
                    // Redirect with success message
                    header('Location: ' . '/sibeta/public/index.php?page=upload-administratif&status=updated');
                    exit();
                } else {
                    throw new Exception("Gagal memperbarui dokumen di database");
                }
            } else {
                throw new Exception("Gagal mengunggah file");
            }
        } else {
            // If no new file is uploaded, update only the document type
            $updateResult = $mahasiswaController->updateDocument($dokumenID, $jenisDokumenID, null);

            if ($updateResult) {
                // Redirect with success message
                header('Location: ' . '/sibeta/public/index.php?page=upload-administratif&status=updated');
                exit();
            } else {
                throw new Exception("Gagal memperbarui dokumen");
            }
        }
    } catch (Exception $e) {
        // Handle any errors
        $updateError = $e->getMessage();
        // You might want to add error handling logic here
        echo '<div class="alert alert-danger">' . $updateError . '</div>';
    }
}

if (isset($_GET['status'])) {
    $statusMessage = '';
    $statusType = '';

    switch ($_GET['status']) {
        case 'updated':
            $statusMessage = "Dokumen berhasil diperbarui";
            $statusType = 'success';
            break;
    }
}

$documents = $mahasiswaController->getDocumentsByType($nim, 'Administratif');

$documentCounts = $mahasiswaController->getDocumentCountByType($nim, 'Administratif');

$isComplete = $mahasiswaController->isAdministrativeDocumentsComplete($nim);

$jenisDokumen = $mahasiswaController->getJenisDokumen('Administratif');

$saved = false;
foreach ($documents as $document) {
    if ($document['IsSaved'] == 0) {
        $saved = false;
        break;
    } else {
        $saved = true;
    }
}

$showView = 'default';

if ($documentCounts > 0 && !$saved) {
    $showView = 'with_files';
} elseif ($saved) {
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
    <title>Administrasi - SIBETA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=home" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
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
                    <span>Administrasi</span>
                </div>

                <h5 class="mt-3">Unggah Dokumen Administratif</h5>

                <?php if (isset($uploadStatus)): ?>
                    <div class="alert alert-<?php echo $uploadStatus === 'success' ? 'success' : 'danger'; ?>" role="alert">
                        <?php echo $uploadMessage; ?>
                    </div>
                <?php endif; ?>

                <?php
                // Status untuk update dokumen dan operasi lainnya
                if (isset($_GET['status'])):
                    $statusMessage = '';
                    $statusType = '';

                    switch ($_GET['status']) {
                        case 'updated':
                            $statusMessage = "Dokumen berhasil diperbarui";
                            $statusType = 'success';
                            break;
                        case 'deleted':
                            $statusMessage = "Dokumen berhasil dihapus";
                            $statusType = 'success';
                            break;
                        case 'saved':
                            $statusMessage = "Dokumen administratif berhasil disimpan";
                            $statusType = 'success';
                            break;
                        case 'error':
                            $statusMessage = "Terjadi kesalahan. Silakan coba lagi.";
                            $statusType = 'danger';
                            break;
                        default:
                            $statusMessage = "Status tidak dikenali";
                            $statusType = 'warning';
                    }
                ?>
                    <div class="alert alert-<?php echo $statusType; ?>" role="alert">
                        <?php echo $statusMessage; ?>
                    </div>
                <?php endif; ?>

                <div class="py-3">
                    <div class="card">
                        <div class="card-body">
                            <!-- modal tambah dokumen -->
                            <div class="modal fade" id="tambahDokumen" tabindex="-1" aria-labelledby="tambahDokumenLabel" aria-hidden="true">
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
                                                    <?php
                                                    foreach ($jenisDokumen as $dokumen) {
                                                        echo '<option value="' . $dokumen['JenisDokumenID'] . '">' . $dokumen['NamaDokumen'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="uploadDokumen" class="form-label">Upload Dokumen</label>
                                                <input name="uploadDokumen" class="form-control" type="file" id="uploadDokumen" accept=".pdf" required>
                                            </div>
                                            <input type="hidden" name="action" value="add_document">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn-custom align-content-center">Simpan</button>
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
                                        <input type="text" id="searchInput" class="form-control" placeholder="Cari dokumen..." aria-label="Search" aria-describedby="basic-addon1" style="border-left: none;">
                                        <button id="searchButton" class="btn" style="margin-left: 10px; color:#fff; background-color: #3E368C; border-radius: 4px; height: auto;">Cari</button>
                                    </div>
                                    <a href="#" class="btn-custom align-content-center" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#tambahDokumen">Tambah Dokumen</a>
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
                                        <?php $count = 1;
                                        foreach ($documents as $document):
                                            $tanggalUpload = date('d F Y', strtotime($document['TanggalUpload'])); ?>
                                            <tr>
                                                <td scope="row"><?php echo $count; ?></td>
                                                <td class="text-truncate" style="max-width: 50px;"><?php echo $document['NamaDokumen']; ?></td>
                                                <td><?php echo $tanggalUpload; ?></td>
                                                <td>
                                                    <a href="<?php echo '../app/' . $document['FilePath']; ?>" target="_blank" style="text-decoration: none;">
                                                        <button type="button" class="btn-custom px-3">
                                                            <span class="material-symbols-outlined m-0" style="font-size: 18px;">visibility</span>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php $count++;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>

                            <?php if ($showView === 'with_files'): ?>
                                <form method="POST">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col" class="col-nama-dokumen">Nama Dokumen</th>
                                                <th scope="col" class="col-tanggal">Tanggal Upload</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 1;
                                            foreach ($documents as $document):
                                                $tanggalUpload = date('d F Y', strtotime($document['TanggalUpload'])); ?>
                                                <tr>
                                                    <th scope="row"><?php echo $count;
                                                                    $count++; ?></th>
                                                    <td class="text-truncate" style="max-width: 50px;"><?php echo $document['NamaDokumen']; ?></td>
                                                    <td><?php echo $tanggalUpload; ?></td>
                                                    <td>
                                                        <div class="aksi d-flex flex-row gap-4">
                                                            <a href="<?php echo '../app/' . $document['FilePath'] ?>" target="_blank" style="text-decoration: none;" class="align-items-center">
                                                                <button type="button" class="btn-custom px-3 d-flex align-self-center">
                                                                    <span class="material-symbols-outlined m-0" style="font-size: 18px;">visibility</span>
                                                                </button>
                                                            </a>
                                                            <button type="button" class="btn-edit px-3 d-flex align-self-center" style="background-color: #F7BE1A;"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editDokumen"
                                                                data-document-id="<?php echo $document['DokumenID']; ?>"
                                                                data-document-name="<?php echo $document['NamaDokumen']; ?>"
                                                                data-document-type-id="<?php echo $document['JenisDokumenID']; ?>"
                                                                data-document-path="<?php echo '../app/' . $document['FilePath']; ?>">
                                                                <span class="material-symbols-outlined m-0" style="font-size: 18px; color: #fff;">edit</span>
                                                            </button>
                                                            <button type="button" class="btn-hapus px-3 d-flex align-self-center" style="background-color: #DC3545;"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#hapusDokumen"
                                                                data-document-id="<?php echo $document['DokumenID']; ?>"
                                                                data-document-name="<?php echo $document['NamaDokumen']; ?>">
                                                                <span class="material-symbols-outlined m-0" style="color:#FFFFFF; font-size: 18px;">delete</span>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn-custom" id="btnSimpan">Simpan</button>
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
                                                    <option value="">Pilih Dokumen</option>
                                                    <?php
                                                    foreach ($jenisDokumen as $dokumen) {
                                                        $selected = isset($document['JenisDokumenID']) && $document['JenisDokumenID'] == $dokumen['JenisDokumenID'] ? 'selected' : '';
                                                        echo '<option value="' . $dokumen['JenisDokumenID'] . '" ' . $selected . '>' . $dokumen['NamaDokumen'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="uploadDokumen" class="form-label">Upload Dokumen</label>
                                                <input name="uploadDokumen" class="form-control" accept=".pdf" type="file" id="uploadDokumen">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn-custom">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Modal Konfirmasi Simpan -->
                            <div class="modal fade" id="konfirmasiSimpan" tabindex="-1" aria-labelledby="konfirmasiSimpanLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="konfirmasiSimpanLabel">Konfirmasi Simpan</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menyimpan dokumen?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form method="POST" id="saveDocumentForm">
                                                <input type="hidden" name="action" value="save_document">
                                                <button type="submit" class="btn-custom">Ya, Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Status Dokumen -->
                            <div class="modal fade" id="statusDokumen" tabindex="-1" aria-labelledby="statusDokumenLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="statusDokumenLabel">Status Dokumen</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p id="statusDokumenText"></p>
                                        </div>
                                    </div>
                                </div>
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
                                            <button type="submit" class="btn-hapus">Hapus Dokumen</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const searchButton = document.getElementById('searchButton');

            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase();

                // Cari semua tabel yang ada
                const tables = document.querySelectorAll('.table');

                tables.forEach(table => {
                    const tbody = table.querySelector('tbody');
                    if (tbody) {
                        const rows = tbody.querySelectorAll('tr');

                        rows.forEach(row => {
                            const documentName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                            row.style.display = documentName.includes(searchTerm) ? '' : 'none';
                        });
                    }
                });
            }

            // Event listeners
            searchButton.addEventListener('click', performSearch);
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });
            searchInput.addEventListener('input', performSearch);

            // Script untuk edit dan delete modal
            var editModal = document.getElementById('editDokumen');
            var deleteModal = document.getElementById('hapusDokumen');

            editModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var documentId = button.getAttribute('data-document-id');
                var documentName = button.getAttribute('data-document-name');
                var documentTypeId = button.getAttribute('data-document-type-id');

                var modalDocumentId = editModal.querySelector('#editDocumentId');
                var modalNamaDokumen = editModal.querySelector('#editNamaDokumen');

                modalDocumentId.value = documentId;
                modalNamaDokumen.value = documentTypeId;
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

            // Modifikasi event listener untuk tombol Simpan
            document.getElementById('btnSimpan').addEventListener('click', function() {
                const isComplete = <?php echo json_encode($isComplete); ?>;

                // Inisialisasi modal
                const konfirmasiModal = new bootstrap.Modal(document.getElementById('konfirmasiSimpan'));
                const statusModal = new bootstrap.Modal(document.getElementById('statusDokumen'));

                if (!isComplete) {
                    // Jika dokumen belum lengkap, tampilkan modal status
                    document.getElementById('statusDokumenText').textContent = "Dokumen belum lengkap.";
                    statusModal.show();
                } else {
                    // Jika dokumen lengkap, tampilkan modal konfirmasi
                    konfirmasiModal.show();
                }
            });
        });
    </script>
</body>

</html>