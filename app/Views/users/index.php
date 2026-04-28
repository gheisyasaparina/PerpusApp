<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <!-- 🔥 HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">👥 Manajemen User</h3>
            <small class="text-muted">Kelola semua data pengguna sistem</small>
        </div>

        <div class="d-flex gap-2">
            <a href="<?= base_url('users/print') ?>" class="btn btn-light border">
                <i class="bi bi-printer"></i>
            </a>

            <a href="<?= base_url('users/create') ?>" class="btn btn-primary shadow-sm">
                <i class="bi bi-person-plus"></i> Tambah User
            </a>
        </div>
    </div>

    <!-- 🔥 CARD STATS -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3">
                <h6 class="text-muted">Total User</h6>
                <h3 class="fw-bold"><?= count($users) ?></h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3">
                <h6 class="text-muted">Admin</h6>
                <h3 class="fw-bold text-danger">
                    <?= count(array_filter($users, fn($u) => $u['role']=='admin')) ?>
                </h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3">
                <h6 class="text-muted">Anggota</h6>
                <h3 class="fw-bold text-primary">
                    <?= count(array_filter($users, fn($u) => $u['role']=='anggota')) ?>
                </h3>
            </div>
        </div>
    </div>

    <!-- 🔍 SEARCH -->
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body">
            <form method="get" action="<?= base_url('users') ?>" class="row g-2">

                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="">Semua Role</option>
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                        <option value="anggota">Anggota</option>
                    </select>
                </div>

                <div class="col-md-5">
                    <input type="text" name="keyword" class="form-control" placeholder="Cari user...">
                </div>

                <div class="col-md-auto">
                    <button class="btn btn-info text-white">
                        <i class="bi bi-search"></i>
                    </button>
                    <a href="<?= base_url('users') ?>" class="btn btn-light border">Reset</a>
                </div>

            </form>
        </div>
    </div>

    <!-- 📊 TABLE -->
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">

            <table class="table align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php if (!empty($users)): ?>
                    <?php $no=1; foreach($users as $u): ?>

                    <tr>
                        <td><?= $no++ ?></td>

                        <!-- USER INFO -->
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="<?= $u['foto'] 
                                    ? base_url('uploads/users/'.$u['foto']) 
                                    : 'https://ui-avatars.com/api/?name='.$u['nama'] ?>"
                                    class="rounded-circle"
                                    width="40">

                                <div>
                                    <div class="fw-bold"><?= $u['nama'] ?></div>
                                    <small class="text-muted"><?= $u['email'] ?></small>
                                </div>
                            </div>
                        </td>

                        <td><code><?= $u['username'] ?></code></td>

                        <!-- ROLE -->
                        <td>
                            <span class="badge 
                                <?= $u['role']=='admin' ? 'bg-danger' : 'bg-primary' ?>">
                                <?= ucfirst($u['role']) ?>
                            </span>
                        </td>

                        <!-- AKSI -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">

                                <a href="<?= base_url('users/detail/'.$u['id']) ?>" 
                                   class="btn btn-sm btn-light border">
                                   <i class="bi bi-eye"></i>
                                </a>

                                <a href="<?= base_url('users/edit/'.$u['id']) ?>" 
                                   class="btn btn-sm btn-warning text-white">
                                   <i class="bi bi-pencil"></i>
                                </a>

                                <a href="<?= base_url('users/delete/'.$u['id']) ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin hapus?')">
                                   <i class="bi bi-trash"></i>
                                </a>

                            </div>
                        </td>

                    </tr>

                    <?php endforeach; ?>
                <?php else: ?>

                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            Tidak ada data
                        </td>
                    </tr>

                <?php endif; ?>
                </tbody>

            </table>

        </div>
    </div>

</div>

<style>
.card {
    border-radius: 14px;
}

.table td {
    vertical-align: middle;
}

.btn {
    border-radius: 8px;
}

.badge {
    font-size: 12px;
    padding: 6px 10px;
}
</style>

<?= $this->endSection() ?>