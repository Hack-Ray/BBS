<?php
session_start();
/*
這是一個簡單的連接資料庫並搜尋文章的練習
這次練習嘗試將邏輯與view寫在同一個檔案 這樣就不用進行跳頁的動作 比較有連貫性
我想再繼續思考如何將檔案分開來寫但是可以不要進行跳頁的動作保持連貫性

另外在做這個題目遇到個問題就是$_GET變數在搜尋送出之前都是空值 
如果沒有先用if把他攔截 資料庫搜尋的語法就會直接執行 網頁上就會跳出錯誤訊息
另外這次也發現$_GET變數儲存的內容是array key value pair的型態 method get 送出的name 會變成key
他所對應的值就會是使用者送出的搜尋資料
蠻有趣的
*/

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
    <title>search</title>
</head>
<body>
    <form method="get">
        搜尋文章id: <input type="text" name="id">
        <input type="submit" value="搜尋">
    </form>
    <a href="index.php">回首頁</a>
    <br/>

<?php //回到php
if ($_GET != NULL){ //如果$_GET變數還沒有收到資料 像是剛進網站還沒搜尋
    if( is_integer($_GET['id'])){ //如果傳的資料我沒有 或是根本不是正確的內容 就跳警告
        echo "請輸入正確的id";
    } else {
        $result = mysqli_query($conn,"SELECT * FROM articles WHERE id = {$_GET["id"]};"); //驗證過後才能夠進到搜尋頁面 
        //這邊是資料庫語法 用mysqli_query(連線資料,"搜尋的語法 在此是搜尋表格 文章 找 id = $_GET[id]的文章)
        if ($result->num_rows > 0) { //行數大於0才印
            // output data of each row
            while($row = $result->fetch_assoc()) {
            echo "id：" . $row["id"]. "<h4>title：" . $row["title"]. "</h4><hr/><p>" . $row["body"]. "</p><br/>"; 
            //將得到的結果解析成陣列存到$row 用跟資料庫一樣的名稱作為key搜尋
            }
        } else {
            echo "0 results"; //沒有結果就顯示沒有結果
        }
    }
} else {
    echo "請輸入要搜尋的文章id"; //還沒搜尋就顯示請搜尋
}
?>


    <div id="disqus_thread"></div>
<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://blog-mne8zd9tyv.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>


<?php
if($_SESSION['user'] == 'ok'){
    echo "<a href='logout.php'>登出</a>";
}
$conn->close(); //結束搜尋即關掉資料庫連線
?>
<script id="dsq-count-scr" src="//blog-mne8zd9tyv.disqus.com/count.js" async></script>
</body>
</html> <!-- 這邊是網頁的html -->