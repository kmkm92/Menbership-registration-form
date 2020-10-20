<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>kakunin1.php</title>
    
  </head>
  <body>
<?php
session_start();
     //サーバーに接続
    require 'connect.php';

    $tablename = "test6_0";
   
//フォームが空でなかったら
  if(!empty($_POST['ninnsyou'])) {

    //変数を定義
   $password = $_POST['ninnsyou'];
   


    //同じメールアドレスがないか調べる
    $sql = "SELECT * FROM $tablename WHERE password = :password";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    $passco = $stmt->fetch();
    //同じものがあったら
      if ($passco['password'] === $password) {
        $msg = ' ';
        $link = ' ';
        require 'passset_form1.php';
        $test_alert = "<script type='text/javascript'>alert('メール認証が完了しました');</script>";
        echo $test_alert;

      }else{
       
        $msg = 'コードが違います';
        $link = '<a href="kakunin_form1.php">戻る</a>';
        
        
      }
  }else{
    $msg = 'フォームが空です。';
    $link = '<a href="kakunin_form1.php">戻る</a>';
  }    
  

?>  
<!--メッセージの出力-->
<h1><?php echo $msg; ?></h1>
    <?php echo $link; ?>

  </body>
</html>