<?php



require_once 'UserLogic.php';

//受取失敗時のエラーメッセージ
$err = [];

$token = filter_input(INPUT_POST,'csrf_token');
//トークンがない、もしくは一致しない場合、処理を中止
if(!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']){
    exit('不正なリクエスト');
}
//問題がない場合
unset($_SESSION['csrf_token']);

//バリエーション
if(!$username = filter_input(INPUT_POST,'username')){
    $err[] = 'ユーザ名を記入してください';
}
if(!$email = filter_input(INPUT_POST,'email')){
    $err[] = 'メールアドレスを記入してください';
}
$password = filter_input(INPUT_POST,'password');
//password正規表現設定
if(!preg_match("/\A[a-z\d]{5,20}+\Z/i",$password)){
    $err[] = 'パスワードは英数字8文字以上20文字時以下にしてください';
}
$password_conf = filter_input(INPUT_POST,'password_conf');
if($password !== $password_conf){
    $err[] = '確認用パスワードと異なってます';
}

if(count($err) === 0){
    //ユーザの登録処理
    $hasCreated = UserLogic::createUser($_POST);
    if(!$hasCreated){
        $err[] = '登録に失敗しました';
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="button.css">
    <title>ユーザ登録完了画面</title>
</head>
<body>
    <?php if (count($err) >0): ?>
        <?php foreach($err as $e): ?>
            <p><?php echo $e ?></p>
                <?php endforeach ?>
                <?php else:?>
                <p>ユーザ登録が完成しました。</p>
                <?php endif ?>
    
    <a href="signup_form.php"><button>戻る</button></a>
</body>
</html>