<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SIBETA</title>
    <link rel="icon" type="image/x-icon" href="/sibeta/public/assets/images/Logo-White.png">

    <link rel="stylesheet" type="text/css" href="/sibeta/public/assets/css/loginStyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWXg6Pkd6qGmW+g6rekW7QzQfffpfKv+aT+tfczX+6qR" crossorigin="anonymous">

</head>

<body>

<button class="back-button">
    <a href="/sibeta/index.php">
        <i data-lucide="arrow-left" class="me-2"></i>
    </a>
</button>

    <div class="login-card">
        <img src="/sibeta/public/assets/images/Sibeta-Blue.svg" alt="Sibeta Logo" class="login-logo">
        <div class="login-title">
            <div class="login-title-desc">
                <h4>Selamat Datang!</h4>
                <p>Masuk sebagai mahasiswa, admin, atau teknisi untuk mengelola proses bebas tanggungan</p>
            </div>
        </div>
        <form class="input-sect">
            <div class="input-container">
                <p>Username</p>
                <div class="input-field">
                    <input type="text" name="username" id="username" placeholder="Username" required>
                </div>
            </div>
            <div class="input-container">
                <p>Password</p>
                <div class="input-field">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
            </div>
            <a href="#" class="forgot-password">Lupa Password?</a>
            <div class="btn-cont">
                <button type="submit" class="btn-sect">
                    Masuk
                </button>
            </div>
        </form>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    // Initialize Lucide icons
    lucide.createIcons();
    </script>
</body>

</html>