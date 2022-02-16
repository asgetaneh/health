<?php
$host="10.140.5.58";
$user="user";
$password="mis2030";
$db="misNew";

$con=mysqli_connect($host,$user,$password,$db);

if(mysqli_connect_errno()){

die("connection error");
}
else{
    echo "fff";
}
// SRS_DATABASE_URL=mysql://sis_user:sis.@Ju_p@2021@10.140.5.200:3306/srs
