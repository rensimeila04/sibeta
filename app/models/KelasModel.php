<?php
class KelasModel {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function getKelas($limit, $offset) {
        $query = "SELECT * FROM kelas LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countKelas() {
        $query = "SELECT COUNT(*) AS total FROM kelas";
        $stmt = $this->db->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function deleteKelas($id) {
        $query = "DELETE FROM kelas WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function addKelas($nama, $programStudi) {
        $query = "INSERT INTO kelas (nama, program_studi) VALUES (:nama, :programStudi)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nama', $nama);
        $stmt->bindValue(':programStudi', $programStudi);
        return $stmt->execute();
    }
}
