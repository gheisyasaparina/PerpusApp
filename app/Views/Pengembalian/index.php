<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.container { padding:20px; }

.title {
    font-size:22px;
    font-weight:bold;
    margin-bottom:15px;
}

.btn {
    padding:8px 12px;
    border-radius:8px;
    text-decoration:none;
    color:white;
    font-size:13px;
}
.btn-green { background:#22c55e; }

.table-box {
    background:white;
    border-radius:10px;
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

.badge {
    padding:4px 8px;
    border-radius:6px;
    font-size:12px;
    color:white;
}

.badge-success { background:#22c55e; }
.badge-danger { background:#ef4444; }
</style>

<div class="container">

    <div class="title">📦 Data Pengembalian</div>

    <a href="<?= base_url('pengembalian/create') ?>" class="btn btn-green">
        + Tambah Pengembalian
    </a>

    <br><br>

    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Denda</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($pengembalian as $p): ?>
                <tr>
                    <td><?= $p['nama'] ?></td>
                    <td><?= $p['judul'] ?></td>
                    <td><?= $p['tanggal_pinjam'] ?></td>
                    <td><?= $p['tanggal_kembali'] ?></td>

                    <td>
                        <?php if (!empty($p['jumlah_denda'])): ?>
                            <span class="badge badge-danger">
                                Rp <?= number_format($p['jumlah_denda'],0,',','.') ?>
                            </span>
                        <?php else: ?>
                            <span class="badge badge-success">Tidak ada</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<?= $this->endSection() ?>