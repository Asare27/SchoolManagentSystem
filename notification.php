<?php
session_start();
$_SESSION['Message']="";
?>
<?php
include("dbstring.php");
include("code.php");
@$_MessageId=$code;
@$_Message=$_POST['message'];
@$_UserId=$_POST['userid'];

if(isset($_POST['send_message'])){
		if(!$_UserId)
		{
		$_SESSION['Message']="<div style='color:red'>No user selected</div>";
		}
		else{
			foreach($_UserId as $selecteduser)
			{	
				//Get mobile number from users	
				$_SQL_H=mysqli_query($con,"SELECT * FROM tblsystemuser su WHERE su.userid='$selecteduser'");
				if($rowm=mysqli_fetch_array($_SQL_H,MYSQLI_ASSOC)){
				$_Mobile=$rowm["mobile"];
				}
				$message=$_Message;
				$phone=$_Mobile;
				include("bulksms/bulksms.php");	
			}
	   }
}
?>

<?php
if(isset($_GET["delete_message"])){
$_SQL_D=mysqli_query($con,"DELETE FROM tbladministration WHERE messageid='$_GET[delete_message]'");
if($_SQL_D){
	$_SESSION['Message']="<div style='color:red;padding:10px;'>Notice Successfully Deleted</di>";
}
else{
	$_Error=mysqli_error($con);
	$_SESSION['Message']="<div style='color:red;padding:10px;'>Notice failed to delete</div>";
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
   var inputs = document.getElementsByName("userid[]");
    for(var i=0;i<inputs.length;i++){
     inputs[i].checked=false;
    }
     return false;
 }
  function checkBox(){
var inputs = document.getElementsByName("userid[]");
    for(var i=0;i<inputs.length;i++){
     inputs[i].checked=true;
    }
 return false;
 }
</script>
</head>
<body class="body-style">
<div class="header">
<?php
include("menu.php");
?>		
</div>
<div class="main-platform" align="center" ><br/>
<div class="form-entry">
<table border="0" width="100%">
<caption>Notification</caption>
<tr>
<td colspan="1" width="50%">
<div class="form-entry" align="center">
<form id="formID" method="post">
<select id="recipient" name="recipient" class="validate[required]">
<option value="">Select Recipient</option>
<option value="Teaching Staff">Teaching Staff</option>
<option value="Non-Teaching Staff">Non Teaching Staff</option>
<option value="Student">Student</option>
</select>
	
</td>
<td width="50%">
<?php
echo $_SESSION['Message'];
?>
<button class="button-show" id="showrecipient" name="showrecipient"><i class="fa fa-search" style="color:white"></i> SHOW USERS</button>
</form>
</td>
</tr>
<tr>
<td width="50%" valign="top" align="center">		
<form method="post" id="formID" name="formID" action="notification.php">
<input type="hidden" id="userid" name="userid" value="<?php echo $_SESSION['USERID'];?>" class="validate[required]" readonly/>
<label>Message</label><br/>
<textarea id="message" name="message" style="background-color:white;" class="validate[required]"></textarea><br/><br/>		
<div align="right"><button class="button-save" id="send_message" name="send_message"><i class="fa fa-send"></i> SEND</button></div>
</div>
</div>
</td>
<td width="50%" valign="top">
<div class="form-entry">
<?php	
@$_Recipient=$_POST["recipient"];
if(isset($_POST["showrecipient"])){
	$_SQL_2=mysqli_query($con,"SELECT * FROM tblsystemuser su WHERE su.staffstatus='$_Recipient' ORDER BY su.userid ASC");
	echo "<table>";
	echo "<caption>LIST OF USERS</caption>";
	echo "<thead><th><input type='checkbox' id='all' name='all' Onclick='selectAll()' /></th><th>*</th><th>MOBILE</th><th>FULL NAME</th></thead>";
	echo "<tbody>";
	@$serial=0;
	while($row=mysqli_fetch_array($_SQL_2,MYSQLI_ASSOC))
	{
	echo "<tr class='light'>";
	echo "<td>";
	echo "<input type='checkbox' id='userid' name='userid[]' value='$row[userid]' />";
	echo "</td>";
	echo "<td>";
	echo $serial=$serial+1;
	echo "</td>";
	echo "<td>";
	echo $row['mobile'];
	echo "</td>";			
	echo "<td>";
	echo $row['firstname']." ". $row['othernames']." ". $row['surname']."(".$row['userid'].")";
	echo "</td>";
	echo "</tr>";
	}	
	echo "</tbody>";
	echo "</table>";
}
?>
</form>
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