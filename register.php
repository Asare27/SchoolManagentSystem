<?php
session_start();
$_SESSION['Message']="";

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
@$_SystemType="User";
@$_Filename=$_POST['filename'];

if(isset($_POST['register_user'])){
$_SQL_EXECUTE=mysqli_query($con,"INSERT INTO tblsystemuser(userid,firstname,surname,othernames,gender,birthday,age,postaladdress,homeaddress,hometown,religion,relationship,nextofkin_fullname,nextofkin_contact,email,mobile,registereddatetime,status,username,password,accesslevel,systemtype,branchid)
	VALUES('$_UserID','$_Firstname','$_Surname','$_Othernames','$_Gender',STR_TO_DATE('$_Birthday','%d-%m-%Y'),'$_Age','$_PostalAddress','$_HomeAddress','$_HomeTown','$_Religion','$_Relationship','$_Nextofkin_fullname','$_Nextofcontact','$_Email','$_Mobile',NOW(),'active','$_Username','$_Password','$_AccessLevel','$_SystemType','$_SESSION[BRANCHID]')");
if($_SQL_EXECUTE){
$_SESSION['Message']="<div style='color:green;text-align:center'>User Information Successfully Saved</div>";
}
else{
	$_Error=mysqli_error($con);
	$_SESSION['Message']="<div style='color:red'>User Information Failed to save,Error:$_Error</div>";
}

}
?>

<?php
include("dbstring.php");

if(isset($_GET["block_user"]))
{
$_SQL_EXECUTE=mysqli_query($con,"UPDATE tblsystemuser SET status='block' WHERE userid='$_GET[block_user]'");
	if($_SQL_EXECUTE){
	$_SESSION['Message']="<div style='color:red;text-align:center;background-color:white'>User is blocked</div>";
	}
	else{
		$_Error=mysqli_error($con);
		$_SESSION['Message']="<div style='color:red'>User failed to block</div>";
	}
}
?>

<?php
include("dbstring.php");

if(isset($_GET["unblock_user"]))
{
$_SQL_EXECUTE=mysqli_query($con,"UPDATE tblsystemuser SET status='active' WHERE userid='$_GET[unblock_user]'");
	if($_SQL_EXECUTE){
	$_SESSION['Message']="<div style='color:green;text-align:center;background-color:white'>User is active</div>";
	}
	else{
		$_Error=mysqli_error($con);
		$_SESSION['Message']="<div style='color:red'>User failed to unblock</div>";
	}
}
?>


<?php
include("dbstring.php");
if(isset($_GET["delete_user"])){
$_SQL_EXECUTE=mysqli_query($con,"DELETE FROM tblsystemuser WHERE userid='$_GET[delete_user]'");
if($_SQL_EXECUTE){
$_SESSION['Message']="<div style='color:green;text-align:center;background-color:#efe;padding:5px;border:1px solid green'>User Record Successfully Deleted</div>";
}
else{
$_Error=mysqli_error($con);
$_SESSION['Message']="<div style='background-color:#eff;padding:5px;color:red;'>User failed to delete,Error:$_Error</div>";
	}
}

if(isset($_POST["deleteallusers"])){
$_AllUserIDs=$_POST["user_id"];
	foreach($_AllUserIDs as $_SelectedUser){
		$_SQLDeleteAll=mysqli_query($con,"DELETE FROM tblsystemuser WHERE userid='$_SelectedUser'");
		if($_SQLDeleteAll){
			$_SESSION["Message"]=$_SESSION["Message"]."<div style='background-color:#efe;color:green;padding:5px;border:1px solid green;'>$_SelectedUser Successfully Deleted</div>";
		}
		else{
			$_Error=mysqli_error($con);
		$_SESSION["Message"]=$_SESSION["Message"]."<div style='background-color:#fee;color:red;padding:5px;border:1px solid red;'>$_SelectedUser failed to delete, Error:$_Error</div>";
			
		}
	}
}
?>
<html>
<head>
<?php
include("links.php");
?>

<script type="text/javascript">
function selectAll(){
  var selall = document.getElementById("all").checked;
  if(selall==true){
    checkBox();
  }
  else if(selall==false){
    uncheckBox();
  }  
 }
 function uncheckBox(){
 	document.getElementById("deleteallusers").style.display="none";
   var inputs = document.getElementsByName("user_id[]");
    for(var i=0;i<inputs.length;i++){
     inputs[i].checked=false;
    }
     return false;
 }
  function checkBox(){
document.getElementById("deleteallusers").style.display="block";
   
var inputs = document.getElementsByName("user_id[]");
    for(var i=0;i<inputs.length;i++){
     inputs[i].checked=true;
    }
 return false;
 }
</script>

<script type="text/javascript">
function hideButton(){
document.getElementById("deleteallusers").style.display="none";
}
</script>
</head>
<body onload="hideButton()">
	<div class="header">
	<?php
	include("menu.php");
	?>		
	</div>
<div class="main-platform" style="">
<table width="200%">
<tr>
<td valign="top" width="30%" align="center">
<div class="form-entry" align="left">
<form method="post" id="formID" name="formID" action="register.php">
<h3>Registration </h3>
			<br/>
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
			<input type="text" id="mobile" name="mobile" class="validate[required]" /><br/><br/>

			
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
			<input type="text" id="nextofkincontact" name="nextofkincontact" class="validate[required]" /><br/><br/>

			</fieldset><br/><br/>
			<label>E-mail</label>
			<input type="text" id="email" name="email" class="validate[required,custom[email]]" /><br/><br/>


			<label>Username</label><br/>
			<input type="text" id="username" name="username" /><br/><br/>

			<label>Password</label><br/>
			<input type="password" id="password" name="password" class="validate[required,minSize[6]]" class="validate[required]"/><br/><br/>

			<label>Repeat Password</label><br/>
			<input type="password" id="password" name="password" class="validate[required,equals[password]]"/><br/><br/>
			
<div align="center"><button class="button-save" id="register_user" name="register_user"><i class="fa fa-plus"></i> SAVE USER</button></div>
</form>
</div>
</td>
<td width="70%">
<form method="post" action="register.php">				
<div class="form-entry" align="left">
				<?php
				echo $_SESSION['Message'];

				include("dbstring.php");
				$_SQL_EXECUTE=mysqli_query($con,"SELECT * FROM tblsystemuser WHERE systemtype<>'super_user' ORDER BY firstname ASC");

				//Registered clients
				echo "<table width='100%' style='background-color:white'>";
				echo "<caption>Users</caption>";
				echo "<thead><th colspan=4>TASK</th><th><input type='checkbox' id='all' name='all' onclick='selectAll()' /></th><th>USER ID</th><th>FIRST NAME</th><th>SURNAME</th><th>OTHERNAMES</th><th>TYPE</th><th>DATE/TIME</th><th>STATUS</th></thead>";
				echo "<tbody>";
				
				while($row=mysqli_fetch_array($_SQL_EXECUTE,MYSQLI_ASSOC)){
				echo "<tr>";
				echo "<td align='center'><a title='View $row[firstname] ($row[userid])' href='user-profile.php?view_user=$row[userid]'<i class='fa fa-book' style='color:blue'></i></a></td>";
				echo "<td align='center'><a title='Delete $row[firstname] ($row[userid])' onclick=\"javascript:return confirm('Do you want to delete?');\" href='register.php?delete_user=$row[userid]'<i class='fa fa-trash-o' style='color:red'></i></a></td>";
				echo "<td align='center'><a title='Edit $row[firstname] ($row[userid])' href='register_edit.php?edit_user=$row[userid]'<i class='fa fa-edit' style='color:green'></i></a></td>";
				echo "<td>";
				if($row['status']=="active"){
				echo"<a title='Block $row[firstname] ($row[userid])' href='register.php?block_user=$row[userid]'<i class='fa fa-user' style='color:orange'></i></a>";
					
			}else{
				echo"<a title='Unblock $row[firstname] ($row[userid])' href='register.php?unblock_user=$row[userid]'<i class='fa fa-user' style='color:red'></i></a>";
				
			}
				echo "</td>";
				echo "<td>";
				echo "<input type='checkbox' id='user_id' name='user_id[]' value='$row[userid]' />";
				echo "</td>";
				
				echo "<td>$row[userid]</td>";
				echo "<td>$row[firstname]</td>";
				echo "<td>$row[surname]</td>";
				echo "<td>$row[othernames]</td>";
				echo "<td>$row[systemtype]</td>";
				echo "<td>$row[registereddatetime]</td>";
				echo "<td>";
				if($row['status']=="active"){
					echo "<strong style='color:green'>Active</strong>";
				}
				else{
					echo "<strong style='color:red'>Blocked</strong>";
				}
				echo "</td>";
				echo "</tr>";
				}
				echo "<tr style='background-color:#fee;'>";
				echo "<td colspan='13'>";
				echo "<button class='button-delete' id='deleteallusers' name='deleteallusers'><i class='fa fa-times'></i> Delete All</button>";
				echo "</td>";
				echo "</tr>";
				echo "</tbody>";
				echo "</table>";
				?>
			</div>
		</form>
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