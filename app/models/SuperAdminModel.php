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

    public function getJenisDokumenById($id)
    {
        try {
            $sql = "SELECT * FROM JenisDokumen WHERE JenisDokumenID = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                throw new Exception("Jenis dokumen dengan ID $id tidak ditemukan.");
            }

            return $result;
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function editJenisDokumen($jenisDokumenID, $namaDokumen, $tipe, $isRequired)
    {
        try {
            $sql = "
            UPDATE JenisDokumen
            SET 
                NamaDokumen = :namaDokumen,
                Tipe = :tipe,
                IsRequired = :isRequired
            WHERE 
                JenisDokumenID = :jenisDokumenID
        ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':namaDokumen', $namaDokumen);
            $stmt->bindParam(':tipe', $tipe);
            $stmt->bindParam(':isRequired', $isRequired, PDO::PARAM_BOOL);
            $stmt->bindParam(':jenisDokumenID', $jenisDokumenID, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->rowCount() > 0; // Mengembalikan true jika ada perubahan
        } catch (PDOException $e) {
            throw new Exception("Gagal mengedit jenis dokumen: " . $e->getMessage());
        }
    }
    public function getAllProdi()
    {
        try {
            $sql = "SELECT * FROM ProgramStudi ORDER BY ProdiID ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function addProdi($namaProdi)
    {
        try {
            $sql = "INSERT INTO ProgramStudi (NamaProdi) VALUES (:namaProdi)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':namaProdi', $namaProdi, PDO::PARAM_STR);
            $stmt->execute();
            return $this->conn->lastInsertId(); // Mengembalikan ID dari program studi yang baru ditambahkan
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function deleteProdi($prodiID)
    {
        try {
            $sql = "DELETE FROM ProgramStudi WHERE ProdiID = :prodiID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':prodiID', $prodiID, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true; // Berhasil dihapus
            } else {
                return false; // Tidak ada data yang dihapus
            }
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }
    public function getProdiById($prodiID)
    {
        try {
            $sql = "SELECT * FROM ProgramStudi WHERE ProdiID = :prodiID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':prodiID', $prodiID, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function updateProdi($prodiID, $namaProdi)
    {
        try {
            $sql = "UPDATE ProgramStudi SET NamaProdi = :namaProdi WHERE ProdiID = :prodiID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':namaProdi', $namaProdi, PDO::PARAM_STR);
            $stmt->bindParam(':prodiID', $prodiID, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true; // Berhasil diperbarui
            } else {
                return false; // Tidak ada data yang diperbarui
            }
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }
}
