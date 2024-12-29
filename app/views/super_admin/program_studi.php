<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Studi - SIBETA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=home" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_super_admin.php"; ?>
        <div class="main">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_admin.php"; ?>
            <div class="dokumen p-3">
                <div class="breadcrumbs">
                    <span class="material-symbols-outlined">home</span>
                    <a href="/sibeta/public/index.php?page=landing">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Program Studi</span>
                </div>

                <h5 class="mt-3">Program Studi</h5>

                <div class="py-3">
                    <div class="card">
                        <div class="card-body">
                            <!-- modal tambah program studi -->
                            <div class="modal fade" id="tambahProdi" tabindex="-1" aria-labelledby="tambahProdiLabel" aria-hidden="true">
                                <form method="POST" enctype="multipart/form-data" class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="tambahProdiLabel">Tambahkan Program Studi</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="namaProdi" class="form-label">Nama Program Studi</label>
                                                <input name="namaProdi" class="form-control" type="text" id="namaProdi" placeholder="Masukkan Nama Program Studi" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn-custom align-content-center">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Modal Delete -->
                            <div class="modal fade" id="hapusProdi" tabindex="-1" aria-labelledby="hapusProdiLabel" aria-hidden="true">
                                <form method="POST" class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="hapusDokumenLabel">Hapus Program Studi</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="action" value="delete_document">
                                            <input type="hidden" name="documentId" id="deleteDocumentId">
                                            Apakah Anda yakin ingin menghapus <b id="deleteDocumentName"></b>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn-hapus">Hapus</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="d-flex justify-content-between mb-3 align-items-center">
                                <div class="d-flex align-items-center" style="border-radius: 8px; width: 300px; position: relative;">
                                    <i class="bi bi-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #ADB5BD; font-size: 16px;"></i>
                                    <input type="text" id="searchInput" class="form-control" placeholder="Cari" aria-label="Search"
                                        style="padding-left: 35px; border-radius: 8px; width: 100%;">
                                    <button id="searchButton" class="btn" style="margin-left: 10px; color:#fff; background-color: #3E368C; border-radius: 4px; height: auto;">Cari</button>
                                </div>


                                <a href="#" class="btn-custom align-content-center" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#tambahProdi">Tambah Program Studi</a>
                            </div>

                            <table class="table table-striped table-borderless table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 5%;">ID</th>
                                        <th scope="col" style="width: 85%">Nama</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allProdi as $prodi): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($prodi['ProdiID']); ?></td>
                                            <td><?php echo htmlspecialchars($prodi['NamaProdi']); ?></td>
                                            <td>
                                                <div class="d-flex justify-content-start align-items-center gap-2">
                                                    <a href="/sibeta/public/index.php?page=detail_program_studi&id=<?php echo htmlspecialchars($prodi['ProdiID']); ?>"
                                                        style="text-decoration: none;"
                                                        class="align-items-center">
                                                        <button type="button" class="btn-custom px-2 py-1" style="font-size: 18px;">
                                                            <span class="material-symbols-outlined m-0">visibility</span>
                                                        </button>
                                                    </a>
                                                    <button type="button" class="btn-custom px-2 py-1" style="background-color: #DC3545 !important; font-size: 18px;">
                                                        <span class="material-symbols-outlined m-0" style="color:#FFFFFF; background-color: #DC3545 !important;">delete</span>
                                                    </button>
                                                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
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