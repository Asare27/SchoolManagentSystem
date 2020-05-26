<?php
session_start();
$_SESSION['Message']="";
?>

<?php
include("dbstring.php");

@$_UserID=$_POST['userid'];
@$_Firstname=$_POST['firstname'];
@$_Surname=$_POST['surname'];
@$_Othernames=$_POST['othernames'];
@$_Gender=$_POST['gender'];
@$_Birthday=$_POST['birthday'];
@$_Age=$_POST['age'];
@$_PostalAddress=$_POST['postaladdress'];
@$_HomeAddress=$_POST['homeaddress'];
@$_HomeTown=$_POST['hometown'];
@$_Religion=$_POST['religion'];
@$_Relationship=$_POST['relationship'];
@$_Nextofkin_fullname=$_POST['nextoffullname'];
@$_Nextofcontact=$_POST['nextofkincontact'];
@$_Username=$_POST['username'];
@$_Password=$_POST['password'];
@$_AccessLevel="user";
@$_SystemType=$_POST['systemtype'];
@$_Filename=$_POST['filename'];

if(isset($_POST['register_user'])){
$_SQL_EXECUTE=mysqli_query($con,"INSERT INTO tblsystemuser(userid,firstname,surname,othernames,gender,birthday,age,postaladdress,homeaddress,hometown,religion,relationship,nextofkin_fullname,nextofkin_contact,registereddatetime,status,username,password,accesslevel,systemtype,branchid)
	VALUES('$_UserID','$_Firstname','$_Surname','$_Othernames','$_Gender',STR_TO_DATE('$_Birthday','%d-%m-%Y'),'$_Age','$_PostalAddress','$_HomeAddress','$_HomeTown','$_Religion','$_Relationship','$_Nextofkin_fullname','$_Nextofcontact',NOW(),'active','$_Username','$_Password','$_AccessLevel','$_SystemType','$_SESSION[BRANCHID]')");
if($_SQL_EXECUTE){
$_SESSION['Message']="<div style='color:green;text-align:center'>Teacher/Student Information Successfully Saved</div>";
}
else{
	$_Error=mysqli_error($con);
	$_SESSION['Message']="<div style='color:red'>Teacher/Student Information Failed to save,Error:$_Error</div>";
}

}
?>


<?php
include("dbstring.php");
include("code.php");
@$_MessageId=$code;
@$_Message=$_POST['message'];

if(isset($_POST["send_message"])){
$_SQL=mysqli_query($con,"INSERT INTO tblmessages(messageid,messages,datetimeentry,status,sentby)
VALUES('$_MessageId','$_Message',NOW(),'active','$_SESSION[USERID]')");
if($_SQL){
$_SESSION['Message']="<div style='color:green;padding:10px;'>Message Successfully Submitted</di>";
}
else{
	$_Error=mysqli_error($con);
	$_SESSION['Message']="<div style='color:red;padding:10px;'>Message failed to submit</div>";
}
}
?>

<?php

if(isset($_GET["delete_message"])){
$_SQL_D=mysqli_query($con,"DELETE FROM tblmessages WHERE messageid='$_GET[delete_message]'");
if($_SQL_D){
	$_SESSION['Message']="<div style='color:red;padding:10px;'>Message Successfully Deleted</di>";
}
else{
	$_Error=mysqli_error($con);
	$_SESSION['Message']="<div style='color:red;padding:10px;'>Message failed to delete</div>";
}

}
?>


<html>
<head>
<?php
include("links.php");
?>

</head>

<body class="body-style">
	<!--Header-->
	
	<div class="header">
		<!--<img src="images/logo.png" width="100px" height="100px" alt="logo"/>-->
	<?php
	include("menu.php");
	?>		
	</div>

<div class="main-platform" align="center" >
	<?php
	//echo $_SESSION["Message"];
	?>
	<br/>

<table border="0" width="100%">
<tr>
<td width="25%" valign="top">
<?php
include("welcome.php");
include("menuboard.php");
?>
</td>
<td width="50%" valign="top" align="center">
<h4 align="left">MESSAGES</h4>
<?php
//echo $_SESSION['Message'];
?>
<div class="form-entry" align="center">
	<?php
	include("dbstring.php");
	$_SQL_Msg=mysqli_query($con,"SELECT * FROM tblmessages WHERE sentby='$_SESSION[USERID]'");
	while($row=mysqli_fetch_array($_SQL_Msg,MYSQLI_ASSOC)){
		echo "<div style='padding:10px;border-bottom:1px solid #ddd;text-align:justify'>";
		echo $row['messages'];
		echo "<br/><strong style='color:darkblue;font-size:10px;;text-align:right'> $row[datetimeentry] </strong>";

		echo "<div style='color:red;text-align:right'><a href='student-page.php?delete_message=$row[messageid]'><i class='fa fa-times' style='color:red'></i></a></div>";
		echo "</div><br/><br/>";
	}
	?>		
<h3>SEND MESSAGE 
</h3>
	<form method="post" id="formID" name="formID" action="student-page.php">

			<input type="hidden" id="userid" name="userid" value="<?php echo $_SESSION['USERID'];?>" class="validate[required]" readonly/>

			<label>Message</label><br/>
			<textarea id="message" name="message" style="background-color:white;"></textarea><br/><br/>
			
			<div align="right"><button class="button-pay" id="send_message" name="send_message"><i class="fa fa-send"></i> SEND</button></div>
		</form>

		</div>
	
				
			</td>

			<td width="25%" valign="top">
			<h4>REPORT SUMMARY</h4>
				<?php
				
				
				?>
				
			</td>
		</tr>
	</table>
</div>
</body>
</html>