<?php
session_start();
$_SESSION['Message']="";
?>
<?php
include("dbstring.php");
@$_ClassId=$_POST['classid'];
@$_BatchId=$_POST["batchid"];
@$_UserId=$_POST['userid'];
@$_Class=$_POST['class'];
@$_Recordedby=$_SESSION['USERID'];

if(isset($_POST['register_class'])){
	if($_UserId=="")
	{
	$_SESSION['Message']="<div style='color:red;padding:5px;text-align:center;border:1px solid #eaa;background-color:#fee;'>Student not selected</div>";	
	}
	else{
$_SQL_EXECUTE=mysqli_query($con,"INSERT INTO tblclass(classid,userid,class_entryid,batchid,datetimeentry,recordedby,status)
	VALUES('$_ClassId','$_UserId','$_Class','$_BatchId',NOW(),'$_Recordedby','active')");
if($_SQL_EXECUTE){
	$_SESSION['Message']="<div style='color:green;padding:5px;text-align:center;border:1px solid #aea;background-color:#efe;'>Class Successfully Registered</div>";	
	}
	else{
		$_Error=mysqli_error($con);
	$_SESSION['Message']="<div style='color:red;padding:5px;text-align:center;border:1px solid #eaa;background-color:#fee;'>Class failed to register,$_Error</div>";	
	}
}
}
?>

<?php
include("dbstring.php");

if(isset($_GET["delete_class"]))
{
$_SQL_EXECUTE=mysqli_query($con,"DELETE FROM tblclass WHERE classid='$_GET[delete_class]'");
	if($_SQL_EXECUTE){
	$_SESSION['Message']="<div style='color:red;padding:5px;text-align:center;border:1px solid #eaa;background-color:#fee;'>Class Successfully Deleted</div>";	

	}
	else{
		$_Error=mysqli_error($con);
		$_SESSION['Message']="<div style='color:red;padding:5px;text-align:center;border:1px solid #eaa;background-color:#fee;'>Class failed to delete,Error:$_Error</div>";	
	}
}
?>

<html>
<head>
<?php
include("links.php");
?>

</head>
<body>

	<div class="header">
		<!--<img src="images/logo.png" width="100px" height="100px" alt="logo"/>-->
	<?php
	include("menu.php");
	?>		
	</div>
<div class="main-platform" style="">
	<table width="100%">
		<tr>
			<td valign="top" width="30%" align="center">
			<div class="form-entry" align="left">
			<h3>Class Registration 
				</h3>
			<br/>
			<form method="post" id="formID" name="formID" action="class-registry.php">
			<label>Class Id</label><br/>
			<input type="text" id="classid" name="classid" value="<?php include("shortcode.php");echo $shortcode;?>" class="validate[required]" readonly/><br/><br/>

			<fieldset><legend>STUDENT NAME</legend>
			<?php
			if(isset($_GET['view_user'])){
			@$_SQL_EXECUTE=mysqli_query($con,"SELECT * FROM tblsystemuser WHERE userid='$_GET[view_user]'");
			
			if($row=mysqli_fetch_array($_SQL_EXECUTE,MYSQLI_ASSOC)){
			$_FullName=$row['firstname']." ".$row['surname']." ".$row['othernames']."(".$row['userid'].")";
			echo "<input type='text' id='firstname' name='firstname' value='$_FullName' class='validate[required]' readonly/><br/><br/>";
			echo "<input type='hidden' id='userid' name='userid' value='$row[userid]' class='validate[required]' readonly/>";
			
			}
			}
			?>
			</fieldset><br/>
			
			<?php	
			$_SQL_2=mysqli_query($con,"SELECT * FROM tblclassentry ORDER BY datetimeentry ASC");

			echo "<select id='class' name='class' class='validate[required]'>";
			echo "<option value=''>Select Class</option>";
				while($row=mysqli_fetch_array($_SQL_2,MYSQLI_ASSOC)){
					echo "<option value='$row[class_entryid]'>$row[class_name]</option>";
				}	
			echo "</select><br/><br/>";
			?>

			<?php	
			$_SQL_3=mysqli_query($con,"SELECT * FROM tblbatch ORDER BY datetimeentry ASC");

			echo "<select id='batchid' name='batchid' class='validate[required]'>";
			echo "<option value=''>Select Batch</option>";
				while($row=mysqli_fetch_array($_SQL_3,MYSQLI_ASSOC)){
					echo "<option value='$row[batchid]'>$row[batch]</option>";
				}	
			echo "</select><br/><br/>";
			?>
			
			<div align="center"><button class="button-save" id="register_class" name="register_class"><i class="fa fa-save"></i> SAVE CLASS REGISTRY</button></div>
		</form>

		</div>
			</td>
			<td width="70%">
				<div class="form-entry" align="left">
				<?php
				echo $_SESSION['Message'];

				include("dbstring.php");
				$_SQL_EXECUTE=mysqli_query($con,"SELECT * FROM tblsystemuser WHERE systemtype='Student' ORDER BY firstname ASC");

				//Registered clients
				echo "<table width='100%'>";
				echo "<caption>Class Registry</caption>";
				echo "<thead><th>*</th><th colspan=1>TASK</th><th>STUENT</th><th>CLASS</th><th>BATCH</th><th>ENTRY DATE/TIME</th></thead>";
				echo "<tbody>";
		
				@$serial=0;
				while($row=mysqli_fetch_array($_SQL_EXECUTE,MYSQLI_ASSOC)){
				echo "<tr>";
					echo "<td align='center'>";
				echo $serial=$serial+1 .".";
				echo "</td>";

				echo "<td align='center' ><a title='View $row[firstname] ($row[userid])' href='class-registry.php?view_user=$row[userid]'<i class='fa fa-plus' style='color:royalblue'></i></a></td>";
				
					echo "<td colspan='4'>$row[firstname] $row[othernames] $row[surname] ($row[userid])</td>";
			
				echo "</tr>";

				$_SQL_CLASS=mysqli_query($con,"SELECT *,cl.datetimeentry FROM tblclass cl 
				INNER JOIN tblclassentry ce ON cl.class_entryid=ce.class_entryid
				INNER JOIN tblbatch bh ON cl.batchid=bh.batchid
				 WHERE  cl.userid='$row[userid]' ORDER BY ce.class_name ASC");
				
				while($row_cl=mysqli_fetch_array($_SQL_CLASS,MYSQLI_ASSOC)){

				echo "<tr style='background-color:#ffffff;border-bottom:1px solid gray'>";
				echo "<td colspan='1'>";
				echo "</td>";
				echo "<td align='center'><a onclick=\"javascript:return confirm('Do you want to remove class?')\" title='Remove class $row_cl[class_name]' href='class-registry.php?delete_class=$row_cl[classid]'<i class='fa fa-trash-o' style='color:red'></i></a></td>";
				echo "<td colspan='1' align='right'>";
				echo "Class:";
				echo "</td>";
				echo "<td colspan='1'>";
				echo $row_cl['class_name'];
				echo "</td>";

				echo "<td colspan='1'>";
				echo $row_cl["batch"];
				echo "</td>";

				echo "<td colspan='1'>";
				echo $row_cl['datetimeentry'];
				echo "</td>";
				echo "</tr>";

		}
		}
				echo "</tbody>";
				echo "</table>";
				?>
			</td>
		</tr>
	</table>


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