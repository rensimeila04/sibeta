<?php
class StaffController
{
    private $staffModel;

    public function __construct($db)
    {
        $this->staffModel = new StaffModel($db);
    }

    public function getAllStaff()
    {
        return $this->staffModel->getAllStaff();
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

    public function handleUpdateProfileSuperAdmin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nip = $_POST['nip'];
            $nama = $_POST['name'];
            $username = $_POST['username'];
            $role = $_POST['role'];

            if (empty($nama) || empty($nip) || empty($username) || empty($role)) {
                throw new Exception("Field tidak boleh ada yang kosong.");
            }

            $oldData = $this->getStaff($nip);
            $nipLama = $oldData['NIP'];
            if ($nipLama != $nip) {
                $cekNIP = $this->staffModel->getAllStaff();
                foreach ($cekNIP as $row) {
                    if ($row['NIP'] == $nip) {
                        throw new Exception("NIP $nip sudah digunakan.");
                    }
                }
            }

            $usernameLama = $oldData['Username'];
            if ($usernameLama != $username) {
                $cekUsername = $this->staffModel->getAllStaff();
                foreach ($cekUsername as $row) {
                    if ($row['Username'] == $username) {
                        throw new Exception("Username $username sudah digunakan.");
                    }
                }
            }

            $acceptRole = ['Teknisi', 'Admin Prodi', 'Super Admin'];
            if (!in_array($role, $acceptRole)) {
                throw new Exception("Role tidak valid.");
            }

            $roleID = null;
            switch ($role) {
                case 'Teknisi':
                    $roleID = 3;
                    break;
                case 'Admin Prodi':
                    $roleID = 2;
                    break;
                case 'Super Admin':
                    $roleID = 1;
                    break;
                case 'Mahasiswa':
                    $roleID = 4;
                    break;
            }

            $newData = [
                'nama' => $nama,
                'nip' => $nip,
                'username' => $username,
                'roleID' => $roleID
            ];

            try {
                $getUserID = $this->getStaff($nip);
                $userID = $getUserID['UserID'];
                $result = $this->staffModel->updateProfileSuperAdmin($userID, $newData);
                if ($result) {
                    return true;
                }
                return false;
            } catch (Exception $e) {
                throw new Exception("Gagal mengupdate profil: " . $e->getMessage());
            }
        }
        return false;
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

    public function handleUpdatePasswordSuperAdmin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $staff = $this->getStaffByID($_GET['id']);
            $nip = $staff['NIP'];
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
                    switch ($staff['RoleID']) {
                        case 2:
                            header('Location: /sibeta/public/index.php?page=super_admin/detail_admin&success=updatePassword&nip=' . $nip);
                            break;
                        case 3:
                            header('Location: /sibeta/public/index.php?page=super_admin/detail_teknisi&success=updatePassword&nip=' . $nip);
                            break;
                    }
                } else {
                    throw new Exception("Failed to update password!");
                }
            } catch (Exception $e) {
                switch ($staff['RoleID']) {
                    case 2:
                        header('Location: /sibeta/public/index.php?page=super_admin/detail_admin&error=' . urlencode($e->getMessage()));
                        break;
                    case 3:
                        header('Location: /sibeta/public/index.php?page=super_admin/detail_teknisi&error=' . urlencode($e->getMessage()));
                        break;
                }
            }
            exit();
        }
    }

    public function getAllStaffByRole($role)
    {
        $roleID = null;
        switch ($role) {
            case 'Admin Prodi':
                $roleID = 2;
                break;
            case 'Teknisi':
                $roleID = 3;
                break;
        }
        return $this->staffModel->getAllStaffByRole($roleID);
    }

    public function deleteStaff()
    {
        $nip = $_GET['nip'];
        $staff = $this->getStaff($nip);
        $userID = $staff['UserID'];
        $result = $this->staffModel->deleteStaffByUserID($userID);
        if ($result) {
            switch ($staff['RoleID']) {
                case 2:
                    header('Location: /sibeta/public/index.php?page=super_admin/admin&success=delete');
                    break;
                case 3:
                    header('Location: /sibeta/public/index.php?page=super_admin/teknisi&success=delete');
                    break;
            }
        }
    }

    public function addStaff($tipe)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fileFoto = $_FILES['foto_profil'];
            $nip = $_POST['nip'];
            $username = $nip;
            $nama = $_POST['nama'];
            $password = $nip;
            $confirmPassword = $nip;
            $roleID = null;
            switch ($tipe) {
                case 'Teknisi':
                    $roleID = 3;
                    break;
                case 'Admin Prodi':
                    $roleID = 2;
                    break;
            }

            $cekNIP = $this->staffModel->getAllStaff();
            foreach ($cekNIP as $row) {
                if ($row['NIP'] == $nip) {
                    throw new Exception("NIP sudah digunakan!");
                }
            }

            // Validasi gambar foto profil
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

            // Validasi password
            if ($password !== $confirmPassword) {
                throw new Exception("Password dan konfirmasi password tidak cocok!");
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

            $fileFinal = '/uploads/profile/' . $fileBaru;

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $newData = [
                'foto_profil' => $fileFinal,
                'username' => $username,
                'nama' => $nama,
                'kata_sandi' => $hashedPassword,
                'nip' => $nip,
                'roleID' => $roleID
            ];

            return $this->staffModel->addStaff($newData);
        }
    }

    public function getStaffByID($id)
    {
        return $this->staffModel->getStaffByID($id);
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
