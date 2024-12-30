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
    <div class="header" style="justify-content: end !important;">

        <div class="profile">
            <div class="profile-info">
                <div class="profile-name">
                    <?= $nama ?>
                </div>
                <div class="text-muted" style="text-transform: capitalize;">
                    <?= $role ?>
                </div>
            </div>

            <div class="profile-settings d-flex flex-row align-items-center">
                <?php
                $profile_path = '../app/' . $photo_profile_path;
                $default_avatar = "/sibeta/public/assets/img/avatar.png";

                // Check if profile image exists and is readable
                if (!empty($photo_profile_path) && file_exists($profile_path) && is_readable($profile_path)) {
                    $image_path = $profile_path;
                } else {
                    $image_path = $default_avatar;
                }
                ?>
                <img src="<?php echo $image_path; ?>" alt="avatar" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                <div class="dropdown ms-2">
                    <button
                        class="btn border-0 bg-transparent dropdown-toggle"
                        type="button"
                        id="dropdownMenuButton"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <span class="material-symbols-outlined">keyboard_arrow_down</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li>
                            <a href="/sibeta/public/index.php?page=profile_staff" class="dropdown-item d-flex align-items-center">
                                <span class="material-symbols-outlined me-2">person</span>
                                Profil <?= $role; ?>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>