
<?php
session_start();
function insertRegisterData($_UserId,$_Firstname,$_Surname,$_Othernames,$_Gender,$_Birthday,$_Age,
		$_PostalAddress,$_HomeAddress,$_HomeTown,$_Religion,$_Relationship,$_Nextofkin_fullname,$_Nextofkin_contact,
		$_Email,$_Mobile,$_Username,$_UserPassword,$_AccessLevel,$_SystemType,$_Recipient)
{	

//Declaration of variables
@$message ="";
if($_UserId=="userid" || $_Firstname=="firstname" || $_Surname=="surname")
{}
else{
include("dbstring.php");
$sql="SELECT * FROM tblsystemuser WHERE userid='$_UserId'";
$result = mysqli_query($con,$sql);
$count = mysqli_num_rows($result);

if($count>0){
	$message =$message ."<div style='background-color:white;color:red;' align='center'>User Information already created!! </div><br>";
	}
	else{
	//$_SQL_EXECUTE=mysqli_query($con,"INSERT INTO tblsystemuser(userid,firstname,surname,othernames,gender,birthday,age,postaladdress,homeaddress,hometown,religion,relationship,nextofkin_fullname,nextofkin_contact,email,mobile,registereddatetime,status,username,password,accesslevel,systemtype,branchid)
	//	VALUES('$_UserId','$_Firstname','$_Surname','$_Othernames','$_Gender',STR_TO_DATE('$_Birthday','%d-%m-%Y'),'$_Age','$_PostalAddress','$_HomeAddress','$_HomeTown','$_Religion','$_Relationship','$_Nextofkin_fullname','$_Nextofkin_contact','$_Email','$_Mobile',NOW(),'active','$_Username','$_Password','$_AccessLevel','$_SystemType','$_SESSION[BRANCHID]')");
$_UserPassword=md5($_UserPassword);

//$_SQL_EXECUTE=mysqli_query($con,"INSERT INTO tblsystemuser(userid,firstname,surname,othernames,gender,birthday,age,postaladdress,homeaddress,hometown,religion,relationship,nextofkin_fullname,nextofkin_contact,email,mobile,registereddatetime,status,username,password,accesslevel,systemtype,staffstatus,branchid)
//		VALUES('$_UserId','$_Firstname','$_Surname','$_Othernames','$_Gender',NOW(),'$_Age','$_PostalAddress','$_HomeAddress','$_HomeTown','$_Religion','$_Relationship','$_Nextofkin_fullname','$_Nextofkin_contact','$_Email','$_Mobile',NOW(),'active','$_Username','$_Password','$_AccessLevel','$_SystemType','$_Recipient','$_SESSION[BRANCHID]')");

$_SQL_EXECUTE=mysqli_query($con,"INSERT INTO tblsystemuser(userid,firstname,surname,othernames,gender,birthday,age,postaladdress,homeaddress,hometown,religion,relationship,nextofkin_fullname,nextofkin_contact,email,mobile,registereddatetime,status,username,password,accesslevel,systemtype,staffstatus,branchid)
		VALUES('$_UserId','$_Firstname','$_Surname','$_Othernames','$_Gender',NOW(),'$_Age','$_PostalAddress','$_HomeAddress','$_HomeTown','$_Religion','$_Relationship','$_Nextofkin_fullname','$_Nextofkin_contact','$_Email','$_Mobile',NOW(),'active','$_Username','$_UserPassword','$_AccessLevel','$_SystemType','$_Recipient','$_SESSION[BRANCHID]')");

		if($_SQL_EXECUTE){
		//$message =$message ."<div style='background-color:white;color:green;' align='center'>User Information Successfully Saved </div><br>";
		}
		else{
			$_Error=mysqli_error($con);
			echo "<div style='background-color:white;color:red;' align='center'>User Information failed to save,Error: $_Error </div><br>";
		}
	}
}
}
?>

<?php
require_once 'simplexlsx.class.php';
@$counter=0;
@$message ="";

if(isset($_POST['submit_group_data'])){
	@$file = $_FILES['file1']['tmp_name'];
	$xlsx = new SimpleXLSX($file);

	foreach($xlsx->rows() as $field){
		$_UserId = $field[0];
		$_Firstname = $field[1];
		$_Surname = $field[2];
		$_Othernames = $field[3];
		$_Gender = $field[4];
		$_Birthday = $field[5];
		$_Age = $field[6];
		$_PostalAddress = $field[7];
		$_HomeAddress = $field[8];
		$_HomeTown = $field[9];
		$_Religion = $field[10];
		$_Relationship = $field[11];
		$_Nextofkin_fullname = $field[12];
		$_Nextofkin_contact = $field[13];
		$_Email = $field[14];
		$_Mobile = $field[15];
		$_Username = $field[16];
		$_Password=$field[17];
		$_AccessLevel="user";
		$_SystemType=$field[18];
		$_Recipient=$field[19];
$counter = $counter + 1;

insertRegisterData($_UserId,$_Firstname,$_Surname,$_Othernames,$_Gender,$_Birthday,$_Age,
		$_PostalAddress,$_HomeAddress,$_HomeTown,$_Religion,$_Relationship,$_Nextofkin_fullname,$_Nextofkin_contact,
		$_Email,$_Mobile,$_Username,$_Password,$_AccessLevel,$_SystemType,$_Recipient);
	}
if($counter>0){
$message ="<div style='background-color:white;color:green;' align='center'>Register Data Successfully Uploaded </div><br>";
}
else{
	$message ="<div style='background-color:white;color:red;' align='center'>Register Data Failed To Upload</div><br>";
}
}
?>
<?php
echo $message;
?>




