<?php
class NotifikasiController
{
    private $notifikasiModel;

    public function __construct($db)
    {
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

    public function createNotifikasi($nim, $pesan)
    {
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

    public function getTopNotifications($nim)
    {
        try {
            return $this->notifikasiModel->getTopThreeNotifications($nim);
        } catch (Exception $e) {
            error_log("Error in controller getting notifications: " . $e->getMessage());
            throw new Exception("Gagal mengambil notifikasi: " . $e->getMessage());
        }
    }

    public function markNotificationAsRead($notifikasiId)
    {
        try {
            return $this->notifikasiModel->markAsRead($notifikasiId);
        } catch (Exception $e) {
            error_log("Error in controller marking notification: " . $e->getMessage());
            throw new Exception("Gagal mengubah status notifikasi: " . $e->getMessage());
        }
    }

    public function getUnreadNotificationCount($nim)
    {
        try {
            // Get the top 3 notifications
            $topNotifications = $this->notifikasiModel->getTopThreeNotifications($nim);
            
            // Count how many of these are unread
            $unreadCount = 0;
            foreach ($topNotifications as $notification) {
                if ($notification['IsDibaca'] == 0) {
                    $unreadCount++;
                }
            }
            
            return $unreadCount;
        } catch (Exception $e) {
            error_log("Error in controller getting unread count: " . $e->getMessage());
            throw new Exception("Gagal menghitung notifikasi: " . $e->getMessage());
        }
    }
}