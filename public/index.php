<?php
session_start();

// Load Config & Controller
require_once '../config/database.php';
require_once '../app/autoload.php';

// Database connection
$db = new Database();
$conn = $db->getConnection();


// Initialize controllers
$authController = new AuthController($conn);
$mahasiswaController = new MahasiswaController($conn);
$staffController = new StaffController($conn);
$dokumenController = new DokumenController($conn);

// Routes
$page = $_GET['page'] ?? 'landing'; // Default page is landing
$action = $_GET['action'] ?? '';

if ($action === 'edit') {
    $mahasiswaController->handleUpdateProfile();
}

// Middleware: Cek jika pengguna sudah login untuk halaman tertentu
$protectedPages = ['mahasiswa', 'staff', 'teknisi']; // Halaman yang memerlukan login
if (in_array($page, $protectedPages) && !isset($_SESSION['userID'])) {
    header('Location: /sibeta/public/index.php?page=login');
    exit;
}

switch ($page) {
    case 'landing':
        include '../app/views/landing/index.php';
        break;

    case 'login':
        // Handle login form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $authController->login($username, $password);

            $message = $authController->login($username, $password);
        }
        // Include login view
        include '../app/views/auth/index.php';
        break;

    case 'logout':
        // Logout action
        session_destroy();
        header('Location: /sibeta/public/index.php?page=login');
        break;

    case 'mahasiswa':
        $nama = $_SESSION['nama'];
        $nim = $_SESSION['nim'];
        $photo_profile_path = $_SESSION['photo_profile'];
        $documentCounts = $mahasiswaController->getDocumentCounts($nim);
        $documents = $mahasiswaController->getDocuments($nim);
        include '../app/views/mahasiswa/index.php';
        break;

    case 'admin':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = 'admin';
        $photo_profile_path = $_SESSION['photo_profile'];
        $documentCounts = $dokumenController->getDocumentCounts('Administratif');
        $documents = $dokumenController->getDocuments('Administratif');
        include '../app/views/admin_prodi/index.php';
        break;

    case 'teknisi':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = 'teknisi';
        $photo_profile_path = $_SESSION['photo_profile'];
        $documentCounts = $dokumenController->getDocumentCounts('Teknis');
        $documents = $dokumenController->getDocuments('Teknis');
        include '../app/views/teknisi/index.php';
        break;
    case 'upload-administratif':
        $nama = $_SESSION['nama'];
        $nim = $_SESSION['nim'];
        $photo_profile_path = $_SESSION['photo_profile'];
        include '../app/views/mahasiswa/upload_administratif.php';
        break;
    case 'upload-teknis':
        $nama = $_SESSION['nama'];
        $nim = $_SESSION['nim'];
        $photo_profile_path = $_SESSION['photo_profile'];
        include '../app/views/mahasiswa/upload_teknis.php';
        break;
    case 'dokumen':
        $nama = $_SESSION['nama'];
        $nim = $_SESSION['nim'];
        $photo_profile_path = $_SESSION['photo_profile'];
        include '../app/views/mahasiswa/dokumen.php';
        break;
    case 'detail-dokumen-mahasiswa':
        $nama = $_SESSION['nama'];
        $nim = $_SESSION['nim'];
        $photo_profile_path = $_SESSION['photo_profile'];
        include '../app/views/mahasiswa/detail_dokumen.php';
        break;
    case 'kelola':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = $_SESSION['role'];
        $photo_profile_path = $_SESSION['photo_profile'];

        $currentPage = isset($_GET['page_number']) ? (int)$_GET['page_number'] : 1;
        $itemsPerPage = 10;
        switch ($role) {
            case 'Admin Prodi':
                $role = 'admin';
                $totalDocuments = $dokumenController->getTotalDocuments('Administratif');
                $documents = $dokumenController->getPageDocuments('Administratif', $currentPage, $itemsPerPage);
                include '../app/views/admin_prodi/kelola.php';
                break;
            case 'Teknisi':
                $role = 'teknisi';
                $totalDocuments = $dokumenController->getTotalDocuments('Teknis');
                $documents = $dokumenController->getPageDocuments('Teknis', $currentPage, $itemsPerPage);
                include '../app/views/teknisi/kelola.php';
                break;
        }
        break;

    case 'detail-mahasiswa':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $photo_profile_path = $_SESSION['photo_profile'];
        $role = $_SESSION['role'];
        $nim = $_GET['nim'];
        switch ($role) {
            case 'Admin Prodi':
                $role = 'admin';
                $documentsMahasiswa = $dokumenController->getDocumentMahasiswa($nim, 'Administratif');
                $mahasiswa = $mahasiswaController->getMahasiswaByNIM($nim);
                include '../app/views/admin_prodi/detail_mahasiswa.php';
                break;
            case 'Teknisi':
                $role = 'teknisi';
                $documentsMahasiswa = $dokumenController->getDocumentMahasiswa($nim, 'Teknis');
                $mahasiswa = $mahasiswaController->getMahasiswaByNIM($nim);
                include '../app/views/teknisi/detail_mahasiswa.php';
                break;
        }
        break;

    case 'verifikasi':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $photo_profile_path = $_SESSION['photo_profile'];
        $role = $_SESSION['role'];
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT); // Sanitizing ID as a number
        $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : ''; // No sanitization needed for 'aksi' since it's a simple action

        if ($id && $role) {
            switch ($role) {
                case 'Admin Prodi':
                    $role = 'admin';
                    $documentsMahasiswa = $dokumenController->getDocumentMahasiswaByIDDocument($id, 'Administratif');

                    if ($aksi) {
                        switch ($aksi) {
                            case 'reject':
                                // Sanitize comment input
                                $comment = isset($_POST['comment']) ? htmlspecialchars(trim($_POST['comment']), ENT_QUOTES, 'UTF-8') : null;
                                $dokumenController->updateDocumentStatus($id, $nip, 'Ditolak', $comment);
                                $file = basename($documentsMahasiswa[0]['FilePath']);
                                header('Location: /sibeta/public/index.php?page=kelola&nim=' . urlencode($documentsMahasiswa[0]['Nim']));
                                exit;
                            case 'verify':
                                $dokumenController->updateDocumentStatus($id, $nip, 'Diverifikasi', null);
                                $file = basename($documentsMahasiswa[0]['FilePath']);
                                header('Location: /sibeta/public/index.php?page=kelola&nim=' . urlencode($documentsMahasiswa[0]['Nim']));
                                exit;
                        }
                    }

                    include '../app/views/admin_prodi/verifikasi.php';
                    break;

                case 'Teknisi':
                    $role = 'teknisi';
                    $documentsMahasiswa = $dokumenController->getDocumentMahasiswaByIDDocument($id, 'Teknis');

                    if ($aksi) {
                        switch ($aksi) {
                            case 'reject':
                                // Sanitize comment input
                                $comment = isset($_POST['comment']) ? htmlspecialchars(trim($_POST['comment']), ENT_QUOTES, 'UTF-8') : null;
                                $dokumenController->updateDocumentStatus($id, $nip, 'Ditolak', $comment);
                                $file = basename($documentsMahasiswa[0]['FilePath']);
                                header('Location: /sibeta/public/index.php?page=kelola&nim=' . urlencode($documentsMahasiswa[0]['Nim']));
                                exit;
                            case 'verify':
                                $dokumenController->updateDocumentStatus($id, $nip, 'Diverifikasi', null);
                                $file = basename($documentsMahasiswa[0]['FilePath']);
                                header('Location: /sibeta/public/index.php?page=kelola&nim=' . urlencode($documentsMahasiswa[0]['Nim']));
                                exit;
                        }
                    }

                    include '../app/views/teknisi/verifikasi.php';
                    break;
            }
        } else {
            header('Location: /sibeta/public/index.php?page=error');
            exit;
        }
        break;

    case 'profile_staff':
        $nip = $_SESSION['nip'];
        $staff = $staffController->getStaff($nip);
        switch ($staff['RoleName']) {
            case 'Admin Prodi':
                $nama = $staff['Nama'];
                $nip = $staff['NIP'];
                $role = 'admin';
                include '../app/views/admin_prodi/profil.php';
                break;
            case 'Teknisi':
                $nama = $staff['Nama'];
                $nip = $staff['NIP'];
                $role = 'teknisi';
                include '../app/views/teknisi/profil.php';
                break;
        }
        break;

    case 'change_staff_profile':
        $nama = $_POST['name'];
        $nipChange = $_POST['nip'];
        $nip = $_SESSION['nip'];
        $result = $staffController->getStaff($nip);
        $userid = $result['UserID'];
        $resultUpdate = $staffController->updateStaffProfile($userid, $nama, $nipChange);
        if ($resultUpdate) {
            $_SESSION['nama'] = $nama;
            $_SESSION['nip'] = $nipChange; // Update session jika berhasil
            header('Location: /sibeta/public/index.php?page=profile_staff');
            exit;
        } else {
            echo "Update gagal.";
        }
        break;

    case 'change_staff_password':
        $password = $_POST['password'];
        $nip = $_SESSION['nip'];
        $result = $staffController->getStaff($nip);
        $userid = $result['UserID'];
        $staffController->updateStaffPassword($userid, $password);
        header('Location: /sibeta/public/index.php?page=profile_staff');
        break;
        exit;


    case 'riwayat_staff':
        $nip = $_SESSION['nip'];
        $staff = $staffController->getStaff($nip);

        $currentPage = isset($_GET['page_number']) ? (int)$_GET['page_number'] : 1;
        $itemsPerPage = 10;
        switch ($staff['RoleName']) {
            case 'Admin Prodi':
                $nama = $staff['Nama'];
                $nip = $staff['NIP'];
                $role = 'admin';
                $totalDocuments = $dokumenController->getTotalDocuments('Administratif');
                $documents = $dokumenController->getPageDocuments('Administratif', $currentPage, $itemsPerPage);
                include '../app/views/admin_prodi/riwayat.php';
                break;
            case 'Teknisi':
                $nama = $staff['Nama'];
                $nip = $staff['NIP'];
                $role = 'teknisi';
                $totalDocuments = $dokumenController->getTotalDocuments('Administratif');
                $documents = $dokumenController->getPageDocuments('Administratif', $currentPage, $itemsPerPage);
                include '../app/views/teknisi/riwayat.php';
                break;
        }
        break;

    case 'detail_riwayat_mahasiswa':
        $nim = $_GET['nim'];
        $nip = $_SESSION['nip'];
        $mahasiswa = $mahasiswaController->getMahasiswaByNIM($nim);
        $staff = $staffController->getStaff($nip);
        switch ($staff['RoleName']) {
            case 'Admin Prodi':
                $nama = $staff['Nama'];
                $documentsMahasiswa = $dokumenController->getDocumentMahasiswa($nim, 'Administratif');
                $role = 'admin';
                include '../app/views/admin_prodi/detail_riwayat_mahasiswa.php';
                break;
            case 'Teknisi':
                $nama = $staff['Nama'];
                $documentsMahasiswa = $dokumenController->getDocumentMahasiswa($nim, 'Administratif');
                $role = 'teknisi';
                include '../app/views/teknisi/detail_riwayat_mahasiswa.php';
                break;
        }
        break;
    case 'updatePassword':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mahasiswaController = new MahasiswaController($conn);
            try {
                $newPassword = $_POST['newPassword'] ?? '';
                $confirmPassword = $_POST['confirmPassword'] ?? '';

                // Debug
                error_log("Received password update request");

                if (empty($newPassword) || empty($confirmPassword)) {
                    throw new Exception("Password fields cannot be empty");
                }

                if ($newPassword !== $confirmPassword) {
                    throw new Exception("Passwords do not match");
                }

                if (!isset($_SESSION['nim'])) {
                    throw new Exception("User not logged in");
                }

                $mahasiswaController->handleUpdatePassword();
            } catch (Exception $e) {
                error_log("Password update error: " . $e->getMessage());
                header('Location: /sibeta/public/index.php?page=profil_mahasiswa&error=' . urlencode($e->getMessage()));
                exit();
            }
        }
        break;
    case 'profil_mahasiswa':
        $nama = $_SESSION['nama'];
        $nim = $_SESSION['nim'];
        $photo_profile_path = $_SESSION['photo_profile'];
        include '../app/views/mahasiswa/profil.php';
        break;
    case 'bantuan':
        $nama = $_SESSION['nama'];
        $nim = $_SESSION['nim'];
        $photo_profile_path = $_SESSION['photo_profile'];
        include '../app/views/mahasiswa/bantuan.php';
        break;

    default:
        echo "Halaman tidak ditemukan.";
        break;
}
