<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.container {
    padding: 20px;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.title {
    font-size: 22px;
    font-weight: bold;
    color: #1e293b;
}

.btn {
    padding: 8px 12px;
    border-radius: 8px;
    text-decoration: none;
    color: white;
    font-size: 13px;
}

.btn-green {
    background: #22c55e;
}

.table-box {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
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

.empty {
    padding: 20px;
    text-align: center;
    color: #64748b;
}
</style>

<div class="container">

    <div class="header">
        <div class="title">✍️ Data Penulis</div>
        <a href="<?= base_url('penulis/create') ?>" class="btn btn-green">
            + Tambah Penulis
        </a>
    </div>

    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Penulis</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($penulis)): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($penulis as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $p['nama_penulis'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2" class="empty">
                            Belum ada data penulis
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<?= $this->endSection() ?>