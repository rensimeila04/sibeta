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
        $currentPage = isset($_GET['page_number']) ? (int)$_GET['page_number'] : 1;
        $itemsPerPage = 10;
        $totalDocuments = $dokumenController->getTotalDocuments('Administratif');
        $documents = $dokumenController->getPageDocuments('Administratif', $currentPage, $itemsPerPage);
        include '../app/views/admin_prodi/index.php';
        break;

    case 'teknisi':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = 'teknisi';
        $photo_profile_path = $_SESSION['photo_profile'];
        $documentCounts = $dokumenController->getDocumentCounts('Teknis');
        $currentPage = isset($_GET['page_number']) ? (int)$_GET['page_number'] : 1;
        $itemsPerPage = 10;
        $totalDocuments = $dokumenController->getTotalDocuments('Teknis');
        $documents = $dokumenController->getPageDocuments('Teknis', $currentPage, $itemsPerPage);
        include '../app/views/teknisi/index.php';
        break;
    case 'super_admin':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = 'super admin';
        $photo_profile_path = $_SESSION['photo_profile'];
        include '../app/views/super_admin/index.php';
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
    case 'download-surat':
        $nama = $_SESSION['nama'];
        $nim = $_SESSION['nim'];
        $photo_profile_path = $_SESSION['photo_profile'];
        include '../app/views/mahasiswa/download.php';
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

        $currentPage = isset($_GET['page_number']) ? (int)$_GET['page_number'] : 1;
        $itemsPerPage = 10;
        switch ($role) {
            case 'Admin Prodi':
                $role = 'admin';
                $totalDocuments = $dokumenController->getTotalDocuments('Administratif');
                $documentsMahasiswa = $dokumenController->getPageDocumentsMahasiswa($nim, 'Administratif', $currentPage, $itemsPerPage);
                $mahasiswa = $mahasiswaController->getMahasiswaByNIM($nim);
                include '../app/views/admin_prodi/detail_mahasiswa.php';
                break;
            case 'Teknisi':
                $role = 'teknisi';
                $totalDocuments = $dokumenController->getTotalDocuments('Teknis');
                $documentsMahasiswa = $dokumenController->getPageDocumentsMahasiswa($nim, 'Teknis', $currentPage, $itemsPerPage);
                $mahasiswa = $mahasiswaController->getMahasiswaByNIM($nim);
                include '../app/views/teknisi/detail_mahasiswa.php';
                break;
        }
        break;
    case 'program_studi':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = $_SESSION['role'];
        include '../app/views/super_admin/program_studi.php';
        break;
    case 'detail_program_studi':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = $_SESSION['role'];
        include '../app/views/super_admin/detail_program_studi.php';
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

                case 'Super Admin':
                    $role = 'super_admin';
                    $documentsMahasiswa = $dokumenController->getDocumentMahasiswaByIDDocument($id, 'Administratif');
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
        $photo_profile_path = $_SESSION['photo_profile'];
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
        try {
            $result = $staffController->handleUpdateProfileName();
            if ($result) {
                header('Location: /sibeta/public/index.php?page=profile_staff&success=updateProfile');
            } else {
                header('Location: /sibeta/public/index.php?page=profile_staff&error=Update gagal');
            }
        } catch (Exception $e) {
            header('Location: /sibeta/public/index.php?page=profile_staff&error=' . urlencode($e->getMessage()));
        }
        exit;
        break;

    case 'change_staff_password':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $staffController = new StaffController($conn);
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

                if (!isset($_SESSION['nip'])) {
                    throw new Exception("User not logged in");
                }

                $staffController->handleUpdatePassword();
            } catch (Exception $e) {
                error_log("Password update error: " . $e->getMessage());
                header('Location: /sibeta/public/index.php?page=profile_staff&error=' . urlencode($e->getMessage()));
                exit();
            }
        }
        break;


    case 'riwayat_staff':
        $nip = $_SESSION['nip'];
        $staff = $staffController->getStaff($nip);
        $photo_profile_path = $_SESSION['photo_profile'];

        $currentPage = isset($_GET['page_number']) ? (int)$_GET['page_number'] : 1;
        $itemsPerPage = 10;
        switch ($staff['RoleName']) {
            case 'Admin Prodi':
                $nama = $staff['Nama'];
                $nip = $staff['NIP'];
                $role = 'admin';
                $totalDocuments = $dokumenController->getTotalDocuments('Administratif');
                $documents = $dokumenController->getPageDocumentsRiwayat('Administratif', $currentPage, $itemsPerPage);
                include '../app/views/admin_prodi/riwayat.php';
                break;
            case 'Teknisi':
                $nama = $staff['Nama'];
                $nip = $staff['NIP'];
                $role = 'teknisi';
                $totalDocuments = $dokumenController->getTotalDocuments('Teknis');
                $documents = $dokumenController->getPageDocumentsRiwayat('Teknis', $currentPage, $itemsPerPage);
                include '../app/views/teknisi/riwayat.php';
                break;
        }
        break;

    case 'detail_riwayat_mahasiswa':
        $nim = $_GET['nim'];
        $nip = $_SESSION['nip'];
        $mahasiswa = $mahasiswaController->getMahasiswaByNIM($nim);
        $staff = $staffController->getStaff($nip);
        $photo_profile_path = $_SESSION['photo_profile'];

        $currentPage = isset($_GET['page_number']) ? (int)$_GET['page_number'] : 1;
        $itemsPerPage = 10;
        switch ($staff['RoleName']) {
            case 'Admin Prodi':
                $nama = $staff['Nama'];
                $role = 'admin';
                $totalDocuments = $dokumenController->getTotalDocumentsMahasiswa($nim, 'Administratif');
                $documentsMahasiswa = $dokumenController->getPageDocumentsMahasiswa($nim, 'Administratif', $currentPage, $itemsPerPage);
                include '../app/views/admin_prodi/detail_riwayat_mahasiswa.php';
                break;
            case 'Teknisi':
                $nama = $staff['Nama'];
                $role = 'teknisi';
                $totalDocuments = $dokumenController->getTotalDocumentsMahasiswa($nim, 'Teknis');
                $documentsMahasiswa = $dokumenController->getPageDocumentsMahasiswa($nim, 'Teknis', $currentPage, $itemsPerPage);
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
    case 'change_mahasiswa_profile':
        try {
            $result = $mahasiswaController->handleUpdateProfileName();
            if ($result) {
                header('Location: /sibeta/public/index.php?page=profil_mahasiswa&success=updateProfile');
            } else {
                header('Location: /sibeta/public/index.php?page=profil_mahasiswa&error=Update gagal');
            }
        } catch (Exception $e) {
            header('Location: /sibeta/public/index.php?page=profil_mahasiswa&error=' . urlencode($e->getMessage()));
        }
        exit;
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
    case 'generate_surat':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = 'super admin';
        $photo_profile_path = $_SESSION['photo_profile'];
        include '../app/views/mahasiswa/generate_surat.php';
        break;
    case 'super_admin/mahasiswa':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = 'super admin';
        $photo_profile_path = $_SESSION['photo_profile'];
        include '../app/views/super_admin/mahasiswa.php';
        break;
    case 'super_admin/admin':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = 'super admin';
        $photo_profile_path = $_SESSION['photo_profile'];
        $admin = $staffController->getAllStaffByRole('Admin Prodi');
        include '../app/views/super_admin/admin.php';
        break;
    case 'super_admin/teknisi':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = 'super admin';
        $photo_profile_path = $_SESSION['photo_profile'];
        $teknisi = $staffController->getAllStaffByRole('Teknisi');
        include '../app/views/super_admin/teknisi.php';
        break;
    case 'super_admin/kelas':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = 'super admin';
        $photo_profile_path = $_SESSION['photo_profile'];
        include '../app/views/super_admin/kelas.php';
        break;
    case 'super_admin/prodi':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = 'super admin';
        $photo_profile_path = $_SESSION['photo_profile'];
        include '../app/views/super_admin/program_studi.php';
        break;
    case 'super_admin/dokumen':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = 'super admin';
        $photo_profile_path = $_SESSION['photo_profile'];
        include '../app/views/super_admin/dokumen.php';
        break;
    case 'super_admin/tambah_admin':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = 'super admin';
        $photo_profile_path = $_SESSION['photo_profile'];
        include '../app/views/super_admin/tambah_admin.php';
        break;
    case 'super_admin/insert_admin':
        try {
            $result = $staffController->addStaff('Admin Prodi');
            if ($result) {
                header('Location: /sibeta/public/index.php?page=super_admin/tambah_admin&success=Admin Berhasil Ditambahkan');
            } else {
                header('Location: /sibeta/public/index.php?page=super_admin/tambah_admin&error=Gagal Menambahkan Admin');
            }
        } catch (Exception $e) {
            header('Location: /sibeta/public/index.php?page=super_admin/tambah_admin&error=' . urlencode($e->getMessage()));
        }
        exit;
        break;
    case 'super_admin/change_staff_profile':
        $user = $authController->getUserByID($_GET['id']);
        try {
            $result = $staffController->handleUpdateProfileSuperAdmin();

            if ($result) {
                switch ($user['RoleID']) {
                    case 2:
                        $admin = $staffController->getStaffByID($_GET['id']);
                        header('Location: /sibeta/public/index.php?page=super_admin/detail_admin&nip=' . $admin['NIP'] . '&success=updateProfile');
                        break;
                    case 3:
                        $teknisi = $staffController->getStaffByID($_GET['id']);
                        header('Location: /sibeta/public/index.php?page=super_admin/detail_teknisi&nip=' . $teknisi['NIP'] . '&success=updateProfile');
                        break;
                }
            }
        } catch (Exception $e) {
            switch ($user['RoleID']) {
                case 2:
                    $admin = $staffController->getStaffByID($_GET['id']);
                    header('Location: /sibeta/public/index.php?page=super_admin/detail_admin&nip=' . $admin['NIP'] . '&error=Gagal Mengubah Profil : ' . urlencode($e->getMessage()));
                    break;
                case 3:
                    $teknisi = $staffController->getStaffByID($_GET['id']);
                    header('Location: /sibeta/public/index.php?page=super_admin/detail_teknisi&nip=' . $teknisi['NIP'] . '&error=Gagal Mengubah Profil : ' . urlencode($e->getMessage()));
                    break;
            }
        }
        exit;
        break;
    case 'super_admin/update_password_staff':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $staffController = new StaffController($conn);
            $staff = $staffController->getStaffByID($_GET['id']);
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

                if (!isset($_SESSION['nip'])) {
                    throw new Exception("User not logged in");
                }

                $staffController->handleUpdatePasswordSuperAdmin();
            } catch (Exception $e) {
                switch ($staff['RoleID']) {
                    case 2:
                        $admin = $staffController->getStaffByID($_GET['id']);
                        header('Location: /sibeta/public/index.php?page=super_admin/detail_admin&nip=' . $admin['NIP'] . '&error=Gagal Mengubah Password : ' . urlencode($e->getMessage()));
                        break;
                    case 3:
                        $teknisi = $staffController->getStaffByID($_GET['id']);
                        header('Location: /sibeta/public/index.php?page=super_admin/detail_teknisi&nip=' . $teknisi['NIP'] . '&error=Gagal Mengubah Password : ' . urlencode($e->getMessage()));
                        break;
                }
                exit();
            }
        }
        break;

    case 'super_admin/tambah_teknisi':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = 'super admin';
        $photo_profile_path = $_SESSION['photo_profile'];
        include '../app/views/super_admin/tambah_teknisi.php';
        break;
    case 'super_admin/insert_teknisi':
        try {
            $result = $staffController->addStaff('Teknisi');
            if ($result) {
                header('Location: /sibeta/public/index.php?page=super_admin/tambah_teknisi&success=Teknisi Berhasil Ditambahkan');
            } else {
                header('Location: /sibeta/public/index.php?page=super_admin/tambah_teknisi&error=Gagal Menambahkan Teknisi');
            }
        } catch (Exception $e) {
            header('Location: /sibeta/public/index.php?page=super_admin/tambah_teknisi&error=' . urlencode($e->getMessage()));
        }
        exit;
        break;

    case 'super_admin/tambah_dokumen':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = 'super admin';
        $photo_profile_path = $_SESSION['photo_profile'];
        include '../app/views/super_admin/tambah_dokumen.php';
        break;
    case 'super_admin/tambah_mahasiswa':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = 'super admin';
        $photo_profile_path = $_SESSION['photo_profile'];
        include '../app/views/super_admin/tambah_mahasiswa.php';
        break;
    case 'super_admin/detail_mahasiswa':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = 'super admin';
        $photo_profile_path = $_SESSION['photo_profile'];
        include '../app/views/super_admin/detail_pengguna_mahasiswa.php';
        break;
    case 'super_admin/detail_admin':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = 'super admin';

        $nipAdmin = $_GET['nip'];
        $admin = $staffController->getStaff($nipAdmin);

        $photo_profile_path = $_SESSION['photo_profile'];
        include '../app/views/super_admin/detail_pengguna_admin.php';
        break;
    case 'super_admin/detail_teknisi':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = 'super admin';

        $nipTeknisi = $_GET['nip'];
        $teknisi = $staffController->getStaff($nipTeknisi);

        $photo_profile_path = $_SESSION['photo_profile'];
        include '../app/views/super_admin/detail_pengguna_teknisi.php';
        break;
    case 'super_admin/detail_kelas':
        $nama = $_SESSION['nama'];
        $nip = $_SESSION['nip'];
        $role = 'super admin';
        $photo_profile_path = $_SESSION['photo_profile'];
        include '../app/views/super_admin/detail_kelas.php';
        break;
    case 'change_profile_photo':
        try {
            $result = $authController->handleUpdateProfilePhoto();
            $user = $authController->getUserByID($_GET['id']);
            if ($result) {
                switch ($user['RoleID']) {
                    case 2:
                        $admin = $staffController->getStaffByID($_GET['id']);
                        header('Location: /sibeta/public/index.php?page=super_admin/detail_admin&nip=' . $admin['NIP']);
                        break;
                    case 3:
                        $teknisi = $staffController->getStaffByID($_GET['id']);
                        header('Location: /sibeta/public/index.php?page=super_admin/detail_teknisi&nip=' . $teknisi['NIP']);
                        break;
                }
            } else {
                switch ($user['RoleID']) {
                    case 2:
                        $admin = $staffController->getStaffByID($_GET['id']);
                        header('Location: /sibeta/public/index.php?page=super_admin/detail_admin&nip=' . $admin['NIP']);
                        break;
                    case 3:
                        $teknisi = $staffController->getStaffByID($_GET['id']);
                        header('Location: /sibeta/public/index.php?page=super_admin/detail_teknisi&nip=' . $teknisi['NIP']);
                        break;
                }
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        exit;
        break;

    case 'super_admin/delete_teknisi':
        try {
            $result = $staffController->deleteStaff();
            if ($result) {
                header('Location: /sibeta/public/index.php?page=super_admin/teknisi&success=Teknisi Berhasil Dihapus');
            } else {
                header('Location: /sibeta/public/index.php?page=super_admin/teknisi&error=Gagal Menghapus Teknisi');
            }
        } catch (Exception $e) {
            header('Location: /sibeta/public/index.php?page=super_admin/teknisi&error=' . urlencode($e->getMessage()));
        }
        exit;
        break;
    case 'super_admin/delete_admin':
        try {
            $result = $staffController->deleteStaff();
            if ($result) {
                header('Location: /sibeta/public/index.php?page=super_admin/admin&success=Admin Berhasil Dihapus');
            } else {                
                header('Location: /sibeta/public/index.php?page=super_admin/admin&error=Gagal Menghapus Admin');
            }
        } catch (Exception $e) {
            header('Location: /sibeta/public/index.php?page=super_admin/admin&error=' . urlencode($e->getMessage()));
        }
    default:
        echo "Halaman tidak ditemukan.";
        break;
}
