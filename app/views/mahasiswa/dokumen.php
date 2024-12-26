<?php
$documents = $mahasiswaController->getDocuments($nim);
?>

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
    <title>Dokumen - SIBETA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=home" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_mahasiswa.php"; ?>
        <div class="main">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_mahasiswa.php"; ?>
            <div class="dokumen p-3">
                <div class="breadcrumbs">
                    <span class="material-symbols-outlined">home</span>
                    <a href="/sibeta/public/index.php?page=landing">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Dokumen</span>
                </div>

                <h5 class="mt-3">Riwayat Pengajuan Dokumen</h5>

                <div class="py-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div class="input-group w-25" style="border-radius: 8px;">
                                    <span class="input-group-text" id="basic-addon1" style="background-color: #FFFFFF;">
                                        <i class="bi bi-search" style="color: #ADB5BD; font-size: 16px;"></i>
                                    </span>
                                    <input type="text" id="searchInput" class="form-control" placeholder="Cari dokumen..." aria-label="Search" aria-describedby="basic-addon1" style="border-left: none;">
                                    <button id="searchButton" class="btn" style="margin-left: 10px; color:#fff; background-color: #3E368C; border-radius: 4px; height: auto;">Cari</button>
                                </div>
                            </div>

                            <table class="table table-striped table-borderless table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col" class="col-nama-dokumen">Nama Dokumen</th>
                                        <th scope="col">Jenis Dokumen</th>
                                        <th scope="col" class="col-tanggal">Tanggal Upload</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($documents as $index => $document) {
                                        $tanggalUpload = date('d F Y', strtotime($document['TanggalUpload']));
                                        $badgeClass = '';
                                        switch ($document['Status']) {
                                            case 'Diverifikasi':
                                                $badgeClass = 'bg-success';
                                                break;
                                            case 'Diajukan':
                                                $badgeClass = 'bg-warning';
                                                break;
                                            case 'Ditolak':
                                                $badgeClass = 'bg-danger';
                                                break;
                                        }
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $index + 1; ?></th>
                                            <td class="text-truncate" style="max-width: 50px;"><?php echo $document['NamaDokumen']; ?></td>
                                            <td scope="row"><?php echo $document['Tipe']; ?></td>
                                            <td><?php echo $tanggalUpload; ?></td>
                                            <td>
                                                <span class="badge <?php echo $badgeClass; ?>" style="border-radius: 16px; font-size: 16px; height: 35px; width: 126px; font-weight: 400; padding-top: 7px;">
                                                    <?php echo $document['Status']; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="aksi">
                                                    <a href="/sibeta/public/index.php?page=detail-dokumen-mahasiswa&id=<?php echo $document['DokumenID']; ?>" style="text-decoration: none;">
                                                        <button type="button" class="btn btn-detail">
                                                            Detail
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
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