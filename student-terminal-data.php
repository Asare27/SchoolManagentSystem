<?php
session_start();
$_SESSION['Message']="";
?>

<?php
include("dbstring.php");
@$_ClassId=$_POST['classid'];
@$_terminalid=$_POST['terminalid'];
@$_UserId=$_POST['userid'];
@$_Term=$_POST['term'];
@$_BatchId=$_POST['batchid'];
@$_Roll=$_POST['roll'];
@$_Attendance=$_POST['attendance'];
@$_TotalAttendance=$_POST['totalattendance'];
@$_PromotedTo=$_POST['promotedto'];
@$_Conduct=$_POST['conduct'];
@$_Interest=$_POST['interest'];
@$_ClassTeacherRemark=$_POST['class_teacher_remark'];
@$_HeadTeacherRemark=$_POST['head_teacher_remark'];
@$_Recordedby=$_SESSION['USERID'];

if(isset($_POST['register_student_terminal']))
{
$_SQL_CHECK=mysqli_query($con,"SELECT * FROM tblstudentterminalreport WHERE (userid='$_UserId' AND batchid='$_BatchId')");
if(mysqli_num_rows($_SQL_CHECK)>0)
{
	$_SQL_UPDATE=mysqli_query($con,"UPDATE tblstudentterminalreport SET roll='$_Roll',
		attendance='$_Attendance',totalattendance='$_TotalAttendance',promotedto='$_PromotedTo',
		conduct='$_Conduct',interest='$_Interest',class_teacher_remark='$_ClassTeacherRemark',
		head_teacher_remark='$_HeadTeacherRemark',recordedby='$_Recordedby' 
		WHERE batchid='$_BatchId'");
	if($_SQL_UPDATE){
		$_SESSION['Message']="<div style='color:red'>Student Terminal Data Successfully Updated</div>";	

		}
//$_SESSION['Message']="<div style='color:red'>Student has already registered for Term $_Term or Batch: $_BatchName already created</div>";	
}
else{
$_SQL_EXECUTE=mysqli_query($con,"INSERT INTO tblstudentterminalreport(terminalid,userid,batchid,
	roll,attendance,totalattendance,promotedto,conduct,interest,class_teacher_remark,
	head_teacher_remark,recordedby,status,datetimeentry)
	VALUES('$_terminalid','$_UserId','$_BatchId','$_Roll','$_Attendance','$_TotalAttendance','$_PromotedTo','$_Conduct','$_Interest','$_ClassTeacherRemark','$_HeadTeacherRemark','$_Recordedby','active',NOW())");
	if($_SQL_EXECUTE){
	$_SESSION['Message']="<div style='color:green;text-align:center;background-color:white'>Student Terminal Data Successfully Saved</div>";
	}
	else{
		$_Error=mysqli_error($con);
		$_SESSION['Message']="<div style='color:red'>Student Terminal Data failed to save,$_Error</div>";
	}
}
}
?>

<?php
include("dbstring.php");
if(isset($_GET["delete_term"]))
{
$_SQL_EXECUTE=mysqli_query($con,"DELETE FROM tblstudentterminalreport WHERE terminalid='$_GET[delete_term]'");
	if($_SQL_EXECUTE){
	$_SESSION['Message']="<div style='color:maroon;text-align:center;background-color:white'>Term Successfully Deleted</div>";
	}
	else{
		$_Error=mysqli_error($con);
		$_SESSION['Message']="<div style='color:red;text-align:center'>Term failed to delete,Error:$_Error</div>";
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
	<?php
	//include("side-menu.php");

	?>
	</div>
<div class="main-platform" style="">
	<table width="100%">
		<tr>
			<td valign="top" width="30%" align="center">
				<div class="form-entry" align="left">
			
			<h3>Student Semester Data Entry 
				</h3>
		
			<form method="post" id="formID" name="formID" action="student-terminal-data.php">

			<label>Semester Id</label><br/>
			<input type="text" id="terminalid" name="terminalid" value="<?php include("code.php");echo $code;?>" class="validate[required]" readonly/><br/><br/>

			<fieldset><legend>STUDENT NAME</legend>
			<?php
			if(isset($_GET['view_user'])){
				@$Class_ID=$_GET['class_id'];
				@$_Batch_ID=$_GET['batch_id'];
				@$_Term_Name=$_GET['term_name'];

			@$_SQL_EXECUTE=mysqli_query($con,"SELECT * FROM tblsystemuser WHERE userid='$_GET[view_user]'");
			
			if($row=mysqli_fetch_array($_SQL_EXECUTE,MYSQLI_ASSOC)){
			$_FullName=$row['firstname']." ".$row['surname']." ".$row['othernames']."(".$row['userid'].")";
			echo "<input type='text' id='firstname' name='firstname' value='$_FullName' class='validate[required]' readonly/><br/><br/>";
			echo "<input type='hidden' id='userid' name='userid' value='$row[userid]' class='validate[required]' readonly/>";
			echo "<input type='hidden' id='classid' name='classid' value='$Class_ID' class='validate[required]' readonly/>";
			echo "<input type='hidden' id='batchid' name='batchid' value='$_Batch_ID' class='validate[required]' readonly/>";
			
			$_SQL_CLASS=mysqli_query($con,"SELECT * FROM tblclassentry WHERE class_entryid='$Class_ID'");
			if($row_cl=mysqli_fetch_array($_SQL_CLASS,MYSQLI_ASSOC)){
			//echo "Class: ". $row_cl['class_name'];
			echo "<input type='text' id='class_1' name='class_1' value='$row_cl[class_name] Semester: $_Term_Name' readonly/>";
			}

			$_SQL_BAT=mysqli_query($con,"SELECT * FROM tblbatch WHERE batchid='$_Batch_ID'");
			if($row_bh=mysqli_fetch_array($_SQL_BAT,MYSQLI_ASSOC)){
			//echo "Class: ". $row_cl['class_name'];
			echo "<input type='text' id='batchname' name='batchname' value='$row_bh[batch]' readonly/>";
			}

			}
			}
			?>
			
			</fieldset><br/>

			<label>No. On Roll</label><br/>
			<input type="number" id="roll" name="roll" value="" class="validate[required]" /><br/><br/>


<label>Attendance</label><br/>
<input type="number" id="attendance" name="attendance" value="" class="validate[required]" /><br/><br/>


<label>Total Attendance</label><br/>
<input type="number" id="totalattendance" name="totalattendance" value="" class="validate[required]" /><br/><br/>

<label>Promoted To</label><br/>
	<?php	
			$_SQL_2=mysqli_query($con,"SELECT * FROM tblclassentry");

			echo "<select id='promotedto' name='promotedto'>";
			echo "<option value=''>Select Class</option>";
				while($row=mysqli_fetch_array($_SQL_2,MYSQLI_ASSOC)){
				echo "<option value='$row[class_entryid]'>$row[class_name]</option>";
				}
				
			echo "</select><br/><br/>";
			?>


<label>Conduct</label><br/>
<input type="text" id="conduct" name="conduct" value="" class="validate[required]" /><br/><br/>

<label>Interest (Special Aptitude)</label><br/>
<input type="text" id="interest" name="interest" value="" class="validate[required]" /><br/><br/>

<label>Class Teacher's Remark</label><br/>
<input type="text" id="class_teacher_remark" name="class_teacher_remark" value="" class="validate[required]" /><br/><br/>

<label>Head Teacher's Remark</label><br/>
<input type="text" id="head_teacher_remark" name="head_teacher_remark" value="" class="validate[required]" /><br/><br/>

				
			<div align="center"><button class="button-save" id="register_student_terminal" name="register_student_terminal"><i class="fa fa-save"></i> SAVE DATA</button></div>
		</form>

		</div>
			</td>
<td width="70%">
<div class="form-entry">
<?php
echo $_SESSION['Message'];
include("dbstring.php");
			
$_SQL_SU=mysqli_query($con,"SELECT * FROM tblsystemuser WHERE systemtype='Student'");
if(mysqli_num_rows($_SQL_SU)>0){
				//Registered clients
				echo "<table width='100%' style='background-color:white'>";
				echo "<caption>students' end of semester data</caption>";
				echo "<thead><th colspan=1>Task</th><th>Class</th><th>Term</th><th>Batch</th><th>Entry Date/Time</th></thead>";
				echo "<tbody>";
	while($row_c=mysqli_fetch_array($_SQL_SU,MYSQLI_ASSOC)){
				echo "<tr style='background-color:#ede'>";
				//echo "<td align='center'><a title='View $row_c[firstname] ($row_c[userid])' href='student-terminal-data.php?view_user=$row_c[userid]&class_id=$row_c[class_entryid]'><i class='fa fa-book' style='color:blue'></i></a></td>";
				echo "<td colspan='4'>$row_c[firstname] $row_c[othernames] $row_c[surname] ($row_c[userid])</td>";
				echo "<td align='center'></td>";
				echo "</tr>";

				$_SQL_EXECUTE=mysqli_query($con,"SELECT * FROM tblclass cl 
					INNER JOIN tblclassentry ce ON cl.class_entryid=ce.class_entryid 
					WHERE cl.userid='$row_c[userid]' ORDER BY ce.class_name ASC");

				
				while($row=mysqli_fetch_array($_SQL_EXECUTE,MYSQLI_ASSOC)){
				echo "<tr>";
			//	echo "<td align='center'><a title='View ($row[class_name])' href='student-terminal-data.php?view_user=$row[userid]&class_id=$row[class_entryid]'><i class='fa fa-book' style='color:blue'></i></a></td>";
				
				//echo "<td>$row[firstname] $row[othernames] $row[surname] ($row[userid])</td>";
				//echo "<td align='center'></td>";
				//echo "<td align='center'></td>";
				echo "<td align='center'></td>";
				
				echo "<td align='center'>$row[class_name]</td>";
				echo "<td align='center'></td>";				
				echo "</tr>";

				$_SQL_TERM=mysqli_query($con,"SELECT * FROM tbltermregistry tr 
				INNER JOIN tblbatch b ON tr.batchid=b.batchid
				WHERE tr.userid='$row[userid]' AND tr.class_entryid='$row[class_entryid]' ORDER BY tr.termname ASC");
				while($row_tr=mysqli_fetch_array($_SQL_TERM,MYSQLI_ASSOC))
				{
				echo "<tr style='background-color:#eee'>";
				//echo "<td align='center'><a onclick=\"javascript:return confirm('Do you want to remove term?')\" title='Remove term $row_tr[termname]' href='student-terminal-data.php?delete_term=$row_tr[terminalid]'<i class='fa fa-times' style='color:red'></i></a></td>";
				echo "<td align='center'><a title='View ($row[class_name] Term: $row_tr[termname])' href='student-terminal-data.php?view_user=$row[userid]&batch_id=$row_tr[batchid]&class_id=$row[class_entryid]&term_name=$row_tr[termname]'><i class='fa fa-book' style='color:blue'></i></a></td>";
			
				echo "<td colspan='1' align='right'>";
				//echo "Term:";
				echo "</td>";
				echo "<td align='center'>";
				echo $row_tr['termname'];
				echo "</td>";
				echo "<td align='center'>$row_tr[batch]</td>";
				echo "<td align='center'>";
				echo $row_tr['datetimeentry'];
				echo "</td>";
				echo "</tr>";

				$_SQL_STR=mysqli_query($con,"SELECT * FROM tblstudentterminalreport str INNER JOIN tblbatch bch ON str.batchid=bch.batchid WHERE str.userid='$row_tr[userid]' AND str.batchid='$row_tr[batchid]'");
				if(mysqli_num_rows($_SQL_STR)>0)
				{
				echo "<tr>";
				echo "<td colspan='5'>";

				echo "<table>";
				echo "<caption>Semester: $row_tr[termname], $row_tr[batch]</caption>";
				echo "<thead><th>Batch</th><th>Roll</th><th>Attend.</th><th>Total Attend.</th><th>Promoted To</th><th>Conduct</th><th>Interest</th><th>Class Teacher's Remark</th><th>Head Teacher's Remark</th><th>Date/Time</th></thead>";
				echo "<tbody>";
				if($row_str=mysqli_fetch_array($_SQL_STR,MYSQLI_ASSOC)){
				echo "<tr>";
				echo "<td align='center'>";
				echo $row_str["batch"];
				echo "</td>";

				echo "<td align='center'>";
				echo $row_str["roll"];
				echo "</td>";

				echo "<td align='center'>";
				echo $row_str["attendance"];
				echo "</td>";

				echo "<td align='center'>";
				echo $row_str["totalattendance"];
				echo "</td>";
				
				echo "<td align='center'>";
				echo $row_str["promotedto"];
				echo "</td>";
				
				echo "<td align='center'>";
				echo $row_str["conduct"];
				echo "</td>";
				
				echo "<td align='center'>";
				echo $row_str["interest"];
				echo "</td>";

				echo "<td>";
				echo $row_str["class_teacher_remark"];
				echo "</td>";

				echo "<td>";
				echo $row_str["head_teacher_remark"];
				echo "</td>";
				
				echo "<td>";
				echo $row_str["datetimeentry"];
				echo "</td>";
				
				echo "</tr>";
				}	
				echo "</tbody>";
				echo "</table>";
			}

				echo "</td>";
				echo "</tr>";
			}
		}
	}
echo "</tbody>";
echo "</table>";
}
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