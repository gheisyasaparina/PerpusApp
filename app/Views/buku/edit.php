<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3>Edit Buku</h3>

    <form method="post" action="<?= base_url('buku/update/' . $buku['id_buku']) ?>" enctype="multipart/form-data">

        <!-- Judul -->
        <div class="mb-2">
            <label>Judul</label><br>
            <input type="text" name="judul" value="<?= $buku['judul'] ?>" class="form-control">
        </div>

        <!-- ISBN -->
        <div class="mb-2">
            <label>ISBN</label><br>
            <input type="text" name="isbn" value="<?= $buku['isbn'] ?? '' ?>" class="form-control">
        </div>

        <!-- Kategori -->
        <div class="mb-2">
            <label>Kategori</label><br>
            <select name="id_kategori" class="form-control">
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['id_kategori'] ?>"
                        <?= $buku['id_kategori'] == $k['id_kategori'] ? 'selected' : '' ?>>
                        <?= $k['nama_kategori'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Penulis -->
        <div class="mb-2">
            <label>Penulis</label><br>
            <select name="id_penulis" class="form-control">
                <?php foreach ($penulis as $p): ?>
                    <option value="<?= $p['id_penulis'] ?>"
                        <?= $buku['id_penulis'] == $p['id_penulis'] ? 'selected' : '' ?>>
                        <?= $p['nama_penulis'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Penerbit -->
        <div class="mb-2">
            <label>Penerbit</label><br>
            <select name="id_penerbit" class="form-control">
                <?php foreach ($penerbit as $p): ?>
                    <option value="<?= $p['id_penerbit'] ?>"
                        <?= $buku['id_penerbit'] == $p['id_penerbit'] ? 'selected' : '' ?>>
                        <?= $p['nama_penerbit'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Rak -->
        <div class="mb-2">
            <label>Rak</label><br>
            <select name="id_rak" class="form-control">
                <?php foreach ($rak as $r): ?>
                    <option value="<?= $r['id_rak'] ?>"
                        <?= $buku['id_rak'] == $r['id_rak'] ? 'selected' : '' ?>>
                        <?= $r['nama_rak'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Tahun -->
        <div class="mb-2">
            <label>Tahun Terbit</label><br>
            <input type="number" name="tahun_terbit" value="<?= $buku['tahun_terbit'] ?>" class="form-control">
        </div>

        <!-- Jumlah -->
        <div class="mb-2">
            <label>Jumlah</label><br>
            <input type="number" name="jumlah" value="<?= $buku['jumlah'] ?>" class="form-control">
        </div>

        <!-- Tersedia -->
        <div class="mb-2">
            <label>Tersedia</label><br>
            <input type="number" name="tersedia" value="<?= $buku['tersedia'] ?>" class="form-control">
        </div>

        <!-- Deskripsi -->
        <div class="mb-2">
            <label>Deskripsi</label><br>
            <textarea name="deskripsi" class="form-control"><?= $buku['deskripsi'] ?></textarea>
        </div>

        <!-- Upload Cover -->
        <div class="mb-2">
            <label>Upload Cover Baru</label><br>
            <input type="file" name="cover" class="form-control">
        </div>

        <!-- Preview Cover -->
        <div class="mb-3">
            <label>Cover Saat Ini</label><br>

            <?php if (!empty($buku['cover'])): ?>
                <?php
                $ext = pathinfo($buku['cover'], PATHINFO_EXTENSION);
                ?>

                <?php if (in_array(strtolower($ext), ['jpg','jpeg','png','gif'])): ?>
                    <img src="<?= base_url('uploads/buku/' . $buku['cover']) ?>" width="120">
                <?php else: ?>
                    <a href="<?= base_url('uploads/buku/' . $buku['cover']) ?>" target="_blank">
                        Lihat File
                    </a>
                <?php endif; ?>
            <?php else: ?>
                <span>Tidak ada cover</span>
            <?php endif; ?>
        </div>

        <!-- Button -->
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('buku') ?>" class="btn btn-secondary">Kembali</a>

    </form>
</div>

<?= $this->endSection() ?>