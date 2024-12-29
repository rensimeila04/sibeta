<?php
class SuperAdminModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get total number of students
    public function getTotalStudents()
    {
        try {
            $sql = "SELECT COUNT(*) as count FROM Mahasiswa";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function getTotalTechnicians()
    {
        try {
            $sql = "SELECT COUNT(*) as count FROM Users WHERE RoleID = (SELECT RoleID FROM Roles WHERE RoleName = 'Teknisi')";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function getTotalAdminProdi()
    {
        try {
            $sql = "SELECT COUNT(*) as count FROM Users WHERE RoleID = (SELECT RoleID FROM Roles WHERE RoleName = 'Admin Prodi')";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function getTotalDocuments()
    {
        try {
            $sql = "SELECT COUNT(*) as count FROM Dokumen";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function getStudentsByProdi()
    {
        try {
            $sql = "
                SELECT 
                    ps.NamaProdi, COUNT(m.NIM) as count
                FROM 
                    Mahasiswa m
                INNER JOIN 
                    Kelas k ON m.KelasID = k.KelasID
                INNER JOIN 
                    ProgramStudi ps ON k.ProdiID = ps.ProdiID
                WHERE 
                    ps.NamaProdi IN ('Sistem Informasi Bisnis', 'Teknik Informatika')
                GROUP BY 
                    ps.NamaProdi
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $output = [];
            foreach ($result as $row) {
                $output[$row['NamaProdi']] = $row['count'];
            }
            return $output;
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function getJenisDokumen()
    {
        try {
            $sql = "SELECT JenisDokumenID, NamaDokumen, Tipe, IsRequired FROM JenisDokumen";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function addJenisDokumen($namaDokumen, $tipe, $isRequired = 1)
    {
        try {
            $sql = "INSERT INTO JenisDokumen (NamaDokumen, Tipe, IsRequired) 
                VALUES (:namaDokumen, :tipe, :isRequired)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':namaDokumen', $namaDokumen);
            $stmt->bindParam(':tipe', $tipe);
            $stmt->bindParam(':isRequired', $isRequired, PDO::PARAM_BOOL);
            $stmt->execute();
            return $this->conn->lastInsertId(); // Mengembalikan ID dari dokumen yang baru ditambahkan
        } catch (PDOException $e) {
            throw new Exception("Gagal menambahkan jenis dokumen: " . $e->getMessage());
        }
    }

    public function deleteJenisDokumen($jenisDokumenID)
    {
        try {
            $sql = "DELETE FROM JenisDokumen WHERE JenisDokumenID = :jenisDokumenID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':jenisDokumenID', $jenisDokumenID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount() > 0; // True jika ada baris yang dihapus
        } catch (PDOException $e) {
            throw new Exception("Penghapusan gagal: " . $e->getMessage());
        }
    }
}
