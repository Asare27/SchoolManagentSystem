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
@$_Email=$_POST['email'];
@$_Mobile=$_POST['mobile'];

@$_Religion=$_POST['religion'];
@$_Relationship=$_POST['relationship'];
@$_Nextofkin_fullname=$_POST['nextoffullname'];
@$_Nextofcontact=$_POST['nextofkincontact'];
@$_Username=$_POST['username'];
@$_Password=md5($_POST['password']);
@$_AccessLevel="user";
@$_SystemType="Student";
@$_Filename=$_POST['filename'];

if(isset($_POST['register_user'])){
$_SQL_EXECUTE=mysqli_query($con,"INSERT INTO tblsystemuser(userid,firstname,surname,othernames,gender,birthday,age,postaladdress,homeaddress,hometown,religion,relationship,nextofkin_fullname,nextofkin_contact,email,mobile,registereddatetime,status,username,password,accesslevel,systemtype,branchid)
	VALUES('$_UserID','$_Firstname','$_Surname','$_Othernames','$_Gender',STR_TO_DATE('$_Birthday','%d-%m-%Y'),'$_Age','$_PostalAddress','$_HomeAddress','$_HomeTown','$_Religion','$_Relationship','$_Nextofkin_fullname','$_Nextofcontact','$_Email','$_Mobile',NOW(),'active','$_Username','$_Password','$_AccessLevel','$_SystemType','$_SESSION[BRANCHID]')");
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
<div class="main-platform" align="center" >
	<?php
	echo $_SESSION["Message"];
	?>

	<table border="0" width="100%">
		<tr>
			<td width="30%" valign="top" align="center">
				<h4>Group Students Remark Upload</h4>	
				
	<div class="form-entry" align="left">
		<form method="post" action="import-remark-data.php" id="form1" enctype="multipart/form-data">
		<div align="center">

		<div id="subscription-style1" align="left">
			<!--Employee Details -->
			
			<label>Upload Excel File*</label><br>
			<input type="file" id="file1" name="file1" /><br><br>				
			
			<!--Submit form's data -->
			<button class="button-pay" id="submit_group_data" name="submit_group_data"><i class="fa fa-upload" ></i> Upload Remark Data</button>
			
		</div>
	</div>
	</form>
		</div>
			</td>

			<td width="70%" valign="top">
				<div class="form-entry" align="left">
				<?php
				include("dbstring.php");
				$_SQL_EXECUTE=mysqli_query($con,"SELECT * FROM tblstudentterminalreport str INNER JOIN tblsystemuser us ON str.userid=us.userid 
					INNER JOIN tblbatch bh ON str.batchid=bh.batchid");

				//Registered clients
				echo "<table width='100%' style='background-color:white'>";
				echo "<caption>REMARK DATA</caption>";
				echo "<thead><th colspan=2>Task</th><th>User</th><th>Batch</th><th>On Roll</th><th>Attendance</th><th>Total Attendance</th>
				<th>Promoted To</th><th>Conduct</th><th>Interest</th><th>Class Teacher Remark</th>
				<th>Head Teacher Remark</th><th>Date/Time</th></thead>";
				echo "<tbody>";
				
				while($row=mysqli_fetch_array($_SQL_EXECUTE,MYSQLI_ASSOC)){
				echo "<tr>";
				echo "<td align='center'></td>";
				echo "<td align='center'></td>";
				
				echo "<td>$row[firstname] $row[surname] $row[othernames]($row[userid])</td>";
				echo "<td align='center'>$row[batch]</td>";
				echo "<td align='center'>$row[roll]</td>";
				echo "<td align='center'>$row[attendance]</td>";
				
				echo "<td align='center'>$row[totalattendance]</td>";
				echo "<td align='center'>$row[promotedto]</td>";
				echo "<td align='center'>$row[conduct]</td>";
				echo "<td align='center'>$row[interest]</td>";
				echo "<td align='center'>$row[class_teacher_remark]</td>";
				echo "<td align='center'>$row[head_teacher_remark]</td>";
				echo "<td align='center'>$row[datetimeentry]</td>";
				echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";
				?>
			</div>
			</td>
		</tr>
	</table>
	<br/><br/>
<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button> 

 <script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
</div>
</body>
</html>