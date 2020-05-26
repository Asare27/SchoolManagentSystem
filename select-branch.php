<?php session_start();?>
<?php include("dbstring.php"); 
$_SESSION['Message']="";
?>


<?php
include("dbstring.php");
@$_SubBranchId=$_POST['subbranchid'];

if(isset($_POST['button_update_sublogo'])){
  //Upload Logo
  @$_Filename=$_FILES["logo"]["name"];
  @$_Image=$_FILES["logo"]["tmp_name"];
  $_Destination="images/logo";

  if(!file_exists($_Destination."/".$_Filename)){
    move_uploaded_file($_Image, $_Destination."/".$_Filename);
  }
    if(file_exists($_Destination."/".$_Filename))
    {
    $_SQL_2=mysqli_query($con,"UPDATE tblsubbranch SET logo='$_Filename' WHERE subbranchid='$_SubBranchId'");
  if($_SQL_2){
    header("location:select-branch.php");
    }
  }
}
?>


<?php
include("dbstring.php");
@$_BranchId=$_POST['branchid'];
@$_Initials=$_POST['initials'];

if(isset($_POST['button_update_logo'])){
  //Upload Logo
  @$_Filename=$_FILES["logo"]["name"];
  @$_Image=$_FILES["logo"]["tmp_name"];
  $_Destination="images/logo";

  if(!file_exists($_Destination."/".$_Filename)){
    move_uploaded_file($_Image, $_Destination."/".$_Filename);
  }
    if(file_exists($_Destination."/".$_Filename))
    {
    $_SQL_2=mysqli_query($con,"UPDATE tblbranch SET logo='$_Filename' WHERE branchid='$_BranchId'");
  if($_SQL_2){
    header("location:select-branch.php");
    }
  }
}
?>


<?php
//Declare the variables
@$_Update_CompanyId=$_POST['update_companyid'];

if(isset($_POST["button_update"]))
{
include("code.php"); 
//Upload Logo
  @$_Filename=$_FILES["backgroundphoto"]["name"];
  @$_Image=$_FILES["backgroundphoto"]["tmp_name"];
  $_Destination="images/logo";

  if(!file_exists($_Destination."/".$_Filename)){
    move_uploaded_file($_Image, $_Destination."/".$_Filename);
  }
  if(file_exists($_Destination."/".$_Filename)){

$sql2 ="UPDATE tblcompany SET backgroundphoto='$_Filename' WHERE companyid='$_Update_CompanyId'";
if(!mysqli_query($con,$sql2)){
die('Error:' .mysqli_error($con));
}
else{
header("location:select-branch.php");
}
}
mysqli_close($con);
}
?>

<?php
if(isset($_GET['select_branch_id']))
{
$_SESSION['BRANCHID']=$_GET['select_branch_id'];

if(!$_SESSION["BRANCHID"]==""){
header("location:admin.php");
}
}
?>

<?php
include("validation/header.php"); 
?>

<html>
<head>
 <?php
  include("title.php");
  ?>
   <?php
  include("links.php");
  ?>
<meta name="viewport" content="width=device-width, initial-scale=1">

<script>
  var rnd;
function getStaffId()
{
rnd=Math.floor( Math.random()*100000000);
document.getElementById("staff-id").value=rnd;
}
</script>
</head>
<body onload="idleLogout()">
  <?php
/*if(!$_SESSION["AUDITDATE"]){
header("location:auditdatealert.php");
}
else{
echo "<div style='font-size:12px;font-family:tahoma;color:royalblue;text-align:left'>Audit Date:". $_SESSION["AUDITDATE"]."</div>";  
}
*/
?>
<div class="pos-main-board"> <!--Start of pos-main-board -->
   <div class="pos-inner-board"><!--Start of pos-inner-board -->
   
  <?php
  include("check-login.php");
?>
<br/>

 <div class="users-login">
<?php
  include("loginlogout.php");
?>
<br/>
<form method="post" action="select-branch.php">
<?php 
//echo "<button name='upload_database' style='background-color:#333' onclick='move()'><i style='color:orange' class='fa fa-upload'></i> Upload Database To Online</button>";
?>
</form>

