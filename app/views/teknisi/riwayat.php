<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../components/sidebar_admin.html">
    <link rel="stylesheet" href="../components/header_admin.html">
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLlSwoa9G6QBuxRSFc9qHHzpOQy8OP6cULrhlQ/3p+utUg4IYbm9URuTb4yVZ9dOELGGPr1Q==" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>

<body>
    <div class="wrapper">
        <?php
        include '../components/sidebar_admin.html';
        ?>
        <div class="main">
            <?php
            include '../components/header_admin.html';
            ?>
            <div class="p-4 dashboard">
                <div class="breadcrumbs mb-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
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
                            <input type="text" class="form-control" placeholder="Cari dokumen..." aria-label="Sarch" aria-describedby="basic-addon1" style="border-left: none;">
                            <button class="btn" style="margin-left: 10px; color:#fff; background-color: #3E368C; border-radius: 4px; height: auto;">Cari</button>
                        </div>
                    </div>


                    <div class="table-container w-100">
                        <table class="table table-borderless table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">NIM</th>
                                    <th scope="col">Nama Mahasiswa</th>
                                    <th scope="col">Program Studi</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $dataMhs = [
                                    ["2341720201", "Ahmad Dzul Fadhli Hannan", "D-IV Teknik Informatika", "2E"],
                                    ["2341720201", "Afthalaric Nero M", "D-IV Teknik Informatika", "2E"],
                                    ["2341720201", "Esa Pratama Putri", "D-IV Teknik Informatika", "2E"],

                                ];

                                $rowNumber = 1;
                                foreach ($dataMhs as $data) {
                                    echo "<tr>";
                                    echo "<th scope='row'>" . $rowNumber . "</th>";
                                    echo "<td>" . $data[0] . "</td>";
                                    echo "<td>" . $data[1] . "</td>";
                                    echo "<td>" . $data[2] . "</td>";
                                    echo "<td>" . $data[3] . "</td>";
                                    echo "<td><button type='button' class='btn btn-detail btn-sm'>Detail</button></td>";
                                    echo "</tr>";
                                    $rowNumber++;
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>