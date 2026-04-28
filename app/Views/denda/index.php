<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h4 class="fw-bold mb-0" style="color:#1e293b;">Data Denda</h4>
            <a href="<?= base_url('denda/create') ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0" style="border-radius: 12px;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4">No</th>
                            <th>ID Anggota</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($denda as $i => $d): ?>
                        <tr>
                            <td class="px-4"><?= $i+1 ?></td>
                            <td><?= $d['nama_anggota'] ?></td>
                            <td class="fw-bold text-danger">
                                Rp <?= number_format($d['jumlah_denda']) ?>
                            </td>

                            <td>
                                <?php if ($d['status'] == 'lunas'): ?>
                                    <span class="badge bg-success">Lunas</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Belum</span>
                                <?php endif; ?>
                            </td>


                            <td class="text-center">
                                <a href="<?= base_url('denda/edit/'.$d['id_denda']) ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?= base_url('denda/delete/'.$d['id_denda']) ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Hapus data?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>