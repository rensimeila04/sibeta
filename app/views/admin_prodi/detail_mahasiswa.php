<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa</title>
</head>

<body>
    <div class="wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_admin.php"; ?>
        <div class="main">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_admin.php"; ?>
            <div class="p-4">
                <div class="breadcrumbs mb-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="/sibeta/public/index.php?page=<?php echo $role; ?>">SIBETA</a>
                    <span class="separator">/</span>
                    <a href="/sibeta/public/index.php?page=kelola">Kelola Dokumen</a>
                    <span class="separator">/</span>
                    <span>Detail Mahasiswa</span>
                </div>

                <div class="card my-4">
                    <div class="card-body p-4">
                        <div class="d-flex flex-column justify-content-between mb-3 gap-2">
                            <div class="fw-semibold fs-3">Detail Mahasiswa</div>
                            <div class="d-flex flex-column gap-1">
                                <p class="text-muted">Detail mahasiswa yang telah mengajukan dokumen</p>

                            </div>
                        </div>
                        <div class="py-3">
                            <div class="detail-desc mb-5 gap-1 w-50">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th>NIM</th>
                                            <td><?php echo $mahasiswa['NIM']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td><?php echo $mahasiswa['NamaMahasiswa']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Program Studi</th>
                                            <td><?php echo $mahasiswa['ProgramStudi']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kelas</th>
                                            <td><?php echo $mahasiswa['Kelas']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <table class="table table-striped table-borderless table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Dokumen</th>
                                        <th>Tanggal Upload</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                        <th>Verifikasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($documentsMahasiswa as $doc):
                                        $TanggalUpload = date('d F Y', strtotime($doc['TanggalUpload'])); ?>
                                        <tr>
                                            <td class="fw-bold"><?php echo $no++; ?></td>
                                            <td><?php echo $doc['NamaDokumen']; ?></td>
                                            <td><?php echo $TanggalUpload; ?></td>
                                            <td>
                                                <p class="<?php
                                                            // Apply different classes based on the status
                                                            if ($doc['Status'] == 'Diverifikasi') {
                                                                echo 'bg-success';
                                                            } elseif ($doc['Status'] == 'Diajukan') {
                                                                echo 'bg-warning';
                                                            } elseif ($doc['Status'] == 'Ditolak') {
                                                                echo 'bg-danger';
                                                            }
                                                            ?> fw-semibold" style='border-radius: 16px; font-size: 16px; height: 35px; width: 126px; font-weight: 400; padding-top: 5px; text-align: center; color: white;'>
                                                    <?php echo $doc['Status']; ?>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start align-items-center gap-2">
                                                    <a href="<?php echo '../app' . $doc['FilePath']; ?>" class="material-symbols-outlined align-items-center btn-custom" target="_blank" style="text-decoration: none; font-size:18px;">
                                                        visibility
                                                    </a>
                                                    <a href="<?php echo '../app' . $doc['FilePath']; ?>" class="material-symbols-outlined align-items-center btn-custom2" style="text-decoration: none; font-size: 18px;" download>
                                                        download
                                                    </a>
                                                </div>
                                            </td>
                                            <?php
                                            $buttonClass = ($doc['Status'] === 'Terverifikasi') ? 'btn-disabled d-flex align-items-center' : 'btn-custom d-flex align-items-center';
                                            ?>
                                            <td>
                                                <a href="/sibeta/public/index.php?page=verifikasi&id=<?php echo $doc['DokumenID']; ?>"
                                                    class="<?php echo $buttonClass; ?> text-decoration-none w-75"
                                                    <?php if (($doc['Status'] === 'Diverifikasi' || $doc['Status'] === 'Ditolak') || ($doc['Status'] === 'Diajukan' && $doc['IsSaved'] == '0')): ?>
                                                    style="pointer-events: none; opacity: 0.5;"
                                                    class="disabled"
                                                    <?php endif; ?>>
                                                    <span class="material-symbols-outlined">
                                                        done_all
                                                    </span>Verifikasi
                                                </a>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
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
</body>

</html>