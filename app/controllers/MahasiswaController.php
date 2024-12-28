<?php

class MahasiswaController
{
    private $mahasiswaModel;

    public function __construct($db)
    {
        $this->mahasiswaModel = new MahasiswaModel($db);
    }

    public function getDocumentCounts($nim)
    {
        // Mengambil jumlah dokumen berdasarkan status
        $diajukan = $this->mahasiswaModel->getDocumentCountByStatus($nim, 'Diajukan');
        $terverifikasi = $this->mahasiswaModel->getDocumentCountByStatus($nim, 'Diverifikasi');
        $ditolak = $this->mahasiswaModel->getDocumentCountByStatus($nim, 'Ditolak');

        return [
            'diajukan' => $diajukan,
            'terverifikasi' => $terverifikasi,
            'ditolak' => $ditolak,
        ];
    }

    public function getMahasiswaByNIM($nim)
    {
        return $this->mahasiswaModel->getMahasiswaByNIM($nim);
    }

    public function getDocuments($nim)
    {
        // Mengambil semua dokumen mahasiswa
        return $this->mahasiswaModel->getAllDocuments($nim);
    }

    public function getDocumentById($id)
    {
        try {
            return $this->mahasiswaModel->getDocumentById($id);
        } catch (Exception $e) {
            // Tangani error atau tampilkan pesan error ke user
            return null;
        }
    }

    public function getDocumentsByType($nim, $tipe)
    {
        // Mengambil dokumen berdasarkan tipe
        return $this->mahasiswaModel->getDocumentsByType($nim, $tipe);
    }

    public function getDocumentCountByType($nim, $tipe)
    {
        // Mengambil jumlah dokumen berdasarkan tipe
        return $this->mahasiswaModel->getDocumentCountByType($nim, $tipe);
    }

    // Fungsi untuk mengecek apakah dokumen administratif sudah lengkap
    public function isAdministrativeDocumentsComplete($nim)
    {
        // Memanggil model untuk memeriksa kelengkapan dokumen administratif
        return $this->mahasiswaModel->isAdministrativeDocumentsComplete($nim);
    }

    public function isTeknisDocumentsComplete($nim)
    {
        // Memanggil model untuk memeriksa kelengkapan dokumen administratif
        return $this->mahasiswaModel->isTeknisDocumentsComplete($nim);
    }

    public function getJenisDokumen($tipe)
    {
        // Mengambil semua jenis dokumen berdasarkan tipe
        return $this->mahasiswaModel->getJenisDokumen($tipe);
    }

    public function uploadDocument($nim, $jenisDokumenID, $file)
    {
        try {
            // Memanggil model untuk mengupload dokumen
            $result = $this->mahasiswaModel->uploadDocument($nim, $jenisDokumenID, $file);
            if ($result) {
                return ['status' => 'success', 'message' => 'Dokumen berhasil diunggah.'];
            } else {
                return ['status' => 'error', 'message' => 'Dokumen gagal diunggah.'];
            }
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function deleteDocument($dokumenID, $nim)
    {
        try {
            // Memanggil model untuk menghapus dokumen
            return $this->mahasiswaModel->deleteDocument($dokumenID, $nim);
        } catch (Exception $e) {
            throw new Exception("Gagal menghapus dokumen: " . $e->getMessage());
        }
    }

    public function updateIsSavedByType($nim, $tipe)
    {
        // Memanggil model untuk update IsSaved berdasarkan tipe
        $updatedRows = $this->mahasiswaModel->updateIsSavedByType($nim, $tipe);

        // Mengembalikan jumlah baris yang berhasil diperbarui
        return $updatedRows;
    }

    // Fungsi untuk mengedit dokumen
    public function updateDocument($dokumenID, $jenisDokumenID, $filePath)
    {
        // Memanggil model untuk memperbarui data dokumen
        return $this->mahasiswaModel->updateDocument($dokumenID, $jenisDokumenID, $filePath);
    }

    public function getMahasiswaInfo($nim)
    {
        // Mengambil detail mahasiswa
        return $this->mahasiswaModel->getMahasiswaDetails($nim);
    }

    public function updateProfile($nim, $newData)
    {
        return $this->mahasiswaModel->updateProfile($nim, $newData);
    }

    public function updatePassword($nim, $newPassword)
    {
        return $this->mahasiswaModel->updatePassword($nim, $newPassword);
    }

    public function handleUpdateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nim = $_SESSION['nim'];
            $newData = [
                'nama' => $_POST['nama'],
                'newNim' => $_POST['newNim'],
                'kelas' => $_POST['kelas'],
                'programStudi' => $_POST['programStudi'],
            ];

            try {
                $this->mahasiswaModel->updateProfile($nim, $newData);
                header('Location: /sibeta/public/index?profil_mahasiswa=success');
            } catch (Exception $e) {
                header('Location: /sibeta/app/views/profil.php?error=' . urlencode($e->getMessage()));
            }
            exit();
        }
    }
    public function handleUpdateProfileName()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nim = $_SESSION['nim'];
            $nama = $_POST['name'];

            if (empty($nama)) {
                throw new Exception("Nama tidak boleh kosong");
            }

            // Get current mahasiswa data
            $currentData = $this->getMahasiswaByNIM($nim);

            $newData = [
                'nama' => $nama,
                'newNim' => $nim,
                'kelas' => $currentData['Kelas'],
                'programStudi' => $currentData['ProgramStudi']
            ];

            try {
                $result = $this->mahasiswaModel->updateProfile($nim, $newData);
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
            $nim = $_SESSION['nim'];
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

                $result = $this->mahasiswaModel->updatePassword($nim, $newPassword);

                if ($result) {
                    header('Location: /sibeta/public/index.php?page=profil_mahasiswa&success=updatePassword');
                } else {
                    throw new Exception("Failed to update password!");
                }
            } catch (Exception $e) {
                header('Location: /sibeta/public/index.php?page=profil_mahasiswa&error=' . urlencode($e->getMessage()));
            }
            exit();
        }
    }

    public function updateDocumentFile($dokumenID, $filePath = null)
    {
        try {
            return $this->mahasiswaModel->updateDocumentFile($dokumenID, $filePath);
        } catch (Exception $e) {
            throw new Exception("Gagal memperbarui dokumen: " . $e->getMessage());
        }
    }
}
