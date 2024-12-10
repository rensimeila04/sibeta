<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/iconsax-css/style.css">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
      crossorigin="anonymous">
    <link rel="stylesheet" href="../../../public/assets/css/sidebar.css">
    <script src="https://grxvityhj.github.io/iconsax/script.js"></script>
  </head>

  <body>
    <aside id="sidebar" class="expand">
      <div class="d-flex justify-content-center align-items-center pt-4">
        <img src="/sibeta/public/assets/img/logo.png">
      </div>
      <ul class="sidebar-nav">
        <li class="sidebar-item">
          <a href="index.php" class="sidebar-link d-flex align-items-center">
            <span class="material-symbols-outlined">
              home
            </span>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="#"
            class="sidebar-link collapsed has-dropdown d-flex align-items-center"
            data-bs-toggle="collapse" data-bs-target="#unggah"
            aria-expanded="false" aria-controls="unggah">
            <span class="material-symbols-outlined">upload_file</span>
            <span>Unggah Dokumen</span>
          </a>
          <ul id="unggah" class="sidebar-dropdown list-unstyled collapse"
            data-bs-parent="#sidebar">
            <li class="sidebar-item">
              <a href="administrasi.php" class="sidebar-link">Administrasi</a>
            </li>
            <li class="sidebar-item">
              <a href="#" class="sidebar-link">Teknis</a>
            </li>
          </ul>
        </li>
        <li class="sidebar-item">
          <a href="dokumen.php" class="sidebar-link d-flex align-items-center">
            <span class="material-symbols-outlined">
              article
            </span>
            <span>Dokumen</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link d-flex align-items-center">
            <span class="material-symbols-outlined">
              help
            </span>
            <span>Bantuan</span>
          </a>
        </li>
      </ul>
      <div class="sidebar-footer">
        <a href="#" class="sidebar-link-logout d-flex align-items-center">
          <span class="material-symbols-outlined" style="color: #CA3521;">
            logout
          </span>
          <span style="color: #CA3521;">Logout</span>
        </a>
      </div>
    </aside>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"></script>
    <script src="script.js"></script>

    <script>
      // Ambil URL saat ini
      const currentPage = window.location.pathname.split("/").pop();

      // Ambil semua elemen <a> di sidebar
      const navLinks = document.querySelectorAll('a.sidebar-link');

      // Loop semua link dan tambahkan class 'active' jika href cocok
      navLinks.forEach(link => {
        console.log(link.getAttribute('href'));
          if (link.getAttribute('href') === currentPage) {
              link.classList.add('sidebar-link-active');
          }
      });
  </script>
  </body>

</html>