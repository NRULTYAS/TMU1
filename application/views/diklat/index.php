<h2>Daftar Diklat</h2>
<table border="1">
    <tr>
        <th>ID</th><th>Nama</th><th>Kode</th><th>Jenis</th><th>Penyelenggara</th><th>Kesehatan</th>
    </tr>
    <?php foreach($diklat as $d): ?>
    <tr>
        <td><?= $d->id ?></td>
        <td><?= $d->nama_diklat ?></td>
        <td><?= $d->kode_diklat ?></td>
        <td><?= $d->jenis_diklat_id ?></td>
        <td><?= $d->is_exist ?></td>
        <td><?= $d->check_kesehatan ? 'Ya' : 'Tidak' ?></td>
    </tr>
    <?php endforeach; ?>
</table>
