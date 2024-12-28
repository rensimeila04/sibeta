<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Program Studi</title>
</head>

<body>
    <div class="wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_super_admin.php"; ?>
        <div class="main">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_admin.php"; ?>
            <div class="p-4 dashboard">
                <div class="breadcrumbs mb-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Program Studi</span>
                </div>

                <h5>Detail Program Studi</h5>

                <!-- Detail Prodi Section -->
                    <div class="card p-4 mt-4 mb-4" style="width: 1150px;">
                        <div class="card-body ">
                            <form method="POST" action="#">
                                <div class="mb-3 d-flex align-items-center">
                                    <label for="name" class="form-label me-3" style="width: 100px;">ID</label>
                                    <input type="text" class="form-control" id="name" name="name" value="1" disabled style="height: 40px; width: 200px;">
                                </div>
                                <div class="mb-3 d-flex align-items-center">
                                    <label for="nim" class="form-label me-3" style="width: 100px;">Nama</label>
                                    <input type="text" class="form-control" id="nim" value="Teknik Informatika" style="height: 40px; width: 950px;">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-custom">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</body>

</html>