<?php
session_start();
if($_SESSION['user'] != 'ok'){
    include 'login.php';
} else {
/*
這次在實作管理後台作業發現的問題
html和php不知道可不可以分開寫 寫在一起十分雜亂 且不了解嵌入的語法 時常卡在這裡噴出錯誤訊息
要去學習PDO 固定同一種控制資料庫的語法 不然不同功能使用不同語法在修改的時候真的是惡夢
在實作功能時要試著畫一下圖 了解功能相互的關係 光是在腦中想像功能的使用流程常常會少東少西的
導致一個功能明明可以寫的更完善 或是在同一個介面 同一個檔案就可以完成的事情被我分了好幾個網站

過兩天還要重新再讀一次今天寫的這個作業 了解一下寫這個程式要怎麼優化他的可讀性又不影響功能
sql語法要再加油 目前還在簡單的增刪改查 就已經讓我頭痛了 要再努力研究其他複雜的方式
功能寫出來真的很開心 持續努力 加油
*/
$wwwroot = 'http://localhost/web/'; //共同網址頭
$search = 'search.php'; //搜尋的php檔案
$update = 'update.php'; //更新的php檔案
$delete = 'delete.php'; //刪除的php檔案
//連接資料庫的資訊
$servername = "localhost"; //server的名稱
$username = "root"; //資料庫管理員的名稱
$password = "1234"; //資料庫管理員的密碼
$dbname = "test"; //使用的資料庫
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname); //建立一個新的連線（連線所需的資料）存到 $conn
// Check connection
if ($conn->connect_error) {  //如果連結到資料庫失敗
  die("Connection failed: " . $conn->connect_error);
} //如果連線失敗，就顯示連線失敗 然後錯誤訊息
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>文章管理</title>
</head>
<body>
    <h1>管理</h1>
    <a href="create_article.php">新增文章</a>
    <hr>
    <?php //回到php
        $result = mysqli_query($conn,"SELECT * FROM articles;"); //所有資料庫內的內容都查詢出來 無論是否開放 因為這裡是管理員的介面
        
        if ($result->num_rows > 0) { //行數大於0才印
            // output data of each row
            while($row = $result->fetch_assoc()) { 
                echo "<a href= '${wwwroot}${search}?id=${row['id']}' > " . //按資料庫內id做連結 此連結可以透過get id導向單獨的文章頁面 
                $row["title"] . "</a> - <span>建立於：" . 
                $row["created_at"] . "</span>" . 
                "<a href= '${wwwroot}${update}?id=${row['id']}' >修改</a><span>    </span>" . //前往修改介面按鈕 也是用get id 為參數
                "<a href= '${wwwroot}${delete}?id=${row['id']}' >刪除</a><br/>";//刪除按鈕 用get id 為參數
                //將得到的結果解析成陣列存到$row 用跟資料庫一樣的名稱作為key搜尋
            }
        }    
    ?>
</body>
</html> <!-- 這邊是網頁的html -->
<?php

if($_SESSION['user'] == 'ok'){
    echo "<a href='logout.php'>登出</a>";
}
$conn->close(); //結束搜尋即關掉資料庫連線
    }