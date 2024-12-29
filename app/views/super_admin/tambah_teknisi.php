<?php
require_once  $_SERVER['DOCUMENT_ROOT'] . '/sibeta/app/controllers/StaffController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'addTeknisi':
                $staffController->addStaff();
                break;
            default:
                header('HTTP/1.0 404 Not Found');
                echo "Action not found";
                break;
        }
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo "Action not specified";
    }
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet" />
    <link rel="stylesheet" href="../../../public/assets/css/dashboard.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIBETA</title>
</head>

<body>
    <div class="wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_super_admin.php"; ?>
        <div class="main">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_super_admin.php"; ?>
            <div class="p-3 dashboard">
                <div class="breadcrumbs ps-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Pengguna</span>
                    <span class="separator">/</span>
                    <span>Teknisi</span>
                    <span class="separator">/</span>
                    <span>Tambah Teknisi</span>
                </div>

                <div class="mx-3 mt-3">
                    <h2>Tambah Teknisi</h2>
                </div>

                <!-- Menampilkan pesan error atau success -->
                <?php
                if (isset($_GET['error'])) {
                    echo '<div class="alert alert-danger mx-3">' . htmlspecialchars($_GET['error']) . '</div>';
                }
                if (isset($_GET['success'])) {
                    echo '<div class="alert alert-success mx-3">' . htmlspecialchars($_GET['success']) . '</div>';
                }
                ?>

                <div class="mt-4 px-3">
                    <div class="card">
                        <div class="card-body">
                            <form action="/sibeta/public/index.php?page=super_admin/insert_teknisi" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="foto_profil">Foto Profil</label>
                                            <input type="file" name="foto_profil" id="foto_profil" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="nip">NIP</label>
                                            <input type="text" name="nip" id="nip" class="form-control" placeholder="Masukkan NIP" required oninput="updateUsername()">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control" readonly>
                                        </div>

                                        <div class="mb-3 password-wrapper">
                                            <label for="kata_sandi">Kata Sandi</label>
                                            <input type="password" name="kata_sandi" id="kata_sandi" class="form-control" placeholder="Kata Sandi Diset Sama Seperti NIP" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label for="konfirmasi_kata_sandi">Konfirmasi Kata Sandi</label>
                                            <input type="password" name="konfirmasi_kata_sandi" id="konfirmasi_kata_sandi" class="form-control" placeholder="Kata Sandi Diset Sama Seperti NIP" readonly>
                                        </div>

                                        <div class="text-end" style="padding-top: 40px">
                                            <button type="submit" class="btn btn-custom">Simpan Perubahan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        function updateUsername() {
            const nipInput = document.getElementById('nip');
            const usernameInput = document.getElementById('username');

            usernameInput.value = nipInput.value;
        }
    </script>
</body>

</html>