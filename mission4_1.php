<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>

<?php
//DB接続
$dsn='データベース名';
$user='ユーザ名';
$password='パスワード';
$pdo= new PDO($dsn,$user,$password);
//$pdo= new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)); //sqlのエラーを表示させたい時





//編集
if(!empty($_POST['editnum'])){
  $id=$_POST['editnum'];
  $results=$pdo->query("SELECT * FROM mission4_1 Where id=$id");
  foreach($results as $row){  //$resultsというオブジェクトを１行ずつ$row という配列に変換する
    /*echo $row['id'].",";
    echo $row['name'].",";
    echo $row['comment'].",";
    echo $row['password2'].",";
    echo $row['date']."<br>"; */
  }

//  echo $row['id'];  //デバッグ用

  if($_POST['editpassword']==$row['password2']){
    $editnum=$_POST['editnum'];
    $edituser=$row['name'];
    $editcomment=$row['comment'];
    $editpassword=$row['password2'];
    echo "string";
    //echo $row['name'];
  }
  elseif($_POST['editpassword']!=$row['password2']){
    echo "パスワードが違います<br>";

  }
}

if(!empty($_POST['print_edit'])){ //hiddenの方に値あり
//  echo "string2";
  $id=$_POST['print_edit'];
  $edit_user=$_POST['user'];
  $edit_comment=$_POST['comment'];
  $edit_password2=$_POST['password'];
  $timestamp=time();
  $date=date("Y/m/d H:i:s",$timestamp);
  $sql="update mission4_1 set id='$id', name='$edit_user', comment='$edit_comment', password2='$edit_password2', date='$date' where id=$id"   ;
  $result=$pdo->query($sql);
  $editnum=Null;

}



//データ追加
if(empty($_POST['print_edit'])){ //hiddenの方に値なし
  if(!empty($_POST['user']) && !empty($_POST['comment'])){
    $sql=$pdo->prepare("INSERT INTO mission4_1(name,comment,password2,date) VALUES(:name,:comment,:password2,:date)");
    $sql->bindParam(':name',$name,PDO::PARAM_STR);
    $sql->bindParam(':comment',$comment,PDO::PARAM_STR);
    $sql->bindParam(':password2',$password2,PDO::PARAM_STR);
    $sql->bindParam(':date',$date,PDO::PARAM_STR);

    $name= $_POST['user'];
    $comment=$_POST['comment'];
    $password2=$_POST['password'];
    $timestamp = time();
    $date= date("Y/m/d H:i:s",$timestamp);
    $sql->execute();
    // auto increment値取得
    $id = $pdo->lastInsertId();
  }
}

//削除
if(!empty($_POST['deletenum'])){
  $id=$_POST['deletenum'];

  $sql="SELECT * FROM mission4_1 Where id=$id";
  $results=$pdo->query($sql);//podオブジェクトは　-> で扱う
  //$deletepassword = $stmt->fetchAll();
  foreach($results as $row){  //$resultsというオブジェクトを１行ずつ$row という配列に変換する
  /*  echo $row['id'].",";
    echo $row['name'].",";
    echo $row['comment'].",";
    echo $row['password2'].",";
    echo $row['date']."<br>"; */
  }
  //echo $row['id'];
  if($_POST['deletepassword']==$row['password2']){
    $sql="delete from mission4_1 where id=$row[id]";  //連想配列をダブルクォーテーションでくくる場合、"$GLOBALS[key]"てな具合でkeyをシングルクォーテーションでくくっては、いけないらしい。
    $result=$pdo->query($sql);
  }
  elseif($_POST['deletepassword']!=$row['password2']){
    echo "パスワードが違います<br>";
  }
}

//表示
//echo "string";
$sql='SELECT*FROM mission4_1';
$results=$pdo->query($sql);
foreach($results as $row){
  echo $row['id'].",";
  echo $row['name'].",";
  echo $row['comment'].",";
  echo $row['date']."<br>";
}
//echo "aaa";


 ?>


   <body>
     <form method="post" action="mission4-1.php">
       <input type="text" name="user" placeholder="名前" value="<?php echo $edituser; ?>"><br>
       <input type="text" name="comment" placeholder="コメント" value="<?php echo $editcomment; ?>" ><br>
       <input type="text" name="password" placeholder="password" value="<?php echo $editpassword; ?>"><input type="submit" name="add" value="送信"><br>
       <input type="hidden" name="print_edit" value="<?php echo $editnum;?>"><br>
       </form>
       <form method="post" action="mission4-1.php">
         <input type="text" name="deletenum" placeholder="削除したいコメントの行番号"><br>
         <input type="text" name="deletepassword" placeholder="password"><input type="submit" name="delete" value="削除"><br>
       </form>

       <form method="post" action="mission4-1.php">
         <input type="text" name="editnum" placeholder="編集したいコメントの行番号"><br>
         <input type="text" name="editpassword" placeholder="password"><input type="submit" name="edit" value="編集"><br>
       </form>
   </body>
 </html>
