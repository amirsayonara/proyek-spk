<?php include './includes/api.php';
akses_pengguna(array(1));
if (!empty($_GET)) {
    @$id = $_GET['id'];
    $q = $conn->prepare("DELETE FROM bobot_kriteria WHERE kriteria_1='$id' OR kriteria_2='$id'");
    $q->execute();
    $q = $conn->prepare("DELETE FROM nilai_alternatif WHERE kriteria='$id'");
    $q->execute();
    $q = $conn->prepare("DELETE FROM kriteria WHERE id='$id'");
    $q->execute();
    header('Location: ./data-kriteria');
} else header('Location: ./data-kriteria');