<?php

class MahasiswaModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Mengambil jumlah dokumen berdasarkan status
    public function getDocumentCountByStatus($nim, $status)
    {
        try {
            $sql = "SELECT COUNT(*) as count
                    FROM Dokumen
                    WHERE MahasiswaNIM = :nim AND Status = :status";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    // Mengambil semua dokumen mahasiswa
    public function getAllDocuments($nim)
    {
        try {
            $sql = "SELECT d.DokumenID, jd.NamaDokumen, jd.Tipe, d.TanggalUpload, d.Status
                    FROM Dokumen d
                    JOIN JenisDokumen jd ON d.JenisDokumenID = jd.JenisDokumenID
                    WHERE d.MahasiswaNIM = :nim";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function getMahasiswaDetails($nim)
    {
        try {
            $sql = "SELECT 
                    u.Nama AS NamaMahasiswa, 
                    m.NIM, 
                    k.NamaKelas, 
                    p.NamaProdi
                FROM Mahasiswa m
                JOIN Users u ON m.UserID = u.UserID
                JOIN Kelas k ON m.KelasID = k.KelasID
                JOIN ProgramStudi p ON k.ProdiID = p.ProdiID
                WHERE m.NIM = :nim";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function updateProfile($nim, $newData)
    {
        try {
            $sql = "UPDATE Mahasiswa m
                JOIN Users u ON m.UserID = u.UserID
                JOIN Kelas k ON m.KelasID = k.KelasID
                SET u.Nama = :nama,
                    m.NIM = :newNim,
                    m.KelasID = (SELECT KelasID FROM Kelas WHERE NamaKelas = :kelas),
                    k.ProdiID = (SELECT ProdiID FROM ProgramStudi WHERE NamaProdi = :programStudi)
                WHERE m.NIM = :nim";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':nama', $newData['nama'], PDO::PARAM_STR);
            $stmt->bindParam(':newNim', $newData['newNim'], PDO::PARAM_STR);
            $stmt->bindParam(':kelas', $newData['kelas'], PDO::PARAM_STR);
            $stmt->bindParam(':programStudi', $newData['programStudi'], PDO::PARAM_STR);
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new Exception("Update gagal: " . $e->getMessage());
        }
    }

    public function updatePassword($nim, $newPassword)
    {
        try {
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $sql = "UPDATE Users u
                JOIN Mahasiswa m ON u.UserID = m.UserID
                SET u.Password = :password
                WHERE m.NIM = :nim";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new Exception("Update gagal: " . $e->getMessage());
        }
    }
}
