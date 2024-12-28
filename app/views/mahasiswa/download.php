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
                        <div class="text-center">
                            <h5>Download Surat Bebas Tanggungan</h5>
                            <p class="text-muted">Unduh Surat Bebas Tanggungan Anda sekarang dengan sekali klik melalui tombol di bawah ini.</p>
                            <a href="#" target="_blank" class="btn-custom px-3 py-2 align-content-center" style="text-decoration: none;">Download Surat</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</body>

</html>