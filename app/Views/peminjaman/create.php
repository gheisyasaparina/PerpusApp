<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div style="max-width: 600px; margin: 20px auto; padding: 25px; background: white; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); font-family: sans-serif;">
    
    <h2 style="text-align: center; color: #1e293b;">📝 Form Peminjaman Buku</h2>
    <hr style="margin-bottom: 25px; border: 0; border-top: 1px solid #eee;">

    <form action="<?= base_url('peminjaman/store') ?>" method="post">
        <?= csrf_field(); ?>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">👤 Petugas</label>
            <select name="id_petugas" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;" required>
                <option value="">-- Pilih Petugas --</option>
                <?php foreach ($petugas as $pts) : ?>
                    <option value="<?= $pts['id_petugas'] ?>"><?= $pts['nama'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">👥 Anggota</label>
            <select name="id_anggota" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;" required>
                <option value="">-- Pilih Anggota --</option>
                <?php foreach ($anggota as $agt) : ?>
                    <option value="<?= $agt['id_anggota'] ?>"><?= $agt['nama'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">📚 Pilih Buku</label>
            <select name="id_buku" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;" required>
                <option value="">-- Pilih Buku --</option>
                <?php foreach ($buku as $bk) : ?>
                    <option value="<?= $bk['id_buku'] ?>"><?= $bk['judul'] ?> (Stok: <?= $bk['tersedia'] ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>

        <div style="display: flex; gap: 15px; margin-bottom: 25px;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">📅 Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" value="<?= date('Y-m-d') ?>" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;" required>
            </div>
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">📅 Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" value="<?= date('Y-m-d', strtotime('+3 days')) ?>" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;" required>
            </div>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" style="flex: 2; background: #22c55e; color: white; padding: 12px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold;">
                💾 Simpan Peminjaman
            </button>
            <a href="<?= base_url('peminjaman') ?>" style="flex: 1; text-align: center; background: #94a3b8; color: white; padding: 12px; border-radius: 8px; text-decoration: none;">Batal</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>