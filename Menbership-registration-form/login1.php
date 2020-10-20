<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>login1.php</title>
    
  </head>
  <body>
<?php
session_start();
     //サーバーに接続
    require 'connect.php';

    $tablename = "test6_0";

//フォームが空でなかったら
  if(!empty($_POST['mail']) && !empty($_POST['password'])) {
//変数を定義
   $mail = $_POST['mail'];
   $password = $_POST['password'];
  //$nichiji = date("Y年m月d日 H:i:s");

    $sql = "SELECT * FROM $tablename WHERE mail = :mail";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':mail', $mail);
    $stmt->execute();
    $member = $stmt->fetch();
      
      if ($mail == $member{'mail'} && $password == $member{'password'}) {
        $_SESSION['id'] = $member['id'];
        $_SESSION['name'] = $member['name'];
        $msg = 'ログインしました。';
        $link = '<a href="home1.php">ホーム</a>';
      }else{
        $msg = 'メールアドレスもしくはパスワードが間違っています。';
        $link = '<a href="login_form1.php">戻る</a>';
      }

  }else{
    $msg = '未入力の箇所があります。';
    $link = '<a href="login_form1.php">戻る</a>';
  }  


?>  

<!--メッセージの出力-->
<h1><?php echo $msg; ?></h1>
    <?php echo $link; ?>
  </body>
</html>