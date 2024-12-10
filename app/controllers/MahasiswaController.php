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

    public function getDocuments($nim)
    {
        // Mengambil semua dokumen mahasiswa
        return $this->mahasiswaModel->getAllDocuments($nim);
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

    public function handleUpdatePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nim = $_SESSION['nim'];
            $newPassword = $_POST['newPassword'];

            try {
                $this->mahasiswaModel->updatePassword($nim, $newPassword);
                header('Location: /sibeta/app/views/profil.php?success=updatePassword');
            } catch (Exception $e) {
                header('Location: /sibeta/app/views/profil.php?error=' . urlencode($e->getMessage()));
            }
            exit();
        }
    }
}
