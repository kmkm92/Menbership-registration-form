<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>passset1.php</title>
    
  </head>
  <body>
<?php
session_start();

     //サーバーに接続
     $dsn = 'mysql:dbname=tb220461db;host=localhost';
     $user = 'tb-220461';
     $password = 'Pec5ztDR7L';
     $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    $tablename = "test6_0";
    
/*     //テーブルを作成
    $sql = "CREATE TABLE IF NOT EXISTS $tablename"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(128),"
    . "mail char(128),"
    . "password char(128),"
    . "date TIMESTAMP"
	.");";
  $stmt = $pdo->query($sql);
 */

    $password = $_POST['password'];
    $mail = $_SESSION['mail'];
    $name = $_SESSION['name'];

//フォームが空でなかったら
  if(!empty($_POST['password'])) {
    
    $password = $_POST['password'];
    $mail = $_SESSION['mail'];
    $name = $_SESSION['name'];

    $Max = 11;
    $Min = 5;
    $passLength = strlen($password);
    if ($Max > $passLength && $passLength > $Min) {

      $sql = "UPDATE $tablename SET name=:name,password=:password,date=:date WHERE mail=:mail";
      $stmt = $pdo->prepare($sql);
      $stmt -> bindParam(':name', $name, PDO::PARAM_STR);
      $stmt -> bindParam(':mail', $mail, PDO::PARAM_STR);
      $stmt -> bindValue(':date', date('Y-m-d H:i:s'), PDO::PARAM_STR);
      $stmt -> bindParam(':password', $password, PDO::PARAM_STR);
      $stmt->execute();

        $msg = ' 新規登録が完了しました';
        $link = '<a href="login_form1.php">ログイン</a>';
    }else{
      $msg = '6文字以上10文字以下ではありません。';
      $link = '<a href="passset_form1.php">戻る</a>';
    }  
      
  }else{
    $msg = 'フォームが空です';
    $link = '<a href="passset_form1.php">戻る</a>';
  }    
  

?>  
<!--メッセージの出力-->
<h1><?php echo $msg; ?></h1>
    <?php echo $link; ?>

<!--    
こちらに入力してください
<form action=".php" method="post">
      <input type="text" name="name" placeholder="名前" value=""><br>
      <input type="text" name="mail" placeholder="メールアドレス" value=""><br>
      <input type="text" name="password" placeholder="パスワード"value="">
      <input type="submit" name="submit" value="送信">
    </form>
 -->

<?php
  //表示
  /* 
  $sql = 'SELECT * FROM test6_0';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		
		echo $row['id'].',';
		echo $row['name'].',';
        echo $row['mail'].',';
        echo $row['password'].',';
		echo $row['date'].'<br>';
	echo "<hr>";
	}
 */
?>
  </body>
</html>