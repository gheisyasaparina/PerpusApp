<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .grid-buku {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
        padding: 20px;
    }
    .card {
        border: 1px solid #ddd;
        border-radius: 10px;
        text-align: center;
        background: white;
        padding: 15px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 5px;
    }
    .btn-pinjam {
        display: block;
        background: #22c55e;
        color: white;
        padding: 10px;
        text-decoration: none;
        border-radius: 6px;
        margin-top: 10px;
        font-weight: bold;
    }
</style>

<div class="container" style="padding:20px;">
    <h2>📚 Pilih Buku yang Ingin Dipinjam</h2>
    <p>Halo, <b><?= session()->get('nama') ?></b>! Silakan pilih buku favoritmu.</p>

    <div class="grid-buku">
        <?php foreach ($buku as $b) : ?>
            <div class="card">
                <img src="<?= base_url('uploads/buku/' . ($b['cover'] ?? 'no-image.png')) ?>">
                <h4 style="margin:10px 0;"><?= $b['judul'] ?></h4>
                <p style="font-size: 13px; color: #666;">Tersedia: <?= $b['tersedia'] ?></p>
                
                <a href="<?= base_url('peminjaman/pinjamLangsung/' . $b['id_buku']) ?>" 
                   class="btn-pinjam" 
                   onclick="return confirm('Pinjam buku <?= $b['judul'] ?>?')">
                   Pinjam Sekarang
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>