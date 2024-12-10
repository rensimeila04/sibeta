<?php 

class AdminController {
    private $adminModel;

    public function __construct($db) {
        $this->adminModel = new AdminModel($db);
    }

    public function getDocumentCounts() {
        $diajukan = $this->adminModel->getDocumentCountByStatus('Diajukan');
        $terverifikasi = $this->adminModel->getDocumentCountByStatus('Diverifikasi');
        $ditolak = $this->adminModel->getDocumentCountByStatus('Ditolak');

        return [
            'diajukan' => $diajukan,
            'terverifikasi' => $terverifikasi,
            'ditolak' => $ditolak
        ];
    }

    public function getDocuments() {
        return $this->adminModel->getDocumentVerifByAdminProdi();
    }

    public function getDocumentMahasiswa($nim) {
        return $this->adminModel->getDocumentMahasiswa($nim);
    }

    public function getDocumentMahasiswaByIDDocument($id) {
        return $this->adminModel->getDocumentMahasiswaByIDDocument($id);
    }

    public function updateDocumentStatus($id, $status, $comment) {
        switch ($status) {
            case 'verify':
                $status = 'Diverifikasi';
                break;
            case 'reject':
                $status = 'Ditolak';
                break;
        }
        return $this->adminModel->updateDocumentStatus($id, $status, $comment);
    }
}