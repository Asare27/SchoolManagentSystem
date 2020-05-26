<?php
if($_SESSION['USERID']==""){
 header("location:index.php");
}
include("dbstring.php");
//Read the key from a file
//$filename=fopen("api.txt", "r");

$_ValidKey=md5("hnWZab3Fjs9IwEcABz47-B2Hdp9OIluKLfbRhvPaC-UNrk7ESwZz8H01afbI4B-kZUbfhQJ1OtGrSYI7c0u01-01-2020");

$_SQL=mysqli_query($con,"SELECT * FROM tblapi WHERE apikey='$_ValidKey'AND status='inuse'");
if(mysqli_num_rows($_SQL)==0){
header("location:app_authentication.php");
}
?>