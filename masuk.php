<?php include 'includes/api.php';
if (!empty(pengguna())) header('Location: /.');

if (!empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $q = $conn->prepare("SELECT * FROM pengguna WHERE username='$username'");
    $q->execute();
    if ($q->rowCount() > 0) {
        $q = $conn->prepare("SELECT * FROM pengguna WHERE username='$username' AND password=SHA2('$password', 0)");
        $q->execute();
        if ($q->rowCount() > 0) {
            $q = $conn->prepare('SELECT UUID()');
            $q->execute();
            $uuid = @$q->fetchAll()[0][0];
            $q = $conn->prepare("INSERT INTO masuk VALUE ('$uuid', '$username')");
            $q->execute();
            setcookie('masuk', $uuid, time()+3600*24*30*12);
            header('Location: ./');
        } else $pesan_error = '<div class="alert alert-dismissable alert-danger">Maaf, <b>Password</b> yang anda masukan salah</div>';
    } else $pesan_error = '<div class="alert alert-dismissable alert-danger">Maaf, <b>Username</b> yang anda masukan tidak terdaftar</div>';
}
include './includes/header.php';
?>
<div class="card mb-4 shadow-sm" style="margin:30px auto;max-width:400px;">
    <div class="card-header">
        <h4 class="my-0 font-weight-normal">Masuk</h4>
    </div>
    <div class="card-body">
        <form method="post" id="form-masuk">
            <label class="mr-sm-2" for="username">Username</label>
            <input id="username" value="<?=@$username?>" name="username" class="form-control mb-2 mr-sm-2" type="text">
            <label class="mr-sm-2" for="password">Password</label>
            <input id="password" value="<?=@$password?>" name="password" class="form-control mb-2 mr-sm-2" type="password">
            <span class="text-danger" id="pesan-error"></span>
            <button type="submit" class="btn btn-outline-primary float-right">Masuk</button>
        </form>
    </div>
    <?=@$pesan_error;?>
</div>
<?php include 'includes/footer.php';?>