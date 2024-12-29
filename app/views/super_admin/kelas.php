<?php
$kelas = $kelasController->showKelas();

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $kelasID = $_GET['id'];
    $kelasController->hapusKelas($kelasID);
    header("Location: /sibeta/public/index.php?page=super_admin/kelas"); // Redirect after deletion
    exit();
}

if (isset($_GET['action']) && $_GET['action'] === 'tambah') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $namaKelas = $_POST['namaKelas'];
        $programStudi = $_POST['programStudi'];

        // Panggil method tambahKelas di controller
        $kelasController->tambahKelas($namaKelas, $programStudi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet" />
    <link rel="stylesheet" href="../../../public/assets/css/dashboard.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas - SIBETA</title>
</head>


<body>
    <div class="wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_super_admin.php"; ?>
        <div class="main">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_admin.php"; ?>
            <div class="p-4 dashboard">
                <div class="breadcrumbs mb-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="/sibeta/public/index.php?page=<?php echo $role; ?>">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Kelas</span>
                </div>
                <div class="mb-3">
                    <h2>Kelas</h2>
                </div>
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($_GET['error']) ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">
                        Data kelas berhasil diperbarui
                    </div>
                <?php endif; ?>

                <div class="card p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3 w-100">
                        <div class="input-group" style="width: auto; max-width: 400px;">
                            <span class="input-group-text" id="basic-addon1" style="background-color: #FFFFFF; border-right: none;">
                                <i class="bi bi-search" style="color: #ADB5BD; font-size: 16px;"></i>
                            </span>
                            <input type="text" id="searchInput" class="form-control" placeholder="Cari..." aria-label="Search"
                                aria-describedby="basic-addon1" style="border-left: none; border-radius: 0 4px 4px 0;">
                            <div class="ms-3">
                                <button class="btn" id="searchButton" style="color: #fff; background-color: #3E368C; border-radius: 4px;">Cari</button>
                            </div>
                        </div>
                        <div class="ms-3 align-items-end">
                            <button class="btn" id="tambahButton" data-bs-toggle="modal" data-bs-target="#tambahKelasModal" style="color: #fff; background-color: #3E368C; border-radius: 4px;">Tambah Kelas</button>
                        </div>
                    </div>

                    <div class="table-container w-100">
                        <?php if (!empty($kelas)): ?>
                            <table class="table table-striped table-borderless table-hover" id="documentsTable">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th style="width: 10%;">Nama</th>
                                        <th style="width: 70%;">Program Studi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($kelas as $index => $data): ?>
                                        <tr>
                                            <td><?= $index + 1; ?></td>
                                            <td><?= $data['nama_kelas']; ?></td>
                                            <td><?= $data['nama_prodi']; ?></td>
                                            <td>
                                                <a href="/sibeta/public/index.php?page=super_admin/detail_kelas&id=<?= $data['id_kelas']; ?>" class="material-symbols-outlined btn-custom" style="text-decoration: none;">visibility</a>
                                                <a href="#" class="material-symbols-outlined btn-custom3" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal" data-id="<?= $data['id_kelas']; ?>" style="text-decoration: none;">delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                    </div>
                <?php else: ?>
                    <p class="text-center">Data kelas tidak ditemukan.</p>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="tambahKelasModal" tabindex="-1" aria-labelledby="tambahKelasModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahKelasModalLabel">Tambahkan Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/sibeta/public/index.php?page=super_admin/kelas&action=tambah" id="tambahKelasForm">
                        <div class="mb-3">
                            <label for="namaKelas" class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" id="namaKelas" name="namaKelas" placeholder="Nama Kelas" required>
                        </div>
                        <div class="mb-3">
                            <label for="programStudi" class="form-label">Program Studi</label>
                            <select class="form-select" id="programStudi" name="programStudi" required>
                                <option value="">Pilih Program Studi</option>
                                <option value="Teknik Informatika">Teknik Informatika</option>
                                <option value="Sistem Informasi Bisnis">Sistem Informasi Bisnis</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn" style="background-color: #3E368C; color: #fff;" form="tambahKelasForm">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Hapus kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus <strong><span id="kelasName"></span></strong> kelas ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a id="confirmDeleteButton" href="#" class="btn btn-danger">
                        Hapus
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Get all delete buttons and trigger modal with the correct KelasID
        document.querySelectorAll('.btn-custom3').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                var kelasID = button.getAttribute('data-id');
                var kelasName = button.closest('tr').querySelector('td:nth-child(2)').innerText; // Get class name

                // Set the Kelas name in the modal
                document.getElementById('kelasName').innerText = kelasName;

                // Update the modal link with the KelasID for deletion
                document.getElementById('confirmDeleteButton').setAttribute('href', '/sibeta/public/index.php?page=super_admin/kelas&action=delete&id=' + kelasID);
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const searchButton = document.getElementById('searchButton');

            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase();

                // Cari semua tabel yang ada
                const tables = document.querySelectorAll('.table');

                tables.forEach(table => {
                    const tbody = table.querySelector('tbody');
                    if (tbody) {
                        const rows = tbody.querySelectorAll('tr');

                        rows.forEach(row => {
                            const documentName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                            row.style.display = documentName.includes(searchTerm) ? '' : 'none';
                        });
                    }
                });
            }

            // Event listeners
            searchButton.addEventListener('click', performSearch);
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });
            searchInput.addEventListener('input', performSearch);
        });
    </script>

</body>

</html>