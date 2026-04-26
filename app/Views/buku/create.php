<div style="max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; background-color: #f9f9f9; font-family: sans-serif;">
    
    <h2 style="text-align: center; color: #333;">Tambah Buku Baru</h2>
    <hr>

    <form action="<?= base_url('buku/store') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">ISBN</label>
            <input type="text" name="isbn" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Contoh: 978-602-..." required>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Judul Buku</label>
            <input type="text" name="judul" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Masukkan judul lengkap" required>
        </div>

        <div style="display: flex; gap: 10px; margin-bottom: 15px;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Tahun Terbit</label>
                <input type="number" name="tahun_terbit" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" placeholder="2024" required>
            </div>
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Jumlah Stok</label>
                <input type="number" name="jumlah" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" placeholder="0" required>
            </div>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Deskripsi / Sinopsis</label>
            <textarea name="deskripsi" rows="4" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Tulis ringkasan buku..."></textarea>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Cover Buku</label>
            <input type="file" name="cover" accept="image/*" style="width: 100%; padding: 5px;">
            <small style="color: #888;">Format: JPG, PNG, JPEG (Maks. 2MB)</small>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" style="flex: 2; background-color: #28a745; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
                💾 Simpan Data
            </button>
            <a href="<?= base_url('buku') ?>" style="flex: 1; text-align: center; background-color: #6c757d; color: white; padding: 10px; border: none; border-radius: 5px; text-decoration: none; font-size: 14px;">
                Batal
            </a>
        </div>
    </form>
</div>