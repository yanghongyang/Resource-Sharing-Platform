﻿<?php

$UID=$_POST['userID'];
$specName=$_POST['specName'];
//$UID = 1;
//$specName="李红裔";
$con = @new mysqli("123.206.68.192", "mysqluser", "16211621");
//如果连接错误
if (mysqli_connect_errno()) {
    echo "连接失败"; //数据库连接失败
    $con = null;
    exit;
}

mysqli_set_charset($con, 'utf8');
mysqli_select_db($con, "test");
//paper.ID as paperID, title, paper.date as 'time', cited as citedNum
$sql=("select paper.id as paperID, title, paper.date as 'time', cited as citedNum from achievement, specialist, specialist_achievement, paper ".
    "where achievement.id=specialist_achievement.aid and specialist.id=specialist_achievement.sid and paper.id=achievement.id");

$runSQL=mysqli_query($con, $sql);
$data=array();
while ($row = mysqli_fetch_assoc($runSQL)) {
    $data[] = $row;
}
$json = json_encode($data);
$utf8 = @preg_replace("/\\\u([0-9a-f]{4})/ie", "iconv('UTF-16BE', 'UTF-8', pack('H4','\\1'))", $json);
echo $utf8;
