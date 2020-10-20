<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>passset_form1.php</title>
    
  </head>
  <body>

<h1>パスワード設定</h1>
<?php
 if(!isset($_SESSION)){
  session_start();
}

//サーバーに接続
require 'connect.php';

$namae = $_SESSION['name'];
$mailad = $_SESSION['mail'];

echo "名前：".$namae."<br>";
echo "メールアドレス：".$mailad."<br>";
?>
パスワードを6文字以上10文字以下で設定してください
<form action="passset1.php" method="post">
      <input type="text" name="password" placeholder="パスワード設定"value="">
      <input type="submit" name="submit" value="OK">
    </form>

  </body>
</html>