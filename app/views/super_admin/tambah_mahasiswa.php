<?php
$programStudiOptions = $staffController->getProgramStudiOptions();
$kelasOptions = $staffController->getKelasOptions();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa - SIBETA</title>

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

            <div class="p-3 dashboard">
                <div class="breadcrumbs ps-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Dashboard</span>
                </div>

                <h2>Tambah Mahasiswa</h2>
                <div class="container mt-4 px-4">
                    <div class="card p-4">
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
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
                                            <label for="nim">NIM</label>
                                            <input type="text" name="nim" id="nim" class="form-control" placeholder="Masukkan NIM" required oninput="updateUsername()">
                                        </div>

                                        <div class="mb-3">
                                            <label for="kelas">Kelas</label>
                                            <select name="kelas" id="kelas" class="form-control" required>
                                                <option value="">Pilih Kelas</option>
                                                <?php foreach ($kelasOptions as $kelas): ?>
                                                    <option value="<?= htmlspecialchars($kelas['KelasID']) ?>"><?= htmlspecialchars($kelas['NamaKelas']) ?> (<?= htmlspecialchars($kelas['NamaProdi']) ?>)</option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label for="kata_sandi">Kata Sandi</label>
                                            <input type="password" name="kata_sandi" id="kata_sandi" class="form-control" placeholder="Masukkan Kata Sandi" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="konfirmasi_kata_sandi">Konfirmasi Kata Sandi</label>
                                            <input type="password" name="konfirmasi_kata_sandi" id="konfirmasi_kata_sandi" class="form-control" placeholder="Konfirmasi Kata Sandi" required>
                                        </div>

                                        <div class="text-end" style="padding-top: 150px">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(`${fieldId}-icon`);

            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash'); // Icon for visible password
            } else {
                field.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye'); // Icon for hidden password
            }
        }

        function validatePassword() {
            const newPassword = document.getElementById('kata_sandi').value;
            const confirmPassword = document.getElementById('konfirmasi_kata_sandi').value;

            if (newPassword !== confirmPassword) {
                alert('Konfirmasi kata sandi tidak cocok!');
                return false;
            }

            if (newPassword.length < 6) {
                alert('Kata sandi harus minimal 6 karakter!');
                return false;
            }

            return true;
        }

        function updateUsername() {
            const nimInput = document.getElementById('nim');
            const usernameInput = document.getElementById('username');

            // Set username sama dengan NIM
            usernameInput.value = nimInput.value;
        }
    </script>
</body>

</html>