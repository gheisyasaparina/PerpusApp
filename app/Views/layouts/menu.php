<div class="sidebar-header" style="padding: 10px 15px 20px; font-weight: bold; color: #38bdf8; display: flex; align-items: center; gap: 10px;">
    <i class="bi bi-book-half" style="font-size: 1.5rem;"></i>
    <span>LitSpace</span>
</div>

<a href="<?= base_url('dashboard') ?>" class="nav-link <?= (uri_string() == 'dashboard') ? 'active' : '' ?>">
    <i class="bi bi-speedometer2"></i> Dashboard
</a>

<hr style="border-color: rgba(255,255,255,0.1); margin: 5px 0;">

<a href="<?= base_url('users') ?>" class="nav-link <?= (uri_string() == 'users') ? 'active' : '' ?>">
    <i class="bi bi-people"></i> Users
</a>

<a href="<?= base_url('anggota') ?>" class="nav-link <?= (uri_string() == 'anggota') ? 'active' : '' ?>">
    <i class="bi bi-person-badge"></i> Anggota
</a>

<a href="<?= base_url('penulis') ?>" class="nav-link <?= (uri_string() == 'penulis') ? 'active' : '' ?>">
    <i class="bi bi-pencil-square"></i> Penulis
</a>

<a href="<?= base_url('buku') ?>" class="nav-link <?= (uri_string() == 'buku') ? 'active' : '' ?>">
    <i class="bi bi-book"></i> Buku
</a>

<a href="<?= base_url('rak') ?>" class="nav-link <?= (uri_string() == 'rak') ? 'active' : '' ?>">
    <i class="bi bi-layers"></i> Rak
</a>

<hr style="border-color: rgba(255,255,255,0.1); margin: 5px 0;">

<?php if (in_array(strtolower(session()->get('role')), ['admin','petugas'])): ?>
    <a href="<?= base_url('peminjaman') ?>" 
       class="nav-link <?= (uri_string() == 'peminjaman') ? 'active' : '' ?>">
        <i class="bi bi-journal-arrow-up"></i> Peminjaman
    </a>
<?php endif; ?>
<a href="<?= base_url('pengembalian') ?>" class="nav-link <?= (uri_string() == 'pengembalian') ? 'active' : '' ?>">
    <i class="bi bi-journal-check"></i> Pengembalian
</a>

<a href="<?= base_url('kategori') ?>" class="nav-link <?= (uri_string() == 'kategori') ? 'active' : '' ?>">
    <i class="bi bi-tags"></i> Kategori
</a>

<hr style="border-color: rgba(255,255,255,0.1); margin: 5px 0;">

<a href="<?= base_url('laporan') ?>" class="nav-link <?= (uri_string() == 'laporan') ? 'active' : '' ?>">
    <i class="bi bi-file-earmark-bar-graph"></i> Laporan
</a>

<a href="<?= base_url('setting') ?>" class="nav-link <?= (uri_string() == 'setting') ? 'active' : '' ?>">
    <i class="bi bi-gear"></i> Setting
</a>

<div style="padding: 10px 0;">
    <a href="<?= base_url('backup') ?>" style="background: #10b981; color: white; border-radius: 8px; justify-content: center; margin: 0 10px; font-size: 13px;">
        <i class="bi bi-database-fill-up"></i> Backup Database
    </a>
</div>

<div style="margin-top: auto; padding: 15px; background: rgba(0,0,0,0.2); border-radius: 10px; margin-bottom: 10px;">
    <small style="display: block; color: #94a3b8;">Masuk sebagai:</small>
    <div style="display: flex; align-items: center; gap: 10px; margin-top: 5px;">
        <img src="https://ui-avatars.com/api/?name=<?= session()->get('nama') ?>&background=random" style="width: 35px; border-radius: 50%;">
        <div style="overflow: hidden;">
            <p style="margin: 0; font-size: 13px; font-weight: bold; color: white;"><?= session()->get('nama') ?> (<?= session()->get('role') ?>)</p>
        </div>
    </div>
</div>

<a href="<?= base_url('logout') ?>" style="background-color: #ef4444; color: white; justify-content: center; border-radius: 8px;">
    <i class="bi bi-box-arrow-right"></i> Log Out
</a>