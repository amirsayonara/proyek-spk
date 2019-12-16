<?php include './includes/api.php';akses_pengguna(array(0));include './includes/header.php';?>
<h5><span class="fas fa-users-cog"></span> Manajemen Pengguna</h5><hr>
<table class="table table-striped table-bordered table-sm">
    <tr class="text-center">
        <th>No</th><th>Username</th><th>Level</th><th>Nama</th><th>Pengaturan</th>
    </tr>
    <?php $no=1; foreach (data_pengguna() as $x) {
        echo "<tr>";
        echo "<td class=\"text-center\">$no</td><td>{$x['username']}</td><td class=\"text-center\">{$x['keterangan']}</td><td>{$x['nama']}</td><td class=\"text-center\"><button onclick=\"location.href='./edit-pengguna?username={$x[0]}'\" class=\"btn btn-primary\"><span class=\"fas fa-pen\"></span> Edit</button> <button onclick=\"hapus_pengguna('{$x[0]}')\" class=\"btn btn-danger\"><span class=\"fas fa-trash-alt\"></span> Hapus</button></td>";
        echo '</tr>';
        $no++;
    } ?>
</table>
<button class="btn btn-primary" onclick="location.href='./tambah-pengguna'"><span class="fas fa-plus-circle"></span> Tambah Pengguna</button>
<?php include './includes/footer.php';?>