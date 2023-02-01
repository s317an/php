<?php

require_once 'dbconnect.php';

class UserLogic{
    /**
     * ユーザを登録する
     * @param array $userData
     * @return bool $result
     */
    public static function createUser($userData){
        $result = false;
        $sql = 'INSERT INTO users (name,email,password) VALUES(?,?,?)';

        //ユーザデータを配列に入れる
        $arr = [];
        $arr   [] = $userData['username'];
        $arr   [] = $userData['email'];
        $arr   [] = password_hash($userData['password'],PASSWORD_DEFAULT);

        try{
            $stmt = connect()-> prepare($sql);
            $result = $stmt-> execute($arr);
            return $result;
        } catch(\Exception $e){
            return $result;
        }
    }
        /**
     * ログイン処理
     * @param  string $email
     * @param  string $password
     * @return bool $result
     */
    public static function login($email,$password){
        //結果
        $result = false;
        //ユーザをemailから検索して取得
        $user = self::getUserByEmail($email);
        if(!$user){
            $_SESSION['msg'] = 'emailが一致しません';
            return $result;
        }
        //パスワードの照会
        if(password_verify($password,$user['password'])){
        //ログイン成功
        session_regenerate_id(true);
        $_SESSION['login_user'] = $user;
        $result = true;
        return $result;
        }
        $_SESSION['msg'] = 'パスワードが一致しません';
        return $result;
    }

    /**
     * getUserByEmailの処理
     * @param  string $email
     * @return array|bool $user|false
     */
    public static function getUserByEmail($email){
        //SQLの準備
        $sql = 'SELECT * FROM users WHERE email = ?';

        //emalデータを配列に入れる
        $arr = [];
        $arr   [] = $email;

        //SQLの実行
        try{
            $stmt = connect()-> prepare($sql);
            $stmt-> execute($arr);
            //SQLの結果を返す
            $user = $stmt->fetch();
            return $user;
        } catch(\Exception $e){
            return false;
        }}
}