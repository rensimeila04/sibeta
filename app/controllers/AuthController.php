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

                // Ambil detail mahasiswa jika role adalah 'Mahasiswa'
                if ($user['RoleName'] === 'Mahasiswa') {
                    $mahasiswaDetails = $this->userModel->getMahasiswaDetails($user['UserID']);
                    $_SESSION['nama'] = $mahasiswaDetails['Nama'];
                    $_SESSION['nim'] = $mahasiswaDetails['NIM'];
                    $_SESSION['photo_profile'] = $mahasiswaDetails['photo_profile_path'] ?? '/sibeta/public/assets/img/default-avatar.png';
                }

                // Redirect berdasarkan role
                switch ($user['RoleName']) {
                    case 'Mahasiswa':
                        header("Location: /sibeta/public/index.php?page=mahasiswa");
                        break;
                    case 'Admin Prodi':
                        header("Location: /sibeta/public/index.php?page=admin");
                        break;
                    case 'Teknisi':
                        header("Location: /sibeta/public/index.php?page=teknisi");
                        break;
                    default:
                        echo "Role tidak dikenal!";
                        break;
                }
                exit;
            } else {
                echo "Username atau password salah!";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
