<?php
    session_start();
    if($_SESSION['user'] != 'ok'){
        include 'login.php';
    }else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create_article</title>
</head>
<body>
<?php
/*
遇到的問題SQL中 透過php $_POST 語法解析的變數 如果是文本的話要加 ' ' 如果是數字的話就不加 不然會產生錯誤
然後就是要注意 使用的控制資料庫的函式庫 要統一不要都複製貼上就完事了 根本不會解析 跑不動
*/



//連接資料庫的資訊
$servername = "localhost"; //server的名稱
$username = "root"; //資料庫管理員的名稱
$password = "1234"; //資料庫管理員的密碼
$dbname = "test"; //使用的資料庫
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname); //建立一個新的連線（連線所需的資料）存到 $conn
// Check connection
if (!$conn) { 
  die("Connection failed: " . mysqli_connect_error());
} //如果連線失敗，就顯示連線失敗 然後錯誤訊息
$result = mysqli_query($conn,"SELECT * FROM articles WHERE id = {$_GET["id"]};"); //驗證過後才能夠進到搜尋頁面 
//這邊是資料庫語法 用mysqli_query(連線資料,"搜尋的語法 在此是搜尋表格 文章 找 id = $_GET[id]的文章)
if ($result->num_rows > 0) { //行數大於0才印
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id：" . $row['id'] . "<br/>"; 
        //將得到的結果解析成陣列存到$row 用跟資料庫一樣的名稱作為key搜尋
?>
        <form method="POST">
        <?php
        echo 'title :  <input type="text" name="title" value="' . $row['title'] . '"><br/>';
        echo 'body :  <textarea rows="10" cols="30" name="body" >' . $row['body'] . '</textarea>
        <br/><br/> ';
        echo '<input type="radio" name="is_published" value="1"><label>發佈?</label><br>';
        ?>
        <input type="submit" value="送出">
    </form> 
<?php 
    }
} else {
    echo "0 results"; //沒有結果就顯示沒有結果
}

//UPDATE `articles` SET `title`='[value-2]',`body`='[value-3]',`is_published`='[value-5]' WHERE 1

if ($_POST != NULL) {
    $sql = "UPDATE articles SET title='{$_POST["title"]}', body = '{$_POST["body"]}', is_published = {$_POST["is_published"]} WHERE id = {$_GET['id']}";
    if (mysqli_query($conn, $sql)) {
    echo "<p>文章修改成功</p>";
    } else {
    echo "Error: " . $sql . "<br>" . $mysqli_error($conn);
    }
}
if($_SESSION['user'] == 'ok'){
    echo "<a href='logout.php'>登出</a>";
}
mysqli_close($conn);
}
?>  
<a href="index.php">回首頁</a>
</body>
</html>
 
 