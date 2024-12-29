<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data yang dikirimkan dari form
    $namaKelas = $_POST['nama']; // Nama Kelas yang baru
    $programStudi = $_POST['programStudi']; // Program Studi yang baru
    $kelasID = $_POST['id']; // ID Kelas yang akan diupdate

    // Panggil method update di controller untuk update data kelas
    $kelasController->editKelas($kelasID, $namaKelas, $programStudi);

    // Redirect atau tampilkan pesan sukses setelah update
    header("Location: /sibeta/public/index.php?page=super_admin/kelas"); // Redirect kembali ke daftar kelas
    exit();
}
?>