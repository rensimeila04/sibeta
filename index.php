<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="components/sidebar/style.css">
  <link rel="stylesheet" href="components/header/style.css">
  <link rel="stylesheet" href="css/dashboard.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - SIBETA</title>
</head>

<body>
  <div class="wrapper">
    <?php
    include 'components/sidebar/index.html';
    ?>
    <div class="main">
      <?php
      include 'components/header/index.html';
      ?>
      <div class="p-3 dashboard">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">

            <li class="breadcrumb-item">
              <i class="iconsax breadcrumb-icon" type="linear" stroke-width="1.5"
                icon="home-1"></i>
              <a class="breadcrumb-link" href="#">SIBETA</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
          </ol>
        </nav>

        <div class="container mt-4">
          <!-- Statistic Cards -->
          <div class="row text-center mb-4">
            <div class="col-md-3">
              <div class="card">
                <div class="card-body">
                  <h6 class="text-secondary">Dokumen Diajukan</h6>
                  <h1 class="text" style="color: #3E368C;">12</h1>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card">
                <div class="card-body">
                  <h6 class="text-secondary">Menunggu Verifikasi</h6>
                  <h1 class="text-warning">5</h1>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card">
                <div class="card-body">
                  <h6 class="text-secondary">Dokumen Terverifikasi</h6>
                  <h1 class="text-success">4</h1>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card">
                <div class="card-body">
                  <h6 class="text-secondary">Dokumen Ditolak</h6>
                  <h1 class="text-danger">3</h1>
                </div>
              </div>
            </div>
          </div>
          <!-- Download Section -->
          <div class="card">
            <div class="card-body">
              <div class="text-center">
                <h5>Download Template Surat</h5>
                <p class="text-muted">Lorem ipsum dolor sit amet consectetur. Feugiat proin aliquet.</p>
                <a href="#" class="btn" style="color:#fff; background-color: #3E368C;">Download Template</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container p-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
              <div class="fw-semibold fs-3">Dokumen Anda</div>
              <a href="#" class="btn" style="color:#fff; background-color: #3E368C;">Lihat Semua</a>
            </div>
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Dokumen</th>
                  <th scope="col">Jenis Dokumen</th>
                  <th scope="col">Tanggal Upload</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td class=" text-truncate" style="max-width: 50px;">Tanda Terima Penyerahan Laporan Tugas Akhir/Skripsi ke Ruang Baca</td>
                  <td>Administratif</td>
                  <td>12 November 2024</td>
                  <td><span class="badge text-bg-success">Terverifikasi</span></td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td class=" text-truncate" style="max-width: 50px;">Tanda Terima Penyerahan Laporan Tugas Akhir/Skripsi ke Ruang Baca</td>
                  <td>Administratif</td>
                  <td>12 November 2024</td>
                  <td><span class="badge text-bg-warning">Diajukan</span></td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td class=" text-truncate" style="max-width: 50px;">Laporan Tugas/Akhir Skripsi</td>
                  <td>Teknis</td>
                  <td>12 November 2024</td>
                  <td><span class="badge text-bg-danger">Ditolak</span></td>
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
</body>

</html>