<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Styling untuk Info Box agar mirip dengan gambar */
    .info-card {
        padding: 20px;
        border-radius: 12px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
    }
    
    .info-card .data {
        z-index: 2;
    }

    .info-card h3 {
        margin: 0;
        font-size: 28px;
        font-weight: bold;
    }

    .info-card p {
        margin: 0;
        font-size: 14px;
        opacity: 0.9;
    }

    .info-card i {
        font-size: 45px;
        opacity: 0.3;
        z-index: 1;
    }

    /* Warna Gradasi */
    .bg-blue   { background: linear-gradient(45deg, #00b4db, #0083b0); }
    .bg-green  { background: linear-gradient(45deg, #11998e, #38ef7d); }
    .bg-orange { background: linear-gradient(45deg, #f2994a, #f2c94c); }
    .bg-red    { background: linear-gradient(45deg, #eb3349, #f45c43); }
</style>

<div class="container mt-4">
    <div class="mb-4">
        <h4 style="color: #1e293b; font-weight: bold;">Dashboard <small style="font-size: 14px; color: #64748b; font-weight: normal;">Control panel</small></h4>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="info-card bg-blue">
                <div class="data">
                    <h3><?= $total_buku ?? 0 ?></h3>
                    <p>Total Buku</p>
                </div>
                <i class="bi bi-book"></i>
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-card bg-green">
                <div class="data">
                    <h3><?= $total_anggota ?? 0 ?></h3>
                    <p>Total Anggota</p>
                </div>
                <i class="bi bi-people"></i>
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-card bg-orange">
                <div class="data">
                    <h3><?= $total_pinjam ?? 0 ?></h3>
                    <p>Sedang Dipinjam</p>
                </div>
                <i class="bi bi-journal-arrow-up"></i>
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-card bg-red">
                <div class="data">
                    <h3><?= $total_kembali ?? 0 ?></h3>
                    <p>Total Kembali</p>
                </div>
                <i class="bi bi-journal-check"></i>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <p>Ini adalah Halaman Dashboard
            <br>Selamat datang di <b>perpustakaan</b>App!
            <br>Cemangatt tataaaa
        </p>
    </div>
</div>

<?= $this->endSection() ?>