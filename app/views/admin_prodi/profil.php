<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>

<body>
    <div class="wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_admin.php"; ?>
        <div class="main">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_admin.php"; ?>
            <div class="p-4 dashboard">
                <div class="breadcrumbs mb-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="/sibeta/public/index.php?page=<?php echo $role; ?>">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Profil Petugas</span>
                </div>

                <h5>Profil Petugas</h5>

                <!-- Profile admin Section -->
                <div class="row mb-4 mt-4">
                    <div class="col-md-6">
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <img src="<?php echo htmlspecialchars($_SESSION['photo_profile']); ?>" alt="" style="width: 80px; height: 80px;">
                                </div>
                                <form action="/sibeta/public/index.php?page=change_staff_profile" method="post">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="name" id="name" value="<?= $nama ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nip" class="form-label">NIP</label>
                                        <input type="text" class="form-control" name="nip" id="nip" value="<?= $nip ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="role" class="form-label">Peran</label>
                                        <input type="text" class="form-control" id="role" value="<?= $role ?>" disabled>
                                    </div>
                                    <div class="text-center py-3">
                                        <button type="submit" class="btn btn-custom">Simpan Perubahan</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Change Password Section -->
                    <div class="col-md-6">
                        <div class="card p-4">
                            <div class="card-body">
                                <h5 class="card-title text-start mb-4">Ubah Kata Sandi</h5>
                                <form id="change-password-form" action="/sibeta/public/index.php?page=change_staff_password" method="post">
                                    <div class="mb-3 password-wrapper">
                                        <label for="new-password" class="form-label">Kata Sandi Baru</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="new-password" name="new-password" placeholder="Masukkan Kata Sandi Baru">
                                            <span class="input-group-text" onclick="togglePassword('new-password')">
                                                <i class="bi bi-eye" id="new-password-icon"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3 password-wrapper">
                                        <label for="confirm-password" class="form-label">Konfirmasi Kata Sandi</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Konfirmasi Kata Sandi">
                                            <span class="input-group-text" onclick="togglePassword('confirm-password')">
                                                <i class="bi bi-eye" id="confirm-password-icon"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-custom">Ubah Kata Sandi</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function togglePassword(id) {
            const passwordField = document.getElementById(id);
            const icon = document.getElementById(id + '-icon');
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                passwordField.type = "password";
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }

        document.getElementById('change-password-form').addEventListener('submit', function(e) {
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;

            if (newPassword !== confirmPassword) {
                e.preventDefault(); // Cegah form dikirim
                alert('Kata sandi baru dan konfirmasi kata sandi tidak sama.');
            }
        });
    </script>
</body>

</html>