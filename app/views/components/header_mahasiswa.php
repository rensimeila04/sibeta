<?php
$notifications = $notifikasiController->getTopNotifications($nim);
$unreadCount = $notifikasiController->getUnreadNotificationCount($nim);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
        crossorigin="anonymous">
    <link rel="stylesheet" href="../../../public/assets/css/header.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet" />
    <title>Header Dropdown</title>
</head>

<body>
    <div class="header">
        <div class="header-left">
            <div class="notification">
                <div class="dropdown dropdown-menu-notif">
                    <button class="border-0 bg-transparent d-flex align-items-center position-relative"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <span class="material-symbols-outlined">
                            notifications
                        </span>
                        <?php if ($unreadCount > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php echo $unreadCount; ?>
                            </span>
                        <?php endif; ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li class="notification-header">
                            <h6 class="m-0 p-2 text-center border-bottom">Notifikasi</h6>
                        </li>
                        <?php foreach ($notifications as $notification): ?>
                            <li class="notification-item">
                                <div class="dropdown-item notification-button w-100 text-start border-0"
                                    style="<?php echo $notification['IsDibaca'] ? 'background-color: #f8f9fa;' : ''; ?>">
                                    <div class="notification-content">
                                        <p class="notification-text mb-0"><?php echo htmlspecialchars($notification['Pesan']); ?></p>
                                        <small class="text-muted">
                                            <?php echo date('d M Y H:i', strtotime($notification['TanggalNotifikasi'])); ?>
                                        </small>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Profile section moved to right -->
        <div class="header-right">
            <div class="profile">
                <div class="profile-info">
                    <div class="profile-name">
                        <?= $nama ?>
                    </div>
                    <div class="profile-nim">
                        <?= $nim ?>
                    </div>
                </div>

                <div class="profile-settings d-flex flex-row align-items-center">
                    <img src="<?php echo '../app/' . $photo_profile_path; ?>" alt="avatar" style="width: 40px; height: 40px;">
                    <div class="dropdown">
                        <button class="border-0 bg-transparent d-flex align-items-center"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="material-symbols-outlined">keyboard_arrow_down</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-profil">
                            <li>
                                <div class="d-flex flex-row align-items-center">
                                    <span class="material-symbols-outlined" style="margin-left: 15px;">
                                        person
                                    </span>
                                    <a href="/sibeta/public/index.php?page=profil_mahasiswa"
                                        class="dropdown-item border-0 bg-transparent"
                                        style="color: #212529;">
                                        Profil Mahasiswa
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous">
    </script>
</body>

</html>