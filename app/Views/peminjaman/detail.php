<h2>Detail Peminjaman</h2>

<p><b>Nama Anggota:</b> <?= $peminjaman['nama_anggota'] ?? '-' ?></p>
<p><b>Petugas:</b> <?= $peminjaman['nama_anggota'] ?? '-' ?></p>
<p><b>Tanggal Pinjam:</b> <?= $peminjaman['tanggal_pinjam']; ?></p>
<p><b>Status:</b> <?= $peminjaman['status']; ?></p>

<hr>

<h3>Daftar Buku</h3>

<table border="1">
    <tr>
        <th>No</th>
        <th>Judul Buku</th>
        <th>Jumlah</th>
        <th>Status</th>
    </tr>

    <?php 
    $no = 1; 
    if (!empty($detail)) :
        foreach ($detail as $d): 
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $d['judul']; ?></td>
        <td><?= $d['jumlah']; ?></td>
        <td><?= $d['status']; ?></td>
    </tr>
    <?php 
        endforeach;
    else: 
    ?>
    <tr>
        <td colspan="4">Tidak ada detail buku</td>
    </tr>
    <?php endif; ?>

</table>

<br>
<a href="/peminjaman">Kembali</a>
<p><b>Tanggal Kembali:</b> <?= $peminjaman['tanggal_kembali'] ?? '-' ?></p>
<p><b>Dikembalikan:</b> <?= $peminjaman['tanggal_dikembalikan'] ?? '-' ?></p>
<p><b>Denda:</b> Rp <?= number_format($peminjaman['denda'] ?? 0) ?></p>
<p><b>Denda:</b> 
    <?= ($peminjaman['denda'] > 0) 
        ? 'Rp ' . number_format($peminjaman['denda']) 
        : '-' ?>
</p>
