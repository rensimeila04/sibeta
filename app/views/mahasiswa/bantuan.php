<!DOCTYPE html>
<html>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/detail_dokumen.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa</title>
</head>

<body>
    <div class="wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_mahasiswa.php"; ?>
        <div class="main">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_mahasiswa.php"; ?>
            <div class="p-4 dashboard">
                <div class="breadcrumbs mb-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Bantuan</span>
                </div>

                <!-- kerjain disini -->
                <div class="card">
                    <h3 class="text-center mb-2">Mengalami kesulitan?</h3>
                    <div class="text-center mb-2 w-100 d-flex justify-content-center">
                        <p class="text-muted w-50 align-items-center ">Hubungi pihak terkait dengan menggunakan kontak dibawah, pesan Anda akan dibalas di jam kerja</p>
                    </div>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="/sibeta/public/assets/img/whatsapp-logo.png" alt="WhatsApp" class="whatsapp-logo me-3" />
                                        <h5 class="card-title mb-0">Admin Program Studi<br>Teknik Informatika</h5>
                                    </div>
                                    <a href="https://wa.me/6282131596693" class="btn btn-detail mt-3">Hubungi Sekarang</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="/sibeta/public/assets/img/whatsapp-logo.png" alt="WhatsApp" class="whatsapp-logo me-3" />
                                        <h5 class="card-title mb-0">Admin Program Studi<br>Sistem Informasi Bisnis</h5>
                                    </div>
                                    <a href="https://wa.me/6282131596693" class="btn btn-detail mt-3">Hubungi Sekarang</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="/sibeta/public/assets/img/whatsapp-logo.png" alt="WhatsApp" class="whatsapp-logo me-3" />
                                        <h5 class="card-title mb-0">Teknisi Lantai 7</h5>
                                    </div>
                                    <a href="https://wa.me/6282131596693" class="btn btn-detail mt-3">Hubungi Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>