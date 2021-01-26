<?php
include "../controller/MysqlConnection.php";
//include "../controller/db.php";
//
//$config = include "../config/database.php";
$username = $_POST['username'];
$password = $_POST['password'];
//$Mysql = new db($config['mysql']['host'],$config['mysql']["user"],$config['mysql']['password'],$config['mysql']['dbname']);
try{
    //编辑sql语句
    $UserWhere = array(
        'table' => 'users',
        'field' => 'id,name,password',
        'where' => "name = "."'$username'"
    );
    $UserRestful = $Mysql->getOne($UserWhere);
    if (!empty($UserRestful)){
        if ($UserRestful['password']== $password){
            session_start();
            $_SESSION['UserInfo'] = array(
                "userid" => $UserRestful['id'],
                "username" => $UserRestful['name']
            );
            echo json_encode(['static' => true,'id' => session_id()]);
        }else{
            echo json_encode(['static' => false,'message' => '密码错误']);
        }
    }else{
        echo json_encode(['static' => false,'message' => '用户不存在']);
    }

}catch (Exception $exception){
    die("Exception:".$exception->getMessage());
}