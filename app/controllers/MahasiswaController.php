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
}
