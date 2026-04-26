<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <div class="card shadow">

        <!-- HEADER -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">📚 Data Buku</h4>
            <a href="<?= base_url('buku/create') ?>" class="btn btn-primary">
                + Tambah Buku
            </a>
        </div>

        <div class="card-body">

            <!-- SEARCH -->
            <form method="get" action="<?= base_url('buku') ?>" class="row g-2 mb-3">

                <div class="col-md-6">
                    <input type="text"
                           name="keyword"
                           class="form-control"
                           placeholder="Cari judul buku..."
                           value="<?= esc($keyword ?? '') ?>">
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn btn-success">Cari</button>
                    <a href="<?= base_url('buku') ?>" class="btn btn-secondary">Reset</a>
                    <a href="<?= base_url('buku/print?' . http_build_query($_GET)) ?>"
                       target="_blank"
                       class="btn btn-dark">
                        Print
                    </a>
                </div>

            </form>

            <!-- FLASH -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Cover</th>
                            <th>ISBN</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun</th>
                            <th>Rak</th>
                            <th>Jumlah</th>
                            <th>Tersedia</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($buku)): ?>
                            <?php $no = 1; foreach ($buku as $b): ?>
                                <tr>

                                    <td><?= $no++ ?></td>

                                    <!-- COVER -->
                                    <td>
                                        <?php if (!empty($b['cover'])): ?>
                                            <img src="<?= base_url('uploads/buku/' . $b['cover']) ?>"
                                                 width="60"
                                                 class="rounded">
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>

                                    <td><?= esc($b['isbn'] ?? '-') ?></td>
                                    <td><?= esc($b['judul'] ?? '-') ?></td>
                                    <td><?= esc($b['nama_kategori'] ?? '-') ?></td>
                                    <td><?= esc($b['nama_penulis'] ?? '-') ?></td>
                                    <td><?= esc($b['nama_penerbit'] ?? '-') ?></td>
                                    <td><?= esc($b['tahun_terbit'] ?? '-') ?></td>

                                    <!-- ✅ RAK TANPA buku_rak -->
                                    <td><?= esc($b['nama_rak'] ?? '-') ?></td>

                                    <td><?= esc($b['jumlah'] ?? 0) ?></td>
                                    <td><?= esc($b['tersedia'] ?? 0) ?></td>

                                    <!-- AKSI -->
                                    <td class="text-nowrap">

                                        <a href="<?= base_url('buku/detail/' . $b['id_buku']) ?>"
                                           class="btn btn-info btn-sm">Detail</a>

                                        <a href="<?= base_url('buku/edit/' . $b['id_buku']) ?>"
                                           class="btn btn-warning btn-sm">Edit</a>

                                        <a href="<?= base_url('buku/delete/' . $b['id_buku']) ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Hapus buku ini?')">
                                            Hapus
                                        </a>

                                    </td>

                                </tr>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <tr>
                                <td colspan="12" class="text-center text-muted">
                                    Belum ada data buku
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>

                </table>
            </div>

<a href="<?= base_url('peminjaman/pinjamLangsung/' . $b['id_buku']) ?>" 
   class="btn btn-success" 
   onclick="return confirm('Pinjam buku ini sekarang?')">
   ⚡ Pinjam Sekarang
</a>

            <!-- PAGINATION -->
            <?php if (!empty($pager)) : ?>
                <div class="mt-3">
                    <?= $pager->links() ?>
                </div>
            <?php endif; ?>

        </div>
    </div>

</div>

<?= $this->endSection() ?>