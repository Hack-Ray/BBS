<?php
$pwd = 1234;
?>
<form method="post">
    <input type="password" name="pwd">
    <input type="submit" value="登入">
</form>

<?php
if ($_POST != NULL){
    if ($_POST['pwd'] != $pwd) {
        echo "您無此權限";
    } else {
        echo "登入成功";
        $_SESSION['user'] = 'ok';
        echo "<a href='dashboard.php'>回管理介面</a><br/>
        <a href='logout.php'>登出</a>";
    }
}


/*
完成自學網頁の嬰兒教材所有內容
真的是舒服啊 沒有問人 自己上網查資料 解題 嘗試錯誤 try and solve the error

在實作簡單的管理員登入問題遇到了許多麻煩
像是登入後介面顯示不出來
不知道要怎麼進行頁面跳轉
不知道要怎麼消除session
要怎麼實作登出按鈕等
最麻煩的就是沒有session的時候 因為我的判斷式是寫 if($_SESSION['user'] == 'ok'){}
網頁原本沒有session 更沒有名為user的session
所以就會一直產生錯誤訊息 這裡沒有那裡沒有的
最後直接在首頁寫一個$_SESSION['user'] = '';的宣告
讓所有的頁面至少都有user這個session 但 session的密碼仍然需要辨識才能通過
接下來要多研究session在網頁上如何應用會比較好 比較安全


*/