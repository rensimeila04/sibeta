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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <span>Pengguna</span>
                    <span class="separator">/</span>
                    <span>Admin</span>
                </div>
                <div class="mb-3">
                    <h3>Admin</h3>
                </div>

                <div class="card p-3">
                    <!-- Search and Add Admin Buttons -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="input-group w-25" style="border-radius: 8px;">
                            <span class="input-group-text" id="basic-addon1" style="background-color: #FFFFFF;">
                                <i class="bi bi-search" style="color: #ADB5BD; font-size: 16px;"></i>
                            </span>
                            <input type="text" id="searchInput" class="form-control" placeholder="Cari ..." aria-label="Search" aria-describedby="basic-addon1" style="border-left: none;">
                            <button class="btn" id="searchButton" style="margin-left: 10px; color:#fff; background-color: #3E368C; border-radius: 4px; height: auto;">Cari</button>
                        </div>
                        <a href="/sibeta/public/index.php?page=super_admin/tambah_admin" class="btn btn-custom">Tambah Admin</a>
                    </div>

                    <!-- Admin Table -->
                    <div class="table-container w-100">
                        <table class="table table-striped table-borderless" id="documentsTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th style="width: 75%;">Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($admin as $row): ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['NIP']; ?></td>
                                        <td><?php echo $row['Nama']; ?></td>
                                        <td>
                                            <a href="/sibeta/public/index.php?page=super_admin/detail_admin&nip=<?= $row['NIP']; ?>" class="material-symbols-outlined align-items-center btn-custom" style="text-decoration: none;">visibility</a>
                                            <a href="#" class="material-symbols-outlined align-items-center btn-custom3" style="text-decoration: none;" onclick="showDeleteModal('<?= $row['NIP']; ?>')">delete</a>
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

    <!-- Modal for Deletion Confirmation -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #f8f9fa; color: #333; border-radius: 8px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data terkait?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a id="confirmDeleteBtn" class="btn btn-danger" href="#">Hapus</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showDeleteModal(nip) {
            // Set the action of the delete button
            var deleteButton = document.getElementById("confirmDeleteBtn");
            deleteButton.href = "/sibeta/public/index.php?page=super_admin/delete_admin&nip=" + nip;

            // Show the modal
            var myModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            myModal.show();
        }
    </script>
    <script>
        document.getElementById("searchButton").addEventListener("click", function() {
            var searchInput = document.getElementById("searchInput").value.toLowerCase();
            var table = document.getElementById("documentsTable");
            var rows = table.getElementsByTagName("tr");

            // Loop through all table rows (excluding the header)
            for (var i = 1; i < rows.length; i++) {
                var row = rows[i];
                var nameColumn = row.cells[2].textContent.toLowerCase(); // The Nama column is index 2

                if (nameColumn.includes(searchInput)) {
                    row.style.display = ""; // Show row
                } else {
                    row.style.display = "none"; // Hide row
                }
            }
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