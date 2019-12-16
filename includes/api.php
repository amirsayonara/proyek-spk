<?php
$NAMA_DATABASE = 'tugas_spk3';
$USERNAME_DATABASE = 'root';
$PASSWORD_DATABASE = '';
$conn = new PDO("mysql:host=localhost;dbname=$NAMA_DATABASE", $USERNAME_DATABASE, $PASSWORD_DATABASE);
if (isset($_COOKIE['tanggapan'])) $TANGGAPAN = $_COOKIE['tanggapan'];
else {
    $q = $conn->prepare('SELECT UUID()');
    $q->execute();
    $uuid = @$q->fetchAll()[0][0];
    $TANGGAPAN = $uuid;
    setcookie('tanggapan', $uuid, time()+3600*24*30*12);
}

function tanggapan() {
    global $TANGGAPAN, $conn;
    @$action = $_POST['action'];
    if ($action=='push') {
        $q = $conn->prepare("DELETE FROM tanggapan WHERE id='$TANGGAPAN'");
        $q->execute();
        $q = $conn->prepare("INSERT INTO tanggapan VALUE ('$TANGGAPAN', '{$_POST['tanggapan']}', '{$_POST['akurasi']}')");
        $q->execute();
    } else {
        $q = $conn->prepare("SELECT akurasi FROM tanggapan");
        $q->execute();
        if ($q->rowCount() > 0) {
            $data = $q->fetchAll();
            $j = 0;
            foreach($data as $x) $j += $x['akurasi'];
            return strval($j/count($data)).' % ('.strval(count($data)).' tanggapan)';
        }
        else return strval(100).' % (0 tanggapan)';
    }
}

function akses_pengguna($level=false) {
    if (!empty(pengguna())) {
        if ($level!=false) {
            $akses = false;
            foreach ($level as $x)
                if ($x==pengguna()['level'])
                    $akses = true;
            if (!$akses) {
                exit('<div style="font-size: 20pt;position: absolute;transform: translate(-50%, -50%);  top: 50%;left: 50%;margin: auto;text-align: center;"><span style="font-family: Lucida Console;">Akses tidak diijinkan</span><br><br><span style="font-family: Lucida Console;cursor: pointer;color: blue;" onclick="location.href=\'./\'"><< <u>Kembali ke halaman awal</u> <<</a></span></div>');
            }
        }
    } else {
        exit('<div style="font-size: 20pt;position: absolute;transform: translate(-50%, -50%);  top: 50%;left: 50%;margin: auto;text-align: center;"><span style="font-family: Lucida Console;">Akses tidak diijinkan</span><br><br><span style="font-family: Lucida Console;cursor: pointer;color: blue;" onclick="location.href=\'./\'"><< <u>Kembali ke halaman awal</u> <<</a></span></div>');
    }
}

function cek_valid_bobot() {
    global $conn;
    $q = $conn->prepare("SELECT * FROM kriteria WHERE bobot IS NULL");
    $q->execute();
    if ($q->rowCount() > 0) return false;
    return true;
}

function pengguna($pengguna=false) {
    global $conn;
    @$id = $_COOKIE['masuk'];
    if ($pengguna!=false) $q = $conn->prepare("SELECT * FROM pengguna p JOIN level l on p.level=l.id WHERE p.username='$pengguna'");
    else $q = $conn->prepare("SELECT * FROM masuk m JOIN pengguna p ON m.pengguna=p.username JOIN level l on p.level=l.id WHERE m.id='$id'");
    $q->execute();
    return @$q->fetchAll()[0];
}

function data_kriteria() {
    global $conn;
    $q = $conn->prepare('SELECT * FROM kriteria JOIN atribut ON kriteria.atribut=atribut.id');
    $q->execute();
    return @$q->fetchAll();
}

function data_pengguna() {
    global $conn;
    $q = $conn->prepare("SELECT * FROM pengguna p JOIN level l on p.level=l.id");
    $q->execute();
    return @$q->fetchAll();
}

function data_atribut() {
    global $conn;
    $q = $conn->prepare('SELECT * FROM atribut');
    $q->execute();
    return @$q->fetchAll();
}

function data_level() {
    global $conn;
    $q = $conn->prepare('SELECT * FROM level');
    $q->execute();
    return @$q->fetchAll();
}

function bobot_kriteria($k1, $k2) {
    if ($k1==$k2) return array('bobot' => '1/1', 'nilai' => 1);
    global $conn;
    $q = $conn->prepare("SELECT * FROM bobot_kriteria WHERE (kriteria_1='$k1' AND kriteria_2='$k2') OR (kriteria_1='$k2' AND kriteria_2='$k1')");
    $q->execute();
    @$data = $q->fetchAll()[0];
    if ($data) {
        @$bobot1 = explode('/', $data['bobot'])[0];
        @$bobot2 = explode('/', $data['bobot'])[1];
        @$n1 = $bobot1/$bobot2;
        @$n2 = $bobot2/$bobot1;
        if ($k1==$data['kriteria_1']) return array('bobot' => $data['bobot'], 'nilai' => $n1);
        else return array('bobot' => $bobot2.'/'.$bobot1, 'nilai' => $n2);
        return $data;
    } else return false;
}

function nilai_alternatif($a, $k) {
    global $conn;
    $q = $conn->prepare("SELECT * FROM nilai_alternatif WHERE alternatif='$a' AND kriteria='$k'");
    $q->execute();
    @$data = $q->fetchAll()[0][2];
    if ($data) return $data;
    else return 0;
}

function data_alternatif() {
    global $conn;
    $q = $conn->prepare("SELECT * FROM alternatif");
    $q->execute();
    @$data = $q->fetchAll();
    if ($data) return $data;
    else return array();
}

