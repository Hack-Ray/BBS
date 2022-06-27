<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create_article</title>
</head>
<body>
    <form action="receive_data.php" method="POST"> <!--連結到receive_data.php 傳送post變數-->
        title :  <input type="text" name="title"><br/> 
        <br/>
        body :  <textarea rows="10" cols="30" name="body" hloder="內文"></textarea>
        <br/><br/>
        <input type="submit" value="送出">
        
    </form>
    <a href="index.php">回首頁</a>
</body>
</html>