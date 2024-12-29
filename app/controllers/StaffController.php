<?php
class StaffController
{
    private $staffModel;

    public function __construct($db)
    {
        $this->staffModel = new StaffModel($db);
    }

    public function getStaff($nip)
    {
        return $this->staffModel->getStaffByNip($nip);
    }


    public function handleUpdateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nip = $_SESSION['nip'];
            $newData = [
                'nama' => $_POST['nama'],
                'nip' => $_POST['nip'],
            ];

            try {
                $this->staffModel->updateProfile($nip, $newData);
                header('Location: /sibeta/public/index?profile_staff=success');
            } catch (Exception $e) {
                header('Location: /sibeta/app/views/profil.php?error=' . urlencode($e->getMessage()));
            }
            exit();
        }
    }
    public function handleUpdateProfileName()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nip = $_SESSION['nip'];
            $nama = $_POST['name'];

            if (empty($nama)) {
                throw new Exception("Nama tidak boleh kosong.");
            }

            $newData = [
                'nama' => $nama,
                'nip' => $nip,
            ];

            try {
                $getUserID = $this->getStaff($nip);
                $userID = $getUserID['UserID'];
                $result = $this->staffModel->updateProfile($userID, $newData);
                if ($result) {
                    $_SESSION['nama'] = $nama;
                    return true;
                }
                return false;
            } catch (Exception $e) {
                throw new Exception("Gagal mengupdate profil: " . $e->getMessage());
            }
        }
        return false;
    }


    public function handleUpdatePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nip = $_SESSION['nip'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            try {
                // Validate password
                if (empty($newPassword)) {
                    throw new Exception("Password cannot be empty!");
                }

                if (strlen($newPassword) < 6) {
                    throw new Exception("Password must be at least 6 characters long!");
                }

                if ($newPassword !== $confirmPassword) {
                    throw new Exception("Password confirmation does not match!");
                }
                $getUserID = $this->getStaff($nip);
                $userID = $getUserID['UserID'];
                $result = $this->staffModel->updatePassword($userID, $newPassword);

                if ($result) {
                    header('Location: /sibeta/public/index.php?page=profile_staff&success=updatePassword');
                } else {
                    throw new Exception("Failed to update password!");
                }
            } catch (Exception $e) {
                header('Location: /sibeta/public/index.php?page=profile_staff&error=' . urlencode($e->getMessage()));
            }
            exit();
        }
    }

    public function getTotalMahasiswaCount()
    {
        return $this->staffModel->getTotalMahasiswaCount();
    }

    public function getAllMahasiswa()
    {
        return $this->staffModel->getAllMahasiswa();
    }

    public function getPaginatedMahasiswa($currentPage, $itemsPerPage)
    {
        return $this->staffModel->getPaginatedMahasiswa($currentPage, $itemsPerPage);
    }

    public function getKelasOptions()
    {
        return $this->staffModel->getKelasOptions();
    }

    public function getProgramStudiOptions()
    {
        return $this->staffModel->getProgramStudiOptions();
    }

    public function insertMahasiswa($nim, $nama, $kelas, $username, $password, $file)
    {
        try {
            // Memanggil model untuk menambahkan mahasiswa
            $result = $this->staffModel->insertMahasiswa($nim, $nama, $kelas, $username, $password, $file);
            if ($result) {
                return ['status' => 'success', 'message' => 'Mahasiswa berhasil ditambahkan.'];
            } else {
                return ['status' => 'error', 'message' => 'Gagal menambahkan mahasiswa.'];
            }
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    // Mengambil data mahasiswa berdasarkan NIM
    public function getMahasiswa($nim)
    {
        return $this->staffModel->getMahasiswaByNIM($nim);
    }

    // Memperbarui data mahasiswa
    public function handleUpdateMahasiswa()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nim = $_POST['nim']; // Ambil NIM dari form
            $username = $_POST['username'];
            $nama = $_POST['name'];
            $kelas = $_POST['kelas'];

            if (empty($nama) || empty($username) || empty($nim)) {
                throw new Exception("Semua field harus diisi");
            }

            $newData = [
                'username' => $username,
                'nama' => $nama,
                'nim' => $nim,
                'kelas' => $kelas
            ];

            try {
                $result = $this->staffModel->updateMahasiswa($nim, $newData);
                if ($result) {
                    // Redirect ke halaman detail mahasiswa dengan NIM dan pesan sukses
                    header('Location: /sibeta/public/index.php?page=super_admin/detail_mahasiswa&nim=' . urlencode($nim) . '&success=updateDetail');
                    exit();
                }
            } catch (Exception $e) {
                header('Location: /sibeta/public/index.php?page=super_admin/detail_mahasiswa&nim=' . urlencode($nim) . '&error=' . urlencode($e->getMessage()));
                exit();
            }
        }
        return false;
    }

    public function handleUpdatePasswordMahasiswa()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nim = $_POST['nim'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            try {
                // Validate password
                if (empty($newPassword)) {
                    throw new Exception("Password cannot be empty!");
                }

                if (strlen($newPassword) < 6) {
                    throw new Exception("Password must be at least 6 characters long!");
                }

                if ($newPassword !== $confirmPassword) {
                    throw new Exception("Password confirmation does not match!");
                }
                $getUserID = $this->getMahasiswa($nim);
                $userID = $getUserID['UserID'];
                $result = $this->staffModel->handleUpdatePassword();

                if ($result) {
                    header('Location: /sibeta/public/index.php?page=super_admin/detail_mahasiswa&nim=' . urlencode($nim) . '&success=updatePassword');
                    exit();
                }
            } catch (Exception $e) {
                header('Location: /sibeta/public/index.php?page=super_admin/detail_mahasiswa&nim=' . urlencode($nim) . '&error=' . urlencode($e->getMessage()));
                exit();
            }
        }
    }

    public function deleteMahasiswa($nim)
    {
        try {
            // Memanggil model untuk menghapus mahasiswa
            return $this->staffModel->deleteMahasiswa($nim);
        } catch (Exception $e) {
            throw new Exception("Gagal menghapus mahasiswa: " . $e->getMessage());
        }
    }
}
