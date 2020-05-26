<?php
$_Localhost="localhost";
$_Database="newschool";
$_User="root";
$_Password="";
$con=mysqli_connect($_Localhost,$_User,$_Password,$_Database);

//update tblsystemuser set username=userid where userid=userid
//update tblsystemuser set password=md5(userid) where userid=userid
?>