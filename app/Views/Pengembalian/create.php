<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .container {
        padding: 20px;
    }

    h2 {
        margin-bottom: 15px;
    }

    .btn {
        padding: 6px 10px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
        color: white;
    }

    .btn-green { background: #22c55e; }
    .btn-blue { background: #3b82f6; }
    .btn-red { background: #ef4444; }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    th, td {
        padding: 10px;
        text-align: center;
        border-bottom: 1px solid #eee;
    }

    th {
        background: #1e293b;
        color: white;
    }

    tr:hover {
        background: #f1f5f9;
    }

    .badge {
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 12px;
        color: white;
    }

    .badge-success { background: #22c55e; }
    .badge-danger { background: #ef4444; }
    .badge-warning { background: #f59e0b; }

    img {
        width: 50px;
        border-radius: 5px;
    }
</style>

<div class="container">

    <h2>📚 Data Peminjaman</h2>

    <a href="<?= base_url('peminjaman/create') ?>" class="btn btn-green">+ Tambah</a>

    <br><br>

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
            <?php foreach ($peminjaman as $p): ?>

            <tr>
                <!-- COVER -->
                <td>
                    <img src="<?= base_url('uploads/buku/' . ($p['cover'] ?? 'default.png')) ?>">
                </td>

                <!-- NAMA ANGGOTA -->
                <td><?= $p['nama'] ?? 'Tidak ada' ?></td>

                <!-- JUDUL BUKU -->
                <td><?= $p['judul'] ?? 'Tidak ada' ?></td>

                <!-- TANGGAL -->
                <td><?= $p['tanggal_pinjam'] ?></td>
                <td><?= $p['tanggal_kembali'] ?></td>

                <!-- DENDA -->
                <td>
                    Rp <?= number_format($p['denda'] ?? 0, 0, ',', '.') ?>
                </td>

                <!-- STATUS -->
                <td>
                    <?php if ($p['status'] == 'dipinjam'): ?>
                        <span class="badge badge-warning">Dipinjam</span>
                    <?php else: ?>
                        <span class="badge badge-success">Kembali</span>
                    <?php endif; ?>
                </td>

                <!-- PEMBAYARAN -->
                <td>
                    <?php if (($p['status_denda'] ?? '') == 'lunas'): ?>
                        <span class="badge badge-success">Lunas</span>
                    <?php else: ?>
                        <span class="badge badge-danger">Belum</span>
                    <?php endif; ?>
                </td>

                <!-- AKSI -->
                <td>
                    <a href="<?= base_url('peminjaman/kembali/' . $p['id_peminjaman']) ?>" class="btn btn-blue">
                        Kembalikan
                    </a>

                    <?php if (($p['status_denda'] ?? '') != 'lunas'): ?>
                        <a href="<?= base_url('peminjaman/bayar/' . $p['id_peminjaman']) ?>" class="btn btn-red">
                            💰 Bayar
                        </a>
                    <?php endif; ?>
                </td>
            </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?= $this->endSection() ?>