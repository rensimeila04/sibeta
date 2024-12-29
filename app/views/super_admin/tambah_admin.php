<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/sibeta/public/assets/css/header.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/sibeta/public/assets/css/style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet" />
    <link rel="stylesheet" href="../../../public/assets/css/dashboard.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIBETA</title>
 <style>
/* Container styling */
.container {
    max-width: 800px;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Form layout */
.container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

/* Form group styling - for two columns */
.form-group {
    margin-bottom: 20px;
}

/* Make specific fields take full width */
.form-group.full-width {
    grid-column: 1 / -1;
}

/* Label styling */
.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #333;
}

/* Input fields styling */
.form-group input[type="text"],
.form-group input[type="password"],
.form-group select {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    color: #666;
    background-color: white;
}

.form-group input[type="text"]::placeholder,
.form-group input[type="password"]::placeholder {
    color: #999;
}

/* File input styling */
.form-group input[type="file"] {
    width: 100%;
    padding: 6px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

/* Select dropdown styling */
.form-group select {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background-color: white;
    cursor: pointer;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23666' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    padding-right: 28px;
}

/* Submit button styling */
button[type="submit"] {
    background-color:rgb(35, 7, 126);
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    grid-column: 2;
    justify-self: end;
    margin-top: 20px;
}

button[type="submit"]:hover {
    background-color: #3730a3;
}

/* Password visibility toggle */
.password-field {
    position: relative;
}

.password-toggle {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #666;
}

/* Breadcrumbs styling */
.breadcrumbs {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
    color: #666;
    padding: 0 20px;
}

.breadcrumbs a {
    color: #4338ca;
    text-decoration: none;
}

.breadcrumbs .separator {
    color: #999;
}

/* Page title styling */
h2 {
    margin-bottom: 24px;
    color: #333;
    font-size: 24px;
    padding: 0 20px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container {
        grid-template-columns: 1fr;
        padding: 15px;
    }
    
    button[type="submit"] {
        grid-column: 1;
        width: 100%;
    }
}
 </style>
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

                <h2>Tambah Admin</h2>
                <div class="container mt-4 px-4">
    <div class="form-group">
        <label for="foto_profil">Foto Profil</label>
        <input type="file" name="foto_profil" id="foto_profil">
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="Masukkan Username" readonly>
    </div>
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" placeholder="Masukkan Nama">
    </div>
    <div class="form-group">
        <label for="kata_sandi">Kata Sandi</label>
        <div class="password-field">
            <input type="password" name="kata_sandi" id="kata_sandi" placeholder="Masukkan Kata Sandi">
        </div>
    </div>
    <div class="form-group">
        <label for="nip">NIP</label>
        <input type="text" name="nip" id="nip" placeholder="Masukkan NIP">
    </div>
    <div class="form-group">
        <label for="konfirmasi_kata_sandi">Konfirmasi Kata Sandi</label>
        <div class="password-field">
            <input type="password" name="konfirmasi_kata_sandi" id="konfirmasi_kata_sandi" placeholder="Konfirmasi Kata Sandi">
        </div>
    </div>
    <button type="submit">Simpan Perubahan</button>
</div>