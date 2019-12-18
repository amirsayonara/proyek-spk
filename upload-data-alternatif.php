<?php include './includes/api.php'; require_once "./PHPExcel-1.8/Classes/PHPExcel.php";akses_pengguna(array(1));

if (!empty($_FILES)) {
    $eks = explode('.', $_FILES['file']['name']);
    $eks = $eks[count($eks)-1];
    $file = './_upload/'.random_int(0, 999999999).'.'.$eks;
    move_uploaded_file($_FILES['file']['tmp_name'], $file);

    //baca excel
    $excelReader = PHPExcel_IOFactory::createReaderForFile($file);
    $excelObj = $excelReader->load($file);
    unlink($file);
    $worksheet = $excelObj->getSheet(0);
    $baris_terakhir = $worksheet->getHighestRow();

    //set kolom
    $baris_mulai_data = @$_POST['baris'];
    $nama = @$_POST['nama'];
    $kriteria = array();
    foreach (data_kriteria() as $x) {
        $kriteria[$x[0]] = $_POST[$x[0]];
    }
    
    $q = $conn->prepare("DELETE FROM nilai_alternatif");
    $q->execute();
    $q = $conn->prepare("DELETE FROM alternatif");
    $q->execute();

    for ($baris = $baris_mulai_data; $baris <= $baris_terakhir; $baris++) {
        $q = $conn->prepare("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA='$NAMA_DATABASE' AND TABLE_NAME='alternatif'");
        $q->execute();
        $_next_id = @$q->fetchAll()[0][0];
        $_nama = $worksheet->getCell($nama.$baris)->getValue();

        $q = $conn->prepare("INSERT INTO alternatif VALUE (NULL, '$_nama')"); //insert nama alternatif
        $q->execute();

        foreach (data_kriteria() as $x) { //insert nilai alternatif ke setiap kriteria pada baris ke x
            $_nilai = $worksheet->getCell($kriteria[$x[0]].$baris)->getValue();
            $_nilai = str_replace(',', '.', $_nilai);
            $q = $conn->prepare("INSERT INTO nilai_alternatif VALUE ('$_next_id', '{$x[0]}', '$_nilai')");
            $q->execute();
        }

        $q = $conn->prepare("DELETE FROM tanggapan WHERE 1"); //hapus tanggapan
        $q->execute();
    }
    header('Location: ./data-alternatif');
} else { include './includes/header.php'; ?>
<h5><span class="fas fa-upload"></span> Upload Data Alternatif</h5><hr>
<form enctype="multipart/form-data" method="post" id="form-upload-data-siswa">
    <div class="custom-file mb-2 mr-sm-2">
        <input class="custom-file-input" name="file" id="file" required type="file" accept=".xls,.xlsx">
        <label class="custom-file-label" for="file">File Excel</label>
    </div>
    <div class="form-group row">
        <label for="nama" class="col-sm-3 col-form-label">Kolom Nama Alternatif:</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Kolom nama alternatif" value="A" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="baris" class="col-sm-3 col-form-label">Baris Mulai Data:</label>
        <div class="col-sm-3">
            <input type="number" class="form-control" id="baris" name="baris" placeholder="Baris mulai data" value="2" required>
        </div>
    </div>
    <input type="hidden" name="abaikan">
    <?php $k = 66;
    foreach (data_kriteria() as $x) {?>
    <div class="form-group row">
        <label for="<?=$x[0]?>" class="col-sm-3 col-form-label">Kolom <?=$x[1]?>:</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="<?=$x[0]?>" name="<?=$x[0]?>" placeholder="Kolom alternatif <?=$x[1]?>" value="<?=chr($k)?>" required>
        </div>
    </div>
    <?php $k++; } ?>
    <button class="btn btn-primary" id="upload" type="submit"><span class="fas fa-upload"></span> Upload</button>
</form>
<?php } include './includes/footer.php';?>