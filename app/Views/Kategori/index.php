<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0" style="color: #1e293b;">Data Kategori</h4>
            <p class="text-muted small mb-0">Klasifikasi genre dan kategori buku</p>
        </div>
        <button class="btn btn-primary shadow-sm px-4">
            <i class="bi bi-plus-lg"></i> Tambah Kategori
        </button>
    </div>

    <div class="row">
        <div class="col-md-8"> <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead style="background-color: #f1f5f9;">
                                <tr>
                                    <th class="px-4 py-3 text-secondary" style="width: 80px;">No</th>
                                    <th class="py-3 text-secondary">Nama Kategori</th>
                                    <th class="px-4 py-3 text-center text-secondary" style="width: 150px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $kategori = ['fiksi', 'non fiksi', '-', 'non fiksi', 'fiksi', 'non fiksi', 'Novel', 'Komik', 'Novel', 'Komik'];
                                foreach ($kategori as $index => $nama): 
                                ?>
                                <tr>
                                    <td class="px-4 text-muted"><?= $index + 1 ?></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="icon-box bg-light rounded text-primary d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                <i class="bi bi-tag-fill"></i>
                                            </div>
                                            <span class="fw-semibold" style="color: #334155;"><?= ($nama == '-') ? '<em class="text-muted">Tanpa Nama</em>' : ucwords($nama) ?></span>
                                        </div>
                                    </td>
                                    <td class="px-4 text-center">
                                        <a href="#" class="btn btn-sm btn-outline-info me-1" title="Edit"><i class="bi bi-pencil"></i></a>
                                        <a href="#" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="border-radius: 12px; background: linear-gradient(135deg, #3b82f6, #2563eb); color: white;">
                <div class="card-body p-4">
                    <h5>Info Kategori</h5>
                    <p class="small opacity-75">Kategori membantu anggota menemukan buku sesuai minat mereka dengan lebih cepat.</p>
                    <hr class="opacity-25">
                    <div class="d-flex justify-content-between">
                        <span>Total Kategori</span>
                        <span class="fw-bold"><?= count($kategori) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table tbody tr:hover {
        background-color: #f8fafc;
    }
    .icon-box i {
        font-size: 1.1rem;
    }
    .btn-outline-info:hover {
        color: white !important;
    }
</style>

<?= $this->endSection() ?>