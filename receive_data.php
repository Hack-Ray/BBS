<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>送出成功！</title>
</head>
<body>
<?php

/*
這次遇到的問題是我自己忘記在ＳＱＬ語法中變數要用{}包起來
後來還有發現SQL語法無法接受text裡面有'fff' 會無法解析
但目前沒有想到辦法解決 希望之後會發現相關文章
*/


$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "test";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

//INSERT INTO `articles`(`id`, `title`, `body`, `created_at`, `is_published`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]')

$sql = "INSERT INTO articles (title, body) VALUES ('{$_POST["title"]}', '{$_POST["body"]}')";

if (mysqli_query($conn, $sql)) {
  echo "<p>文章送出成功</p>";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

if($_SESSION['user'] == 'ok'){
  echo "<a href='logout.php'>登出</a>";
}
mysqli_close($conn);
?>  
    <a href="index.php">回首頁</a>
</body>
</html>