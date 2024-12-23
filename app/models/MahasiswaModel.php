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

    public function getMahasiswaByNIM($nim) {
        try {
            $sql = "SELECT 
                m.NIM,
                u.Nama as NamaMahasiswa,
                k.namaKelas as Kelas,
                p.NamaProdi as ProgramStudi
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
}