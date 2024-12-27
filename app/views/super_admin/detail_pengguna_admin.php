<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="../../../public/assets/css/dashboard.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin</title>
</head>

<body>
    <div class="wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_super_admin.php"; ?>
        
        <div class="main">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_admin.php"; ?>

            <div class="p-3 dashboard">
                <div class="breadcrumbs ps-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Profil</span>
                </div>

                <h5>Detail Admin</h5>

                <!-- Profil Mahasiswa -->
                <div class="row mb-4 mt-4">
                    <div class="col-md-6">
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <img src="<?php echo '../app/' . $photo_profile_path; ?>" alt="avatar" style="width: 80px; height: 80px;">
                                </div>
                                <form method="POST" action="/sibeta/public/index.php?page=change_mahasiswa_profile">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="0987654321">
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name" value="Budiono">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nip" class="form-label">NIP</label>
                                        <input type="text" class="form-control" id="nip" value="0987654321">
                                    </div>
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role</label>
                                        <input type="text" class="form-control" id="role" value="Admin">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Ubah Kata Sandi -->
                    <div class="col-md-6">
                        <div class="card p-4">
                            <div class="card-body">
                                <h5 class="card-title text-start mb-4">Ubah Kata Sandi</h5>
                                <form method="POST" action="/sibeta/public/index.php?page=updatePassword" id="passwordForm" onsubmit="return validatePassword()">
                                    <div class="mb-3 password-wrapper">
                                        <label for="new-password" class="form-label">Kata Sandi Baru</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="new-password" name="newPassword" required placeholder="Masukkan Kata Sandi Baru">
                                            <span class="input-group-text" onclick="togglePassword('new-password')">
                                                <i class="bi bi-eye" id="new-password-icon"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3 password-wrapper">
                                        <label for="confirm-password" class="form-label">Konfirmasi Kata Sandi</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="confirm-password" name="confirmPassword" required placeholder="Konfirmasi Kata Sandi">
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
</body>

</html>