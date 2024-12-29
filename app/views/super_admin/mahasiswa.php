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
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_super_admin.php"; ?>

        <div class="main">
            <!-- Header -->
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_admin.php"; ?>

            <div class="p-4 dashboard">
                <div class="breadcrumbs mb-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Pengguna</span>
                    <span class="separator">/</span>
                    <span>Mahasiswa</span>
                </div>
                <div class="mb-3">
                    <h2>Mahasiswa</h2>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <!-- Search and Add Mahasiswa Buttons -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center" style="border-radius: 8px; width: 300px; position: relative;">
                                <i class="bi bi-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #ADB5BD; font-size: 16px;"></i>
                                <input type="text" id="searchInput" class="form-control" placeholder="Cari" aria-label="Search"
                                    style="padding-left: 35px; border-radius: 8px; width: 100%;">
                                <button id="searchButton" class="btn" style="margin-left: 10px; color:#fff; background-color: #3E368C; border-radius: 4px; height: auto;">Cari</button>
                            </div>
                            <a href="/sibeta/public/index.php?page=super_admin/tambah_mahasiswa" class="btn-custom align-items-center text-decoration-none" style="background-color: #3E368C; color: #fff; border-radius: 4px; height: auto; line-height: 1.5; margin: 20px;">Tambah Mahasiswa</a>
                        </div>

                        <!-- Mahasiswa Table -->
                        <div class="table-container w-100">
                            <table class="table table-striped table-borderless" id="mahasiswaTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Kelas</th>
                                        <th>Program Studi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <?php if (count($mahasiswa) > 0): ?>
                                        <?php $no = ($currentPage - 1) * $itemsPerPage + 1; ?>
                                        <?php foreach ($mahasiswa as $mhs): ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo htmlspecialchars($mhs['NIM']); ?></td>
                                                <td><?php echo htmlspecialchars($mhs['NamaMahasiswa']); ?></td>
                                                <td><?php echo htmlspecialchars($mhs['Kelas']); ?></td>
                                                <td><?php echo htmlspecialchars($mhs['ProgramStudi']); ?></td>
                                                <td>
                                                    <a href="/sibeta/public/index.php?page=super_admin/detail_mahasiswa&nim=<?php echo urlencode($mhs['NIM']); ?>" class="material-symbols-outlined align-items-center btn-custom" style="text-decoration: none;">visibility</a>
                                                    <a href="#" class="material-symbols-outlined align-items-center btn-custom3 delete-button" style="text-decoration: none;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#hapusMahasiswa"
                                                        data-nim="<?php echo htmlspecialchars($mhs['NIM']); ?>"
                                                        data-nama="<?php echo htmlspecialchars($mhs['NamaMahasiswa']); ?>"
                                                        onclick="document.getElementById('deleteMahasiswaNim').value = this.getAttribute('data-nim'); document.getElementById('deleteMahasiswaName').innerText = this.getAttribute('data-nama');">
                                                        delete
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data mahasiswa ditemukan.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <!-- Pagination Controls -->
                            <div class="pagination mt-5 text-center">
                                <?php
                                $totalPages = ceil($totalMahasiswaCount / $itemsPerPage);

                                if ($totalPages > 1) {
                                    echo '<div class="pagination-nav">';

                                    // Add "Previous" arrow
                                    if ($currentPage > 1) {
                                        $prevPage = $currentPage - 1;
                                        echo "<a href='/sibeta/public/index.php?page=super_admin/mahasiswa&page_number=$prevPage' class='arrow'>&laquo;</a>";
                                    }

                                    // Display page numbers with "..." for truncation
                                    $startPage = max(1, $currentPage - 2);
                                    $endPage = min($totalPages, $currentPage + 2);

                                    if ($startPage > 1) {
                                        echo "<a href='/sibeta/public/index.php?page=super_admin/mahasiswa&page_number=1'>1</a>";
                                        if ($startPage > 2) {
                                            echo "<span class='dots'>...</span>";
                                        }
                                    }

                                    for ($i = $startPage; $i <= $endPage; $i++) {
                                        $active = $i == $currentPage ? 'active' : '';
                                        echo "<a href='/sibeta/public/index.php?page=super_admin/mahasiswa&page_number=$i' class='$active'>$i</a>";
                                    }

                                    if ($endPage < $totalPages) {
                                        if ($endPage < $totalPages - 1) {
                                            echo "<span class='dots'>...</span>";
                                        }
                                        echo "<a href='/sibeta/public/index.php?page=super_admin/mahasiswa&page_number=$totalPages'>$totalPages</a>";
                                    }

                                    // Add "Next" arrow
                                    if ($currentPage < $totalPages) {
                                        $nextPage = $currentPage + 1;
                                        echo "<a href='/sibeta/public/index.php?page=super_admin/mahasiswa&page_number=$nextPage' class='arrow'>&raquo;</a>";
                                    }

                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Modal Konfirmasi Hapus -->
                        <div class="modal fade" id="hapusMahasiswa" tabindex="-1" aria-labelledby="hapusMahasiswaLabel" aria-hidden="true">
                            <form method="POST" class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="hapusMahasiswaLabel">Hapus Mahasiswa</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="action" value="delete_mahasiswa">
                                        <input type="hidden" name="nim" id="deleteMahasiswaNim">
                                        Apakah Anda yakin ingin menghapus <b id="deleteMahasiswaName"></b>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Hapus Mahasiswa</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        // Get elements
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('tableBody');
        const rows = tableBody.getElementsByTagName('tr');

        // Function to filter table rows
        function filterTable() {
            const searchValue = searchInput.value.toLowerCase();

            for (let i = 0; i < rows.length; i++) { // Start at 0 to include all rows
                const cells = rows[i].getElementsByTagName('td');
                const nim = cells[1] ? cells[1].textContent.toLowerCase() : '';
                const name = cells[2] ? cells[2].textContent.toLowerCase() : '';
                const kelas = cells[3] ? cells[3].textContent.toLowerCase() : '';
                const prodi = cells[4] ? cells[4].textContent.toLowerCase() : '';

                // Check if any cell matches the search value
                if (nim.includes(searchValue) || name.includes(searchValue) || kelas.includes(searchValue) || prodi.includes(searchValue)) {
                    rows[i].style.display = ''; // Show row
                } else {
                    rows[i].style.display = 'none'; // Hide row
                }
            }
        }

        // Add event listener for search input
        searchInput.addEventListener('keyup', filterTable);
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Event listener untuk tombol delete
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function() {
                    const nim = this.getAttribute('data-document-id');
                    const nama = this.getAttribute('data-document-name');
                    document.getElementById('deleteDocumentName').textContent = nama; // Set nama mahasiswa di modal
                    document.getElementById('deleteDocumentId').value = nim; // Set NIM di form
                });
            });
        });
    </script>
</body>

</html>