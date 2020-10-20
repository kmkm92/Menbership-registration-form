<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>kakunin_form1.php</title>
    
  </head>
  <body>

<h1>メール認証</h1>
メールに記載されている五文字の英数字列を入力してください。
<form action="kakunin1.php" method="post">
      <input type="text" name="ninnsyou" placeholder="五文字の英数字列"value="">
      <input type="submit" name="submit" value="認証">
    </form>

    <form action="kakunin_form1.php" method="post">
      <input type="submit" name="resubmit" value="メールを再送信">
    </form>

    <a href="register_form1.php">戻る</a>

    <?php
     if(!isset($_SESSION)){
      session_start();
    }

    //サーバーに接続
    require 'connect.php';

   $tablename = "test6_0";

   if(isset($_POST['resubmit'])){

    require 'send_test.php';
    $test_alert = "<script type='text/javascript'>alert('メールが送信されました！');</script>";
      echo $test_alert;
    }
    ?>


  </body>
</html>