<?php

$namaKelas = $_GET['kelas'] ?? '';

$kelasDetails = [
    [
        "Nama" => "1A",
        "Program Studi" => "Teknik Informatika",
    ],
    [
        "Nama" => "1A",
        "Program Studi" => "Sistem Informasi Bisnis",
    ],
    [
        "Nama" => "1B",
        "Program Studi" => "Teknik Informatika",
    ],
    [
        "Nama" => "1B",
        "Program Studi" => "Sistem Informasi Bisnis",
    ],
    [
        "Nama" => "1C",
        "Program Studi" => "Teknik Informatika",
    ],
    [
        "Nama" => "1C",
        "Program Studi" => "Sistem Informasi Bisnis",
    ],
    [
        "Nama" => "1D",
        "Program Studi" => "Teknik Informatika",
    ],
    [
        "Nama" => "1D",
        "Program Studi" => "Sistem Informasi Bisnis",
    ],
];

$detail = array_filter($kelasDetails, function ($item) use ($namaKelas) {
    return $item['Nama'] === $namaKelas;
});

$detail = $detail ? reset($detail) : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet" />
    <link rel="stylesheet" href="../../../public/assets/css/dashboard.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kelas - SIBETA</title>
</head>


<body>
    <div class="wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_super_admin.php"; ?>
        <div class="main">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_admin.php"; ?>
            <div class="p-4 dashboard">
                <div class="breadcrumbs mb-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="/sibeta/public/index.php?page=<?php echo $role; ?>">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Kelas</span>
                    <span class="separator">/</span>
                    <span>Detail Kelas</span>
                </div>
                <div class="mb-3">
                    <h2>Detail Kelas</h2>
                </div>

                <div class="container p-4 shadow-sm w-100" style="background: #FFFFFF; border-radius: 8px;">
                    <h3>Detail Kelas: <?= htmlspecialchars($namaKelas); ?></h3>
                    <?php if ($detail): ?>
                        <form id="kelasForm" method="POST" action="update_kelas.php" class="w-100">
                            <!-- Hidden Field for Nama Kelas -->
                            <input type="hidden" name="namaKelas" value="<?= htmlspecialchars($namaKelas); ?>">

                            <div class="mb-3 w-25">
                                <label for="id" class="form-label">ID</label>
                                <input type="text" class="form-control" id="id" value="1" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($namaKelas); ?>" placeholder="Nama Kelas">
                            </div>

                            <!-- Program Studi Field -->
                            <div class="mb-3">
                                <label for="programStudi" class="form-label">Program Studi</label>
                                <select class="form-select" id="programStudi" name="programStudi">
                                    <option value="Teknik Informatika" <?= $detail['Program Studi'] === 'Teknik Informatika' ? 'selected' : ''; ?>>Teknik Informatika</option>
                                    <option value="Sistem Informasi Bisnis" <?= $detail['Program Studi'] === 'Sistem Informasi Bisnis' ? 'selected' : ''; ?>>Sistem Informasi Bisnis</option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-end">
                                <button type="button" class="btn btn-primary" style="background-color: #3E368C;" data-bs-toggle="modal" data-bs-target="#submitModal">Simpan Perubahan</button>
                            </div>
                        </form>
                    <?php else: ?>
                        <p class="text-danger">Kelas tidak ditemukan.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="submitModal" tabindex="-1" aria-labelledby="submitModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submitModalLabel">Konfirmasi Simpan Perubahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menyimpan perubahan?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" style="background-color: #3E368C;" onclick="submitForm()">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>
</body>