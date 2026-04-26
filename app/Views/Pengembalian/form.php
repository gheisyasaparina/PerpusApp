<h2>Form Pengembalian Buku</h2>

<form method="post" action="<?= base_url('pengembalian/save') ?>">
    <label>ID Peminjaman</label>
    <input type="text" name="id_peminjaman"><br><br>

    <button type="submit">Simpan</button>
</form>
<form action="<?= base_url('pengembalian/proses/' . $id_peminjaman) ?>" method="post">