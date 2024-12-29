<?php
class KelasController
{
    private $kelasModel;

    public function __construct($db)
    {
        $this->kelasModel = new KelasModel($db);
    }

    public function showKelas($kelasID = null)
    {
        return $this->kelasModel->getKelas($kelasID);
    }

    public function getKelasID($kelasID = null)
    {
        return $this->kelasModel->getKelasByID($kelasID);
    }

    // Fungsi untuk menambah data kelas
    public function tambahKelas($namaKelas, $prodiID)
    {
        try {
            $result = $this->kelasModel->insertKelas($namaKelas, $prodiID);

            if ($result) {
                header("Location: /sibeta/public/index.php?page=super_admin/kelas&success=1");
            } else {
                header("Location: /sibeta/public/index.php?page=super_admin/kelas&error=Gagal menambahkan kelas");
            }
        } catch (Exception $e) {
            header("Location: /sibeta/public/index.php?page=super_admin/kelas&error=" . urlencode($e->getMessage()));
        }
        exit();
    }

    // Fungsi untuk mengedit data kelas
    public function editKelas($kelasID, $prodiID, $namaKelas)
    {
        try {
            // Validasi input
            if (empty($kelasID) || empty($prodiID) || empty($namaKelas)) {
                throw new Exception("Semua data harus diisi.");
            }

            // Update data melalui model
            $result = $this->kelasModel->updateKelas($kelasID, $prodiID, $namaKelas);

            if ($result) {
                header("Location: /sibeta/public/index.php?page=super_admin/kelas&success=update");
                exit();
            } else {
                throw new Exception("Gagal memperbarui data kelas.");
            }
        } catch (Exception $e) {
            header("Location: /sibeta/public/index.php?page=super_admin/detail_kelas&id=" . $kelasID . "&error=" . urlencode($e->getMessage()));
            exit();
        }
    }
    // Fungsi untuk menghapus data kelas
    public function hapusKelas($kelasID)
    {
        if ($kelasID) {
            // Call the model to delete the kelas
            $this->kelasModel->deleteKelas($kelasID);
        }

        // Redirect to the kelas page after deletion
        header("Location: /sibeta/public/index.php?page=super_admin/kelas");
        exit();
    }
}
