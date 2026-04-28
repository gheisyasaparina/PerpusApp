<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.card-form {
    max-width: 500px;
    margin: auto;
    border-radius: 12px;
}

.form-title {
    font-size: 20px;
    font-weight: bold;
    color: #1e293b;
}

.btn-custom {
    border-radius: 8px;
    padding: 8px;
    font-size: 14px;
}
</style>

<div class="container">

    <div class="card shadow-sm border-0 card-form">
        <div class="card-body">

            <div class="form-title mb-3">
                💰 Tambah Denda
            </div>

            <form action="<?= base_url('denda/store') ?>" method="post">

                <!-- ANGGOTA -->
                <div class="mb-3">
                    <label class="form-label">Pilih Anggota</label>
                    <select name="id_anggota" class="form-control" required>
                        <option value="">-- Pilih Anggota --</option>
                       <?php foreach ($anggota as $a): ?>
                            <option value="<?= $a['id_anggota'] ?>">
                                <?= $a['nama'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- JUMLAH DENDA -->
                <div class="mb-3">
                    <label class="form-label">Jumlah Denda</label>
                    <input type="number" name="jumlah_denda" 
                           class="form-control" 
                           placeholder="Contoh: 1000"
                           required>
                </div>

                <!-- STATUS -->
                <div class="mb-4">
                    <label class="form-label">Status Pembayaran</label>
                    <select name="status" class="form-control">
                        <option value="belum">Belum Bayar</option>
                        <option value="lunas">Lunas</option>
                    </select>
                </div>

                <!-- BUTTON -->
                <div class="d-flex gap-2">
                    <button class="btn btn-success w-100 btn-custom">
                        💾 Simpan
                    </button>

                    <a href="<?= base_url('denda') ?>" 
                       class="btn btn-secondary w-100 btn-custom">
                        ⬅️ Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>