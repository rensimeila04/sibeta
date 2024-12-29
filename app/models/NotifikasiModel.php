<?php
class NotifikasiModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addNotifikasi($nim, $pesan) {
        try {
            $sql = "INSERT INTO Notifikasi (MahasiswaNIM, Pesan, TanggalNotifikasi, IsDibaca) 
                    VALUES (:nim, :pesan, GETDATE(), 0)";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
            $stmt->bindParam(':pesan', $pesan, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Gagal menambah notifikasi: " . $e->getMessage());
        }
    }

    public function getTopThreeNotifications($nim) {
        try {
            $sql = "SELECT TOP 3 *
                    FROM Notifikasi
                    WHERE MahasiswaNIM = :nim
                    ORDER BY TanggalNotifikasi DESC";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Gagal mengambil notifikasi: " . $e->getMessage());
        }
    }

    public function markAsRead($notifikasiId) {
        try {
            $sql = "UPDATE Notifikasi 
                    SET IsDibaca = 1 
                    WHERE NotifikasiID = :notifikasiId";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':notifikasiId', $notifikasiId, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Gagal menandai notifikasi sebagai dibaca: " . $e->getMessage());
        }
    }
}