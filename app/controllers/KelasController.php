<?php
class KelasController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function getKelas($limit, $offset) {
        $query = "SELECT * FROM kelas ORDER BY id OFFSET ? ROWS FETCH NEXT ? ROWS ONLY";
        $stmt = $this->model->prepare($query);
        $stmt->bindValue(1, $offset, PDO::PARAM_INT);
        $stmt->bindValue(2, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function countKelas() {
        return $this->model->countKelas();
    }

    public function delete($id) {
        $this->model->deleteKelas($id);
        header('Location: /sibeta/public/index.php?page=kelas');
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['namaKelas'];
            $programStudi = $_POST['programStudi'];
            $this->model->addKelas($nama, $programStudi);
            header('Location: /sibeta/public/index.php?page=kelas');
        }
    }
}   