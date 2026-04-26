<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> LitSpace </title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        :root {
            --sidebar-color: #1e293b;
            --sidebar-hover: #334155;
            --accent-color: #38bdf8;
        }

        body {
            font-family: "Inter", "SF Pro", sans-serif;
            display: flex;
            min-height: 100vh;
            background: #f8fafc;
            margin: 0;
        }

        .sidebar {
            width: 260px;
            background-color: var(--sidebar-color);
            color: white;
            padding: 20px 15px;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            padding: 10px 15px 20px;
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--accent-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar a {
            color: #cbd5e1;
            text-decoration: none;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-radius: 8px;
            margin-bottom: 4px;
            transition: all 0.2s;
            font-size: 14px;
        }

        .sidebar a:hover {
            background-color: var(--sidebar-hover);
            color: white;
        }

        .sidebar a.active {
            background-color: #38bdf8;
            color: #0f172a;
            font-weight: 600;
        }

        .content {
            flex-grow: 1;
            padding: 25px;
            background-color: #f8fafc;
            overflow-y: auto;
        }

        .btn-backup {
            background: #10b981;
            color: white !important;
            justify-content: center;
            margin-top: 10px;
            font-weight: bold;
        }

        .btn-logout {
            background: #ef4444;
            color: white !important;
            justify-content: center;
            margin-top: 10px;
        }

        .user-profile {
            margin-top: auto;
            padding: 15px;
            background: rgba(0,0,0,0.2);
            border-radius: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <i class="bi bi-book-half"></i>
            <span>LitSpace</span>
        </div>

        <a href="<?= base_url('dashboard') ?>" class="<?= (uri_string() == 'dashboard') ? 'active' : '' ?>">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        
        <a href="<?= base_url('users') ?>" class="<?= (uri_string() == 'users') ? 'active' : '' ?>">
            <i class="bi bi-people"></i> Users
        </a>

        <a href="<?= base_url('anggota') ?>" class="<?= (uri_string() == 'anggota') ? 'active' : '' ?>">
            <i class="bi bi-person-vcard"></i> Anggota
        </a>

        <a href="<?= base_url('penulis') ?>" class="<?= (uri_string() == 'penulis') ? 'active' : '' ?>">
            <i class="bi bi-pencil-square"></i> Penulis
        </a>

        <a href="<?= base_url('buku') ?>" class="<?= (uri_string() == 'buku') ? 'active' : '' ?>">
            <i class="bi bi-book"></i> Buku
        </a>

        <a href="<?= base_url('rak') ?>" class="<?= (uri_string() == 'rak') ? 'active' : '' ?>">
            <i class="bi bi-layers"></i> Rak
        </a>

        <a href="<?= base_url('peminjaman') ?>" class="<?= (uri_string() == 'peminjaman') ? 'active' : '' ?>">
            <i class="bi bi-journal-arrow-up"></i> Peminjaman
        </a>

        <a href="<?= base_url('pengembalian') ?>" class="<?= (uri_string() == 'pengembalian') ? 'active' : '' ?>">
            <i class="bi bi-journal-check"></i> Pengembalian
        </a>

        <a href="<?= base_url('kategori') ?>" class="<?= (uri_string() == 'kategori') ? 'active' : '' ?>">
            <i class="bi bi-tags"></i> Kategori
        </a>

        <a href="<?= base_url('setting') ?>" class="<?= (uri_string() == 'setting') ? 'active' : '' ?>">
            <i class="bi bi-gear"></i> Setting
        </a>

        <a href="<?= base_url('backup') ?>" class="btn-backup">
            <i class="bi bi-database-fill-up"></i> Backup Database
        </a>

        <div class="user-profile">
            <small style="color: #94a3b8;">Masuk sebagai:</small>
            <div style="display: flex; align-items: center; gap: 10px; margin-top: 5px;">
                <img src="https://ui-avatars.com/api/?name=User&background=random" style="width: 30px; border-radius: 50%;">
                <span style="font-size: 13px; font-weight: bold;"><?= session()->get('nama') ?? 'Admin' ?></span>
            </div>
        </div>

        <a href="<?= base_url('logout') ?>" class="btn-logout">
            <i class="bi bi-box-arrow-right"></i> Log Out
        </a>
    </div>

    <div class="content">
        <div class="container-fluid">
            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>