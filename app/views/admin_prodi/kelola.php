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
    <title>Kelola</title>
</head>

<body>
    <div class="wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_admin.php"; ?>
        <div class="main">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_admin.php"; ?>
            <div class="p-4 dashboard">
                <div class="breadcrumbs mb-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="/sibeta/public/index.php?page=<?php echo $role; ?>">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Kelola Dokumen</span>
                </div>
                <div class="mb-3">
                    <h2>Kelola Dokumen</h2>
                </div>
                <div class="card">

                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-3 align-self-start">
                            <div class="d-flex align-items-center" style="border-radius: 8px; width: 300px; position: relative;">
                                <i class="bi bi-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #ADB5BD; font-size: 16px;"></i>
                                <input type="text" id="searchInput" class="form-control" placeholder="Cari" aria-label="Search"
                                    style="padding-left: 35px; border-radius: 8px; width: 100%;">
                                <button id="searchButton" class="btn" style="margin-left: 10px; color:#fff; background-color: #3E368C; border-radius: 4px; height: auto;">Cari</button>
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

                        <div class="py-3">
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
                                        <td><a href='/sibeta/public/index.php?page=detail-mahasiswa&nim=" . $data['Nim'] . "' class='btn btn-detail btn-sm'>Detail</a></td>
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

                                    if ($totalPages > 1) {
                                        echo '<div class="pagination-nav">';

                                        // Add "Previous" arrow
                                        if ($currentPage > 1) {
                                            $prevPage = $currentPage - 1;
                                            echo "<a href='/sibeta/public/index.php?page=kelola&page_number=$prevPage' class='arrow'>&laquo;</a>";
                                        }

                                        // Display page numbers with "..." for truncation
                                        $startPage = max(1, $currentPage - 2);
                                        $endPage = min($totalPages, $currentPage + 2);

                                        if ($startPage > 1) {
                                            echo "<a href='/sibeta/public/index.php?page=kelola&page_number=1'>1</a>";
                                            if ($startPage > 2) {
                                                echo "<span class='dots'>...</span>";
                                            }
                                        }

                                        for ($i = $startPage; $i <= $endPage; $i++) {
                                            $active = $i == $currentPage ? 'active' : '';
                                            echo "<a href='/sibeta/public/index.php?page=kelola&page_number=$i' class='$active'>$i</a>";
                                        }

                                        if ($endPage < $totalPages) {
                                            if ($endPage < $totalPages - 1) {
                                                echo "<span class='dots'>...</span>";
                                            }
                                            echo "<a href='/sibeta/public/index.php?page=kelola&page_number=$totalPages'>$totalPages</a>";
                                        }

                                        // Add "Next" arrow
                                        if ($currentPage < $totalPages) {
                                            $nextPage = $currentPage + 1;
                                            echo "<a href='/sibeta/public/index.php?page=kelola&page_number=$nextPage' class='arrow'>&raquo;</a>";
                                        }

                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>



                    </div>
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