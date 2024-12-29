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
                    <span class="separator">/</span>
                    <span>Tambah Dokumen</span>
                </div>
                <div class="mb-3">
                    <h2>Tambah Dokumen</h2>
                </div>
            </div>

            <div class="container">
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

                <!-- Form Inputan untuk Nama Dokumen dan Jenis Dokumen -->
                <form action="/sibeta/public/index.php?page=add_dokumen" method="POST">
                    <!-- Hidden input for handling the form submission -->
                    <input type="hidden" name="action" value="add_dokumen">

                    <div class="mb-3 d-flex align-items-center">
                        <p class="mb-0" style="width: 30%; white-space: nowrap; margin-left: 20px;">Nama Dokumen</p>
                        <div style="width: 100%;">
                            <input type="text" class="form-control" id="namaDokumen" name="namaDokumen" required
                                style="margin-left: 50px; width: 100%;" placeholder="Masukkan nama dokumen">
                        </div>
                    </div>

                    <div class="mb-3 d-flex align-items-center">
                        <p class="mb-0" style="width: 30%; white-space: nowrap; margin-left: 20px;">Jenis Dokumen</p>
                        <div style="width: 65%;">
                            <select class="form-select" id="tipeDokumen" name="tipeDokumen" required
                                style="margin-left: 50px; width: 100%;">
                                <option value="Administratif">Administratif</option>
                                <option value="Teknis">Teknis</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 d-flex align-items-center">
                        <p class="mb-0" style="width: 30%; white-space: nowrap; margin-left: 20px;">Wajib?</p>
                        <div style="width: 65%;">
                            <select class="form-select" id="isRequired" name="isRequired" required
                                style="margin-left: 50px; width: 100%;">
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-custom"
                        style="position: absolute; bottom: 20px; right: 20px;">
                        Tambah Dokumen
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>