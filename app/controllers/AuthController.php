<?php
class AuthController
{
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new UserModel($db);
    }

    public function login($username, $password)
    {
        try {
            $user = $this->userModel->getUserByUsername($username);

            if ($user && password_verify($password, $user['Password'])) {
                $_SESSION['userID'] = $user['UserID'];
                $_SESSION['username'] = $user['Username'];
                $_SESSION['role'] = $user['RoleName'];

                switch ($user['RoleName']) {
                    case 'Mahasiswa':
                        $mahasiswaDetails = $this->userModel->getMahasiswaDetails($user['UserID']);
                        $_SESSION['nama'] = $mahasiswaDetails['Nama'];
                        $_SESSION['nim'] = $mahasiswaDetails['NIM'];
                        $_SESSION['photo_profile'] = $mahasiswaDetails['photo_profile_path'] ?? '/sibeta/public/assets/img/default-avatar.png';

                        header("Location: /sibeta/public/index.php?page=mahasiswa");
                        break;

                    case 'Admin Prodi':
                        $adminDetails = $this->userModel->getStaffDetails($user['UserID']);
                        $_SESSION['nama'] = $adminDetails['Nama'];
                        $_SESSION['nip'] = $adminDetails['NIP'];
                        $_SESSION['photo_profile'] = $adminDetails['photo_profile_path'] ?? '/sibeta/public/assets/img/default-avatar.png';

                        $nama = $_SESSION['nama'];
                        $nip = $_SESSION['nip'];
                        $photo_profile_path = $_SESSION['photo_profile'];

                        header("Location: /sibeta/public/index.php?page=admin");
                        break;

                    case 'Teknisi':
                        $adminDetails = $this->userModel->getStaffDetails($user['UserID']);
                        $_SESSION['nama'] = $adminDetails['Nama'];
                        $_SESSION['nip'] = $adminDetails['NIP'];
                        $_SESSION['photo_profile'] = $adminDetails['photo_profile_path'] ?? '/sibeta/public/assets/img/default-avatar.png';

                        $nama = $_SESSION['nama'];
                        $nip = $_SESSION['nip'];
                        $photo_profile_path = $_SESSION['photo_profile'];

                        header("Location: /sibeta/public/index.php?page=teknisi");
                        break;
                    case 'Super Admin':
                        $adminDetails = $this->userModel->getStaffDetails($user['UserID']);
                        $_SESSION['nama'] = $adminDetails['Nama'];
                        $_SESSION['nip'] = $adminDetails['NIP'];
                        $_SESSION['photo_profile'] = $adminDetails['photo_profile_path'] ?? '/sibeta/public/assets/img/default-avatar.png';

                        $nama = $_SESSION['nama'];
                        $nip = $_SESSION['nip'];
                        $photo_profile_path = $_SESSION['photo_profile'];

                        header("Location: /sibeta/public/index.php?page=super_admin");
                        break;
                    default:
                        return "Role tidak dikenal!";
                        break;
                }

                exit;
            } else {
                return "Username atau password salah!";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getUserByID($id){
        return $this->userModel->getUserByID($id);
    }

    public function handleUpdateProfilePhoto(){
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto_profil'])){
            // Validasi gambar foto profil
            $fileFoto = $_FILES['foto_profil'];
            $user = $this->userModel->getUserByID($_GET['id']);
            $old_photo = basename($user['photo_profile_path']);
            if ($fileFoto['error'] === UPLOAD_ERR_OK) {
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                $fileExtension = strtolower(pathinfo($fileFoto['name'], PATHINFO_EXTENSION));
                if (!in_array($fileExtension, $allowedExtensions)) {
                    throw new Exception("Hanya gambar dengan ekstensi JPG, JPEG, PNG, atau GIF yang diizinkan.");
                }
            } else {
                throw new Exception("Tidak ada file yang dipilih!");
            }

            // Validasi ukuran file foto profil
            $maxFileSize = 5 * 1024 * 1024; // 5 MB
            if ($fileFoto['size'] > $maxFileSize) {
                throw new Exception("Ukuran file foto profil tidak boleh lebih dari 2 MB.");
            }

            // Index unique ID Foto Profil
            $ekstensi = pathinfo($fileFoto['name'], PATHINFO_EXTENSION);
            $fileBaru = uniqid() . '.' . $ekstensi;

            // pindah file foto profil ke direktori tujuan
            $targetDir = '../app/uploads/profile/';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true); // Membuat direktori beserta subdirektori jika belum ada
            }
            $targetFile = $targetDir . $fileBaru;
            if (!move_uploaded_file($fileFoto['tmp_name'], $targetFile)) {
                throw new Exception("Gagal memindahkan file foto profil!");
            }

            $oldPhotoPath = '../app/uploads/profile/' . $old_photo;

            // Hapus file foto profil lama jika ada
            if ($old_photo !== null && file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }

            $fileFinal = '/uploads/profile/' . $fileBaru;

            return $this->userModel->updateUserPhoto($_GET['id'], $fileFinal);
        }
        
            
    }
}
