<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="card shadow-sm border-0" style="border-radius:14px;">
        <div class="card-body p-4">

            <!-- HEADER -->
            <div class="mb-4">
                <h4 class="fw-bold mb-1">✏️ Edit User</h4>
                <small class="text-muted">Perbarui data pengguna</small>
            </div>

            <div class="row">
                
                <!-- FOTO -->
                <div class="col-md-4 text-center">
                    <img src="<?= $user['foto'] 
                        ? base_url('uploads/users/'.$user['foto']) 
                        : 'https://ui-avatars.com/api/?name='.$user['nama'].'&background=random' ?>"
                        class="rounded-circle shadow-sm mb-3"
                        width="120"
                        height="120"
                        style="object-fit:cover;">

                    <form action="<?= base_url('users/update/'.$user['id']) ?>" 
                          method="post" 
                          enctype="multipart/form-data">

                        <label class="form-label fw-semibold">Ganti Foto</label>
                        <input type="file" name="foto" class="form-control mb-2">

                        <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                </div>

                <!-- FORM -->
                <div class="col-md-8">

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?= $user['nama'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="<?= $user['username'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password Baru (opsional)</label>
                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diganti">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select">
                            <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
                            <option value="petugas" <?= $user['role']=='petugas'?'selected':'' ?>>Petugas</option>
                            <option value="anggota" <?= $user['role']=='anggota'?'selected':'' ?>>Anggota</option>
                        </select>
                    </div>

                    <!-- BUTTON -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            💾 Update
                        </button>

                        <a href="<?= base_url('users') ?>" class="btn btn-light border px-4">
                            ❌ Batal
                        </a>
                    </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

<style>
.card {
    border-radius: 14px;
}
.form-control, .form-select {
    border-radius: 10px;
}
</style>

<?= $this->endSection() ?>