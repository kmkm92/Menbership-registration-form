<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>home1.php</title>
    
  </head>
  <body>
<?php
session_start();
     //サーバーに接続
    require 'connect.php';
    
    $tablename = "test6_0";
    
    $username = $_SESSION['name'];
if (isset($_SESSION['id'])) {//ログインしているとき
    $msg = 'こんにちは' . $username . 'さん';
    $link = '<a href="logout1.php">ログアウト</a>';
} else {//ログインしていない時
    $msg = 'ログインしていません';
    $link = '<a href="login_form1.php">ログイン</a>';
}

?>
<!--メッセージの出力-->
<h1><?php echo $msg; ?></h1>
    <?php echo $link; ?>
  </body>
</html>