<?php 

class TeknisiController {
    private $teknisiModel;

    public function __construct($db) {
        $this->teknisiModel = new TeknisiModel($db);
    }

    public function getDocumentCounts() {
        $diajukan = $this->teknisiModel->getDocumentCountByStatus('Diajukan');
        $terverifikasi = $this->teknisiModel->getDocumentCountByStatus('Diverifikasi');
        $ditolak = $this->teknisiModel->getDocumentCountByStatus('Ditolak');

        return [
            'diajukan' => $diajukan,
            'terverifikasi' => $terverifikasi,
            'ditolak' => $ditolak
        ];
    }

    public function getDocuments() {
        return $this->teknisiModel->getDocumentVerifByTeknisiProdi();
    }

    public function getDocumentMahasiswa($nim) {
        return $this->teknisiModel->getDocumentMahasiswa($nim);
    }

    public function getDocumentMahasiswaByIDDocument($id) {
        return $this->teknisiModel->getDocumentMahasiswaByIDDocument($id);
    }

    public function updateDocumentStatus($id, $nip, $status, $comment) {
        switch ($status) {
            case 'verify':
                $status = 'Diverifikasi';
                break;
            case 'reject':
                $status = 'Ditolak';
                break;
        }
        return $this->teknisiModel->updateDocumentStatus($id, $nip, $status, $comment);
    }

    public function createNotification($nim, $status, $file, $comment) {
        switch ($status) {
            case 'reject':
                $pesan = "Dokumen " . $file . " telah ditolak, karena " . $comment . ", silahkan cek dokumen pada halaman Detail Dokumen.";
                break;
            case 'verify':
                $pesan = "Dokumen " . $file . " telah diverifikasi, silahkan cek dokumen pada halaman Detail Dokumen.";
                break;
        }
        return $this->teknisiModel->createNotification($nim, $pesan);
    }
}