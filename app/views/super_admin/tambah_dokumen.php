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
    <link href="(link unavailable)" rel="stylesheet" />
    <link href="(link unavailable)" rel="stylesheet">
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
                    <span>Tambah Dokumen</span>
                </div>
                <h2>Tambah Dokumen</h2>
                <div class="py-3 mx-2">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            // Display error message if any
                            if (isset($_GET['error'])) {
                                echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($_GET['error']) . '</div>';
                            }
                            // Display success message if any
                            if (isset($_GET['success'])) {
                                echo '<div class="alert alert-success" role="alert">Dokumen berhasil ditambahkan!</div>';
                            }
                            ?>
                            <form action="/sibeta/public/index.php?page=add_dokumen" method="POST">
                                <input type="hidden" name="action" value="add_dokumen">
                                <div class="mb-3">
                                    <label for="namaDokumen" class="form-label">Nama Dokumen</label>
                                    <input type="text" class="form-control" id="namaDokumen" name="namaDokumen" required placeholder="Masukkan nama dokumen">
                                </div>
                                <div class="mb-3">
                                    <label for="tipeDokumen" class="form-label">Jenis Dokumen</label>
                                    <select class="form-select" id="tipeDokumen" name="tipeDokumen" required>
                                        <option value="" selected disabled>Pilih Jenis Dokumen</option>
                                        <option value="Administratif">Administratif</option>
                                        <option value="Teknis">Teknis</option>
                                    </select>
                                    <div class="invalid-feedback">Silakan pilih jenis dokumen.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="isRequired" class="form-label">Wajib?</label>
                                    <select class="form-select" id="isRequired" name="isRequired" required>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-custom">Tambah Dokumen</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>