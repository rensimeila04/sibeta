<?php
$documents = $superAdminController->getJenisDokumen();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteDocument'])) {
    $documentID = $_POST['document_id'];

    if ($documentID) {
        try {
            $isDeleted = $superAdminController->deleteJenisDokumen($documentID);

            if ($isDeleted) {
                echo json_encode(['success' => true, 'message' => 'Dokumen berhasil dihapus!']);
                exit;
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal menghapus dokumen. Dokumen mungkin tidak ditemukan.']);
                exit;
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID dokumen tidak valid.']);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIBETA</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_super_admin.php"; ?>

        <div class="main">
            <!-- Header -->
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_super_admin.php"; ?>

            <div class="p-4 dashboard">
                <div class="breadcrumbs mb-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Dokumen</span>
                </div>
                <div class="mb-3">
                    <h3>Dokumen</h3>
                    <div id="alertMessage" class="alert d-none" role="alert"></div>
                </div>
                <div class="py-3">
                    <div class="card">
                        <div class="card-body">
                            <!-- Search and Add Buttons -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="input-group w-25" style="border-radius: 8px;">
                                    <span class="input-group-text" id="basic-addon1" style="background-color: #FFFFFF;">
                                        <i class="bi bi-search" style="color: #ADB5BD; font-size: 16px;"></i>
                                    </span>
                                    <input type="text" id="searchInput" class="form-control" placeholder="Cari ..." aria-label="Search" aria-describedby="basic-addon1" style="border-left: none;">
                                    <button class="btn" id="searchButton" style="margin-left: 10px; color:#fff; background-color: #3E368C; border-radius: 4px; height: auto;">Cari</button>
                                </div>
                                <a href="/sibeta/public/index.php?page=super_admin/tambah_dokumen" class="btn-custom align-content-center" style="text-decoration: none;">Tambah Dokumen</a>
                            </div>

                            <!-- Documents Table -->
                            <div class="table-container w-100">
                                <table class="table table-striped table-borderless" id="documentsTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th style="width: 60%;">Nama</th>
                                            <th style="width: 24%;">Jenis Dokumen</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($documents as $doc): ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo htmlspecialchars($doc['NamaDokumen'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($doc['Tipe'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <a href="/sibeta/public/index.php?page=super_admin/detail_dokumen&id=<?php echo $doc['JenisDokumenID']; ?>" class="material-symbols-outlined align-items-center btn-custom" style="text-decoration: none;">visibility</a>
                                                    <button class="material-symbols-outlined align-items-center btn-custom3 deleteButton" style="text-decoration: none;" data-id="<?php echo $doc['JenisDokumenID']; ?>" data-bs-toggle="modal" data-bs-target="#deleteModal">delete</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus dokumen ini?
                    <input type="hidden" id="documentID" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="confirmDeleteButton" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const deleteModal = document.getElementById("deleteModal");
            const documentIDInput = document.getElementById("documentID");
            const alertMessage = document.getElementById("alertMessage");
            const confirmDeleteButton = document.getElementById("confirmDeleteButton");

            deleteModal.addEventListener("show.bs.modal", function(event) {
                const button = event.relatedTarget;
                const documentID = button.getAttribute("data-id");
                documentIDInput.value = documentID;
            });

            confirmDeleteButton.addEventListener("click", async function() {
                const documentID = documentIDInput.value;
                try {
                    const response = await fetch("", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: new URLSearchParams({
                            deleteDocument: true,
                            document_id: documentID
                        })
                    });

                    const result = await response.json();

                    if (result.success) {
                        alertMessage.className = "alert alert-success";
                        alertMessage.textContent = result.message;
                        alertMessage.classList.remove("d-none");
                        setTimeout(() => location.reload(), 2000);
                    } else {
                        alertMessage.className = "alert alert-danger";
                        alertMessage.textContent = result.message;
                        alertMessage.classList.remove("d-none");
                    }

                    const bootstrapModal = bootstrap.Modal.getInstance(deleteModal);
                    bootstrapModal.hide();
                } catch (error) {
                    alertMessage.className = "alert alert-danger";
                    alertMessage.textContent = "Terjadi kesalahan saat menghapus dokumen.";
                    alertMessage.classList.remove("d-none");
                }
            });

            deleteModal.addEventListener("hidden.bs.modal", function() {
                const backdrops = document.querySelectorAll(".modal-backdrop");
                backdrops.forEach(backdrop => backdrop.remove());
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