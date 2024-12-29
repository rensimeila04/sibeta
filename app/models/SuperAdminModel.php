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
}