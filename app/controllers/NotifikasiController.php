<?php
class NotifikasiController {
    private $notifikasiModel;

    public function __construct($db) {
        $this->notifikasiModel = new NotifikasiModel($db);
        error_log("Initializing NotifikasiModel with database connection");
        try {
            $this->notifikasiModel = new NotifikasiModel($db);
            error_log("NotifikasiModel initialized successfully");
        } catch (Exception $e) {
            error_log("Failed to initialize NotifikasiModel: " . $e->getMessage());
            throw $e;
        }
    }

    public function createNotifikasi($nim, $pesan) {
        try {
            error_log("Attempting to create notification for NIM: " . $nim);
            error_log("Message: " . $pesan);
            
            if (empty($nim)) {
                throw new Exception("NIM tidak boleh kosong");
            }
            
            if (empty($pesan)) {
                throw new Exception("Pesan tidak boleh kosong");
            }
            
            $result = $this->notifikasiModel->addNotifikasi($nim, $pesan);
            error_log("Notification creation result: " . ($result ? "success" : "failed"));
            
            return $result;
        } catch (Exception $e) {
            error_log("Error creating notification: " . $e->getMessage());
            throw new Exception("Gagal membuat notifikasi: " . $e->getMessage());
        }
    }
}
?>