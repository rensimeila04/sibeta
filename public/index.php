<?php
session_start();

// Load Config & Controller
require_once '../config/database.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/models/UserModel.php';
require_once '../app/controllers/MahasiswaController.php';
require_once '../app/models/MahasiswaModel.php';
require_once '../app/controllers/AdminController.php';
require_once '../app/models/AdminModel.php';
require_once '../app/controllers/TeknisiController.php';
require_once '../app/models/TeknisiModel.php';

// Database connection
$db = new Database();
$conn = $db->getConnection();


// Initialize controllers
$authController = new AuthController($conn);

// Routes
$page = $_GET['page'] ?? 'landing'; // Default page is landing

// Middleware: Cek jika pengguna sudah login untuk halaman tertentu
$protectedPages = ['mahasiswa', 'admin', 'teknisi']; // Halaman yang memerlukan login
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
        $mahasiswaController = new MahasiswaController($conn);
        $documentCounts = $mahasiswaController->getDocumentCounts($nim);
        $documents = $mahasiswaController->getDocuments($nim);
        include '../app/views/mahasiswa/index.php';
        break;

    case 'admin':
        $nama = $_SESSION['nama'];
        $nim = $_SESSION['nip'];
        $photo_profile_path = $_SESSION['photo_profile'];
        $adminController = new AdminController($conn);
        $documentCounts = $adminController->getDocumentCounts();
        $documents = $adminController->getDocuments();
        include '../app/views/admin_prodi/index.php';
        break;

    case 'teknisi':
        $nama = $_SESSION['nama'];
        $nim = $_SESSION['nip'];
        $photo_profile_path = $_SESSION['photo_profile'];
        $teknisiController = new TeknisiController($conn);
        $documentCounts = $teknisiController->getDocumentCounts();
        $documents = $teknisiController->getDocuments();
        include '../app/views/teknisi/index.php';
        break;

    case 'kelola':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $photo_profile_path = $_SESSION['photo_profile'];
        $role = $_SESSION['role'];
        $nim = $_GET['nim'];
        switch ($role) {
            case 'Admin Prodi':
                $adminController = new AdminController($conn);
                $documentsMahasiswa = $adminController->getDocumentMahasiswa($nim);
                include '../app/views/admin_prodi/kelola.php';
                break;
            case 'Teknisi':
                $teknisiController = new TeknisiController($conn);
                $documentsMahasiswa = $teknisiController->getDocumentMahasiswa($nim);
                include '../app/views/teknisi/kelola.php';
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
                        $adminController = new AdminController($conn);
                        $documentsMahasiswa = $adminController->getDocumentMahasiswaByIDDocument($id);
        
                        if ($aksi) {
                            switch ($aksi) {
                                case 'reject':
                                    // Sanitize comment input
                                    $comment = isset($_POST['comment']) ? htmlspecialchars(trim($_POST['comment']), ENT_QUOTES, 'UTF-8') : null;
                                    $adminController->updateDocumentStatus($id, 'reject', $comment);
                                    header('Location: /sibeta/public/index.php?page=kelola&nim=' . urlencode($documentsMahasiswa[0]['Nim']));
                                    exit;
                                case 'verify':
                                    $adminController->updateDocumentStatus($id, 'verify', null);
                                    header('Location: /sibeta/public/index.php?page=kelola&nim=' . urlencode($documentsMahasiswa[0]['Nim']));
                                    exit;
                            }
                        }
        
                        include '../app/views/admin_prodi/verifikasi.php';
                        break;
        
                    case 'Teknisi':
                        $teknisiController = new TeknisiController($conn);
                        $documentsMahasiswa = $teknisiController->getDocumentMahasiswaByIDDocument($id);
        
                        if ($aksi) {
                            switch ($aksi) {
                                case 'reject':
                                    // Sanitize comment input
                                    $comment = isset($_POST['comment']) ? htmlspecialchars(trim($_POST['comment']), ENT_QUOTES, 'UTF-8') : null;
                                    $teknisiController->updateDocumentStatus($id, 'reject', $comment);
                                    header('Location: /sibeta/public/index.php?page=kelola&nim=' . urlencode($documentsMahasiswa[0]['Nim']));
                                    exit;
                                case 'verify':
                                    $teknisiController->updateDocumentStatus($id, 'verify', null);
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
        


    default:
        // Default page if no match
        echo "Halaman tidak ditemukan.";
        break;
}
