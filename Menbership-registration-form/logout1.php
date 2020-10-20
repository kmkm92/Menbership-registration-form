<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>logout1.php</title>
    
  </head>
  <body>
<?php
session_start();
     //サーバーに接続
    require 'connect.php';
    
    $tablename = "test6_0";
    
    
    $_SESSION = array();//セッションの中身をすべて削除
    session_destroy();//セッションを破壊


?>
<!--メッセージの出力-->
<p>ログアウトしました。</p>
<a href="login_form1.php">ログインへ</a>
  </body>
</html>