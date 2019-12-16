<?php include './includes/api.php';require_once './includes/Matrix.php';akses_pengguna(array(2));?>
<h5>Perbandingan Kriteria</h5><hr>
<?php
if (!empty($_POST)) {
    foreach (array_keys($_POST) as $x) {
        $k1 = explode('-', $x)[0];
        $k2 = explode('-', $x)[1];
        $q = $conn->prepare("DELETE FROM bobot_kriteria WHERE kriteria_1='$k1' AND kriteria_2='$k2'");
        $q->execute();
        $q = $conn->prepare("INSERT INTO bobot_kriteria VALUE ('$k1', '$k2', '{$_POST[$x]}')");
        $q->execute();
    }
}
$kriteria = data_kriteria();
include './includes/header.php';
echo '<form id="form-perbandingan-matrix" method="post" class="mx-auto" autocomplete="off"><div class="custom-control custom-radio">';
for ($x=0; $x < count($kriteria); $x++) {
    for ($y=$x+1; $y < count($kriteria); $y++) {
        $b = bobot_kriteria($kriteria[$x][0], $kriteria[$y][0]);
        if ($b) $b = $b['bobot'];
        ?>
        <table class="table table-striped">
            <tr class="text-center">
                <th rowspan="2"><?=$kriteria[$x][1]?></th><th>9</th><th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th rowspan="2"><?=$kriteria[$y][1]?></th>
            </tr>
            <tr>
                <th><label class="radio"><input class="radio" <?php if($b=='9/1') echo 'checked' ?> value="9/1" type="radio" name="<?=$kriteria[$x][0].'-'.$kriteria[$y][0]?>"><span></span></label></th>
                <th><label class="radio"><input class="radio" <?php if($b=='8/1') echo 'checked' ?> value="8/1" type="radio" name="<?=$kriteria[$x][0].'-'.$kriteria[$y][0]?>"><span></span></label></th>
                <th><label class="radio"><input class="radio" <?php if($b=='7/1') echo 'checked' ?> value="7/1" type="radio" name="<?=$kriteria[$x][0].'-'.$kriteria[$y][0]?>"><span></span></label></th>
                <th><label class="radio"><input class="radio" <?php if($b=='6/1') echo 'checked' ?> value="6/1" type="radio" name="<?=$kriteria[$x][0].'-'.$kriteria[$y][0]?>"><span></span></label></th>
                <th><label class="radio"><input class="radio" <?php if($b=='5/1') echo 'checked' ?> value="5/1" type="radio" name="<?=$kriteria[$x][0].'-'.$kriteria[$y][0]?>"><span></span></label></th>
                <th><label class="radio"><input class="radio" <?php if($b=='4/1') echo 'checked' ?> value="4/1" type="radio" name="<?=$kriteria[$x][0].'-'.$kriteria[$y][0]?>"><span></span></label></th>
                <th><label class="radio"><input class="radio" <?php if($b=='3/1') echo 'checked' ?> value="3/1" type="radio" name="<?=$kriteria[$x][0].'-'.$kriteria[$y][0]?>"><span></span></label></th>
                <th><label class="radio"><input class="radio" <?php if($b=='2/1') echo 'checked' ?> value="2/1" type="radio" name="<?=$kriteria[$x][0].'-'.$kriteria[$y][0]?>"><span></span></label></th>
                <th><label class="radio"><input class="radio" <?php if($b=='1/1') echo 'checked' ?> value="1/1" type="radio" name="<?=$kriteria[$x][0].'-'.$kriteria[$y][0]?>"><span></span></label></th>
                <th><label class="radio"><input class="radio" <?php if($b=='1/2') echo 'checked' ?> value="1/2" type="radio" name="<?=$kriteria[$x][0].'-'.$kriteria[$y][0]?>"><span></span></label></th>
                <th><label class="radio"><input class="radio" <?php if($b=='1/3') echo 'checked' ?> value="1/3" type="radio" name="<?=$kriteria[$x][0].'-'.$kriteria[$y][0]?>"><span></span></label></th>
                <th><label class="radio"><input class="radio" <?php if($b=='1/4') echo 'checked' ?> value="1/4" type="radio" name="<?=$kriteria[$x][0].'-'.$kriteria[$y][0]?>"><span></span></label></th>
                <th><label class="radio"><input class="radio" <?php if($b=='1/5') echo 'checked' ?> value="1/5" type="radio" name="<?=$kriteria[$x][0].'-'.$kriteria[$y][0]?>"><span></span></label></th>
                <th><label class="radio"><input class="radio" <?php if($b=='1/6') echo 'checked' ?> value="1/6" type="radio" name="<?=$kriteria[$x][0].'-'.$kriteria[$y][0]?>"><span></span></label></th>
                <th><label class="radio"><input class="radio" <?php if($b=='1/7') echo 'checked' ?> value="1/7" type="radio" name="<?=$kriteria[$x][0].'-'.$kriteria[$y][0]?>"><span></span></label></th>
                <th><label class="radio"><input class="radio" <?php if($b=='1/8') echo 'checked' ?> value="1/8" type="radio" name="<?=$kriteria[$x][0].'-'.$kriteria[$y][0]?>"><span></span></label></th>
                <th><label class="radio"><input class="radio" <?php if($b=='1/9') echo 'checked' ?> value="1/9" type="radio" name="<?=$kriteria[$x][0].'-'.$kriteria[$y][0]?>"><span></span></label></th>
            </tr>
        </table><br>

        <?php

        //echo "<input value=\"$b\" name=\"{$kriteria[$x][0]}-{$kriteria[$y][0]}\" id=\"{$kriteria[$x][0]}-{$kriteria[$y][0]}\" class=\"form-control\">";
    }
}
echo '<br><div id="pesan-error"></div><input class="btn btn-primary" type="submit" value="Simpan dan Periksa"></div></form>';
if (!empty($_POST)) {

    echo '<hr><h6>Matriks Perbandingan Berpasangan</h6><table class="table table-bordered table-sm small"><tr><td></td>';
    foreach (data_kriteria() as $x) {
        echo "<th class=\"text-center\">{$x[1]}</th>";
    }
    echo '</tr>';
    $xx = 0;
    $data_matrix = array();
    foreach (data_kriteria() as $x) {
        echo "<tr><th>{$x[1]}</th>";
            $yy = 0;
            foreach (data_kriteria() as $y) {
                $data_matrix[$xx][$yy] = bobot_kriteria($x[0], $y[0])['nilai'];
                echo "<td class=\"text-center\">".bobot_kriteria($x[0], $y[0])['nilai']."</td>";
                $yy++;
            }
        echo '</tr>';
        $xx++;
    }
    $matrix = new Math_Matrix($data_matrix);
    echo '<tr><th>JUMLAH</th>';
    for ($x = 0; $x < $matrix->getSize()[1]; $x++) { //loop sebanyak jml data di baris (banyaknya kolom)
        echo '<th class="text-center">'.array_sum($matrix->getCol($x)).'</th>';
    }
    echo '</table>';

    echo '<hr><h6>Normalisasi Matrix</h6><table class="table table-bordered table-sm small"><tr><td></td>';
    foreach (data_kriteria() as $x) {
        echo "<th class=\"text-center\">{$x[1]}</th>";
    }
    echo '</tr>';
    $xx = 0;
    $data_matrix = array();
    foreach (data_kriteria() as $x) {
        echo "<tr><th>{$x[1]}</th>";
            $yy = 0;
            foreach (data_kriteria() as $y) {
                $data_matrix[$xx][$yy] = bobot_kriteria($x[0], $y[0])['nilai']/array_sum($matrix->getCol($yy));
                echo "<td class=\"text-center\">".(bobot_kriteria($x[0], $y[0])['nilai']/array_sum($matrix->getCol($yy)))."</td>";
                $yy++;
            }
        echo '</tr>';
        $xx++;
    }
    $matrix_norm = new Math_Matrix($data_matrix);
    echo '<tr><th>JUMLAH</th>';
    for ($x = 0; $x < $matrix_norm->getSize()[1]; $x++) { //loop sebanyak jml data di baris (banyaknya kolom)
        echo '<th class="text-center">'.array_sum($matrix_norm->getCol($x)).'</th>';
    }
    echo '</table>';

    echo '<hr><h6>Eign Vector/Hasil bobot</h6><table class="table table-bordered table-sm table-striped">';
    $bobot = array();
    $kriteria = data_kriteria();
    $data_matrix = array();
    for ($x = 0; $x < count($kriteria); $x++) {
        $b = array_sum($matrix_norm->getRow($x))/count($matrix_norm->getRow($x));
        $data_matrix[$x][0] = $b;
        echo "<tr><th>{$kriteria[$x][1]}</th><td>$b</td></tr>";
    }
    echo '</table>';
    $matrix_eign = new Math_Matrix($data_matrix);

    $mul_mat = new Math_Matrix($matrix->getData());
    $mul_mat->multiply($matrix_eign);

    echo '<hr><h6>Perhitungan Konsistensi</h6><table class="table table-bordered table-sm table-striped">';
    echo '<th>Kriteria</th><th>Perkalian Matrix</th><th>Perkalian/Bobot</th>';
    $kriteria = data_kriteria();
    $data_matrix = array();
    $jml = 0;
    for ($x = 0; $x < count($kriteria); $x++) {
        $t = $mul_mat->getData()[$x][0]/$matrix_eign->getData()[$x][0];
        $jml += $t;
        echo "<tr><td>{$kriteria[$x][1]}</td><td>{$mul_mat->getData()[$x][0]}</td><td>$t</td></tr>";
    }
    echo '</table>';
    $t = 1/count($kriteria)*$jml;
    echo 't = 1/'.count($kriteria).'*'.$jml.' = '.$t.'<br>';
    $ci = ($t-count($kriteria))/(count($kriteria));
    echo "CI = ($t-".count($kriteria).')/'.(count($kriteria)).' = '.$ci.'<br>';
    $ri = array(
        1 => 0,
        2 => 0,
        3 => 0.58,
        4 => 0.90,
        5 => 1.12,
        6 => 1.24,
        7 => 1.32,
        8 => 1.41,
        9 => 1.45,
        10 => 1.49,
        11 => 1.51,
        12 => 1.48,
        13 => 1.56,
        14 => 1.57,
        15 => 1.59
    );
    $cr = $ci/$ri[count($kriteria)];
    if ($cr <= 0.10) {
        $ok = " <span class=\"bg-primary text-white\">[OKE/KONSISTEN]</span>";
        //memasukkan ke database
        for ($x=0; $x<count($kriteria); $x++) {
            $b = $matrix_eign->getData()[$x][0];
            $id = $kriteria[$x][0];
            $q = $conn->prepare("UPDATE kriteria SET bobot='$b' WHERE id='$id'");
            $q->execute();
        }
    } else {
        $ok = " <span class=\"bg-danger text-white\">[BERMASALAH/TIDAK KONSISTEN]</span>";
        $q = $conn->prepare("UPDATE kriteria SET bobot=NULL");
        $q->execute();
    }
    echo "CR = $ci/".$ri[count($kriteria)].' = '.$cr.$ok;
}
include './includes/footer.php';?>
<?php
    
?>