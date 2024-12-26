<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLlSwoa9G6QBuxRSFc9qHHzpOQy8OP6cULrhlQ/3p+utUg4IYbm9URuTb4yVZ9dOELGGPr1Q==" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat</title>
</head>

<body>
    <div class="wrapper">
        <div class="wrapper">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_teknisi.php"; ?>
            <div class="main">
                <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_admin.php"; ?>
                <div class="p-4 dashboard">
                    <div class="breadcrumbs mb-3">
                        <span class="material-symbols-outlined">home</span>
                        <a href="/sibeta/public/index.php?page=<?php echo $role; ?>">SIBETA</a>
                        <span class="separator">/</span>
                        <span>Riwayat Pengajuan</span>
                    </div>
                    <div class="mb-3">
                        <h2>Riwayat Pengajuan</h2>
                    </div>

                    <div class="container">
                        <div class="d-flex justify-content-between mb-3 align-self-start">
                            <div class="input-group w-25" style="border-radius: 8px;">
                                <span class="input-group-text" id="basic-addon1" style="background-color: #FFFFFF;">
                                    <i class="bi bi-search" style="color: #ADB5BD; font-size: 16px;"></i>
                                </span>
                                <input type="text" id="searchInput" class="form-control" placeholder="Cari mahasiswa..." aria-label="Sarch" aria-describedby="basic-addon1" style="border-left: none;">
                                <button class="btn" id="searchButton" style="margin-left: 10px; color:#fff; background-color: #3E368C; border-radius: 4px; height: auto;">Cari</button>
                            </div>
                        </div>

                        <!-- Dropdown Filters -->
                        <div class="d-flex gap-3">
                            <select id="filterKelas" class="form-select" aria-label="Filter by Kelas">
                                <option value="">Pilih Kelas</option>
                                <?php
                                // Assuming you have a list of classes in $classes
                                $classes = array_unique(array_column($documents, 'Kelas'));
                                foreach ($classes as $class) {
                                    echo "<option value='$class'>$class</option>";
                                }
                                ?>
                            </select>
                            <select id="filterProdi" class="form-select" aria-label="Filter by Program Studi">
                                <option value="">Pilih Program Studi</option>
                                <?php
                                // Assuming you have a list of programs in $programs
                                $programs = array_unique(array_column($documents, 'ProgramStudi'));
                                foreach ($programs as $program) {
                                    echo "<option value='$program'>$program</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="table-container w-100">
                            <table class="table table-striped table-borderless" id="documentsTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Program Studi</th>
                                        <th>Kelas</th>
                                        <th>Tanggal Upload</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($documents) > 0) {
                                        $no = ($currentPage - 1) * $itemsPerPage + 1;
                                        foreach ($documents as $data) {
                                            $TanggalUpload = date('d-m-Y', strtotime($data['TanggalUpload']));
                                            echo "<tr>
                        <th scope='row'>$no</th>
                        <td>$data[Nim]</td>
                        <td>$data[NamaMahasiswa]</td>
                        <td>$data[ProgramStudi]</td>
                        <td>$data[Kelas]</td>
                        <td>$TanggalUpload</td>
                        <td><a href='/sibeta/public/index.php?page=detail_riwayat_mahasiswa&nim=" . $data['Nim'] . "' class='btn btn-detail btn-sm'>Detail</a></td>
                    </tr>";
                                            $no++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='7' class='text-center'>Tidak ada data mahasiswa ditemukan.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <!-- Pagination Controls -->
                            <div class="pagination mt-5 text-center">
                                <?php
                                $totalPages = ceil($totalDocuments / $itemsPerPage);
                                echo '<div class="pagination-nav">';
                                for ($i = 1; $i <= $totalPages; $i++) {
                                    $active = $i == $currentPage ? 'active' : '';
                                    echo "<a href='/sibeta/public/index.php?page=kelola&page_number=$i' class='$active'>$i</a>";
                                }
                                echo '</div>';

                                ?>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

        <script>
            // Get elements
            const searchInput = document.getElementById('searchInput');
            const filterKelas = document.getElementById('filterKelas');
            const filterProdi = document.getElementById('filterProdi');
            const table = document.getElementById('documentsTable');
            const rows = table.getElementsByTagName('tr');

            // Function to filter table rows
            function filterTable() {
                const searchValue = searchInput.value.toLowerCase();
                const kelasValue = filterKelas.value.toLowerCase();
                const prodiValue = filterProdi.value.toLowerCase();

                for (let i = 1; i < rows.length; i++) { // Start at 1 to skip the header
                    const cells = rows[i].getElementsByTagName('td');
                    const studentName = cells[1] ? cells[1].textContent.toLowerCase() : '';
                    const studentKelas = cells[3] ? cells[3].textContent.toLowerCase() : '';
                    const studentProdi = cells[2] ? cells[2].textContent.toLowerCase() : '';

                    // Check all filters
                    const matchSearch = studentName.includes(searchValue);
                    const matchKelas = !kelasValue || studentKelas === kelasValue;
                    const matchProdi = !prodiValue || studentProdi === prodiValue;

                    if (matchSearch && matchKelas && matchProdi) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';

                    }
                }
            }

            // Add event listeners
            searchInput.addEventListener('keyup', filterTable);
            filterKelas.addEventListener('change', filterTable);
            filterProdi.addEventListener('change', filterTable);
        </script>
</body>

</html>