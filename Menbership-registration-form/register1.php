<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>register1.php</title>
    
  </head>
  <body>
<?php
session_start();

     //サーバーに接続
    require 'connect.php';

    $tablename = "test6_0";
    
    //テーブルを作成
    $sql = "CREATE TABLE IF NOT EXISTS $tablename"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(128),"
    . "mail char(128),"
    . "password char(128),"
    . "date TIMESTAMP"
	.");";
  $stmt = $pdo->query($sql);


//フォームが空でなかったら
  if(!empty($_POST['name']) && !empty($_POST['mail'])) {

    //変数を定義
      $name = $_POST['name'];
      $mail = $_POST['mail'];

      $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJLKMNOPQRSTUVWXYZ0123456789';
      $password = '';
        for ($i = 0; $i < 5; $i++) {
          $password .= $chars[mt_rand(0, 61)];
        }
      //正しいメールアドレスか調べる
    if(preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD', $mail)){
             
      $_SESSION['name'] = $name;
      $_SESSION['mail'] = $mail;
      $_SESSION['code'] = $password;


    //同じメールアドレスがないか調べる
      $sql = "SELECT * FROM $tablename WHERE mail = :mail";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':mail', $mail);
      $stmt->execute();
      $member = $stmt->fetch();

      $_SESSION['id'] = $member['id'];

    //同じものがあったら
      if ($member['mail'] === $mail) {
        $msg = '同じメールアドレスが存在します。';
        $link = '<a href="register_form1.php">戻る</a>';

      }else{
        //なければ新規登録
        $sql = $pdo -> prepare("INSERT INTO $tablename (name, mail, password, date) VALUES (:name, :mail, :password, :date)");
	      $sql -> bindParam(':name', $name, PDO::PARAM_STR);
        $sql -> bindParam(':mail', $mail, PDO::PARAM_STR);
        $sql -> bindParam(':password', $password, PDO::PARAM_STR);
        $sql -> bindValue(':date', date('Y-m-d H:i:s'), PDO::PARAM_STR);
        $sql -> execute();

        $msg = ' ';
        $link = ' ';

        require 'send_test.php';
        $test_alert = "<script type='text/javascript'>alert('メールが送信されました！');</script>";
          echo $test_alert;
        require 'kakunin_form1.php';
      }

    }else{
      $msg = '正しくないメールアドレスです。';
      $link = '<a href="register_form1.php">戻る</a>';
    }

  }else{
    $msg = '未入力の箇所があります。';
    $link = '<a href="register_form1.php">戻る</a>';
  }    
  

?>  
<!--メッセージの出力-->
<h1><?php echo $msg; ?></h1>
    <?php echo $link; ?>


  </body>
</html>