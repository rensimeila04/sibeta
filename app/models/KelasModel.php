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
        // Assuming you have a database connection in $this->db
        $sql = "SELECT * FROM kelas WHERE KelasID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$kelasID]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the row as an associative array
    }

    public function insertKelas($namaKelas, $programStudi)
    {
        // Validasi data yang diterima
        if (!empty($namaKelas) && !empty($programStudi)) {
            // Menyimpan data ke database
            $programStudi = (int)$programStudi;

            $sql = "INSERT INTO kelas (NamaKelas, ProdiID) VALUES (?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$namaKelas, $programStudi]);

            // Redirect atau tampilkan pesan sukses
            header("Location: /sibeta/public/index.php?page=super_admin/kelas");
            exit();
        } else {
            // Tampilkan error jika ada data yang kosong
            echo "Data tidak lengkap.";
        }
    }

    // Fungsi untuk mengedit data kelas
    public function updateKelas($kelasID, $prodiID, $namaKelas)
    {
        $query = "UPDATE Kelas SET ProdiID = :prodiID, NamaKelas = :namaKelas WHERE KelasID = :kelasID";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':kelasID', $kelasID);
        $stmt->bindParam(':prodiID', $prodiID);
        $stmt->bindParam(':namaKelas', $namaKelas);

        return $stmt->execute();
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
