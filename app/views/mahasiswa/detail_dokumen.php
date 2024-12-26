<?php
$documentId = $_GET['id'];
$document = $mahasiswaController->getDocumentById($documentId);

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
<!DOCTYPE html>
<html lang="en">

<head>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
        crossorigin="anonymous">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/detail_dokumen.css">
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
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Dokumen</span>
                    <span class="separator">/</span>
                    <span>Detail Dokumen</span>
                </div>

                <div class="py-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Detail Dokumen</h5>
                                <?php if ($document['Status'] == 'Ditolak'): ?>
                                    <button class="button-edit">
                                        <span class="material-symbols-outlined me-2">
                                            edit
                                        </span>
                                        Edit Dokumen
                                    </button>
                                <?php endif; ?>
                            </div>
                            <table class="table table-borderless mb-0 text-start">
                                <tbody>
                                    <tr class="custom-width">
                                        <th scope="row" class="w-25">Nama Dokumen</th>
                                        <td><?php echo $document['NamaDokumen']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Jenis Dokumen</th>
                                        <td><?php echo $document['Tipe']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Status Dokumen</th>
                                        <td>
                                            <span class="badge <?php echo $badgeClass; ?>" style="border-radius: 16px; font-size: 16px; height: 35px; width: 126px; font-weight: 400; padding-top: 7px;">
                                                <?php echo $document['Status']; ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php if ($document['Status'] == 'Ditolak'): ?>
                                        <tr>
                                            <th scope="row">Komentar</th>
                                            <td>
                                                <?php echo $document['KomentarRevisi']; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th scope="row">Dokumen</th>
                                        <td>
                                            <?php echo basename($document['FilePath']); ?>
                                            <a href="<?php echo '../app/' . $document['FilePath']; ?>" class="btn-view" style="text-decoration: none;">
                                                <span class="material-symbols-outlined">visibility</span>Lihat
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <!-- <script src="components/sidebar/script.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>