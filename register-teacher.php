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
@$_SystemType="Teacher";
@$_Filename=$_POST['filename'];
@$_Recipient=$_POST['recipient'];

if(isset($_POST['register_user'])){
$_SQL_EXECUTE=mysqli_query($con,"INSERT INTO tblsystemuser(userid,firstname,surname,othernames,gender,birthday,age,postaladdress,homeaddress,hometown,religion,relationship,nextofkin_fullname,nextofkin_contact,email,mobile,registereddatetime,status,username,password,accesslevel,systemtype,staffstatus,branchid)
	VALUES('$_UserID','$_Firstname','$_Surname','$_Othernames','$_Gender',STR_TO_DATE('$_Birthday','%d-%m-%Y'),'$_Age','$_PostalAddress','$_HomeAddress','$_HomeTown','$_Religion','$_Relationship','$_Nextofkin_fullname','$_Nextofcontact','$_Email','$_Mobile',NOW(),'active','$_Username','$_Password','$_AccessLevel','$_SystemType','$_Recipient','$_SESSION[BRANCHID]')");
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
	<?php
	include("menu.php");
	?>		

	</div>
<div class="main-platform" align="center" >
	<?php
	echo $_SESSION["Message"];
	?>
	<table border="0" width="100%">
		<tr>
			<td width="30%" valign="top" align="center">
				<h4>TEACHER REGISTRATION</h4>		
				
				<div class="form-entry" align="left">
					
			<form method="post" id="formID" name="formID" action="register-teacher.php">
			
			<?php
			@$_Get_User_ID="";
			@$_SQL_EXECUTE=mysqli_query($con,"SELECT * FROM tblsystemuser");
			$_Count=mysqli_num_rows($_SQL_EXECUTE);
			$_Year=date("Y");
			$_Get_User_ID="MB_$_Year/".($_Count+1);

			?>
			<label>User Id</label><br/>
			<input type="text" id="userid" name="userid" value="<?php echo $_Get_User_ID;?>" class="validate[required]" readonly/><br/><br/>

			<fieldset><legend>BIO-DATA</legend>
			<label>First Name</label><br/>
			<input type="text" id="firstname" name="firstname" class="validate[required]"/><br/><br/>

			<label>Surname</label><br/>
			<input type="text" id="surname" name="surname" class="validate[required]"/><br/><br/>

			<label>Othernames</label><br/>
			<input type="text" id="othernames" name="othernames" />
			</fieldset><br/><br/>

			<fieldset><legend>GENDER</legend>
			<input type="radio" id="gender" name="gender" value="male" class="validate[required]">
			<label>Male</label>
			<input type="radio" id="gender" name="gender" value="female" class="validate[required]">
			<label>Female</label>
			</fieldset><br/><br/>

			<label>Birthday</label><br/>

			<script type="text/javascript">
            function show_alert()
            {
               alert("Please select Date Time Picker");
            }
            </script>
            <script src="scripts/datetimepicker_css.js"></script>

        <?php
         $tomorrow = mktime(0,0,0,date("m")+1,date("d"),date("Y"));
          $tdate= date("d/m/Y", $tomorrow);
         ?>
      <input type="hidden" name="todate" id="todate" value="<?php echo $tdate; ?>">
      <input type="text" maxlength="25" size="25" onclick="javascript:NewCssCal ('birthday','ddMMyyyy','','','','','')" id="birthday" name="birthday" value="" class="validate[required]" readonly   onchange="CheckDateOfBirth()"/>
      <br/><br/>
			<label>Age</label><br/>
			<input type="text" id="age" name="age" class="validate[required]" readonly/><br/><br/>

			<label>Postal Address</label>
			<textarea id="postaladdress" name="postaladdress" ></textarea>
			<br/><br/>

			<label>Home Address</label>
			<textarea id="homeaddress" name="homeaddress" ></textarea>
			<br/><br/>
			<label>Home Town</label>
			<input type="text" id="hometown" name="hometown" />
			<br/><br/>
			<label>Mobile</label>
			<input type="text" id="mobile" name="mobile" class="validate[required]" ><br/><br/>

					
			<select id="religion" name="religion" class="validate[required]">
				<option value="">Select Religion</option>
				<option value="Christian">Christian</option>
				<option value="Muslim">Muslim</option>
				<option value="Tradition">Tradition</option>
				<option value="Others">Others</option>
			</select><br/><br/>

			<select id="relationship" name="relationship" class="validate[required]">
				<option value="">Select Relationship</option>
				<option value="Father">Father</option>
				<option value="Mother">Mother</option>
				<option value="Uncle">Uncle</option>
				<option value="Brother">Brother</option>
				<option value="Sister">Sister</option>
				<option value="Daughter">Daughter</option>
				<option value="Others">Others</option>
			</select><br/><br/>

			<fieldset><legend>Next Of Kin</legend>
			<label>Full Name</label><br/>
			<input type="text" id="nextoffullname" name="nextoffullname" class="validate[required]"/><br/><br/>
			<label>Contact</label>
			<input type="text" id="nextofkincontact" name="nextofkincontact" class="validate[required]" ><br/><br/>

			</fieldset><br/>
			<br/>
			<label>E-mail</label>
			<input type="text" id="email" name="email" class="validate[required,custom[email]]" /><br/><br/>


			<label>Username</label><br/>
			<input type="text" id="username" name="username" /><br/><br/>

			<label>Password</label><br/>
			<input type="password" id="password" name="password" class="validate[required,minSize[6]]" class="validate[required]"/><br/><br/>

			<label>Repeat Password</label><br/>
			<input type="password" id="password" name="password" class="validate[required,equals[password]]"/><br/><br/>
			
			<select id="recipient" name="recipient">
<option value="">Select Recipient</option>
<option value="Teaching Staff">Teaching Staff</option>
<option value="Non-Teaching Staff">Non Teaching Staff</option>

</select><br/><br/>

			
			<div align="center"><button class="button-save" id="register_user" name="register_user"><i class="fa fa-save"></i> SAVE TEACHER</button></div>
		</form>

		</div>

 
			</td>

			<td width="70%" valign="top">
			<div class="form-entry">
				<?php
				
				include("dbstring.php");
				$_SQL_EXECUTE=mysqli_query($con,"SELECT * FROM tblsystemuser WHERE date_format(registereddatetime,'%d-%m-%Y')=date_format(NOW(),'%d-%m-%Y') AND (systemtype='Student' OR systemtype='Teacher') ORDER BY registereddatetime DESC");

				//Registered clients
				echo "<table width='100%' style='background-color:white'>";
				echo "<caption>TEACHERS</caption>";
				echo "<thead><th colspan=2>TASK</th><th>TEACHER</th><th>GENDER</th><th>BIRTHDAY</th><th>USERNAME</th><th>TYPE</th><th>DATE/TIME</th><th>STATUS</th></thead>";
				echo "<tbody>";
				
				while($row=mysqli_fetch_array($_SQL_EXECUTE,MYSQLI_ASSOC)){
				echo "<tr>";
				echo "<td align='center'><a title='View $row[firstname] ($row[userid])' href='user-profile.php?view_user=$row[userid]'<i class='fa fa-book' style='color:blue'></i></a></td>";
				//echo "<td align='center'><a title='Delete $row[firstname] ($row[userid])' onclick=\"javascript:return confirm('Do you want to delete?');\" href='viewstudents.php?delete_user=$row[userid]'<i class='fa fa-times' style='color:red'></i></a></td>";
				echo "<td align='center'><a title='Edit $row[firstname] ($row[userid])' href='register_edit.php?edit_user=$row[userid]'<i class='fa fa-edit' style='color:green'></i></a></td>";
				//echo "<td>";
				if($row['status']=="active"){
				//echo"<a title='Block $row[firstname] ($row[userid])' href='viewstudents.php?block_user=$row[userid]'<i class='fa fa-user' style='color:orange'></i></a>";
					
			}else{
				//echo"<a title='Unblock $row[firstname] ($row[userid])' href='viewstudents.php?unblock_user=$row[userid]'<i class='fa fa-user' style='color:red'></i></a>";
				
			}
			//	echo "</td>";


				echo "<td>$row[firstname] $row[surname] $row[othernames]($row[userid])</td>";
				echo "<td align='center'>$row[gender]</td>";
				echo "<td align='center'>$row[birthday]</td>";
				echo "<td align='center'>$row[username]</td>";
				
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
			</div>
			</td>
		</tr>
	</table>
</div>
</body>
</html>