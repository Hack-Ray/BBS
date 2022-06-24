<?php
session_start();
/*
這次做的練習是首頁練習
遇到的問題是echo中html語法要嵌入php變數遇到的問題
發現要使用特殊語法 原php 語法是 $wwwroot, html的語法是 ${wwwroot}
並且echo中使用的" "要與html的有區別 > ' '
echo 用 " 裡面的html 就要用 '
echo 用 ' 裡面的html 就要用 "
算是蠻有趣的一個問題 但想想也沒錯 沒有區別我自己也看不懂

再來就是我找到的範例似乎跳過太多東西了
導致我根本不知道現在的mysqli語法是怎麼把資料組成陣列的
有空改學＄ＰＤＯ的時候要細心的研究一下
現在mysqli似乎已經落莫 反正之後會用ＯＲＭ比較安全的樣子 就先這樣當作練習ＳＱＬ語法不要想太多

在這份首頁練習的第二部分
我們有時候寫文章還沒有寫完就有事情要先做 這時候就先儲存草稿 但還沒有要發佈出去
或者是說我們刪除了文章在列表的連結 但沒有要完全刪除文章的資料 就可以使用這個方式

在資料庫所有的column添加一列is_published(布林型態)
1是true 0 是false
可以選擇在ＳＱＬ搜尋語法寫WHERE is_published = 1;
也可以寫一個if判斷 if($row["is_published"] == 1) or (!= 0)
來判斷是否要公布

在這個第二部分遇到的問題是
SQL UPDATE時搞錯了sql的語法 where時忘記應該要寫 where id = 3, 5, 7之類的 直接寫where 1; 那就把全部的資料都改為1了


*/
$wwwroot = 'http://localhost/web/search.php?id=';
//連接資料庫的資訊
$servername = "localhost"; //server的名稱
$username = "root"; //資料庫管理員的名稱
$password = "1234"; //資料庫管理員的密碼
$dbname = "test"; //使用的資料庫
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname); //建立一個新的連線（連線所需的資料）存到 $conn
// Check connection
if ($conn->connect_error) { 
  die("Connection failed: " . $conn->connect_error);
} //如果連線失敗，就顯示連線失敗 然後錯誤訊息
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>
<body>
    <h1>首頁</h1>
    <a href="create_article.php">新增文章</a>
    <a href="dashboard.php">管理文章</a><hr>
    <?php //回到php
        $result = mysqli_query($conn,"SELECT * FROM articles;"); //驗證過後才能夠進到搜尋頁面 
        //這邊是資料庫語法 用mysqli_query(連線資料,"搜尋的語法 在此是搜尋表格 文章 找 id = $_GET[id]的文章)
        if ($result->num_rows > 0) { //行數大於0才印
            // output data of each row
            while($row = $result->fetch_assoc()) {
                if ($row["is_published"] == 1) {
                    echo "<a href= '${wwwroot}${row['id']}' > " . 
                    $row["title"] . "</a> - <span>建立於：" . 
                    $row["created_at"] . "</span><br/>";
                    echo $row['body'] . "<hr/>";
                }
                //將得到的結果解析成陣列存到$row 用跟資料庫一樣的名稱作為key搜尋
            }
        }
    ?>
</body>
</html> <!-- 這邊是網頁的html -->
<?php

if (is_set($_SESSION)){
  if($_SESSION['user'] == 'ok'){
    echo "<a href='logout.php'>登出</a>";
  }
}
$conn->close(); //結束搜尋即關掉資料庫連線
