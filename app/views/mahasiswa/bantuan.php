<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../components/sidebar_mahasiswa.html">
    <link rel="stylesheet" href="../components/header_mahasiswa.html">
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa</title>
</head>

<body>
    <div class="wrapper">
        <?php
        include '../components/sidebar_mahasiswa.html';
        ?>
        <div class="main">
            <?php
            include '../components/header_mahasiswa.html';
            ?>
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
                                <img src="whatsapp-logo.png" alt="WhatsApp" class="whatsapp-logo me-3" />
                                    <h5 class="card-title mb-0">Admin Program Studi<br>Teknik Informatika</h5>
                                </div>
                                <a href="#" class="btn btn-detail mt-3">Hubungi Sekarang</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-center">
                                <img src="whatsapp-logo.png" alt="WhatsApp" class="whatsapp-logo me-3" />
                                    <h5 class="card-title mb-0">Admin Program Studi<br>Sistem Informasi Bisnis</h5>
                                </div>
                                <a href="#" class="btn btn-detail mt-3">Hubungi Sekarang</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-center">
                                <img src="whatsapp-logo.png" alt="WhatsApp" class="whatsapp-logo me-3" />
                                    <h5 class="card-title mb-0">Teknisi Lantai 7</h5>
                                </div>
                                <a href="#" class="btn btn-detail mt-3">Hubungi Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>
