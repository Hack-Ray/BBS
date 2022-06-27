<?php
    session_start();
    if($_SESSION['user'] != 'ok'){
      include 'login.php';
    } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>刪除成功！</title>
</head>
<body>
<?php
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

$sql = "DELETE FROM `articles` WHERE id = {$_GET['id']}"; //收到action url 解析變數get 到id 刪除資料表裡id相符的資料

if (mysqli_query($conn, $sql)) { //查詢語句 連接資料庫後將sql指令傳進去 會回傳true or false 
  echo "<p>文章刪除成功</p>";  //成功回傳資料
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn); //錯誤回傳失敗 內容
}

if($_SESSION['user'] == 'ok'){
  echo "<a href='logout.php'>登出</a>";
}
mysqli_close($conn); //關閉資料庫
}
?>  
    <a href="index.php">回首頁</a>
</body>
</html>