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

                    default:
                        return "Role tidak dikenal!";
                }

                exit;
            } else {
                return "Username atau password salah!";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
