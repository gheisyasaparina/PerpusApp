<form action="/rak/update/<?= $rak['id_rak'] ?>" method="post">

    Nama Rak:<br>
    <input type="text" name="nama_rak" value="<?= $rak['nama_rak'] ?>"><br><br>

    Lokasi:<br>
    <input type="text" name="lokasi" value="<?= $rak['lokasi'] ?>"><br><br>

    Deskripsi:<br>
    <textarea name="deskripsi"><?= $rak['deskripsi'] ?></textarea><br><br>

    <button type="submit">Update</button>
</form>