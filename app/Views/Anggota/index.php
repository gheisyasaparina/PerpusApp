<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0" style="color: #1e293b;">Data Anggota</h4>
            <p class="text-muted small mb-0">Manajemen data keanggotaan perpustakaan</p>
        </div>
        <a href="<?= base_url('anggota/tambah') ?>" class="btn btn-primary shadow-sm px-4">
            <i class="bi bi-person-plus-fill"></i> Tambah Anggota
        </a>
    </div>

    <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #f1f5f9;">
                        <tr>
                            <th class="px-4 py-3 text-secondary" style="width: 70px;">No</th>
                            <th class="py-3 text-secondary">Nama Anggota</th>
                            <th class="py-3 text-secondary">Alamat</th>
                            <th class="py-3 text-secondary">No HP</th>
                            <th class="px-4 py-3 text-center text-secondary" style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($anggota as $a) : ?>
                        <tr>
                            <td class="px-4 text-muted"><?= $no++ ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=<?= $a['nama'] ?>&background=random&color=fff" class="rounded-circle" width="35">
                                    <span class="fw-bold" style="color: #334155;"><?= ucwords($a['nama']) ?></span>
                                </div>
                            </td>
                            <td><?= ($a['alamat'] == '') ? '<span class="text-muted">-</span>' : $a['alamat'] ?></td>
                            <td>
                                <?php if($a['no_hp']): ?>
                                    <span class="badge bg-light text-dark border"><i class="bi bi-telephone text-primary me-1"></i> <?= $a['no_hp'] ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 text-center">
                                <div class="btn-group shadow-sm" style="border-radius: 8px; overflow: hidden;">
                                    <?php if($a['no_hp']): ?>
                                        <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $a['no_hp']) ?>" target="_blank" class="btn btn-sm btn-white border" title="WhatsApp">
                                            <i class="bi bi-whatsapp text-success"></i>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <a href="<?= base_url('anggota/edit/' . $a['id_anggota']) ?>" class="btn btn-sm btn-white border" title="Edit">
                                        <i class="bi bi-pencil-square text-warning"></i>
                                    </a>
                                    
                                    <a href="<?= base_url('anggota/delete/' . $a['id_anggota']) ?>" 
                                       onclick="return confirm('Yakin ingin menghapus anggota <?= $a['nama'] ?>?')" 
                                       class="btn btn-sm btn-white border" title="Hapus">
                                        <i class="bi bi-trash text-danger"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php if (empty($anggota)): ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-people mb-2 d-block" style="font-size: 2rem;"></i>
                                Belum ada data anggota.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-white {
        background-color: white;
    }
    .btn-white:hover {
        background-color: #f8fafc;
    }
    .table tbody tr:hover {
        background-color: #f8fafc;
        transition: 0.2s;
    }
</style>

<?= $this->endSection() ?>