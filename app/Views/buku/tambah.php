<h2>Tambah Buku</h2>

<form action="<?= base_url('buku/simpan') ?>" method="post">
    <input type="text" name="judul" placeholder="Judul"><br><br>
    <input type="text" name="penulis" placeholder="Penulis"><br><br>
    <input type="text" name="penerbit" placeholder="Penerbit"><br><br>
    <input type="number" name="tahun" placeholder="Tahun"><br><br>
    <input type="number" name="stok" placeholder="Stok"><br><br>
    <button type="submit">Simpan</button>
</form <input type="number" name="tahun_terbit" placeholder="Tahun Terbit"><br><br>
<input type="number" name="jumlah" placeholder="Jumlah"><br><br>
<input type="number" name="tersedia" placeholder="Tersedia"><br><br>

<textarea name="deskripsi" placeholder="Deskripsi"></textarea><br><br>

<input type="text" name="cover" placeholder="Nama file cover"><br><br>>
<input name="id_kategori">
<input name="id_penulis">
<input name="id_penerbit">