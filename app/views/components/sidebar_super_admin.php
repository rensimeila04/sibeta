<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sidebar</title>
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/iconsax-css/style.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="../../../public/assets/css/sidebar.css" />
  <link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
    rel="stylesheet" />
</head>

<body>
  <aside id="sidebar" class="expand">
    <div class="d-flex justify-content-center align-items-center pt-4">
      <img src="/sibeta/public/assets/img/logo.png" />
    </div>
    <ul class="sidebar-nav">
      <li class="sidebar-item">
        <a href="/sibeta/public/index.php?page=super_admin" class="sidebar-link d-flex align-items-center">
          <span class="material-symbols-outlined"> home </span>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="#"
          class="sidebar-link collapsed has-dropdown d-flex align-items-center"
          data-bs-toggle="collapse" data-bs-target="#pengguna"
          aria-expanded="false" aria-controls="pengguna">
          <span class="material-symbols-outlined">person</span>
          <span>Pengguna</span>
        </a>
        <ul id="pengguna" class="sidebar-dropdown list-unstyled collapse"
          data-bs-parent="#sidebar">
          <li class="sidebar-item">
            <a href="/sibeta/public/index.php?page=super_admin/mahasiswa" class="sidebar-link">Mahasiswa</a>
          </li>
          <li class="sidebar-item">
            <a href="/sibeta/public/index.php?page=super_admin/admin" class="sidebar-link">Admin</a>
          </li>
          <li class="sidebar-item">
            <a href="/sibeta/public/index.php?page=super_admin/teknisi" class="sidebar-link">Teknisi</a>
          </li>
        </ul>
      </li>
      <li class="sidebar-item">
        <a href="/sibeta/public/index.php?page=super_admin/kelas" class="sidebar-link d-flex align-items-center">
          <span class="material-symbols-outlined"> book </span>
          <span>Kelas</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="/sibeta/public/index.php?page=super_admin/prodi" class="sidebar-link d-flex align-items-center">
          <span class="material-symbols-outlined"> school </span>
          <span>Program Studi</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="/sibeta/public/index.php?page=super_admin/dokumen" class="sidebar-link d-flex align-items-center">
          <span class="material-symbols-outlined">
            text_snippet
          </span>
          <span>Dokumen</span>
        </a>
      </li>
    </ul>
    <div class="sidebar-footer">
      <a href="/sibeta/public/index.php?page=logout" class="sidebar-link-logout d-flex align-items-center">
        <span class="material-symbols-outlined" style="color: #ca3521">
          logout
        </span>
        <span style="color: #ca3521">Logout</span>
      </a>
    </div>
  </aside>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Ambil URL saat ini
      const urlParams = new URLSearchParams(window.location.search); // Ambil parameter query
      const currentPage = urlParams.get('page'); // Ambil nilai dari parameter 'page'

      console.log("Current Page:", currentPage); // Debugging

      // Ambil semua elemen <a> di sidebar
      const navLinks = document.querySelectorAll('a.sidebar-link');

      // Loop semua link dan tambahkan class 'active' jika href cocok
      navLinks.forEach(link => {
        const linkPage = new URL(link.href).searchParams.get('page'); // Ambil nilai dari parameter 'page' di href
        console.log("Link Page:", linkPage); // Debugging

        // Tambahkan kelas 'sidebar-link-active' jika linkPage cocok dengan currentPage
        if (linkPage && linkPage === currentPage) {
          link.classList.add('sidebar-link-active');
        } else {
          link.classList.remove('sidebar-link-active'); // Hapus jika tidak cocok
        }
      });

      // Tambahkan logika untuk menandai dropdown (jika ada)
      const dropdownLinks = document.querySelectorAll('.has-dropdown');
      dropdownLinks.forEach(dropdown => {
        const targetId = dropdown.getAttribute('data-bs-target'); // Ambil ID target dropdown
        const dropdownContainer = document.querySelector(targetId); // Temukan elemen dropdown

        if (dropdownContainer) {
          const dropdownItems = dropdownContainer.querySelectorAll('.sidebar-link'); // Semua item dalam dropdown
          let isAnyDropdownLinkActive = false;

          // Periksa apakah ada link aktif di dalam dropdown
          dropdownItems.forEach(item => {
            const linkPage = new URL(item.href).searchParams.get('page');
            if (linkPage && linkPage === currentPage) {
              isAnyDropdownLinkActive = true;
            }
          });

          // Highlight dropdown dan buka jika ada link aktif di dalamnya
          if (isAnyDropdownLinkActive) {
            dropdown.classList.add('sidebar-link-active');
            dropdownContainer.classList.add('show'); // Buka dropdown
          } else {
            dropdown.classList.remove('sidebar-link-active');
            dropdownContainer.classList.remove('show'); // Tutup dropdown
          }
        }
      });
    });
  </script>
</body>

</html>