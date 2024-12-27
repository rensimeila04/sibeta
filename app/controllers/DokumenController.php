<?php 
class DokumenController {
    private $dokumenModel;

    public function __construct($db) {
        $this->dokumenModel = new DokumenModel($db);
    }

    public function getDocumentCounts($tipe) {
        $diajukanNoSaved = $this->dokumenModel->getDocumentCountByStatusNoIsSaved($tipe, 'Diajukan');
        $diajukan = $this->dokumenModel->getDocumentCountByStatusIsSaved($tipe, 'Diajukan');
        $terverifikasi = $this->dokumenModel->getDocumentCountByStatusIsSaved($tipe,'Diverifikasi');
        $ditolak = $this->dokumenModel->getDocumentCountByStatusIsSaved($tipe, 'Ditolak');

        return [
            'diajukanNoSaved' => $diajukanNoSaved,
            'diajukan' => $diajukan,
            'terverifikasi' => $terverifikasi,
            'ditolak' => $ditolak
        ];
    }

    public function getTotalDocuments($tipe) {
        return $this->dokumenModel->getTotalDocuments($tipe);
    }

    public function getTotalDocumentsMahasiswa($nim, $tipe) {
        return $this->dokumenModel->getTotalDocumentsMahasiswa($nim, $tipe);
    }

    public function getDocuments($tipe) {
        return $this->dokumenModel->getDocumentVerif($tipe);
    }

    public function getPageDocuments($tipe, $currentPage, $itemsPerPage) {
        return $this->dokumenModel->getPageDocuments($tipe, $currentPage, $itemsPerPage);
    }

    public function getPageDocumentsMahasiswa($nim, $tipe, $currentPage, $itemsPerPage) {
        return $this->dokumenModel->getPageDocumentsMahasiswa($nim, $tipe, $currentPage, $itemsPerPage);
    }

    public function getDocumentMahasiswa($nim, $tipe) {
        return $this->dokumenModel->getDocumentMahasiswa($nim, $tipe);
    }

    public function getDocumentMahasiswaByIDDocument($id, $tipe) {
        return $this->dokumenModel->getDocumentMahasiswaByIDDocument($id, $tipe);
    }

    public function updateDocumentStatus($id, $nip, $status, $comment) {
        return $this->dokumenModel->updateDocumentStatus($id, $nip, $status, $comment);
    }

}
?>