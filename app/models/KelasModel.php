<?php
class KelasModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getKelas()
    {
        $query = "
            SELECT 
                Kelas.KelasID AS id_kelas, 
                Kelas.NamaKelas AS nama_kelas, 
                ProgramStudi.NamaProdi AS nama_prodi
            FROM 
                Kelas
            INNER JOIN 
                ProgramStudi
            ON 
                Kelas.ProdiID = ProgramStudi.ProdiID
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function getKelasById($kelasID)
    {
        $sql = "SELECT k.KelasID, k.NamaKelas, k.ProdiID, p.NamaProdi 
                FROM kelas k 
                JOIN ProgramStudi p ON k.ProdiID = p.ProdiID 
                WHERE k.KelasID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$kelasID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function checkExistingKelas($namaKelas, $prodiID)
    {
        $query = "SELECT COUNT(*) FROM Kelas WHERE LOWER(NamaKelas) = LOWER(?) AND ProdiID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([trim($namaKelas), $prodiID]);
        return $stmt->fetchColumn() > 0;
    }

    public function insertKelas($namaKelas, $programStudi)
    {
        try {
            // Validasi data yang diterima
            if (empty($namaKelas) || empty($programStudi)) {
                throw new Exception("Data tidak lengkap.");
            }

            // Convert program studi to ID if necessary
            $prodiID = (is_numeric($programStudi)) ? $programStudi : ($programStudi === "Teknik Informatika" ? 1 : ($programStudi === "Sistem Informasi Bisnis" ? 2 : null));

            if ($prodiID === null) {
                throw new Exception("Program studi tidak valid.");
            }

            // Check if class already exists
            if ($this->checkExistingKelas($namaKelas, $prodiID)) {
                throw new Exception("Kelas dengan nama yang sama sudah ada untuk program studi ini.");
            }

            // If no duplicate found, proceed with insertion
            $sql = "INSERT INTO kelas (NamaKelas, ProdiID) VALUES (?, ?)";
            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute([trim($namaKelas), $prodiID]);

            if (!$result) {
                throw new Exception("Gagal menambahkan kelas.");
            }

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
    // Fungsi untuk mengedit data kelas
    public function updateKelas($kelasID, $prodiID, $namaKelas)
    {
        try {
            // Validasi parameter input
            if (empty($kelasID) || empty($prodiID) || empty($namaKelas)) {
                throw new Exception("Data tidak boleh kosong.");
            }

            if (!is_numeric($kelasID) || !is_numeric($prodiID)) {
                throw new Exception("KelasID dan ProdiID harus berupa angka.");
            }

            // Query untuk update
            $query = "UPDATE Kelas 
                      SET ProdiID = :prodiID, NamaKelas = :namaKelas 
                      WHERE KelasID = :kelasID";
            $stmt = $this->conn->prepare($query);

            // Bind parameter untuk mencegah SQL Injection
            $stmt->bindParam(':kelasID', $kelasID, PDO::PARAM_INT);
            $stmt->bindParam(':prodiID', $prodiID, PDO::PARAM_INT);
            $stmt->bindParam(':namaKelas', $namaKelas, PDO::PARAM_STR);

            // Eksekusi query
            if ($stmt->execute()) {
                return true; // Berhasil
            } else {
                throw new Exception("Gagal memperbarui data.");
            }
        } catch (Exception $e) {
            // Tangani error
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    // Fungsi untuk menghapus data kelas
    public function deleteKelas($kelasID)
    {
        if (isset($kelasID) && is_numeric($kelasID)) {
            // SQL query to delete the class
            $sql = "DELETE FROM Kelas WHERE KelasID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$kelasID]);
        } else {
            throw new Exception('Invalid KelasID');
        }
    }
}
