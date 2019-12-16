<?php
include './includes/api.php';
akses_pengguna(array(0));

if (!empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $nama = $_POST['nama'];
    
    $validasi = true;
    $pesan_error = array();

    $q = $conn->prepare("SELECT * FROM pengguna WHERE username='$username'");
    $q->execute();
    if ($q->rowCount() > 0) array_push($pesan_error, 'Username sudah digunakan');
    if ($username=='') array_push($pesan_error, 'Username tidak boleh kosong');

    if ($password=='') array_push($pesan_error, 'Password tidak boleh kosong');
    
    if ($nama=='') array_push($pesan_error, 'Nama tampilan tidak boleh kosong');

    if (empty($pesan_error)) {
        $q = $conn->prepare("INSERT INTO pengguna VALUE ('$username', SHA2('$password', 0), '$level', '$nama')");
        $q->execute();
        header('Location: ./manajemen-pengguna');
    }
}
include './includes/header.php';
?>
<h5><span class="fas fa-plus-circle"></span> Tambah Pengguna</h1><hr>
<form method="post" class="mx-auto" style="max-width:400px" autocomplete="off">
    <label class="mr-sm-2" for="username">Username</label>
    <input id="username" value="<?=@$username?>" name="username" class="form-control mb-2 mr-sm-2" type="text">
    <label class="mr-sm-2" for="password">Password</label>
    <input id="password" value="<?=@$password?>" name="password" class="form-control mb-2 mr-sm-2" type="password">
    <label class="mr-sm-2" for="level">Level</label>
    <select id="level" name="level" class="form-control mb-2 mr-sm-2">
    <?php
    foreach (data_level() as $x) {
        $s = '';
        if ($x['id']==@$level) $s = ' selected';
        echo "<option$s value=\"{$x['id']}\">{$x['keterangan']}</option>";
    }
    ?>
    </select>
    <label class="mr-sm-2" for="nama">Nama Tampilan</label>
    <input id="nama" value="<?=@$nama?>" name="nama" class="form-control mb-2 mr-sm-2" type="text">
    <button class="btn btn-primary" type="submit"><span class="fas fa-plus-circle"></span> Tambah</button>
    <button class="btn btn-danger" type="reset" onclick="location.href='./manajemen-pengguna'"><span class="fas fa-times"></span> Batal</button>
    <?php if (!empty($pesan_error)) {
        echo '<hr><div class="alert alert-dismissable alert-danger"><ul>';
        foreach ($pesan_error as $x) {
            echo '<li>'.$x.'</li>';
        }
        echo '</ul></div>';
    }
    ?>
</form>
<?php include './includes/footer.php';?>