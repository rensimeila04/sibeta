<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../components/sidebar_admin.html">
    <link rel="stylesheet" href="../components/header_admin.html">
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIBETA</title>
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
            <div class="p-3 dashboard">
                <div class="breadcrumbs">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">SIBETA</a>
                    <span class="separator">/</span>
                    <span>Dashboard</span>
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="components/sidebar/script.js"></script> -->
</body>

</html>