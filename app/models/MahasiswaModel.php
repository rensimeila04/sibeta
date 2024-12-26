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
            $sql = "SELECT d.DokumenID, jd.NamaDokumen, jd.Tipe, d.TanggalUpload, d.Status, d.FilePath, d.KomentarRevisi
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

    public function getDocumentById($id)
    {
        try {
            $sql = "SELECT d.DokumenID, jd.NamaDokumen, jd.Tipe, d.TanggalUpload, d.Status, d.FilePath, d.KomentarRevisi
                    FROM Dokumen d
                    JOIN JenisDokumen jd ON d.JenisDokumenID = jd.JenisDokumenID
                    WHERE d.DokumenID = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    // Mengambil dokumen berdasarkan Type
    public function getDocumentsByType($nim, $tipe)
    {
        try {
            $sql = "SELECT d.DokumenID, jd.NamaDokumen, jd.Tipe, d.FilePath, d.TanggalUpload, d.Status, d.IsSaved, jd.JenisDokumenID
                FROM Dokumen d
                JOIN JenisDokumen jd ON d.JenisDokumenID = jd.JenisDokumenID
                WHERE d.MahasiswaNIM = :nim AND jd.Tipe = :tipe";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
            $stmt->bindParam(':tipe', $tipe, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }


    public function getDocumentCountByType($nim, $tipe)
    {
        try {
            $sql = "SELECT COUNT(*) as count
                    FROM Dokumen d
                    JOIN JenisDokumen jd ON d.JenisDokumenID = jd.JenisDokumenID
                    WHERE d.MahasiswaNIM = :nim AND jd.Tipe = :tipe";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
            $stmt->bindParam(':tipe', $tipe, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    // Fungsi untuk mengecek apakah dokumen administratif sudah lengkap
    public function isAdministrativeDocumentsComplete($nim)
    {
        try {
            // Mengambil semua jenis dokumen administratif
            $sql = "SELECT jd.JenisDokumenID
                FROM JenisDokumen jd
                WHERE jd.Tipe = 'Administratif'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $jenisDokumenAdmin = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Mengecek apakah mahasiswa sudah mengunggah semua dokumen administratif
            foreach ($jenisDokumenAdmin as $dokumen) {
                $sql = "SELECT COUNT(*) as count
                    FROM Dokumen d
                    WHERE d.MahasiswaNIM = :nim
                    AND d.JenisDokumenID = :jenisDokumenID";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
                $stmt->bindParam(':jenisDokumenID', $dokumen['JenisDokumenID'], PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                // Jika ada dokumen yang belum diunggah
                if ($result['count'] == 0) {
                    return false; // Dokumen belum lengkap
                }
            }
            return true; // Semua dokumen administratif sudah diunggah
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function isTeknisDocumentsComplete($nim)
    {
        try {
            // Mengambil semua jenis dokumen administratif
            $sql = "SELECT jd.JenisDokumenID
                FROM JenisDokumen jd
                WHERE jd.Tipe = 'Teknis'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $jenisDokumenTeknis = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Mengecek apakah mahasiswa sudah mengunggah semua dokumen administratif
            foreach ($jenisDokumenTeknis as $dokumen) {
                $sql = "SELECT COUNT(*) as count
                    FROM Dokumen d
                    WHERE d.MahasiswaNIM = :nim
                    AND d.JenisDokumenID = :jenisDokumenID";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
                $stmt->bindParam(':jenisDokumenID', $dokumen['JenisDokumenID'], PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                // Jika ada dokumen yang belum diunggah
                if ($result['count'] == 0) {
                    return false; // Dokumen belum lengkap
                }
            }
            return true; // Semua dokumen administratif sudah diunggah
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    // Menampilkan semua jenis dokumen
    public function getJenisDokumen($tipe)
    {
        try {
            $sql = "SELECT JenisDokumenID, NamaDokumen, Tipe
                    FROM JenisDokumen
                    WHERE Tipe = :tipe";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':tipe', $tipe, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    // Fungsi untuk menambahkan dokumen
    public function uploadDocument($nim, $jenisDokumenID, $file)
    {
        try {
            // Mengecek apakah file yang diunggah adalah PDF
            if ($file['type'] !== 'application/pdf') {
                throw new Exception("Hanya file PDF yang diperbolehkan.");
            }

            // Menyimpan file ke folder uploads/dokumen
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/sibeta/app/uploads/dokumen/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $fileName = $nim . '_' . time() . '_' . basename($file['name']);
            $filePath = $uploadDir . $fileName;
            $savePath = 'uploads/dokumen/' . $fileName;

            // Memeriksa file tmp_name
            if (!is_uploaded_file($file['tmp_name'])) {
                throw new Exception("File upload tidak valid.");
            }

            // Memindahkan file ke lokasi yang ditentukan
            if (!move_uploaded_file($file['tmp_name'], $filePath)) {
                throw new Exception("Gagal mengunggah file.");
            }

            // Menyimpan data dokumen ke database
            $sql = "INSERT INTO Dokumen (MahasiswaNIM, JenisDokumenID, FilePath, Status)
                VALUES (:nim, :jenisDokumenID, :filePath, 'Diajukan')";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
            $stmt->bindParam(':jenisDokumenID', $jenisDokumenID, PDO::PARAM_INT);
            $stmt->bindParam(':filePath', $savePath, PDO::PARAM_STR);
            $stmt->execute();

            return true; // Berhasil mengunggah dokumen
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    // Menghapus dokumen berdasarkan DokumenID
    public function deleteDocument($dokumenID, $nim)
    {
        try {
            // Verifikasi apakah dokumen milik mahasiswa yang sesuai
            $sqlCheckOwnership = "SELECT COUNT(*) as count
                              FROM Dokumen
                              WHERE DokumenID = :dokumenID AND MahasiswaNIM = :nim";
            $stmt = $this->conn->prepare($sqlCheckOwnership);
            $stmt->bindParam(':dokumenID', $dokumenID, PDO::PARAM_INT);
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result['count'] == 0) {
                throw new Exception("Dokumen tidak ditemukan atau Anda tidak memiliki akses.");
            }

            // Hapus dokumen dari database
            $sqlDelete = "DELETE FROM Dokumen WHERE DokumenID = :dokumenID";
            $stmt = $this->conn->prepare($sqlDelete);
            $stmt->bindParam(':dokumenID', $dokumenID, PDO::PARAM_INT);
            $stmt->execute();

            return true;

            // Dokumen berhasil dihapus
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function updateIsSavedByType($nim, $tipe)
    {
        try {
            // Query untuk mengupdate IsSaved menjadi 1 berdasarkan tipe dokumen
            $sql = "UPDATE d
                SET d.IsSaved = 1
                FROM Dokumen d
                INNER JOIN JenisDokumen jd ON d.JenisDokumenID = jd.JenisDokumenID
                WHERE d.MahasiswaNIM = :nim AND jd.Tipe = :tipe";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
            $stmt->bindParam(':tipe', $tipe, PDO::PARAM_STR);
            $stmt->execute();

            // Mengembalikan jumlah baris yang terpengaruh
            return $stmt->rowCount();
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    // Fungsi untuk mengedit dokumen
    public function updateDocument($dokumenID, $jenisDokumenID, $filePath = null)
    {
        try {
            // Validasi file PDF jika filepath ada
            if (!empty($filePath)) {
                // Validasi ekstensi file
                $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                if ($fileExtension !== 'pdf') {
                    throw new Exception("File harus berformat PDF.");
                }
            }

            // Sisa kode sama seperti sebelumnya
            if (empty($filePath)) {
                $sql = "UPDATE Dokumen
                        SET JenisDokumenID = :jenisDokumenID,
                            TanggalUpload = GETDATE()
                        WHERE DokumenID = :dokumenID";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':dokumenID', $dokumenID, PDO::PARAM_INT);
                $stmt->bindParam(':jenisDokumenID', $jenisDokumenID, PDO::PARAM_INT);
            } else {
                $sql = "UPDATE Dokumen
                        SET JenisDokumenID = :jenisDokumenID,
                            FilePath = :filePath,
                            TanggalUpload = GETDATE()
                        WHERE DokumenID = :dokumenID";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':dokumenID', $dokumenID, PDO::PARAM_INT);
                $stmt->bindParam(':jenisDokumenID', $jenisDokumenID, PDO::PARAM_INT);
                $stmt->bindParam(':filePath', $filePath, PDO::PARAM_STR);
            }

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new Exception("Update dokumen gagal: " . $e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
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
            // Debug: Print input parameters
            error_log("Attempting to update password for NIM: " . $nim);

            // Hash the password
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

            // Debug: Confirm hash was created
            error_log("Password hash created successfully");

            // Use SQL Server JOIN syntax
            $sql = "UPDATE u 
                    SET u.Password = :password 
                    FROM Users u 
                    INNER JOIN Mahasiswa m ON u.UserID = m.UserID 
                    WHERE m.NIM = :nim";

            // Debug: Print the SQL (without sensitive data)
            error_log("Executing SQL: " . str_replace(":password", "[HIDDEN]", $sql));

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);

            $success = $stmt->execute();

            // Debug: Check execution result
            error_log("Query execution result: " . ($success ? "success" : "failed"));
            error_log("Rows affected: " . $stmt->rowCount());

            if ($stmt->rowCount() === 0) {
                error_log("No rows were updated in the database");
                throw new Exception("Tidak ada perubahan yang dilakukan pada kata sandi.");
            }

            error_log("Password update completed successfully");
            return true;
        } catch (PDOException $e) {
            error_log("Database error during password update: " . $e->getMessage());
            throw new Exception("Gagal mengubah kata sandi: " . $e->getMessage());
        }
    }

    public function getMahasiswaByNIM($nim)
    {
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
