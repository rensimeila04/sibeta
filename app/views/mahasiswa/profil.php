<?php
$nim = $_SESSION['nim'];
$mahasiswaController = new MahasiswaController($conn);

$mahasiswaDetails = $mahasiswaController->getMahasiswaInfo($nim);
require_once  $_SERVER['DOCUMENT_ROOT'] . '/sibeta/app/controllers/MahasiswaController.php';

$mahasiswaController = new MahasiswaController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'updateProfile':
                $mahasiswaController->handleUpdateProfile();
                break;
            case 'updatePassword':
                $mahasiswaController->handleUpdatePassword();
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
<html>

<head>
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
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
                    <span>Profil</span>
                </div>

                <h5>Profil Mahasiswa</h5>

                <!-- Profile Mahasiswa Section -->
                <div class="row mb-4 mt-4">
                    <div class="col-md-6">
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <img src="<?php echo '../app/' . $photo_profile_path; ?>" alt="avatar" style="width: 80px; height: 80px;">
                                </div>
                                <form method="POST" action="/sibeta/public/index.php?page=change_mahasiswa_profile">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $mahasiswaDetails['NamaMahasiswa']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nim" class="form-label">NIM</label>
                                        <input type="text" class="form-control" id="nim" value="<?php echo $mahasiswaDetails['NIM']; ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="class" class="form-label">Kelas</label>
                                        <input type="text" class="form-control" id="class" value="<?php echo $mahasiswaDetails['NamaKelas']; ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="program" class="form-label">Program Studi</label>
                                        <input type="text" class="form-control" id="program" value="<?php echo $mahasiswaDetails['NamaProdi']; ?>" disabled>
                                    </div>
                                    <div class="text-center">
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

            if (newPassword.length < 6) {
                alert('Kata sandi harus minimal 6 karakter!');
                return false;
            }

            if (newPassword !== confirmPassword) {
                alert('Konfirmasi kata sandi tidak cocok!');
                return false;
            }

            return true;
        }
    </script>
</body>

</html>