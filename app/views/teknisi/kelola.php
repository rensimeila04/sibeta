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
    <title>Profil</title>
</head>

<body>
    <div class="wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_teknisi.php"; ?>
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
                                <?php $no = 1;
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
                                ?>
                            </tbody>
                        </table>

                        <div class="pagination mt-5">
                            <span>Total 10 items</span>
                            <div class="pagination-nav">
                                <a href="#" class="arrow">&laquo;</a>
                                <a href="#" class="active">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#">4</a>
                                <a href="#">5</a>
                                <a href="#">6</a>
                                <span>...</span>
                                <a href="#">20</a>
                                <a href="#" class="arrow">&raquo;</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        // Get the search input and table
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('documentsTable');
        const rows = table.getElementsByTagName('tr');

        // Function to filter table rows based on search
        function filterTable() {
            const filter = searchInput.value.toLowerCase();

            // Loop through all table rows
            for (let i = 1; i < rows.length; i++) { // Start at 1 to skip the header
                const cells = rows[i].getElementsByTagName('td');
                const studentName = cells[1] ? cells[1].textContent || cells[1].innerText : ''; // Get Nama Mahasiswa column

                // Check if student name matches the search input
                if (studentName.toLowerCase().indexOf(filter) > -1) {
                    rows[i].style.display = ''; // Show the row
                } else {
                    rows[i].style.display = 'none'; // Hide the row
                }
            }
        }

        // Add event listener to the search input field
        searchInput.addEventListener('keyup', filterTable);
    </script>
</body>

</html>