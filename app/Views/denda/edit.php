<h3>Edit Denda</h3>

<form action="<?= base_url('denda/update/'.$denda['id_denda']) ?>" method="post">

    <!-- ANGGOTA -->
    <select name="id_anggota" class="form-control mb-2">
        <?php foreach ($anggota as $a): ?>
            <option value="<?= $a['id_anggota'] ?>" 
                <?= ($a['id_anggota'] == $denda['id_anggota']) ? 'selected' : '' ?>>
                <?= $a['nama'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <!-- JUMLAH DENDA -->
    <input type="number" name="jumlah_denda" 
        value="<?= $denda['jumlah_denda'] ?>" 
        class="form-control mb-2">

    <!-- STATUS -->
    <select name="status" class="form-control mb-2">
        <option value="belum" <?= $denda['status']=='belum'?'selected':'' ?>>Belum</option>
        <option value="lunas" <?= $denda['status']=='lunas'?'selected':'' ?>>Lunas</option>
    </select>

    <button class="btn btn-primary">Update</button>
</form>