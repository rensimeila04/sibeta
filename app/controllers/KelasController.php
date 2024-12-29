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
        // Cek apakah program studi adalah "Teknik Informatika"
        if ($prodiID === "Teknik Informatika") {
            // Jika iya, ubah menjadi 1
            $prodiID = 1;
        }
        // Jika program studi bukan "Teknik Informatika", tetap menggunakan nilai yang ada
        elseif ($prodiID === "Sistem Informasi Bisnis") {
            $prodiID = 2;  // Misalkan 2 untuk Sistem Informasi Bisnis
        }

        return $this->kelasModel->insertKelas($namaKelas, $prodiID);
    }

    // Fungsi untuk mengedit data kelas
    public function editKelas($kelasID, $prodiID, $namaKelas)
    {
        return $this->kelasModel->updateKelas($kelasID, $prodiID, $namaKelas);
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
