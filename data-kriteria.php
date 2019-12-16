<?php include './includes/api.php';
akses_pengguna(array(1));
include './includes/header.php';
?>
<h5>Data Kriteria</h5><hr>
<table class="table table-striped table-bordered table-sm">
    <tr class="text-center">
        <th>No</th><th>Nama Kriteria</th><th>Atribut</th><th>Pengaturan</th>
    </tr>
    <?php $no=1; foreach (data_kriteria() as $x) {
        echo "<tr>";
        echo "<td class=\"text-center\">$no</td><td>{$x[1]}</td><td class=\"text-center\">{$x[5]}</td><td class=\"text-center\"><button onclick=\"location.href='edit-kriteria?id={$x[0]}'\" class=\"btn btn-primary\">Edit</button> <button onclick=\"hapus_kriteria('{$x[0]}')\" class=\"btn btn-danger\">Hapus</button></td>";
        echo '</tr>';
        $no++;
    } ?>
</table>
<button class="btn btn-primary" onclick="location.href='tambah-kriteria'">Tambah Kriteria</button>
<?php include './includes/footer.php';?>