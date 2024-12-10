<?php
session_start();

// Load Config & Controller
require_once '../config/database.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/models/UserModel.php';
require_once '../app/controllers/MahasiswaController.php';
require_once '../app/models/MahasiswaModel.php';

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

        $nim = $_SESSION['nim'];
        $mahasiswaController = new MahasiswaController($conn);

        $documentCounts = $mahasiswaController->getDocumentCounts($nim);

        $documents = $mahasiswaController->getDocuments($nim);

        
        include '../app/views/mahasiswa/index.php';
        break;

    case 'admin':
        include '../app/views/admin_prodi/index.php';
        break;

    case 'teknisi':
        include '../app/views/teknisi/index.php';
        break;
    case 'upload-administratif':
        include '../app/views/mahasiswa/upload_administratif.php';
        break;
    case 'upload-teknis':
        include '../app/views/mahasiswa/upload_teknis.php';
        break;
    case 'dokumen':
        include '../app/views/mahasiswa/dokumen.php';

    default:
        echo "Halaman tidak ditemukan.";
        break;
}
