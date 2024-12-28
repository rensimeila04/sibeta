<?php
$documentId = $_GET['id'];
$document = $mahasiswaController->getDocumentById($documentId);

$badgeClass = '';
switch ($document['Status']) {
    case 'Diverifikasi':
        $badgeClass = 'bg-success';
        break;
    case 'Diajukan':
        $badgeClass = 'bg-warning';
        break;
    case 'Ditolak':
        $badgeClass = 'bg-danger';
        break;
}

// Handle form submission 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit_document') {
    try {
        $documentId = $_POST['documentId'];
        $filePath = null;

        // Handle file upload
        if (isset($_FILES['uploadDokumen']) && $_FILES['uploadDokumen']['size'] > 0) {
            // Validate file type
            if ($_FILES['uploadDokumen']['type'] !== 'application/pdf') {
                throw new Exception("Hanya file PDF yang diperbolehkan");
            }

            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/sibeta/app/uploads/dokumen/';
            $fileName = $_SESSION['nim'] . '_' . time() . '_' . basename($_FILES['uploadDokumen']['name']);
            $filePath = 'uploads/dokumen/' . $fileName;

            if (!move_uploaded_file($_FILES['uploadDokumen']['tmp_name'], $uploadDir . $fileName)) {
                throw new Exception("Gagal mengunggah file");
            }
        }

        // Update document
        $mahasiswaController->updateDocumentFile($documentId, $filePath);

        // Redirect with success message
        header("Location: /sibeta/public/index.php?page=detail-dokumen-mahasiswa&id=" . $documentId . "&success=1");
        exit();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
        crossorigin="anonymous">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/detail_dokumen.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen - SIBETA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=home" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_mahasiswa.php"; ?>
        <div class="main">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_mahasiswa.php"; ?>
            <div class="dokumen p-3">
                <div class="breadcrumbs">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Dokumen</span>
                    <span class="separator">/</span>
                    <span>Detail Dokumen</span>
                </div>

                <!-- Success/Error Alerts -->
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3" role="alert">
                        Dokumen berhasil diperbarui
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3" role="alert">
                        <?php echo $error; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="py-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Detail Dokumen</h5>
                                <?php if ($document['Status'] == 'Ditolak'): ?>
                                    <button type="button" class="button-edit" data-bs-toggle="modal" data-bs-target="#editDokumen">
                                        <span class="material-symbols-outlined me-2">
                                            edit
                                        </span>
                                        Edit Dokumen
                                    </button>
                                <?php endif; ?>
                            </div>
                            <table class="table table-borderless mb-0 text-start">
                                <tbody>
                                    <tr class="custom-width">
                                        <th scope="row" class="w-25">Nama Dokumen</th>
                                        <td><?php echo $document['NamaDokumen']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Jenis Dokumen</th>
                                        <td><?php echo $document['Tipe']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Status Dokumen</th>
                                        <td>
                                            <span class="badge <?php echo $badgeClass; ?>" style="border-radius: 16px; font-size: 16px; height: 35px; width: 126px; font-weight: 400; padding-top: 7px;">
                                                <?php echo $document['Status']; ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php if ($document['Status'] == 'Ditolak'): ?>
                                        <tr>
                                            <th scope="row">Komentar</th>
                                            <td>
                                                <?php echo $document['KomentarRevisi']; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th scope="row">Dokumen</th>
                                        <td>
                                            <?php echo basename($document['FilePath']); ?>
                                            <a href="<?php echo '../app/' . $document['FilePath']; ?>" class="btn-view" style="text-decoration: none;">
                                                <span class="material-symbols-outlined">visibility</span>Lihat
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- modal edit -->
                <div class="modal fade" id="editDokumen" tabindex="-1" aria-labelledby="editDokumenLabel" aria-hidden="true">
                    <form method="POST" enctype="multipart/form-data" class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editDokumenLabel">Upload Dokumen Baru</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="action" value="edit_document">
                                <input type="hidden" name="documentId" value="<?php echo $documentId; ?>">

                                <div class="mb-3">
                                    <label class="form-label">Nama Dokumen</label>
                                    <p class="form-control-static"><?php echo $document['NamaDokumen']; ?></p>
                                </div>

                                <div class="mb-3">
                                    <label for="uploadDokumen" class="form-label">Upload Dokumen Baru</label>
                                    <input name="uploadDokumen" class="form-control" accept=".pdf" type="file" id="uploadDokumen" required>
                                    <small class="form-text text-muted">File saat ini: <?php echo basename($document['FilePath']); ?></small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn-custom">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>



    </div>
    <!-- <script src="components/sidebar/script.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>