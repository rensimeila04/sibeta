<?php
class TeknisiModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getDocumentCountByStatus($status)
    {
        try {
            $sql = "SELECT COUNT(*) AS count
                    FROM Dokumen d
                    JOIN JenisDokumen jd ON d.JenisDokumenID = jd.JenisDokumenID
                    WHERE jd.Tipe = 'Teknis' AND d.Status = :status";
            $stmt = $this->conn->prepare($sql);
            // $stmt->bindParam(':nip', $nip, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function getDocumentVerifByTeknisiProdi()
    {
        try {
            $sql = "SELECT  DISTINCT
                        d.MahasiswaNIM AS Nim,
                        u.Nama AS NamaMahasiswa,
                        p.NamaProdi AS ProgramStudi, 
                        k.NamaKelas AS Kelas,
                        d.TanggalUpload
                    FROM Dokumen d
                    JOIN Mahasiswa m ON d.MahasiswaNIM = m.NIM
                    JOIN Users u ON m.UserID = u.UserID
                    JOIN JenisDokumen jd ON d.JenisDokumenID = jd.JenisDokumenID
                    JOIN Kelas k ON m.KelasID = k.KelasID 
                    JOIN ProgramStudi p ON k.ProdiID = p.ProdiID 
                    WHERE jd.Tipe = 'Teknis'
                    ORDER BY d.TanggalUpload DESC";
            $stmt = $this->conn->prepare($sql);
            // $stmt->bindParam(':nip', $nip, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function getDocumentMahasiswa($nim) {
        try {
            $sql = "SELECT 
                        d.DokumenID,
                        j.NamaDokumen as NamaDokumen, 
                        d.TanggalUpload as TanggalUpload, 
                        d.Status as Status,
                        d.MahasiswaNIM as Nim,
                        d.IsSaved as IsSaved,
                        u.Nama as NamaMahasiswa,
                        k.namaKelas as Kelas,
                        p.NamaProdi as ProgramStudi
                    FROM Dokumen d
                    JOIN JenisDokumen j ON d.JenisDokumenID = j.JenisDokumenID
                    JOIN Mahasiswa m ON d.MahasiswaNIM = m.NIM
                    JOIN Users u ON m.UserID = u.UserID
                    JOIN Kelas k ON m.KelasID = k.KelasID 
                    JOIN ProgramStudi p ON k.ProdiID = p.ProdiID
                    WHERE d.MahasiswaNIM = :nim AND j.Tipe = 'Teknis'";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function getDocumentMahasiswaByIDDocument($id) {
        try {
            $sql = "SELECT 
                        d.DokumenID,
                        j.NamaDokumen as NamaDokumen, 
                        j.Tipe as Tipe,
                        d.TanggalUpload as TanggalUpload, 
                        d.Status as Status,
                        d.MahasiswaNIM as Nim,
                        d.FilePath as FilePath,
                        d.IsSaved as IsSaved,
                        u.Nama as NamaMahasiswa,
                        k.namaKelas as Kelas,
                        p.NamaProdi as ProgramStudi
                    FROM Dokumen d
                    JOIN JenisDokumen j ON d.JenisDokumenID = j.JenisDokumenID
                    JOIN Mahasiswa m ON d.MahasiswaNIM = m.NIM
                    JOIN Users u ON m.UserID = u.UserID
                    JOIN Kelas k ON m.KelasID = k.KelasID 
                    JOIN ProgramStudi p ON k.ProdiID = p.ProdiID
                    WHERE d.DokumenID = :id AND j.Tipe = 'Teknis'";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function updateDocumentStatus($id, $nip, $status, $comment)
    {
        try {
            $sql = "UPDATE Dokumen SET 
                        Status = :status,
                        VerifikatorNIP = :nip,
                        TanggalVerifikasi = GETDATE(),
                        KomentarRevisi = :comment
                    WHERE DokumenID = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':nip', $nip, PDO::PARAM_STR);
            $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }   

    public function createNotification($nim, $pesan){
        try {
            $sql = "INSERT INTO Notifikasi (MahasiswaNIM, Pesan) VALUES (:nim, :pesan)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
            $stmt->bindParam(':pesan', $pesan, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }
}
