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
        <title>Header Dropdown</title>
    </head>
    <body>
        <div class="header">
            <div class="profile">
                <div class="profile-info">
                    <div class="profile-name">
                        <?= $nama?>
                    </div>
                    <div class="profile-identity">
                        <?= $_SESSION['role'] ?>
                    </div>
                </div>

                <div
                    class="profile-settings d-flex flex-row align-items-center">
                    <img src="/sibeta/public/assets/img/avatar.png" alt>
                    <div class="dropdown">
                        <button
                            class="border-0 bg-transparent d-flex align-items-center"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="material-symbols-outlined">
                                keyboard_arrow_down
                            </span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <span
                                        class="material-symbols-outlined">person</span>
                                    Profil
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
            crossorigin="anonymous"></script>
    </body>
</html>