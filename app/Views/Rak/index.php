<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0" style="font-weight: bold; color: #1e293b;">Data Rak</h4>
            <p class="text-muted small mb-0">Kelola lokasi penyimpanan buku di perpustakaan</p>
        </div>
        <a href="<?= base_url('rak/tambah') ?>" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg"></i> Tambah Rak
        </a>
    </div>

    <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="background: white;">
                    <thead style="background-color: #f1f5f9;">
                        <tr>
                            <th class="px-4 py-3 text-secondary" style="width: 10%;">No</th>
                            <th class="px-4 py-3 text-secondary">Kode Rak</th>
                            <th class="px-4 py-3 text-secondary">Nama Rak</th>
                            <th class="px-4 py-3 text-secondary">Lokasi</th>
                            <th class="px-4 py-3 text-secondary text-center" style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 py-3 align-middle">1</td>
                            <td class="px-4 py-3 align-middle"><span class="badge bg-light text-dark border">-</span></td>
                            <td class="px-4 py-3 align-middle fw-bold">Rak A</td>
                            <td class="px-4 py-3 align-middle">-</td>
                            <td class="px-4 py-3 text-center">
                                <a href="#" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i> Edit</a>
                                <a href="#" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 align-middle">2</td>
                            <td class="px-4 py-3 align-middle"><span class="badge bg-light text-dark border">-</span></td>
                            <td class="px-4 py-3 align-middle fw-bold">Rak A</td>
                            <td class="px-4 py-3 align-middle">-</td>
                            <td class="px-4 py-3 text-center">
                                <a href="#" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i> Edit</a>
                                <a href="#" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 align-middle">3</td>
                            <td class="px-4 py-3 align-middle"><span class="badge bg-light text-dark border">-</span></td>
                            <td class="px-4 py-3 align-middle fw-bold">Rak B</td>
                            <td class="px-4 py-3 align-middle">-</td>
                            <td class="px-4 py-3 text-center">
                                <a href="#" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i> Edit</a>
                                <a href="#" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling tambahan agar tabel terlihat lebih eksklusif */
    .table thead th {
        font-weight: 600;
        font-size: 0.85rem;
        border-bottom: 2px solid #e2e8f0;
    }
    .table tbody td {
        font-size: 0.9rem;
        border-bottom: 1px solid #f1f5f9;
    }
    .btn-outline-primary:hover, .btn-outline-danger:hover {
        color: white !important;
    }
</style>

<?= $this->endSection() ?>