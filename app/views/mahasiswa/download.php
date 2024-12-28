<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIBETA</title>
</head>
<body>
    <div class="wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_mahasiswa.php"; ?>
        <div class="main">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_mahasiswa.php"; ?>
            <div class="p-3 dashboard">
                <div class="breadcrumbs">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Dashboard</span>
                </div>
                <!-- Download Section -->
                <div class="card py-3 mt-4">
                    <div class="card-body">
                        <?php
                        try {
                            $allVerified = $mahasiswaController->areAllDocumentsVerified($nim);
                            
                            if ($allVerified) {
                                // Show download card if all documents are verified
                                ?>
                                <div class="text-center">
                                    <h5>Download Surat Bebas Tanggungan</h5>
                                    <p class="text-muted">Unduh Surat Bebas Tanggungan Anda sekarang dengan sekali klik melalui tombol di bawah ini.</p>
                                    <a href="/sibeta/public/index.php?page=generate_surat" target="_blank" class="btn-custom px-3 py-2 align-content-center" style="text-decoration: none;">Download Surat</a>
                                </div>
                                <?php
                            } else {
                                // Show warning if not all documents are verified
                                ?>
                                <div class="alert alert-warning" role="alert">
                                    <h4 class="alert-heading">Perhatian!</h4>
                                    <p>Dokumen Anda belum terverifikasi semua. Harap pastikan semua dokumen administratif dan teknis telah diverifikasi sebelum mengunduh surat bebas tanggungan.</p>
                                    <hr>
                                    <p class="mb-0">Silakan periksa status verifikasi dokumen Anda di menu Dokumen.</p>
                                </div>
                                <?php
                            }
                        } catch (Exception $e) {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Error!</h4>
                                <p><?php echo htmlspecialchars($e->getMessage()); ?></p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>