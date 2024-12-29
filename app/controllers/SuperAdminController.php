<?php

class SuperAdminController
{
    private $superAdminModel;

    public function __construct($db)
    {
        $this->superAdminModel = new SuperAdminModel($db);
    }

    public function getMahasiswaCount()
    {
        $totalMahasiswa = $this->superAdminModel->getTotalStudents();
        return $totalMahasiswa;
    }

    public function getTechniciansCount()
    {
        return $this->superAdminModel->getTotalTechnicians();
    }

    public function getAdminProdiCount()
    {
        return $this->superAdminModel->getTotalAdminProdi();
    }

    public function getDocumentsCount()
    {
        return $this->superAdminModel->getTotalDocuments();
    }

    public function getMahasiswaByProdi()
    {
        return $this->superAdminModel->getStudentsByProdi();
    }

    public function getJenisDokumen()
    {
        return $this->superAdminModel->getJenisDokumen();
    }

    public function addJenisDokumen($namaDokumen, $tipe, $isRequired = 1)
    {
        // Validasi tipe dokumen
        $validTypes = ['Teknis', 'Administratif'];
        if (!in_array($tipe, $validTypes)) {
            throw new Exception("Tipe dokumen tidak valid. Pilihan yang tersedia adalah: " . implode(', ', $validTypes) . ".");
        }

        // Validasi nama dokumen
        if (empty($namaDokumen) || strlen($namaDokumen) > 100) {
            throw new Exception("Nama dokumen harus diisi dan tidak boleh lebih dari 100 karakter.");
        }

        // Validasi IsRequired (opsional)
        if (!in_array($isRequired, [0, 1], true)) {
            throw new Exception("Nilai IsRequired harus berupa 1 (ya) atau 0 (tidak).");
        }

        try {
            // Panggil metode dari model untuk menyimpan data
            return $this->superAdminModel->addJenisDokumen($namaDokumen, $tipe, $isRequired);
        } catch (Exception $e) {
            // Tangkap error dari model dan berikan pesan yang lebih deskriptif
            throw new Exception("Gagal menambahkan dokumen: " . $e->getMessage());
        }
    }

    public function deleteJenisDokumen($jenisDokumenID)
    {
        return $this->superAdminModel->deleteJenisDokumen($jenisDokumenID);
    }

    public function getJenisDokumenById($id)
    {
        try {
            $result = $this->superAdminModel->getJenisDokumenById($id);
            if (!$result) {
                throw new Exception("Dokumen dengan ID $id tidak ditemukan.");
            }
            return $result;
        } catch (Exception $e) {
            // Log error
            error_log("Error in getJenisDokumenById: " . $e->getMessage());
            throw $e; // Re-throw untuk ditangkap oleh view
        }
    }

    public function updateJenisDokumen($jenisDokumenID, $namaDokumen, $tipe, $isRequired)
    {
        return $this->superAdminModel->editJenisDokumen($jenisDokumenID, $namaDokumen, $tipe, $isRequired);
    }
}
