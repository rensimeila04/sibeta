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
}
