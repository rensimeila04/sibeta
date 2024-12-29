<?php
class NotifikasiModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
        if (!$this->conn) {
            error_log("Database connection is null");
            throw new Exception("Koneksi database tidak tersedia");
        }
        error_log("NotifikasiModel initialized with database connection");
    }

    public function addNotifikasi($nim, $pesan) {
        try {
            error_log("Adding notification - NIM: " . $nim . ", Message: " . $pesan);
            
            // Validate database connection
            if (!$this->conn) {
                throw new Exception("Koneksi database tidak tersedia");
            }
            
            $sql = "INSERT INTO Notifikasi (MahasiswaNIM, Pesan) VALUES (:nim, :pesan)";
            error_log("Executing SQL: " . $sql);
            
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                error_log("Failed to prepare statement");
                throw new Exception("Gagal mempersiapkan query");
            }
            
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
            $stmt->bindParam(':pesan', $pesan, PDO::PARAM_STR);
            
            $result = $stmt->execute();
            error_log("Query execution result: " . ($result ? "success" : "failed"));
            
            if (!$result) {
                $errorInfo = $stmt->errorInfo();
                error_log("Database error: " . print_r($errorInfo, true));
                throw new Exception("Gagal menyimpan notifikasi: " . $errorInfo[2]);
            }
            
            return $result;
        } catch (PDOException $e) {
            error_log("PDO Exception: " . $e->getMessage());
            throw new Exception("Query gagal: " . $e->getMessage());
        } catch (Exception $e) {
            error_log("General Exception: " . $e->getMessage());
            throw $e;
        }
    }
}
?>