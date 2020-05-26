<?php
session_start();
$_SESSION['Message']="";

if(isset($_POST["print_student"]))
{
include("dbstring.php");
include("config.php");
include("company.php");
//Get all the ordered items
require('fpdf181/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();

$width_cell=array(7,55,20,20,20,20,10,25,15);
$pdf->SetFont('Arial','B',10);
//Background color of header//
//Heading of the pdf
// Logo
$pdf->Image("logo/".$_Logo,100,3,20);
$pdf->Ln(15);

$p=10;
$pdf->SetFillColor(255,255,255);
$pdf->Cell($width_cell[0]+$width_cell[1]+$width_cell[2]+$width_cell[3]+$width_cell[4]+$width_cell[5]+$width_cell[6]+$width_cell[7]+$width_cell[8],10,strtoupper($_CompanyName),0,0,'C',true);
$pdf->Ln($p);

$pdf->Cell($width_cell[0]+$width_cell[1]+$width_cell[2]+$width_cell[3]+$width_cell[4]+$width_cell[5]+$width_cell[6]+$width_cell[7]+$width_cell[8],10,$_Address.", ".$_Location,0,0,'C',true);
$pdf->Ln($p);

$pdf->Cell($width_cell[0]+$width_cell[1]+$width_cell[2]+$width_cell[3]+$width_cell[4]+$width_cell[5]+$width_cell[6]+$width_cell[7]+$width_cell[8],10,'TEL:'. $_Telephone1. " ". $_Telephone2,0,0,'C',true);
$pdf->Ln($p);

$text_height = 5;
$text_length = 70;
$n=7;
$pdf->SetFillColor(255,255,255);

@$_ClassentryID=$_POST["print_class_id"];
@$_BatchID=$_POST["print_batchid"];

include("dbstring.php");
$_SQL_EXECUTE2=mysqli_query($con,"SELECT * FROM tblsystemuser su INNER JOIN tblclass cl 
ON su.userid=cl.userid WHERE cl.class_entryid='$_ClassentryID'AND cl.batchid='$_BatchID' AND su.systemtype='Student' ORDER BY su.firstname ASC");

//Registered clients
@$_ClassName="";
$_SQLGC=mysqli_query($con,"SELECT * FROM tblclassentry WHERE class_entryid='$_ClassentryID'");
if($rowc=mysqli_fetch_array($_SQLGC,MYSQLI_ASSOC)){
$_ClassName=$rowc["class_name"];
}

@$_BatchName="";
$_SQL_BATCH=mysqli_query($con,"SELECT * FROM tblbatch WHERE batchid='$_BatchID'");
if($row_ba=mysqli_fetch_array($_SQL_BATCH,MYSQLI_ASSOC)){
		$_BatchName=$row_ba['batch'];
	}

if(mysqli_num_rows($_SQL_EXECUTE2)>0){
	$pdf->SetFont('Arial','',9);
$pdf->Cell($width_cell[0]+$width_cell[1]+$width_cell[2]+$width_cell[3]+$width_cell[4]+$width_cell[5]+$width_cell[6],10,strtoupper(mysqli_num_rows($_SQL_EXECUTE2)." ".$_ClassName ." STUDENT(S) FOUND FOR ". $_BatchName." Batch"),0,0,'L',true);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',7);
//Header starts //
//First header column //
$pdf->Cell($width_cell[0],10,'*',1,0,'C',true);
$pdf->Cell($width_cell[1],10,'STUDENTS',1,0,'C',true);
$pdf->Cell($width_cell[2],10,'ADDRESS',1,0,'C',true);
$pdf->Cell($width_cell[3],10,'EMAIL',1,0,'C',true);
$pdf->Cell($width_cell[4],10,'MOBILE',1,0,'C',true);
$pdf->Cell($width_cell[5],10,'USERNAME',1,0,'C',true);
$pdf->Cell($width_cell[6],10,'TYPE',1,0,'C',true);
$pdf->Cell($width_cell[7],10,'DATE/TIME',1,0,'C',true);
$pdf->Cell($width_cell[8],10,'STATUS',1,0,'C',true);



///header ends///
$pdf->SetFont('Arial','',6);
//Background color of header //
$pdf->SetFillColor(255,255,255);
//to give alternate background fill color to rows//
$fill =false;

@$serial=0;
$pdf->Ln(10);
	while($row=mysqli_fetch_array($_SQL_EXECUTE2,MYSQLI_ASSOC)){
	$_FullName=$row["firstname"]." ".$row["surname"]." ". $row["othernames"]."(".$row["userid"].")";
	$pdf->Cell($width_cell[0],10,$serial=$serial+1,1,0,'C',$fill);
	$pdf->Cell($width_cell[1],10,$_FullName,1,0,'L',$fill);
	$pdf->Cell($width_cell[2],10,$row["postaladdress"],1,0,'L',$fill);
	$pdf->Cell($width_cell[3],10,$row["email"],1,0,'L',$fill);
	$pdf->Cell($width_cell[4],10,$row["mobile"],1,0,'C',$fill);
	$pdf->Cell($width_cell[5],10,$row["username"],1,0,'L',$fill);
	$pdf->Cell($width_cell[6],10,$row["systemtype"],1,0,'L',$fill);
	$pdf->Cell($width_cell[7],10,$row["registereddatetime"],1,0,'L',$fill);
	$pdf->Cell($width_cell[8],10,$row["status"],1,0,'C',$fill);
	$fill = !$fill;
	$pdf->Ln(10);
	}

$tomorrow = mktime(0,0,0,date("m"),date("d"),date("Y"));
$tdate= date("d/m/Y", $tomorrow);
$pdf->SetFillColor(0,0,0);

$pdf->SetFont('Arial','',8);
$pdf->Cell(0,10,'Print Date/Time: '.$tdate,0);

$pdf->Ln(10); 
$pdf->Cell(0,10,'ADMINISTRATOR:',0);
 
$pdf->Ln(10); 
$pdf->Cell(0,10,'SIGNATURE:.......................................................',0);

$pdf->Ln(85); 
$pdf->Cell(0,10,' ',0);

 //}
//}
}
$pdf->Output();
}
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
$_SQL_EXECUTE=mysqli_query($con,"INSERT INTO tblsystemuser(userid,firstname,surname,othernames,gender,birthday,age,postaladdress,homeaddress,hometown,religion,relationship,nextofkin_fullname,nextofkin_contact,registereddatetime,status,username,password,accesslevel,systemtype)
	VALUES('$_UserID','$_Firstname','$_Surname','$_Othernames','$_Gender',STR_TO_DATE('$_Birthday','%d-%m-%Y'),'$_Age','$_PostalAddress','$_HomeAddress','$_HomeTown','$_Religion','$_Relationship','$_Nextofkin_fullname','$_Nextofcontact',NOW(),'active','$_Username','$_Password','$_AccessLevel','$_SystemType')");
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

if(isset($_GET["delete_user"]))
{
$_SQL_EXECUTE=mysqli_query($con,"DELETE FROM tblsystemuser WHERE userid='$_GET[delete_user]'");
	if($_SQL_EXECUTE){
	$_SESSION['Message']="<div style='color:red;text-align:center;background-color:white'>User Record Successfully Deleted</div>";
	}
	else{
		$_Error=mysqli_error($con);
		$_SESSION['Message']="<div style='color:red'>User failed to delete</div>";
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
<div class="main-platform" style="">
	<table width="200%">
		<tr>
			<td width="50%" align="center">
				<div class="form-entry" style="">
				<div  width="50%">
	<form method="post" action="viewstudents.php">
				<?php	
			$_SQL_2=mysqli_query($con,"SELECT * FROM tblclassentry ORDER BY class_name");

			echo "<select id='class_entryid' name='class_entryid' class='validate[required]'>";
			echo "<option value=''>Select Class</option>";
				while($row=mysqli_fetch_array($_SQL_2,MYSQLI_ASSOC)){
					echo "<option value='$row[class_entryid]'>$row[class_name]</option>";
				}
				
			echo "</select><br/><br/>";
			?>	

			<?php	
			$_SQL_2=mysqli_query($con,"SELECT * FROM tblbatch");

			echo "<select id='batchid' name='batchid' class='validate[required]'>";
			echo "<option value=''>Select Batch</option>";
				while($row=mysqli_fetch_array($_SQL_2,MYSQLI_ASSOC)){
					echo "<option value='$row[batchid]'>$row[batch]</option>";
				}
				
			echo "</select><br/><br/>";
			?>	
		</div>
	</td>
<td>
<div width="50%">
<button class="button-show" name="showstudent"><i class="fa fa-search"></i> SHOW STUDENTS</button>	
</div><br/>
</div>
</form>
</td>
</tr>
	</table>
<br/>
<?php
if(isset($_POST["showstudent"]))
{
@$_ClassentryID=$_POST["class_entryid"];
@$_BatchID=$_POST["batchid"];
?>
<div class="form-entry" style="">
				<?php
				echo $_SESSION['Message'];

include("dbstring.php");
$_SQL_EXECUTE2=mysqli_query($con,"SELECT * FROM tblsystemuser su INNER JOIN tblclass cl 
ON su.userid=cl.userid WHERE cl.class_entryid='$_ClassentryID'AND cl.batchid='$_BatchID' AND su.systemtype='Student' ORDER BY su.firstname ASC");

				//Registered clients
				@$_ClassName="";
				$_SQLGC=mysqli_query($con,"SELECT * FROM tblclassentry WHERE class_entryid='$_ClassentryID'");
				if($rowc=mysqli_fetch_array($_SQLGC,MYSQLI_ASSOC)){
				$_ClassName=$rowc["class_name"];
				}
	@$_BatchName="";
	$_SQL_BATCH=mysqli_query($con,"SELECT * FROM tblbatch WHERE batchid='$_BatchID'");
	if($row_ba=mysqli_fetch_array($_SQL_BATCH,MYSQLI_ASSOC)){
		$_BatchName=$row_ba['batch'];
	}
if(mysqli_num_rows($_SQL_EXECUTE2)>0){
	echo "<form method='post' target='_blank'>";
	echo "<input type='hidden' id='print_class_id' name='print_class_id' value='$_ClassentryID'/>";
	echo "<input type='hidden' id='print_batchid' name='print_batchid' value='$_BatchID' />";
	echo "<button class='button-print' id='print_student' name='print_student'><i class='fa fa-print'></i> Print Student</button><br/><br/>";
	echo "</form>";
				echo "<table width='100%' style='background-color:white'>";
				echo "<caption>". mysqli_num_rows($_SQL_EXECUTE2)." ".$_ClassName ." STUDENT(S) FOUND FOR ". $_BatchName." Batch</caption>";
				echo "<thead><th colspan=2>TASK</th><th>*</th><th>STUDENTS</th><th>ADDRESS</th><th>EMAIL</th><th>MOBILE</th><th>USERNAME</th><th>TYPE</th><th>DATE/TIME</th><th>STATUS</th></thead>";
				echo "<tbody>";
				@$serial=0;
				while($row=mysqli_fetch_array($_SQL_EXECUTE2,MYSQLI_ASSOC)){
					$serial=$serial+1;
				echo "<tr>";
				echo "<td align='center'><a title='View $row[firstname] ($row[userid])' href='user-profile.php?view_user=$row[userid]'<i class='fa fa-book' style='color:blue'></i></a></td>";
				//echo "<td align='center'><a title='Delete $row[firstname] ($row[userid])' onclick=\"javascript:return confirm('Do you want to delete?');\" href='viewstudents.php?delete_user=$row[userid]'<i class='fa fa-times' style='color:red'></i></a></td>";
				echo "<td align='center'><a title='Edit $row[firstname] ($row[userid])' href='register_edit.php?edit_user=$row[userid]'<i class='fa fa-edit' style='color:green'></i></a></td>";
				/*echo "<td>";
				if($row['status']=="active"){
				echo"<a title='Block $row[firstname] ($row[userid])' href='viewstudents.php?block_user=$row[userid]'<i class='fa fa-user' style='color:orange'></i></a>";
					
			}else{
				echo"<a title='Unblock $row[firstname] ($row[userid])' href='viewstudents.php?unblock_user=$row[userid]'<i class='fa fa-user' style='color:red'></i></a>";
				
			}
				echo "</td>";
				*/


				echo "<td align='center'>$serial.</td>";
				echo "<td>$row[firstname] $row[surname] $row[othernames]($row[userid])</td>";
				echo "<td align='center'>$row[postaladdress]</td>";
				echo "<td align='center'>$row[email]</td>";
				echo "<td align='center'>$row[mobile]</td>";
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
			}
	?>
</div>
<?php
}
?>


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