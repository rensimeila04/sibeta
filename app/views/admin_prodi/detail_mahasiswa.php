<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../components/sidebar_admin.html">
    <link rel="stylesheet" href="../components/header_admin.html">
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa</title>
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
            <div class="p-4">
                <div class="breadcrumbs mb-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <a href="#">Kelola Dokumen</a>
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
                            <?php
                            $mahasiswa = [
                                [
                                    'nim' => '123456789',
                                    'nama' => 'John Doe',
                                    'program_studi' => 'D-IV Teknik Informatika',
                                    'kelas' => '4E',
                                    'tanggal_upload' => '22 November 2024',
                                    'documents' => [
                                        ['nama_dokumen' => 'Tanda Terima Penyerahan Laporan PKL/Magang ke Ruang Baca', 'tanggal_upload' => '22 November 2024', 'status' => 'Terverifikasi'],
                                        ['nama_dokumen' => 'Tanda Terima Penyerahan Laporan Tugas Akhir/Skripsi ke Ruang Baca', 'tanggal_upload' => '20 November 2024', 'status' => 'Diajukan'],
                                        ['nama_dokumen' => 'Surat Bebas Kompen', 'tanggal_upload' => '18 November 2024', 'status' => 'Ditolak'],
                                        ['nama_dokumen' => 'Scan TOEIC', 'tanggal_upload' => '15 November 2024', 'status' => 'Terverifikasi'],
                                    ]
                                ],
                                [
                                    'nim' => '987654321',
                                    'nama' => 'Jane Smith',
                                    'program_studi' => 'D-IV Teknik Informatika',
                                    'kelas' => '4E',
                                    'tanggal_upload' => '25 November 2024',
                                    'documents' => [
                                        ['nama_dokumen' => 'Tanda Terima Penyerahan Laporan Tugas Akhir/Skripsi ke Ruang Baca', 'tanggal_upload' => '20 November 2024', 'status' => 'Terverifikasi'],
                                        ['nama_dokumen' => 'Tanda Terima Penyerahan Laporan PKL/Magang ke Ruang Baca', 'tanggal_upload' => '22 November 2024', 'status' => 'Diajukan'],
                                        ['nama_dokumen' => 'Scan TOEIC', 'tanggal_upload' => '15 November 2024', 'status' => 'Terverifikasi'],
                                        ['nama_dokumen' => 'Surat Bebas Kompen', 'tanggal_upload' => '18 November 2024', 'status' => 'Ditolak'],
                                    ]
                                ],
                                [
                                    'nim' => '234567890',
                                    'nama' => 'Michael Johnson',
                                    'program_studi' => 'D-IV Sistem Informasi',
                                    'kelas' => '4E',
                                    'tanggal_upload' => '28 November 2024',
                                    'documents' => [
                                        ['nama_dokumen' => 'Surat Bebas Kompen', 'tanggal_upload' => '18 November 2024', 'status' => 'Terverifikasi'],
                                        ['nama_dokumen' => 'Tanda Terima Penyerahan Laporan Tugas Akhir/Skripsi ke Ruang Baca', 'tanggal_upload' => '20 November 2024', 'status' => 'Diajukan'],
                                        ['nama_dokumen' => 'Tanda Terima Penyerahan Laporan PKL/Magang ke Ruang Baca', 'tanggal_upload' => '22 November 2024', 'status' => 'Terverifikasi'],
                                        ['nama_dokumen' => 'Scan TOEIC', 'tanggal_upload' => '15 November 2024', 'status' => 'Terverifikasi'],
                                    ]
                                ],
                                [
                                    'nim' => '345678901',
                                    'nama' => 'Emily Brown',
                                    'program_studi' => 'D-IV Teknik Informatika',
                                    'kelas' => '4F',
                                    'tanggal_upload' => '01 Desember 2024',
                                    'documents' => [
                                        ['nama_dokumen' => 'Tanda Terima Penyerahan Laporan PKL/Magang ke Ruang Baca', 'tanggal_upload' => '22 November 2024', 'status' => 'Terverifikasi'],
                                        ['nama_dokumen' => 'Scan TOEIC', 'tanggal_upload' => '15 November 2024', 'status' => 'Terverifikasi'],
                                        ['nama_dokumen' => 'Surat Bebas Kompen', 'tanggal_upload' => '18 November 2024', 'status' => 'Diajukan'],
                                        ['nama_dokumen' => 'Tanda Terima Penyerahan Laporan Tugas Akhir/Skripsi ke Ruang Baca', 'tanggal_upload' => '20 November 2024', 'status' => 'Ditolak'],
                                    ]
                                ],
                                [
                                    'nim' => '456789012',
                                    'nama' => 'David Lee ',
                                    'program_studi'  => 'D-IV Sistem Informasi',
                                    'kelas' => '4F',
                                    'tanggal_upload' => '05 Desember 2024',
                                    'documents' => [
                                        ['nama_dokumen' => 'Tanda Terima Penyerahan Laporan PKL/Magang ke Ruang Baca', 'tanggal_upload' => '22 November 2024', 'status' => 'Terverifikasi'],
                                        ['nama_dokumen' => 'Scan TOEIC', 'tanggal_upload' => '15 November 2024', 'status' => 'Diajukan'],
                                        ['nama_dokumen' => 'Surat Bebas Kompen', 'tanggal_upload' => '18 November 2024', 'status' => 'Ditolak'],
                                        ['nama_dokumen' => 'Tanda Terima Penyerahan Laporan Tugas Akhir/Skripsi ke Ruang Baca', 'tanggal_upload' => '20 November 2024', 'status' => 'Terverifikasi'],
                                    ]
                                ],
                                [
                                    'nim' => '567890123',
                                    'nama' => 'Olivia Taylor',
                                    'program_studi' => 'D-IV Teknik Informatika',
                                    'kelas' => '4E',
                                    'tanggal_upload' => '10 Desember 2024',
                                    'documents' => [
                                        ['nama_dokumen' => 'Tanda Terima Penyerahan Laporan Tugas Akhir/Skripsi ke Ruang Baca', 'tanggal_upload' => '20 November 2024', 'status' => 'Terverifikasi'],
                                        ['nama_dokumen' => 'Tanda Terima Penyerahan Laporan PKL/Magang ke Ruang Baca', 'tanggal_upload' => '22 November 2024', 'status' => 'Diajukan'],
                                        ['nama_dokumen' => 'Scan TOEIC', 'tanggal_upload' => '15 November 2024', 'status' => 'Terverifikasi'],
                                        ['nama_dokumen' => 'Surat Bebas Kompen', 'tanggal_upload' => '18 November 2024', 'status' => 'Ditolak'],
                                    ]
                                ]
                            ];

                            $index = isset($_GET['index']) ? (int)$_GET['index'] : null;

                            if ($index !== null && isset($mahasiswa[$index])) {
                                $mhs = $mahasiswa[$index];
                            } else {
                                die("Index Mahasiswa Invalid");
                            }

                            ?>

                            <div class="detail-desc mb-5 gap-1 w-50">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th>NIM</th>
                                            <td><?php echo $mhs['nim']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td><?php echo $mhs['nama']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Program Studi</th>
                                            <td><?php echo $mhs['program_studi']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kelas</th>
                                            <td><?php echo $mhs['kelas']; ?></td>
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
                                    <?php foreach ($mhs['documents'] as $doc): ?>
                                        <tr>
                                            <td class="fw-bold"><?php echo $no++; ?></td>
                                            <td><?php echo $doc['nama_dokumen']; ?></td>
                                            <td><?php echo $doc['tanggal_upload']; ?></td>
                                            <td><p class="<?php
                                                        // Apply different classes based on the status
                                                        if ($doc['status'] == 'Terverifikasi') {
                                                            echo 'status-terverifikasi';
                                                        } elseif ($doc['status'] == 'Diajukan') {
                                                            echo 'status-diajukan';
                                                        } elseif ($doc['status'] == 'Ditolak') {
                                                            echo 'status-ditolak';
                                                        }
                                                        ?> fw-semibold px-4">
                                                <?php echo $doc['status']; ?>
                                            </td>
                                            <td>
                                                <i class="material-symbols-outlined align-items-center btn-custom">visibility</i>
                                                <i class="material-symbols-outlined align-items-center btn-custom2">download</i>
                                            </td>
                                            <td>
                                                <button class="btn btn-custom d-flex align-items-center"><i class="material-symbols-outlined align-items-center btn-custom3">check</i>Verifikasi</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
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
</body>

</html>