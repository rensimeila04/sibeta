<?php
// Get document ID from URL
$documentId = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($documentId) {
    try {
        // If form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate and sanitize input
            $namaDokumen = filter_input(INPUT_POST, 'nama_dokumen', FILTER_SANITIZE_STRING);
            $jenis = filter_input(INPUT_POST, 'jenis', FILTER_SANITIZE_STRING);
            $isRequired = filter_input(INPUT_POST, 'is_required', FILTER_VALIDATE_INT);

            // Update document
            $result = $superAdminController->updateJenisDokumen(
                $documentId,
                $namaDokumen,
                $jenis,
                $isRequired
            );

            if ($result) {
                // Redirect with success message
                header('Location: /sibeta/public/index.php?page=super_admin/dokumen&success=update');
                exit;
            } else {
                throw new Exception("Gagal memperbarui dokumen");
            }
        }

        // Get current document data
        $dokumen = $superAdminController->getJenisDokumenById($documentId);
    } catch (Exception $e) {
        echo '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
        $dokumen = null;
    }
} else {
    echo '<div class="alert alert-warning">No document ID provided</div>';
}
?>
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
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_super_admin.php"; ?>

            <div class="p-4 dashboard">
                <div class="breadcrumbs mb-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Dokumen</span>
                    <span class="separator">/</span>
                    <span>Detail Dokumen</span>
                </div>

                <div class="mb-3">
                    <h2>Detail Dokumen</h2>
                </div>

                <div class="container">
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($dokumen['JenisDokumenID'] ?? ''); ?>">

                        <div class="mb-3 d-flex align-items-center">
                            <p class="mb-0" style="width: 30%; white-space: nowrap; margin-left: 20px;">ID</p>
                            <div style="width: 65%;">
                                <input type="number" class="form-control" id="idDokumen" name="id" style="margin-left: 50px;"
                                    value="<?php echo htmlspecialchars($dokumen['JenisDokumenID'] ?? ''); ?>" readonly disabled>
                            </div>
                        </div>

                        <div class="mb-3 d-flex align-items-center">
                            <p class="mb-0" style="width: 30%; white-space: nowrap; margin-left: 20px;">Nama Dokumen</p>
                            <div style="width: 65%;">
                                <input type="text" class="form-control" id="namaDokumen" name="nama_dokumen" required
                                    style="margin-left: 50px; width: 100%;"
                                    value="<?php echo htmlspecialchars($dokumen['NamaDokumen'] ?? ''); ?>">
                            </div>
                        </div>

                        <div class="mb-3 d-flex align-items-center">
                            <p class="mb-0" style="width: 30%; white-space: nowrap; margin-left: 20px;">Jenis Dokumen</p>
                            <div style="width: 65%;">
                                <select class="form-select" id="jenisDokumen" name="jenis" required style="margin-left: 50px; width: 100%;">
                                    <option value="Administratif" <?php echo (isset($dokumen['Tipe']) && $dokumen['Tipe'] == 'Administratif') ? 'selected' : ''; ?>>Administratif</option>
                                    <option value="Teknis" <?php echo (isset($dokumen['Tipe']) && $dokumen['Tipe'] == 'Teknis') ? 'selected' : ''; ?>>Teknis</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 d-flex align-items-center">
                            <p class="mb-0" style="width: 30%; white-space: nowrap; margin-left: 20px;">Wajib</p>
                            <div style="width: 65%;">
                                <select class="form-select" id="isRequired" name="is_required" required style="margin-left: 50px; width: 100%;">
                                    <option value="1" <?php echo (isset($dokumen['IsRequired']) && $dokumen['IsRequired'] == 1) ? 'selected' : ''; ?>>Ya</option>
                                    <option value="0" <?php echo (isset($dokumen['IsRequired']) && $dokumen['IsRequired'] == 0) ? 'selected' : ''; ?>>Tidak</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-custom" style="position: absolute; bottom: 20px; right: 20px;">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>