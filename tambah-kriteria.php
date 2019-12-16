<?php
include './includes/api.php';
akses_pengguna(array(1));

if (!empty($_POST)) {
    $nama = $_POST['nama'];
    $atribut = $_POST['atribut'];
    $q = $conn->prepare("INSERT INTO kriteria VALUE (NULL, '$nama', '$atribut', NULL)");
    $q->execute();
    header('Location: ./data-kriteria');
}
include './includes/header.php';
?>
<h5>Tambah Kriteria</h1><hr>
<form method="post" class="mx-auto" style="max-width:400px" autocomplete="off">
    <label class="mr-sm-2" for="nama">Nama Kriteria</label>
    <input id="nama" name="nama" class="form-control mb-2 mr-sm-2" type="text">
    <label class="mr-sm-2" for="atribut">Atribut</label>
    <select id="atribut" name="atribut" class="form-control mb-2 mr-sm-2">
    <?php
    foreach (data_atribut() as $x) {
        echo "<option value=\"{$x['id']}\">{$x['nama']}</option>";
    }
    ?>
    </select>
    <input  class="btn btn-primary" type="submit" value="Tambah">
    <input class="btn btn-danger" type="reset" onclick="location.href='data-kriteria'" value="Batal">
</form>
<?php include './includes/footer.php';?>