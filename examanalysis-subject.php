<?php
session_start();
$_SESSION['Message']="";
?>

<?php
//Declare the variables
@$_SubjectID=$_POST['subjectid'];
@$_BatchId=$_POST['batchid'];

if(isset($_POST["print_examanalysis_report"]))
{
      include("dbstring.php");
      include("config.php");
      include("company.php");
      include("remark.php");
      include("gradingsystem.php");
      include("positions.php");

@$_grade_obj=new GradingSystem;
@$_position_obj_1=new Position;

@$_SchoolCloses="";
@$_NextTermBegins="";
$_SQL_IN=mysqli_query($con,"SELECT * FROM tblschoolinfo WHERE batchid='$_BatchId'");
if($row_in=mysqli_fetch_array($_SQL_IN,MYSQLI_ASSOC))
{
$_SchoolCloses=$row_in['schoolcloses'];
$_NextTermBegins=$row_in['schoolresumes'];
}

@$_Roll=0;
@$_Attendance=0;
@$_TotalAttendance=0;
@$_Promotedto="";
@$_Conduct="";
@$_Interest="";
@$_Class_Teacher_Remark="";
@$_Head_Teacher_Remark="";



$_SQL_2=mysqli_query($con,"SELECT * FROM tblsubjectassignment sa 
	INNER JOIN tblsubjectclassification sc ON sa.classificationid=sc.classificationid 
	INNER JOIN tblsubject sub ON sc.subjectid=sub.subjectid 
	INNER JOIN tblclassentry ce ON sc.classid=ce.class_entryid
	WHERE  sc.subjectid='$_SubjectID' AND sa.batchid='$_BatchId' ORDER BY ce.class_name,sa.termname ASC");

require('fpdf181/fpdf.php');
//ob_start();

$pdf = new FPDF();
$pdf->AddPage();

$width_cell=array(15,85,30,30,30,35);
$pdf->SetFont('Arial','B',18);
//Background color of header//
//Heading of the pdf
// Logo
     $pdf->Image('images/logo.png',$width_cell[0]+$width_cell[1],3,22);
     $pdf->Ln(20);

$p=7;
$pdf->SetFillColor(255,255,255);
$pdf->Cell($width_cell[0]+$width_cell[1]+$width_cell[2]+$width_cell[3]+$width_cell[4],10,strtoupper($_CompanyName)." - GES",0,0,'C',true);
$pdf->Ln($p);
$pdf->SetFont('Arial','B',10);

//$pdf->Cell($width_cell[0]+$width_cell[1]+$width_cell[2]+$width_cell[3]+$width_cell[4],10,"GHANA EDUCATION SERVICE",0,0,'C',true);
//$pdf->Ln($p);

$pdf->SetFont('Arial','B',10);
$pdf->Cell($width_cell[0]+$width_cell[1]+$width_cell[2]+$width_cell[3]+$width_cell[4],10,$_Address.", ".$_Location,0,0,'C',true);
$pdf->Ln($p);

//$pdf->Cell($width_cell[0]+$width_cell[1]+$width_cell[2]+$width_cell[3]+$width_cell[4],10,'LOCATION: OYOKO ROUNABOUT, KOFORIDUA',0,0,'C',true);
//$pdf->Ln($p);

$pdf->Cell($width_cell[0]+$width_cell[1]+$width_cell[2]+$width_cell[3]+$width_cell[4],10,'Tel:'. $_Telephone1. " ". $_Telephone2,0,0,'C',true);
$pdf->Ln($p);
//$pdf->SetFont('Arial','B',20);

  $text_height = 5;
  $text_length = 70;
  $n=7;
  $pdf->SetFont('Arial','B',12);

  
$pdf->SetFillColor(255,255,255);

$pdf->SetFont('Arial','B',9);
//Header starts //

//First header column //
$pdf->Cell($width_cell[0],10,'*',1,0,'C',true);
$pdf->Cell($width_cell[1],10,'STUDENT',1,0,'C',true);
$pdf->Cell($width_cell[2],10,'TOTAL SCORE',1,0,'C',true);
$pdf->Cell($width_cell[3],10,'POSITION',1,0,'C',true);
$pdf->Cell($width_cell[4],10,'GRADE',1,0,'C',true);

///header ends///
$pdf->SetFont('Arial','',9);
//Background color of header //
$pdf->SetFillColor(255,255,255);
//to give alternate background fill color to rows//
$fill =false;
$pdf->Ln(10);

@$serial1=0;
while($row_sub=mysqli_fetch_array($_SQL_2,MYSQLI_ASSOC))
{

@$_BatchName="";
$_SQL_Batch=mysqli_query($con,"SELECT * FROM tblbatch WHERE batchid='$row_sub[batchid]'");
if($rowb=mysqli_fetch_array($_SQL_Batch,MYSQLI_ASSOC)){
$_BatchName=$rowb["batch"];	
}
$pdf->Cell($width_cell[0]+$width_cell[1]+$width_cell[2]+$width_cell[3]+$width_cell[4],10,strtoupper($row_sub['subject']).": ".strtoupper($_BatchName),1,0,'L',$fill);
$pdf->Ln(10);
$_SQL_CLASS=mysqli_query($con,"SELECT * FROM tblclassentry ce INNER JOIN tbltermregistry tr 
	ON ce.class_entryid=tr.class_entryid WHERE tr.batchid='$row_sub[batchid]'");
if(mysqli_num_rows($_SQL_CLASS)==0){
}else{
while($row_ce=mysqli_fetch_array($_SQL_CLASS,MYSQLI_ASSOC)){
$_SQL_USER=mysqli_query($con,"SELECT * FROM tblsystemuser su WHERE su.userid='$row_ce[userid]' AND su.systemtype='Student'  ORDER BY su.userid");

while($row_rsu=mysqli_fetch_array($_SQL_USER,MYSQLI_ASSOC)){
$serial1=$serial1+1;

$pdf->Cell($width_cell[0],10,$serial1,1,0,'C',$fill);

$_FullName= strtoupper($row_rsu['firstname']." ".$row_rsu['othernames']." ".$row_rsu['surname']);
$_User_Id="(".$row_rsu['userid'].")";

 $pdf->Cell($width_cell[1],10,$_FullName.$_User_Id,1,0,'L',$fill);

for($k=1;$k<3;$k++){
$_SQL_EXECUTE=mysqli_query($con,"SELECT *,su.userid FROM tblmark mk 
		INNER JOIN tblsystemuser su ON mk.userid=su.userid
		INNER JOIN tblsubjectassignment sa ON mk.assignmentid=sa.assignmentid
		INNER JOIN tblsubjectclassification sc ON sa.classificationid=sc.classificationid
		INNER JOIN tblclassentry ce ON sc.classid=ce.class_entryid
		INNER JOIN tblsubject sub ON sc.subjectid=sub.subjectid 
		WHERE su.userid='$row_rsu[userid]' AND sa.batchid='$row_sub[batchid]'
		AND ce.class_entryid='$row_ce[class_entryid]' AND sa.termname='$k' 
		AND sub.subjectid='$_SubjectID'
		ORDER BY su.userid ASC");

if(mysqli_num_rows($_SQL_EXECUTE)==0){

}else{
	@$_TotalMark=0;
	@$serial=0;
	while($row=mysqli_fetch_array($_SQL_EXECUTE,MYSQLI_ASSOC))
	{
	$_getAssignment_Id=$row['assignmentid'];
	$_TotalMark=$_TotalMark+$row['mark'];
	}	
	$pdf->Cell($width_cell[2],10,$_TotalMark,1,0,'C',$fill);

	 //Get the positions
	 @$_Final_Position=0;

	$_position_obj_1->setPosition($_getAssignment_Id,$_TotalMark);
	$_Final_Position= $_position_obj_1->getPosition();

	$pdf->Cell($width_cell[3],10,$_Final_Position,1,0,'C',$fill);

	//Get the positions
	@$_final_grade=0;

	$_grade_obj->setMark($_TotalMark);
	$_final_grade=$_grade_obj->getMark($_TotalMark);

	$pdf->Cell($width_cell[4],10,$_final_grade,1,0,'C',$fill);

	$fill = !$fill;
	 $pdf->Ln(10);
	}
	}
	}
}
}
}
/// end of records ///
$pdf->Output();
 //ob_end_flush(); 
}
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
<form id="formID" name="formID" method="post" action="examanalysis-subject.php">
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

	while($row=mysqli_fetch_array($_SQL_2,MYSQLI_ASSOC)){
			echo "<div style='padding:5px;background-color:#eee'><a style='color:royalblue;' href='examanalysis-subject.php?class_id=$row[class_entryid]&term_id=$row[termname]&subject_id=$row[subjectid]&batchid=$row[batchid]'><i class='fa fa-plus' style='color:darkgreen'></i> $row[class_name]:Semester: $row[termname] $row[subject] - $row[batch]</a></div><br/>";
	}
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
		echo "<div style='padding:5px;background-color:#eee'><a style='color:royalblue;' href='examanalysis-subject.php?class_id=$row[class_entryid]&term_id=$row[termname]&subject_id=$row[subjectid]&batchid=$row[batchid]'><i class='fa fa-plus' style='color:darkgreen'></i> $row[class_name]:Semester: $row[termname] $row[subject] - $row[batch]</a></div><br/>";
	}
}
?>

</form>
</div>
</td>
<td width="70%">
<div class="form-entry">
	<h3>SCORES REPORTS</h3>
<form id="formID2" name="formID2" method="post" action="examanalysis-subject.php">
<?php
include("positions.php");
//include("class-position.php");
include("gradingsystem.php");

//@$_position_obj=new Position;
@$_position_obj_1=new Position;
//@$_class_position_obj=new ClassPosition;
@$_grade_obj=new GradingSystem;

echo $_SESSION['Message'];
include("dbstring.php");

if(isset($_GET['class_id']))
{
$_SQL_2=mysqli_query($con,"SELECT * FROM tblsubjectassignment sa 
	INNER JOIN tblsubjectclassification sc ON sa.classificationid=sc.classificationid 
	INNER JOIN tblsubject sub ON sc.subjectid=sub.subjectid 
	INNER JOIN tblclassentry ce ON sc.classid=ce.class_entryid
	WHERE  sc.subjectid='$_GET[subject_id]' AND sa.batchid='$_GET[batchid]' ORDER BY ce.class_name,sa.termname ASC");

echo "<input type='hidden' name='subjectid' value='$_GET[subject_id]' />";
echo "<input type='hidden' name='batchid' value='$_GET[batchid]' />";
echo "<button class='button-pay' id='print_examanalysis_report' name='print_examanalysis_report'><i class='fa fa-print'></i> Print Report</button><br/><br/>";		

echo "<table width='100%' style='background-color:white'>";
echo "<caption>";
echo "Scores Report";
echo "</caption>";
echo "<thead><th>*</th><th>STUDENT</th><th>TOTAL</th><th>POSITION</th><th>GRADE</th></thead>";
echo "<tbody>";
@$serial1=0;
while($row_sub=mysqli_fetch_array($_SQL_2,MYSQLI_ASSOC))
{

@$_BatchName="";
$_SQL_Batch=mysqli_query($con,"SELECT * FROM tblbatch WHERE batchid='$row_sub[batchid]'");
if($rowb=mysqli_fetch_array($_SQL_Batch,MYSQLI_ASSOC)){
$_BatchName=$rowb["batch"];	
}
echo "<tr style='background-color:#dee;font-weight:bold'><td align='left' colspan='10'>".strtoupper($row_sub['subject']).": ".strtoupper($_BatchName) ."</td></tr>";
$_SQL_CLASS=mysqli_query($con,"SELECT * FROM tblclassentry ce INNER JOIN tbltermregistry tr 
	ON ce.class_entryid=tr.class_entryid WHERE tr.batchid='$row_sub[batchid]'");
if(mysqli_num_rows($_SQL_CLASS)==0){
}else{
while($row_ce=mysqli_fetch_array($_SQL_CLASS,MYSQLI_ASSOC)){
$_SQL_USER=mysqli_query($con,"SELECT * FROM tblsystemuser su WHERE su.userid='$row_ce[userid]' AND su.systemtype='Student'  ORDER BY su.userid");

while($row_rsu=mysqli_fetch_array($_SQL_USER,MYSQLI_ASSOC)){
$serial1=$serial1+1;
echo "<tr>";
echo "<td>$serial1</td>";
echo "<td align='left' colspan='1'>";
echo strtoupper($row_rsu['firstname']." ".$row_rsu['othernames']." ".$row_rsu['surname']);
echo "(".$row_rsu['userid'].")";
echo "</td>";

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
	@$_TotalMark=0;
	@$serial=0;
	while($row=mysqli_fetch_array($_SQL_EXECUTE,MYSQLI_ASSOC))
	{
	$_getAssignment_Id=$row['assignmentid'];
	$_TotalMark=$_TotalMark+$row['mark'];
	}	
	//echo "<tr>";
	//echo "<td colspan='1'>";
	//echo "</td>";

	echo "<td align='center'>";
	echo $_TotalMark;
	echo "</td>";

	echo "<td align='center' width='5%'>";
	 //Get the positions
	 @$_Final_Position=0;

	$_position_obj_1->setPosition($_getAssignment_Id,$_TotalMark);
	$_Final_Position= $_position_obj_1->getPosition();
	echo $_Final_Position;
	echo "</td>";

	echo "<td align='center' width='5%'>";
	 //Get the positions
	@$_final_grade=0;

	$_grade_obj->setMark($_TotalMark);
	$_final_grade=$_grade_obj->getMark($_TotalMark);

	echo $_final_grade;
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