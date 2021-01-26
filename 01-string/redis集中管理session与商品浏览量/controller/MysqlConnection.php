<?php
include "../controller/db.php";
$config = include "../config/database.php";
$Mysql = new db($config['mysql']['host'],$config['mysql']["user"],$config['mysql']['password'],$config['mysql']['dbname']);