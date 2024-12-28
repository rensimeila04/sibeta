<?php
class DokumenModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getDocumentCountByStatusIsSaved($tipe, $status)
    {
        try {
            $sql = "SELECT COUNT(*) AS count
                    FROM Dokumen d
                    JOIN JenisDokumen jd ON d.JenisDokumenID = jd.JenisDokumenID
                    WHERE jd.Tipe = :tipe AND d.Status = :status AND d.IsSaved = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':tipe', $tipe);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function getTotalDocuments($type)
    {
        // Menghitung total dokumen berdasarkan tipe (Administratif atau Teknis)
        $sql = "SELECT COUNT(*) as total FROM Dokumen d 
                JOIN JenisDokumen jd ON d.JenisDokumenID = jd.JenisDokumenID 
                WHERE jd.Tipe = :type AND d.IsSaved = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':type', $type);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }

    public function getTotalDocumentsMahasiswa($nim, $type)
    {
        // Menghitung total dokumen mahasiswa berdasarkan NIM dan tipe (Administratif atau Teknis)
        $sql = "SELECT COUNT(*) as total FROM Dokumen d 
                JOIN JenisDokumen jd ON d.JenisDokumenID = jd.JenisDokumenID 
                WHERE d.MahasiswaNIM = :nim AND jd.Tipe = :type AND d.IsSaved = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nim', $nim);
        $stmt->bindParam(':type', $type);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }

    public function getDocumentCountByStatusNoIsSaved($tipe, $status)
    {
        try {
            $sql = "SELECT COUNT(*) AS count
                    FROM Dokumen d
                    JOIN JenisDokumen jd ON d.JenisDokumenID = jd.JenisDokumenID
                    WHERE jd.Tipe = :tipe AND d.IsSaved = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':tipe', $tipe, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }



    public function getDocumentVerif($tipe)
    {
        try {
            $sql = "SELECT DISTINCT
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
                    WHERE jd.Tipe = :tipe AND d.IsSaved = 1
                    ORDER BY d.TanggalUpload DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':tipe', $tipe);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function getPageDocuments($tipe, $currentPage, $itemsPerPage)
    {
        try {
            $offset = ($currentPage - 1) * $itemsPerPage;

            $sql = "
                SELECT DISTINCT
            d.MahasiswaNIM AS Nim,
            u.Nama AS NamaMahasiswa,
            p.NamaProdi AS ProgramStudi,
            k.NamaKelas AS Kelas,
            MAX(d.TanggalUpload) AS TanggalUpload
        FROM Mahasiswa m
        INNER JOIN Dokumen d ON d.MahasiswaNIM = m.NIM
        INNER JOIN Users u ON m.UserID = u.UserID
        INNER JOIN JenisDokumen jd ON d.JenisDokumenID = jd.JenisDokumenID
        INNER JOIN Kelas k ON m.KelasID = k.KelasID 
        INNER JOIN ProgramStudi p ON k.ProdiID = p.ProdiID
        WHERE jd.Tipe = :tipe
          AND d.IsSaved = 1
          AND NOT EXISTS (
              SELECT 1
              FROM Dokumen d2
              WHERE d2.MahasiswaNIM = d.MahasiswaNIM
                AND d2.JenisDokumenID = d.JenisDokumenID
                AND d2.Status = 'Diverifikasi'
                AND d2.IsSaved = 1
          )
        GROUP BY d.MahasiswaNIM, u.Nama, p.NamaProdi, k.NamaKelas
        ORDER BY MAX(d.TanggalUpload) DESC
        OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY;

            ";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':tipe', $tipe);
            $stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function getPageDocumentsRiwayat($tipe, $currentPage, $itemsPerPage)
    {
        try {
            $offset = ($currentPage - 1) * $itemsPerPage;

            $sql = "
                SELECT DISTINCT
    d.MahasiswaNIM AS Nim,
    u.Nama AS NamaMahasiswa,
    p.NamaProdi AS ProgramStudi,
    k.NamaKelas AS Kelas,
    MAX(d.TanggalUpload) AS TanggalUpload
FROM Mahasiswa m
INNER JOIN Dokumen d ON d.MahasiswaNIM = m.NIM
INNER JOIN Users u ON m.UserID = u.UserID
INNER JOIN JenisDokumen jd ON d.JenisDokumenID = jd.JenisDokumenID
INNER JOIN Kelas k ON m.KelasID = k.KelasID 
INNER JOIN ProgramStudi p ON k.ProdiID = p.ProdiID
LEFT JOIN Dokumen d2 
    ON d2.MahasiswaNIM = d.MahasiswaNIM
    AND d2.JenisDokumenID = d.JenisDokumenID
    AND d2.Status != 'Diverifikasi'  -- Pastikan tidak ada dokumen dengan status selain 'Diverifikasi'
WHERE jd.Tipe = :tipe
  AND d.IsSaved = 1
GROUP BY d.MahasiswaNIM, u.Nama, p.NamaProdi, k.NamaKelas
HAVING COUNT(d2.MahasiswaNIM) = 0  -- Pastikan tidak ada dokumen yang tidak berstatus 'Diverifikasi'
ORDER BY MAX(d.TanggalUpload) DESC
OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY;

            ";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':tipe', $tipe);
            $stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }





    public function getPageDocumentsMahasiswa($nim, $tipe, $currentPage, $itemsPerPage)
    {
        try {
            $offset = ($currentPage - 1) * $itemsPerPage;
            $sql = "SELECT 
                        d.DokumenID,
                        j.NamaDokumen as NamaDokumen, 
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
                    WHERE d.MahasiswaNIM = :nim AND j.Tipe = :tipe AND d.IsSaved = 1
                    ORDER BY d.TanggalUpload DESC
                    OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nim', $nim);
            $stmt->bindParam(':tipe', $tipe);
            $stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function getDocumentMahasiswa($nim, $tipe)
    {
        try {
            $sql = "SELECT 
                        d.DokumenID,
                        j.NamaDokumen as NamaDokumen, 
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
                    WHERE d.MahasiswaNIM = :nim AND j.Tipe = :tipe AND d.IsSaved = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
            $stmt->bindParam(':tipe', $tipe, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function getDocumentMahasiswaByIDDocument($id, $tipe)
    {
        try {
            $sql = "SELECT 
                        d.DokumenID,
                        j.NamaDokumen as NamaDokumen, 
                        j.Tipe as Tipe,
                        d.TanggalUpload as TanggalUpload, 
                        d.Status as Status, 
                        d.FilePath as FilePath,
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
                    WHERE d.DokumenID = :id AND j.Tipe = :tipe AND d.IsSaved = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':tipe', $tipe, PDO::PARAM_STR);
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
}
