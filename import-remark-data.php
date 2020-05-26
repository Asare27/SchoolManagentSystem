
<?php
session_start();
function insertRemarkData($_UserId,$_Batch,$_Onroll,$_Attendance,$_TotalAttendance,$_Promotedto,$_Conduct,$_Interest,$_TeacherRemark,$_HeadTeacherRemark){	
//echo "Hello";
//Declaration of variables
@$message ="";
include("dbstring.php");

@$_Batch_Id="";
if($_UserId=="userid" || $_Attendance=="attendance")
{}
else{
	$_SQLB=mysqli_query($con,"SELECT * FROM tblbatch WHERE batch='$_Batch'");
	if($rowb=mysqli_fetch_array($_SQLB,MYSQLI_ASSOC)){
	 $_Batch_Id=trim($rowb["batchid"]);
	}
	//echo $_Batch_Id;
	
include("dbstring.php");
$sql="SELECT * FROM tblstudentterminalreport WHERE userid='$_UserId' AND batchid='$_Batch_Id'";
$result = mysqli_query($con,$sql);
$count = mysqli_num_rows($result);

if($count>0){
	$message =$message ."<div style='background-color:white;color:red;' align='center'>Student Semester Data already stored!! </div><br>";
	}
	else{
include("code.php");
//echo $code;
$_SQL_EXECUTE=mysqli_query($con,"INSERT INTO tblstudentterminalreport(terminalid,userid,batchid,roll,attendance,totalattendance,promotedto,conduct,interest,class_teacher_remark,head_teacher_remark,recordedby,status,datetimeentry)
		VALUES('$code','$_UserId','$_Batch_Id','$_Onroll','$_Attendance','$_TotalAttendance','$_Promotedto','$_Conduct','$_Interest','$_TeacherRemark','$_HeadTeacherRemark','$_SESSION[USERID]','active',NOW())");

		if($_SQL_EXECUTE){
		$message =$message ."<div style='background-color:white;color:green;' align='center'>User Information Successfully Saved </div><br>";
		}
		else{
			$_Error=mysqli_error($con);
			echo "<div style='background-color:white;color:red;' align='center'>Student Remark Data failed to save,Error: $_Error </div><br>";
		}
	}
}
}

require_once 'simplexlsx.class.php';
@$counter=0;
@$message ="";

if(isset($_POST['submit_group_data'])){
	@$file = $_FILES['file1']['tmp_name'];
	$xlsx = new SimpleXLSX($file);

	foreach($xlsx->rows() as $field){
		
		$_UserId = $field[0];
		$_Batch=$field[1];
		$_Onroll = $field[2];
		$_Attendance = $field[3];
		$_TotalAttendance = $field[4];
		$_Promotedto=$field[5];
		$_Conduct = $field[6];
		$_Interest = $field[7];
		$_TeacherRemark = $field[8];
		$_HeadTeacherRemark = $field[9];
		
		$counter = $counter + 1;

insertRemarkData($_UserId,$_Batch,$_Onroll,$_Attendance,$_TotalAttendance,$_Promotedto,$_Conduct,$_Interest,$_TeacherRemark,$_HeadTeacherRemark);
	}
if($counter>0){
$message ="<div style='background-color:white;color:green;' align='center'>Remark Data Successfully Uploaded </div><br>";
}
else{
	$message ="<div style='background-color:white;color:red;' align='center'>Remark Data Failed To Upload</div><br>";
}
}
?>
<?php
echo $message;
?>




