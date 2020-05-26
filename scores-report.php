<?php
session_start();
$_SESSION['Message']="";
?>
<?php
include("dbstring.php");
@$_Mark=$_POST['marks'];
@$_AssignmentId=$_POST['assignmentid'];
@$_UserId=$_POST['userid'];
@$_TotalMark=$_POST['totalscore'];
@$_Recordedby=$_SESSION['USERID'];

if(isset($_POST['save_all_mark']))
{
	@$_CheckMark=0;
	foreach ($_Mark as $_Selected_Mark) 
	{
		if($_Selected_Mark>$_TotalMark){
			$_CheckMark=1;
		}
	}
//Check if mark entered is more than the total mark
if($_CheckMark==1){
$_SESSION['Message']=$_SESSION['Message']."<div style='color:red;padding:10px;background-color:white;'>Total Mark is less than the mark entered</div>";
}else/*No mark is greater than the total mark*/
{

$_TotalUsers =count($_UserId);

for($k=0;$k<$_TotalUsers;$k++)
{
$_Selected_User=$_UserId[$k];
$_Selected_Mark=$_Mark[$k];

		include("code.php");
	@$_MarkId=$code;
	@$_UserFullname="";

	$_SQL_EXECUTE_USER_2=mysqli_query($con,"SELECT * FROM tblsystemuser su  WHERE su.userid='$_Selected_User'");
		
		if($row_u_2=mysqli_fetch_array($_SQL_EXECUTE_USER_2,MYSQLI_ASSOC)){
		$_UserFullname=$row_u_2['firstname']." ".$row_u_2['othernames']." ".$row_u_2['surname']." (".$row_u_2['userid'].")";
		}

	//@$_Subject="";
	//Check if subject already registered
	/*$_SQL_EXECUTE_SUBJECT=mysqli_query($con,"SELECT * FROM tblsubject sub INNER JOIN tblsubjectclassification sc ON sub.subjectid=sc.subjectid WHERE sc.classificationid='$_Selected_ClassId'");
	if($row_s=mysqli_fetch_array($_SQL_EXECUTE_SUBJECT,MYSQLI_ASSOC)){
	$_Subject=$row_s['subject'];
	$_ClassId=$row_s['classid'];
	//@$_getUser_ID=$row_s['userid'];

	}
	*/

	/*$_SQL_EXECUTE_USER=mysqli_query($con,"SELECT * FROM tblsubjectassignment sa INNER JOIN tblsystemuser su ON sa.userid=su.userid WHERE sa.classificationid='$_Selected_ClassId'");
	if(!mysqli_num_rows($_SQL_EXECUTE_USER)>0){
		$_SQL_EXECUTE_USER_2=mysqli_query($con,"SELECT * FROM tblsystemuser su  WHERE su.userid='$_UserId'");
		
		if($row_u_2=mysqli_fetch_array($_SQL_EXECUTE_USER_2,MYSQLI_ASSOC)){
		$_UserFullname=$row_u_2['firstname']." ".$row_u_2['othernames']." ".$row_u_2['surname']." (".$row_u_2['userid'].")";
		}

	}else{
		if($row_u=mysqli_fetch_array($_SQL_EXECUTE_USER,MYSQLI_ASSOC)){
		$_UserFullname=$row_u['firstname']." ".$row_u['othernames']." ".$row_u['surname']." (".$row_u['userid'].")";
		}
	}
	*/

	//$_SQL_EXECUTE_2=mysqli_query($con,"SELECT * FROM tblsubjectassignment sa WHERE sa.classificationid='$_Selected_ClassId' AND sa.userid='$_UserId' AND sa.classid='$_ClassId'");
	/*$_SQL_EXECUTE_2=mysqli_query($con,"SELECT * FROM tblsubjectassignment sa WHERE sa.classificationid='$_Selected_ClassId'");
	
	if(mysqli_num_rows($_SQL_EXECUTE_2)>0){
		$_SESSION['Message']=$_SESSION['Message']."<div style='color:red;text-align:left;background-color:white'><i class='fa fa-check' style='color:red'></i> $_Subject Already Assigned To $_UserFullname</div>";
		
	}else{
		*/

		$_SQL_EXECUTE=mysqli_query($con,"INSERT INTO tblmark(markid,assignmentid,userid,testtype,mark,totalmark,datetimeentry,status,recordedby)
		VALUES('$_MarkId','$_AssignmentId','$_Selected_User','Class Score','$_Selected_Mark','$_TotalMark',NOW(),'active','$_Recordedby')");
			if($_SQL_EXECUTE)
			{
		
			$_SESSION['Message']=$_SESSION['Message']."<div style='color:green;text-align:left;background-color:white'><i class='fa fa-check' style='color:green'></i> $_Selected_Mark Successfully Stored for $_UserFullname</div>";
			}
			else{
				$_Error=mysqli_error($con);
				$_SESSION['Message']=$_SESSION['Message']."<div style='color:red'>Mark failed to save,$_Error</div>";
			}
	}
	}	
	
}
?>

<?php
include("dbstring.php");
@$_Update_subject=$_POST['update_item'];
@$_Update_subjectid=$_POST['update_subjectid'];

if(isset($_POST['update_item_entry'])){
$_SQL_EXECUTE=mysqli_query($con,"UPDATE tblsubject SET subject='$_Update_subject' WHERE subjectid='$_Update_subjectid'");
if($_SQL_EXECUTE){
	$_SESSION['Message']="<div style='color:green;text-align:center;background-color:white'>Subject Successfully Updated</div>";
	}
	else{
		$_Error=mysqli_error($con);
		$_SESSION['Message']="<div style='color:red'>Subject failed to update,$_Error</div>";
	}
}
?>
<?php
include("dbstring.php");

if(isset($_GET["delete_mark"]))
{
$_SQL_EXECUTE=mysqli_query($con,"DELETE FROM tblmark WHERE markid='$_GET[delete_mark]'");
	if($_SQL_EXECUTE){
	$_SESSION['Message']="<div style='color:maroon;text-align:center;background-color:white'>Mark Successfully Deleted</div>";
	}
	else{
		$_Error=mysqli_error($con);
		$_SESSION['Message']="<div style='color:red;text-align:center'>Mark failed to delete,Error:$_Error</div>";
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
<?php
include("menu.php");
?>		
</div>

<div class="main-platform" style="background-color:white"><br/>
<table width="100%">
<tr>
<td width="30%">
<div class="form-entry">
<form id="formID" name="formID" method="post" action="scores-report.php">
<h4>SUBJECTS</h4>
<?php	
if(($_SESSION["ACCESSLEVEL"]=="administrator"||$_SESSION["ACCESSLEVEL"]=="user") && ($_SESSION["SYSTEMTYPE"]=="super_user" ||$_SESSION["SYSTEMTYPE"]=="normal_user"||$_SESSION["SYSTEMTYPE"]=="User"))
{
include("dbstring.php");
$_SQL_2=mysqli_query($con,"SELECT * FROM tblsubjectassignment sa 
	INNER JOIN tblsubjectclassification sc ON sa.classificationid=sc.classificationid 
	INNER JOIN tblsubject sub ON sc.subjectid=sub.subjectid 
	INNER JOIN tblclassentry ce ON sc.classid=ce.class_entryid
	INNER JOIN tblbatch bch ON bch.batchid=sa.batchid
	ORDER BY ce.class_name,sa.termname ASC");

//echo "<select id='classid' name='classid' class='validate[required]'>";
	//echo "<option value=''>Select Subject</option>";
	while($row=mysqli_fetch_array($_SQL_2,MYSQLI_ASSOC)){
//	echo "<option value='$row[class_entryid]'>$row[class_name]:Term: $row[termname] $row[subject]</option>";
		echo "<div style='padding:5px;background-color:#eee'><a style='color:royalblue;' href='scores-report.php?admin_class_id=$row[class_entryid]&term_id=$row[termname]&subject_id=$row[subjectid]&batchid=$row[batchid]'><i class='fa fa-plus' style='color:darkgreen'></i> $row[class_name]:Semester: $row[termname] $row[subject] - $row[batch]</a></div><br/>";
	}
//echo "</select><br/><br/>";
/*
	$_SQL_2=mysqli_query($con,"SELECT * FROM tblbatch");

			echo "<select id='batchid' name='batchid' class='validate[required]'>";
			echo "<option value=''>Select Batch</option>";
				while($row=mysqli_fetch_array($_SQL_2,MYSQLI_ASSOC)){
					echo "<option value='$row[batchid]'>$row[batch]</option>";
				}
				
			echo "</select><br/><br/>";
			*/
}
elseif($_SESSION["ACCESSLEVEL"]=="user" && $_SESSION["SYSTEMTYPE"]=="Teacher")
{
include("dbstring.php");
$_SQL_2=mysqli_query($con,"SELECT * FROM tblsubjectassignment sa 
	INNER JOIN tblsubjectclassification sc ON sa.classificationid=sc.classificationid 
	INNER JOIN tblsubject sub ON sc.subjectid=sub.subjectid 
	INNER JOIN tblclassentry ce ON sc.classid=ce.class_entryid
	INNER JOIN tblbatch bch ON bch.batchid=sa.batchid
	WHERE sa.userid='$_SESSION[USERID]' ORDER BY ce.class_name,sa.termname ASC");

	while($row=mysqli_fetch_array($_SQL_2,MYSQLI_ASSOC)){
		echo "<div style='padding:5px;background-color:#eee'><a style='color:royalblue;' href='scores-report.php?class_id=$row[class_entryid]&term_id=$row[termname]&subject_id=$row[subjectid]&batchid=$row[batchid]'><i class='fa fa-plus' style='color:darkgreen'></i> $row[class_name]:Semester: $row[termname] $row[subject] - $row[batch]</a></div><br/>";
	}
}
?>

</form>
</div>
</td>
<td width="70%">
<div class="form-entry">
<form id="formID2" name="formID2" method="post" action="scores-report.php">
<?php
echo $_SESSION['Message'];
include("dbstring.php");

if(isset($_GET['class_id']))
{
$_SQL_2=mysqli_query($con,"SELECT * FROM tblsubjectassignment sa 
	INNER JOIN tblsubjectclassification sc ON sa.classificationid=sc.classificationid 
	INNER JOIN tblsubject sub ON sc.subjectid=sub.subjectid 
	INNER JOIN tblclassentry ce ON sc.classid=ce.class_entryid
	WHERE sa.userid='$_SESSION[USERID]' AND sc.subjectid='$_GET[subject_id]' AND sa.batchid='$_GET[batchid]' ORDER BY ce.class_name,sa.termname ASC");


//$_SQL_USER=mysqli_query($con,"SELECT * FROM tblsystemuser su WHERE su.systemtype='Student'  ORDER BY su.userid");

echo "<table width='100%' style='background-color:white'>";
echo "<caption>";
echo "Scores Report";
echo "</caption>";
echo "<thead><th>*</th><th>SUBJECT</th><th>STUDENT</th><th>CLASS</th><th>SEM.</th><th>TYPE</th><th>MARK</th><th>TOTAL</th></thead>";
echo "<tbody>";
@$serial=0;
while($row_sub=mysqli_fetch_array($_SQL_2,MYSQLI_ASSOC))
{
@$_BatchName="";
$_SQL_Batch=mysqli_query($con,"SELECT * FROM tblbatch WHERE batchid='$row_sub[batchid]'");
if($rowb=mysqli_fetch_array($_SQL_Batch,MYSQLI_ASSOC)){
$_BatchName=$rowb["batch"];	
}
echo "<tr style='background-color:#FFF;'><td align='left' colspan='8'>".strtoupper($row_sub['subject']).": ".strtoupper($_BatchName) ."</td></tr>";


//$_SQL_SU=mysqli_query($con,"SELECT * FROM tblsubject");

//SUBJECT
/*echo "<tr style='background-color:#cff;font-weight:bold'>";
echo "<td colspan='1'></td>";
echo "<td align='left' colspan='7'>";
echo strtoupper($row_rsu['subject']);
echo "</td></tr>";
*/
$_SQL_CLASS=mysqli_query($con,"SELECT * FROM tblclassentry ce INNER JOIN tbltermregistry tr 
	ON ce.class_entryid=tr.class_entryid WHERE tr.class_entryid='$row_sub[class_entryid]' AND tr.batchid='$row_sub[batchid]'");
if(mysqli_num_rows($_SQL_CLASS)==0){
}else{
while($row_ce=mysqli_fetch_array($_SQL_CLASS,MYSQLI_ASSOC)){
$_SQL_USER=mysqli_query($con,"SELECT * FROM tblsystemuser su WHERE su.userid='$row_ce[userid]' AND su.systemtype='Student'  ORDER BY su.userid");

if($row_rsu=mysqli_fetch_array($_SQL_USER,MYSQLI_ASSOC)){
echo "<tr style='background-color:#FFF;font-weight:bold'>";
echo "<td colspan='1'>";
echo $serial=$serial+1 .".";
echo "</td>";
echo "<td align='left' colspan='7'>";
echo strtoupper($row_rsu['firstname']." ".$row_rsu['othernames']." ".$row_rsu['surname']);
echo "(".$row_rsu['userid'].")";
echo "</td></tr>";

for($k=1;$k<3;$k++){
$_SQL_EXECUTE=mysqli_query($con,"SELECT *,su.userid FROM tblmark mk 
		INNER JOIN tblsystemuser su ON mk.userid=su.userid
		INNER JOIN tblsubjectassignment sa ON mk.assignmentid=sa.assignmentid
		INNER JOIN tblsubjectclassification sc ON sa.classificationid=sc.classificationid
		INNER JOIN tblclassentry ce ON sc.classid=ce.class_entryid
		INNER JOIN tblsubject sub ON sc.subjectid=sub.subjectid 
		WHERE su.userid='$row_rsu[userid]' AND sa.batchid='$row_sub[batchid]'
		AND ce.class_entryid='$row_ce[class_entryid]' AND sa.termname='$k' 
		AND sub.subjectid='$_GET[subject_id]'
		ORDER BY su.userid ASC");

if(mysqli_num_rows($_SQL_EXECUTE)==0){

}else{
	echo "<tr style='background-color:#FFF;'>";
	echo "<td colspan='2'></td>";
	echo "<td colspan='1'>$row_ce[class_name]</td>";
	echo "<td colspan='5'>";
	echo "SEMESTER: ".$k;
	echo "</td></tr>";

	@$_TotalMark=0;

	while($row=mysqli_fetch_array($_SQL_EXECUTE,MYSQLI_ASSOC))
	{
	echo "<tr>";
	echo "<td colspan='4' align='right'>";
	echo "<a onclick=\"javascript:return confirm('Do you to delete mark?')\" title='Delete score: $row[mark]' href='scores-report.php?delete_mark=$row[markid]'><i class='fa fa-trash-o' style='color:red'></i></a>";
	echo "</td>";

	//echo "<td align='center' width='5%' colspan='1'>";
	//echo $serial=$serial+1;
	//echo "</td>";

	/*echo "<td align='left' width='20%'>";
	echo $row['subject'];
	echo "</td>";
	*/
	echo "<td align='left' width='15%'>";
	echo $row['testtype'];
	echo "</td>";

	echo "<td align='center' width='15%'>";
	echo $row['mark'];
	$_TotalMark=$_TotalMark+$row['mark'];
	echo "</td>";

	echo "</tr>";
	}	
	echo "<tr style='background-color:#eee;font-weight:bold'>";
	echo "<td colspan='6'>";
	echo "</td>";

	echo "<td align='right' colspan='1'>";
	echo "TOTAL:";
	echo "</td>";
	echo "<td align='center'>";
	echo $_TotalMark;
	echo "</td>";
	echo "</tr>";
	}
	}
	}
}
}
}
echo "</tbody>";
echo "</table>";
}
?>
</form>

<form id="formID2" name="formID2" method="post" action="scores-report.php">
<?php 
/*echo $_SESSION['Message'];
include("dbstring.php");

if(isset($_GET['admin_class_id']))
{
$_SQL_2=mysqli_query($con,"SELECT * FROM tblsubjectassignment sa 
	INNER JOIN tblsubjectclassification sc ON sa.classificationid=sc.classificationid 
	INNER JOIN tblsubject sub ON sc.subjectid=sub.subjectid 
	INNER JOIN tblclassentry ce ON sc.classid=ce.class_entryid
	WHERE  sc.subjectid='$_GET[subject_id]' ORDER BY ce.class_name,sa.termname ASC");


//$_SQL_USER=mysqli_query($con,"SELECT * FROM tblsystemuser su WHERE su.systemtype='Student'  ORDER BY su.userid");

echo "<table width='100%' style='background-color:white'>";
echo "<caption>";
echo "</caption>";
echo "<thead><th>SUBJECT</th><th>STUDENT</th><th>CLASS</th><th>SEMESTER</th><th>*</th><th>TYPE</th><th>MARK</th><th>TOTAL</th></thead>";
echo "<tbody>";
while($row_sub=mysqli_fetch_array($_SQL_2,MYSQLI_ASSOC))
{
echo "<tr style='background-color:#dee;font-weight:bold'><td align='left' colspan='8'>".strtoupper($row_sub['subject'])."</td></tr>";




$_SQL_CLASS=mysqli_query($con,"SELECT * FROM tblclassentry ce INNER JOIN tbltermregistry tr 
	ON ce.class_entryid=tr.class_entryid WHERE tr.batchid='$row_sub[batchid]'");
if(mysqli_num_rows($_SQL_CLASS)==0){

}else{
while($row_ce=mysqli_fetch_array($_SQL_CLASS,MYSQLI_ASSOC))
{

$_SQL_USER=mysqli_query($con,"SELECT * FROM tblsystemuser su WHERE su.userid='$row_ce[userid]' AND su.systemtype='Student'  ORDER BY su.userid");

while($row_rsu=mysqli_fetch_array($_SQL_USER,MYSQLI_ASSOC)){

echo "<tr style='background-color:#fee;font-weight:bold'>";
echo "<td colspan='1'></td>";
echo "<td align='left' colspan='7'>";
echo strtoupper($row_rsu['firstname']." ".$row_rsu['othernames']." ".$row_rsu['surname']);
echo "</td></tr>";

for($k=1;$k<3;$k++)
{
	$_SQL_EXECUTE=mysqli_query($con,"SELECT *,su.userid FROM tblmark mk 
		INNER JOIN tblsystemuser su ON mk.userid=su.userid
		INNER JOIN tblsubjectassignment sa ON mk.assignmentid=sa.assignmentid
		INNER JOIN tblsubjectclassification sc ON sa.classificationid=sc.classificationid
		INNER JOIN tblclassentry ce ON sc.classid=ce.class_entryid
		INNER JOIN tblsubject sub ON sc.subjectid=sub.subjectid 
		WHERE su.userid='$row_rsu[userid]'
		AND ce.class_entryid='$row_ce[class_entryid]' AND sa.termname='$k' AND sub.subjectid='$_GET[subject_id]'
		ORDER BY su.userid ASC");

if(mysqli_num_rows($_SQL_EXECUTE)==0){

}else{
	echo "<tr style='background-color:#dee;font-weight:bold'>";
	echo "<td colspan='2'></td>";
	echo "<td colspan='1'>$row_ce[class_name]</td>";
	echo "<td colspan='5'>";
	echo "SEMESTER: ".$k;
	echo "</td></tr>";

	@$_TotalMark=0;
	@$serial=0;
	while($row=mysqli_fetch_array($_SQL_EXECUTE,MYSQLI_ASSOC))
	{
	echo "<tr>";
	echo "<td colspan='4' align='right'>";
	echo "<a onclick=\"javascript:return confirm('Do you to delete mark?')\" href='scores-report.php?delete_mark=$row[markid]'><i class='fa fa-times' style='color:red'></i></a>";
	echo "</td>";

	echo "<td align='center' width='5%' colspan='1'>";
	echo $serial=$serial+1;
	echo "</td>";

	echo "<td align='left' width='15%'>";
	echo $row['testtype'];
	echo "</td>";

	echo "<td align='center' width='15%'>";
	echo $row['mark'];
	$_TotalMark=$_TotalMark+$row['mark'];
	echo "</td>";

	echo "</tr>";
	}	
	echo "<tr style='background-color:#fed;font-weight:bold'>";
	echo "<td colspan='6'>";
	echo "</td>";

	echo "<td align='right' colspan='1'>";
	echo "TOTAL:";
	echo "</td>";
	echo "<td align='center'>";
	echo $_TotalMark;
	echo "</td>";
	echo "</tr>";
	}
	}
	}
}
}
}
echo "</tbody>";
echo "</table>";
}
*/
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