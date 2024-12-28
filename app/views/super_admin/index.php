<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet" />
    <link rel="stylesheet" href="../../../public/assets/css/dashboard.css">
    <!-- Include Required Libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIBETA</title>
</head>


<body>
    <div class="wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/sidebar_super_admin.php"; ?>
        <div class="main">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/sibeta/app/views/components/header_admin.php"; ?>
            <div class="p-3 dashboard">
                <div class="breadcrumbs ps-3">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Dashboard</span>
                </div>
                <!-- Statistic Cards -->
                <div class="row text-center mb-4">
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body-dash">
                                <h6 class="text-secondary">Jumlah Mahasiswa</h6>
                                <h1 class="text" style="color: #3E368C;">12</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body-dash">
                                <h6 class="text-secondary">Jumlah Teknisi</h6>
                                <h1 class="text-warning">2</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body-dash">
                                <h6 class="text-secondary">Jumlah Admin</h6>
                                <h1 class="text-success">2</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body-dash">
                                <h6 class="text-secondary">Dokumen Diajukan</h6>
                                <h1 class="text-info">36</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row-cols-2 mt-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h4 class="mb-5">Jumlah Dokumen Diajukan</h4>
            <canvas id="myChart" width="400" height="300"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h4 class="mb-4">Program Studi</h4>
            <div class="d-flex flex-column justify-content-between gap-5">
                <div class="card flex-grow-1 shadow-sm">
                    <div class="card-body text-center d-flex flex-column justify-content-center p-4">
                        <h5 class="fw-medium mb-3">D-IV Teknik Informatika</h5>
                        <div class="mt-2">
                            <h1 style="color: #3E368C">526</h1>
                            <h6 class="text-secondary">Mahasiswa</h6>
                        </div>
                    </div>
                </div>
                <div class="card flex-grow-1 shadow-sm">
                    <div class="card-body text-center d-flex flex-column justify-content-center p-4">
                        <h5 class="fw-medium mb-3">D-IV Sistem Informasi Bisnis</h5>
                        <div class="mt-2">
                            <h1 style="color: #3E368C">526</h1>
                            <h6 class="text-secondary">Mahasiswa</h6>
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
    </div>

    <script>
        const labels = ['2019', '2020', '2021', '2022', '2023', '2024', '2025'];
        const data = {
            labels: labels,
            datasets: [{
                label: 'Dokumen',
                backgroundColor: 'rgba(78, 115, 223, 1)',
                borderColor: 'rgba(78, 115, 223, 1)',
                data: [1799, 2170, 2690, 3376, 2810, 1890, 1090],
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            },
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
</body>

</html>