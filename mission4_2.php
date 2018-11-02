<html>
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 </head>
</html>

<?php
//DB接続
$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo= new PDO($dsn,$user,$password);
//$pdo= new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)); //sqlのエラーを表示させたい時

$sql="CREATE TABLE mission4_1"
."("
."id INT auto_increment PRIMARY KEY, "
."name char(32),"
."comment TEXT,"
."password2 char(32) NOT NULL,"
."date char(32)"
.");";
$stmt=$pdo->query($sql);
//3-3
$sql="SHOW TABLES";
$result= $pdo->query($sql);
foreach($result as $row){
  echo $row[0];
  echo '<br>';
}
echo"<hr>";

//3-4
$sql="SHOW CREATE TABLE mission4_1";
$result= $pdo->query($sql);
foreach ($pdo as $row ) {
  print_r($row);
}
echo"<hr>";


//表示

$sql='SELECT*FROM mission4_1';
$results=$pdo->query($sql);
foreach($results as $row){
  echo $row['id'].",";
  echo $row['name'].",";
  echo $row['comment'].",";
  echo $row['password2'].",";
  echo $row['date']."<br>";
}


//$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


 ?>
