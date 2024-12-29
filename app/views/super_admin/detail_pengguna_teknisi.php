<?php
$nip = $teknisi['NIP'];
$staffController = new StaffController($conn);

$staffDetails = $staffController->getStaff($nip);
require_once  $_SERVER['DOCUMENT_ROOT'] . '/sibeta/app/controllers/StaffController.php';

$staffController = new StaffController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'updateProfile':
                $staffController->handleUpdateProfileSuperAdmin();
                break;
            case 'updatePassword':
                $staffController->handleUpdatePasswordSuperAdmin();
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
<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">
        <?php
        if ($_GET['success'] === 'updateProfile') echo "Profil berhasil diperbarui!";
        if ($_GET['success'] === 'updatePassword') echo "Kata sandi berhasil diubah!";
        ?>
    </div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger">
        <?php echo htmlspecialchars($_GET['error']); ?>
    </div>
<?php endif; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/assets/css/dashboard.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Teknisi</title>
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
                    <span>Teknisi</span>
                    <span class="separator">/</span>
                    <span>Detail Teknisi</span>
                </div>

                <div class="px-3 mt-3">
                    <h5>Detail Teknisi</h5>
                </div>

                <!-- Profil Mahasiswa -->
                <div class="row mb-4 mt-2">
                    <div class="col-md-6">
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <img src="<?php echo '../app/' . $teknisi['photo_profile_path']; ?>" alt="avatar" style="width: 80px; height: 80px;">
                                </div>
                                <div class="mb-3 text-center">
                                    <form method="POST" action="/sibeta/public/index.php?page=change_profile_photo&id=<?= $teknisi['UserID']; ?>" enctype="multipart/form-data" id="changePhotoForm">
                                        <input type="file" id="photoInput" name="foto_profil" accept="image/*" style="display: none;" onchange="submitPhotoForm()">
                                        <button type="button" class="btn btn-custom mt-2" onclick="triggerPhotoUpload()">Ganti Foto Profil</button>
                                    </form>
                                </div>
                                <form method="POST" action="/sibeta/public/index.php?page=super_admin/change_staff_profile&id=<?= $teknisi['UserID']; ?>">

                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="<?= $teknisi['Username']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?= $teknisi['Nama']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nip" class="form-label">NIP</label>
                                        <input type="text" name = "nip" class="form-control" id="nip" value="<?= $teknisi['NIP']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role</label>
                                        <input type="text" name = "role" class="form-control" id="role" value="<?= $teknisi['RoleName']; ?>">
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-custom">Ubah Profil</button>
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
                                <form method="POST" action="/sibeta/public/index.php?page=super_admin/update_password_staff&id=<?= $teknisi['UserID']; ?>" id="passwordForm" onsubmit="return validatePassword()">
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
    <script>
        function triggerPhotoUpload() {
            // Memicu klik pada input file yang tersembunyi
            document.getElementById('photoInput').click();
        }

        function submitPhotoForm() {
            // Submit form setelah pengguna memilih file
            document.getElementById('changePhotoForm').submit();
        }
    </script>
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
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            
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
    </script>
</body>

</html>