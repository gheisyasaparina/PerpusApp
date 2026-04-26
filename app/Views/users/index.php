<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold mb-0" style="color: #1e293b;">Data Users</h4>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-secondary"><i class="bi bi-printer"></i> Print</button>
                    <button class="btn btn-primary"><i class="bi bi-person-plus"></i> Tambah User</button>
                </div>
            </div>

            <form action="" method="get" class="row g-2">
                <div class="col-md-3">
                    <select class="form-select">
                        <option selected>-- Semua Role --</option>
                        <option>Admin</option>
                        <option>Petugas</option>
                        <option>Anggota</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Cari Nama, Email, atau Username...">
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-info text-white px-4">Cari</button>
                    <button type="reset" class="btn btn-light border px-4">Reset</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3" style="width: 50px;">No</th>
                            <th class="py-3">Foto</th>
                            <th class="py-3">Nama</th>
                            <th class="py-3">Email</th>
                            <th class="py-3">Username</th>
                            <th class="py-3">Role</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $users = [
                            ['gheisya', 'gheisya@gmail.com', 'gheisyasafarina', 'Admin'],
                            ['markeu', 'markeu@gmail.com', 'onyourmark', 'Anggota'],
                            ['mutiara laila', 'mutiaralaila@gmail.com', 'mutiara', 'Anggota'],
                            ['karina', 'karina@gmail.com', 'karina', 'Anggota'],
                            ['dinda', 'dinda@gmail.com', 'dinda', 'Anggota'],
                            ['paos', 'qwertyu123@gmail.com', 'paes', 'Anggota'],
                        ];
                        foreach ($users as $index => $u): 
                        ?>
                        <tr>
                            <td class="px-4"><?= $index + 1 ?></td>
                            <td>
                                <img src="https://ui-avatars.com/api/?name=<?= $u[0] ?>&background=random" class="rounded-circle" width="35" alt="profile">
                            </td>
                            <td class="fw-bold"><?= ucwords($u[0]) ?></td>
                            <td class="text-muted"><?= $u[1] ?></td>
                            <td><code><?= $u[2] ?></code></td>
                            <td>
                                <span class="badge <?= ($u[3] == 'Admin') ? 'bg-danger' : 'bg-primary' ?> bg-opacity-10 <?= ($u[3] == 'Admin') ? 'text-danger' : 'text-primary' ?> border px-3 py-2">
                                    <?= $u[3] ?>
                                </span>
                            </td>
                            <td class="px-4 text-center">
                                <div class="btn-group shadow-sm" style="border-radius: 8px; overflow: hidden;">
                                    <a href="#" class="btn btn-sm btn-light border-end" title="Detail"><i class="bi bi-eye text-info"></i></a>
                                    <a href="#" class="btn btn-sm btn-light border-end" title="Edit"><i class="bi bi-pencil text-warning"></i></a>
                                    <a href="https://wa.me/62812345678" target="_blank" class="btn btn-sm btn-light border-end" title="Kirim WA"><i class="bi bi-whatsapp text-success"></i></a>
                                    <a href="#" class="btn btn-sm btn-light text-danger" title="Hapus"><i class="bi bi-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .table thead th {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
    }
    .btn-group .btn:hover {
        background-color: #f8fafc;
    }
    .badge {
        font-weight: 600;
        letter-spacing: 0.3px;
    }
</style>

<?= $this->endSection() ?>