<table> 
<tr>
<td>
  <?php
  echo $_SESSION['Message'];
  ?>

<?php
    if($_SESSION['SYSTEMTYPE']=="normal_user"){
  ?>
<div class="form-entry">
            <?php
         //Connection to database
         include'dbstring.php';
    
         $_SQL=mysqli_query($con,"SELECT * FROM tblcompany WHERE companyid='$_SESSION[COMPANY]'");
         echo "<table border='1' width='100%'>";
         echo "<caption>ALL BRANCHES</caption>";
          echo "<thead>";
          echo "<th> * </th><th >BRANCH ID</th><th>ADDRESS </th><th>LOCATION </th><th>TEL. 1</th><th>TEL. 2</th> <th colspan='2'>ACTION </th>";
          echo "</thead>";
         while($row_c=mysqli_fetch_array($_SQL,MYSQLI_ASSOC)){
          echo "<form method='post' enctype='multipart/form-data'>";
          echo "<tr>";
      
           echo "<td colspan='8' style='background-color:#ffe'>";
          echo $row_c['fullname']. "(".$row_c['companyid'].")";
          echo "</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td colspan='3' style='background-color:#fff' align='right'>";
          echo "<label>Background Image</label>";
          echo "</td>";
          echo "<td colspan='2'>";
          echo "<input type='hidden' id='update_companyid' name='update_companyid' value='$row_c[companyid]'/>";
          echo "<input type='file' id='backgroundphoto' name='backgroundphoto' /><br/><br/>";
          echo "</td>";
          echo "<td colspan='3'>";
          echo "<button class='button' id='button_update' name='button_update'><i class='fa fa-upload'></i> UPLOAD BACKGROUND IMAGE</button><br/><br/>";
          echo "</td>";
          echo "</tr>";
          echo "</form>";

         $sql1="SELECT br.initials, br.branchid,br.companyid,cp.fullname,br.address,br.location,br.telephone1,br.telephone2,
         br.status FROM tblbranch br INNER JOIN tblcompany cp ON br.companyid=cp.companyid WHERE cp.companyid='$row_c[companyid]' ORDER BY cp.fullname ASC";
         $result=mysqli_query($con,$sql1);

         $count = mysqli_num_rows( $result);
         if($count>0)
         {
         //echo "<div align='center' style='text-transform:uppercase;'> All Branches</div>";
         //}

         @$serial=0;   
         while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
         {
         echo "<tr >";

         echo "<td align='center'>";
         echo $serial=$serial+1 .".";
         echo "</td>";  

        // echo "<td style='min-width:5%;cursor:pointer' align='center'>"; 
         // echo "<button name='$row[location]' style='background-color:white' onclick='move()'><i style='color:blue' class='fa fa-upload'></i></button>";
        // echo "<a  href='select-branch.php?transfer_data_branch_id=$row[branchid]' title='Upload Data of ".$row['location']." to Online'><i style='color:blue' class='fa fa-upload'></i></a>";          
         
         //echo "<a onClick=\"javascript: return confirm('Do you want to upload data of $row[location] to Online?');\" href='select-branch.php?transfer_data_branch_id=$row[branchid]' title='Upload Data of ".$row['location']." to Online'><i style='color:blue' class='fa fa-upload'></i></a>";          
        // echo "</td>";           
          
         echo "<td align='center'>";
         echo $row['branchid'];
         echo "</td>";            

        echo "<td align='center'>";
        echo $row['address'];
        echo "</td>";

        echo "<td align='center'>";
        echo $row['location'];
        echo "</td>";

            echo "<td align='center'>";
            echo $row['telephone1'];
            echo "</td>";

            echo "<td align='center'>";
            echo $row['telephone2'];
            echo "</td>";

            //echo "<td style='min-width:5%;cursor:pointer' align='center'>";          
            //echo "<a href='edit-staff.php?staff_ids=$row[StaffID]' title='Edit ".$row['FullName']."'><i style='color:blue' class='fa fa-edit'></i></a>";          
           // echo "</td>";
           
           // echo "<button style='border:0px solid white;cursor:pointer'><img src='images/icons/remove.png' alt='Remove' width='30px' height='30px'></button>";
            echo "<td style='min-width:5%;cursor:pointer' align='center'>";  
            echo "<a  onClick=\"javascript: return confirm('Do you want to open branch: $row[location] ?');\" href='select-branch.php?select_branch_id=$row[branchid]' title='Open ".$row['location']." branch'><i style='color:green' class='fa fa-file'></i></a>";          
            echo "</td>";
           
            echo "</td>";

            echo "</tr>";
            echo "<form id='formID' name='formID' method='post' enctype='multipart/form-data'>";
             echo "<tr>";
            echo "<td ></td><td align='right'>";
            echo "Branch Logo";           
            echo "</td>";
            echo "<td colspan='2' align='center'>";
            echo "<input type='hidden' name='branchid' value='$row[branchid]' />";
            echo "<input type='hidden' name='initials' value='$row[initials]' />";
            echo "<input type='file' id='logo' name='logo' class='validate[required]'/>";
            echo "</td>";

            echo "<td colspan='2'>";
            echo "<button class='button' id='button_update_logo' name='button_update_logo'><i class='fa fa-upload'></i> UPLOAD BRANCH LOGO</button><br/><br/>";
            echo "</td>";
            echo "</form>";

            echo "</tr>";
         /* $_SQL_MergeBranch=mysqli_query($con,"SELECT * FROM tblsubbranch WHERE branchid='$row[branchid]'");
          if(mysqli_num_rows($_SQL_MergeBranch)>0){  
            echo "<tr>";
            echo "<td colspan='1'></td>";
            echo "<td colspan='6'>";
            echo "<table>";
            echo "<caption>Sub Branch</caption>";
            echo "<thead>";
            echo "<th>Id</th><th>Address</th><th>Location</th><th>Telephone 1</th><th>Telephone 2</th><th>Status</th>";
            echo "</thead>";
            echo "<tbody>";
            /*
            while($rowmb=mysqli_fetch_array($_SQL_MergeBranch,MYSQLI_ASSOC)){
            echo "<tr>";
            echo "<td align='center'>$rowmb[subbranchid]</td>";
            echo "<td align='center'>$rowmb[address]</td>";
            echo "<td align='center'>$rowmb[location]</td>";
            echo "<td align='center'>$rowmb[telephone1]</td>";
            echo "<td align='center'>$rowmb[telephone2]</td>";  
            echo "<td align='center'>";
            if($rowmb['status']=="active"){
              echo "<i class='fa fa-check' style='color:green'></i>";
            }
            echo"</td>";  
            
            echo "</tr>";

             echo "</tr>";
            echo "<form id='formID2' name='formID2' method='post' enctype='multipart/form-data'>";
             echo "<tr>";
            echo "<td ></td><td align='right'>";
            echo "Sub Branch Logo";           
            echo "</td>";
            echo "<td colspan='2' align='center'>";
            echo "<input type='hidden' name='subbranchid' value='$rowmb[subbranchid]' />";
            echo "<input type='hidden' name='subinitials' value='$rowmb[initials]' />";
            echo "<input type='file' id='logo' name='logo' class='validate[required]'/>";
            echo "</td>";

            echo "<td colspan='2'>";
            echo "<button class='button' id='button_update_sublogo' name='button_update_sublogo'><i class='fa fa-upload'></i> UPLOAD SUB BRANCH LOGO</button><br/><br/>";
            echo "</td>";
            echo "</form>";
            echo "</tr>";
            }
            
            echo "</td>";
            echo "</tr>";
            echo "</tbody>";
            echo "</table>";
          }  
          */
          }
       }
          echo "</table>";
         mysqli_close($con);
       }
?>
<?php
}
?>
      </div>
          </td>
      </tr>
   </table>
   </div> <!--End of pos-inner-board-->
</div> <!--End of pos-main-board -->

</body>
</html>