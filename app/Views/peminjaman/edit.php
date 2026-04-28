<h2>Edit Peminjaman</h2>

<form action="<?= base_url('peminjaman/update/'.$peminjaman['id_peminjaman']) ?>" method="post">

    <input type="text" name="id_anggota" value="<?= $peminjaman['id_anggota'] ?>">

    <button type="submit">Update</button>

</form>