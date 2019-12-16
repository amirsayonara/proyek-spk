<?php
include 'includes/api.php';
$q = $conn->prepare("DELETE FROM masuk WHERE id='{$_COOKIE['masuk']}'");
setcookie('masuk', '', time()-3600);
$q->execute();
header('Location: ./');