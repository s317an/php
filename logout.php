<?php

require_once 'UserLogic.php';

if(!$logout = filter_input(INPUT_POST,'logout')){
    exit('不正なリクエストです');
}
//ログインしてるか判定し、セッションが切れたらログインしてくださいとメッセージを出す。
$result = UserLogic::checkLogin();


if(!$result){
    exit('セッションが切れましたので、ログインしなおしてください');
}

//ログアウトする

UserLogic:: logout();


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="button.css">
    <title>ログアウト</title>
</head>
<body>
    <h2>ログアウト完了</h2>
    <p>ログアウトしました!</p>
    <a href="login_form.php">ログイン画面へ</a>
</body>
</html>