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
	<div class="header">
	<?php
	include("menu.php");
	?>		
	</div>
<div class="main-platform" align="center" >
	<?php
	echo $_SESSION["Message"];
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
				echo $_SESSION['Message'];
				?>
<div class="form-entry" align="center">
	<?php
	include("dbstring.php");
	$_SQL_Msg=mysqli_query($con,"SELECT * FROM tblmessages WHERE sentby='$_SESSION[USERID]'");
	while($row=mysqli_fetch_array($_SQL_Msg,MYSQLI_ASSOC)){
		echo "<div style='padding:10px;border-bottom:1px solid #ddd;text-align:justify'>";
		echo $row['messages'];
		echo "<br/><strong style='color:darkblue;font-size:10px;;text-align:right'> $row[datetimeentry] </strong>";

		echo "<div style='color:red;text-align:right'><a href='teacher-page.php?delete_message=$row[messageid]'><i class='fa fa-times' style='color:red'></i></a></div>";
		echo "</div><br/><br/>";
	}
	?>
			
<h3>SEND MESSAGE 
</h3>
	
			<form method="post" id="formID" name="formID" action="teacher-page.php">

			<input type="hidden" id="userid" name="userid" value="<?php echo $_SESSION['USERID'];?>" class="validate[required]" readonly/>

			<label>Message</label><br/>
			<textarea id="message" name="message" style="background-color:white;"></textarea><br/><br/>
			
			<div align="right"><button class="button-pay" id="send_message" name="send_message"><i class="fa fa-send"></i> SEND</button></div>
		</form>

		</div>
	

 
			</td>

			<td width="25%" valign="top">
				<h4>REPORT SUMMARY</h4>
			
				
				<!--<h4>DAILY REGISTRATION</h4>
				<?php
				
				include("dbstring.php");
				$_SQL_EXECUTE=mysqli_query($con,"SELECT * FROM tblsystemuser WHERE date_format(registereddatetime,'%d-%m-%Y')=date_format(NOW(),'%d-%m-%Y') AND (systemtype='Student' OR systemtype='Teacher') ORDER BY registereddatetime DESC");

				//Registered clients
				echo "<table width='100%' style='background-color:white'>";
				//echo "<caption>STUDENTS</caption>";
				echo "<thead><th colspan=1>Task</th><th>User Id</th><th>First Name</th><th>Surname</th><th>Othernames</th><th>Gender</th><th>Birthday</th><th>System Type</th><th>Entry Date/Time</th><th>Status</th></thead>";
				echo "<tbody>";
				
				while($row=mysqli_fetch_array($_SQL_EXECUTE,MYSQLI_ASSOC)){
				echo "<tr>";
				echo "<td align='center'><a title='View $row[firstname] ($row[userid])' href='user-profile.php?view_user=$row[userid]'<i class='fa fa-book' style='color:blue'></i></a></td>";
				// "<td align='center'><a title='Delete $row[firstname] ($row[userid])' onclick=\"javascript:return confirm('Do you want to delete?');\" href='viewstudents.php?delete_user=$row[userid]'<i class='fa fa-times' style='color:red'></i></a></td>";
				//echo "<td align='center'><a title='Edit $row[firstname] ($row[userid])' href='register_edit.php?edit_user=$row[userid]'<i class='fa fa-edit' style='color:green'></i></a></td>";
				//echo "<td>";
				if($row['status']=="active"){
				//echo"<a title='Block $row[firstname] ($row[userid])' href='viewstudents.php?block_user=$row[userid]'<i class='fa fa-user' style='color:orange'></i></a>";
					
			}else{
				//echo"<a title='Unblock $row[firstname] ($row[userid])' href='viewstudents.php?unblock_user=$row[userid]'<i class='fa fa-user' style='color:red'></i></a>";
				
			}
			//	echo "</td>";


				echo "<td align='center'>$row[userid]</td>";
				echo "<td>$row[firstname]</td>";
				echo "<td>$row[surname]</td>";
				echo "<td>$row[othernames]</td>";
				echo "<td align='center'>$row[gender]</td>";
				echo "<td align='center'>$row[birthday]</td>";
				echo "<td align='center'>$row[systemtype]</td>";
				echo "<td align='center'>$row[registereddatetime]</td>";
				echo "<td align='center'>";
				if($row['status']=="active"){
					echo "<strong style='color:green'>Active</strong>";
				}
				else{
					echo "<strong style='color:red'>Blocked</strong>";
				}
				echo "</td>";
				echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";
				?>
			-->

			</td>
		</tr>
	</table>
</div>
</body>
</html>