<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.container { padding:20px; }

.header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:15px;
}

.title {
    font-size:22px;
    font-weight:bold;
    color:#1e293b;
}

.btn {
    padding:6px 10px;
    border-radius:6px;
    text-decoration:none;
    font-size:13px;
    color:white;
}

.btn-green { background:#22c55e; }
.btn-blue  { background:#3b82f6; }
.btn-red   { background:#ef4444; }

.table-box {
    background:white;
    border-radius:12px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
    overflow:hidden;
}

table {
    width:100%;
    border-collapse:collapse;
}

th, td {
    padding:10px;
    text-align:center;
    border-bottom:1px solid #eee;
}

th {
    background:#1e293b;
    color:white;
}

tr:hover {
    background:#f1f5f9;
}

img {
    width:50px;
    border-radius:6px;
}

.badge {
    padding:4px 8px;
    border-radius:6px;
    font-size:12px;
    color:white;
}

.badge-success { background:#22c55e; }
.badge-danger  { background:#ef4444; }
.badge-warning { background:#f59e0b; }

.empty {
    padding:20px;
    color:#64748b;
}
</style>

<div class="container">

    <div class="header">
        <div class="title">📚 Data Peminjaman</div>
        
        <div style="display: flex; gap: 10px;">
            <?php if (session()->get('id_anggota')) : ?>
                <a href="<?= base_url('katalog') ?>" class="btn btn-blue" style="background: #0ea5e9;">
                    🔍 Pilih Buku (Katalog)
                </a>
            <?php endif; ?>

            <a href="<?= base_url('peminjaman/create') ?>" class="btn btn-green">+ Tambah</a>
        </div>
    </div>

    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>Cover</th>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Denda</th>
                    <th>Status</th>
                    <th>Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php if (!empty($peminjaman)): ?>
                <?php foreach ($peminjaman as $p): ?>
                <tr>

                    <td>
                        <img src="<?= base_url('uploads/buku/' . ($p['cover'] ?? 'no-image.png')) ?>">
                    </td>

                    <td><?= $p['nama'] ?? $p['id_anggota'] ?></td>

                    <td><?= $p['judul'] ?? $p['id_buku'] ?></td>

                    <td><?= ($p['tanggal_pinjam'] != '0000-00-00') ? $p['tanggal_pinjam'] : '-' ?></td>
                    <td><?= ($p['tanggal_kembali'] != '0000-00-00') ? $p['tanggal_kembali'] : '-' ?></td>

                    <td>
                        Rp <?= number_format($p['denda'] ?? 0, 0, ',', '.') ?>
                    </td>

                    <td>
                        <?php if ($p['status'] == 'dipinjam'): ?>
                            <span class="badge badge-warning">Dipinjam</span>
                        <?php else: ?>
                            <span class="badge badge-success">Kembali</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if ($p['status_bayar'] == 'lunas'): ?>
                            <span class="badge badge-success">Lunas</span>
                        <?php else: ?>
                            <span class="badge badge-danger">Belum</span>
                        <?php endif; ?>
                    </td>

                    <td>

                        <?php if ($p['status'] == 'dipinjam'): ?>
                            <a href="<?= base_url('peminjaman/kembalikan/'.$p['id_peminjaman']) ?>"
                               class="btn btn-blue"
                               onclick="return confirm('Proses pengembalian buku ini?')">
                               Kembalikan
                            </a>
                        <?php endif; ?>

                        <?php if ($p['status_bayar'] == 'belum' && $p['denda'] > 0): ?>
                            <a href="<?= base_url('peminjaman/bayar/'.$p['id_peminjaman']) ?>"
                               class="btn btn-red">
                               💰 Bayar
                            </a>
                        <?php endif; ?>

                    </td>

                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="empty">Belum ada data peminjaman</td>
                </tr>
            <?php endif; ?>
            </tbody>

        </table>
    </div>

</div>

<?= $this->endSection() ?>