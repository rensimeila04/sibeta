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
              <i class="breadcrumb-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 18V15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path d="M10.07 2.81997L3.14002 8.36997C2.36002 8.98997 1.86002 10.3 2.03002 11.28L3.36002 19.24C3.60002 20.66 4.96002 21.81 6.40002 21.81H17.6C19.03 21.81 20.4 20.65 20.64 19.24L21.97 11.28C22.13 10.3 21.63 8.98997 20.86 8.36997L13.93 2.82997C12.86 1.96997 11.13 1.96997 10.07 2.81997Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg></i>
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
            <table class="table table-striped">
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