<?php
session_start();
?>
<?php
$_SESSION['Message']="";
$_SESSION['USERID']="";
$_SESSION['USERNAME']="";
$_SESSION['CURRENCY']="";
$_SESSION['SYMBOL']="";
$_SESSION['ACCESSLEVEL']="";
$_SESSION['SYSTEMTYPE']="";
$_SESSION['BRANCHID']="";
$_SESSION["AUDITDATE"]="";

include("deviceinformation.php");
@$obj_device=new DeviceInformation();
$obj_device->setIPaddr(1);
@$IPAddress=$obj_device->getIPaddr();
@$obj_os=new DeviceInformation();
$obj_os->setOS(1);
@$OS=$obj_os->getOS();
@$obj_browser=new DeviceInformation();
$obj_browser->setBrowser(1);
@$_Browser=$obj_browser->getBrowser();
@$_DeviceInfo="IP:".$IPAddress.", OS:".$OS.", Browser:".$_Browser;
?>

<?php
include("dbstring.php");
$_SQL_Item_2=mysqli_query($con,"SELECT * FROM tblcurrency");
if($row_item_2=mysqli_fetch_array($_SQL_Item_2,MYSQLI_ASSOC)){
$_SESSION['CURRENCY']=$row_item_2['currencyname'];
$_SESSION['SYMBOL']=$row_item_2['symbol'];
}

if(isset($_POST["login"])){
$_Username=$_POST["username"];
$_Password=md5($_POST["password"]);

$_SQL_EXECUTE=mysqli_query($con,"SELECT * FROM tblsystemuser su INNER JOIN tblbranch br ON su.branchid=br.branchid  WHERE su.username='$_Username' AND su.password='$_Password'");

//$_SQL_EXECUTE=mysqli_query($con,"SELECT * FROM tblsystemuser su  WHERE su.username='$_Username' AND su.password='$_Password'");
	if(mysqli_num_rows($_SQL_EXECUTE)>0){
		if($row=mysqli_fetch_array($_SQL_EXECUTE,MYSQLI_ASSOC)){
			@$_AccessLevel=$row['accesslevel'];
			@$_SystemType=$row['systemtype'];
			$_SESSION['USERID']=$row['userid'];
			$_SESSION['USERNAME']=$row['username'];
			@$_Userfullname=$row['firstname']." ".$row['othernames']." ".$row['surname'];
			$_SESSION['FULLNAME']=$_Userfullname;
			$_SESSION['ACCESSLEVEL']=$row['accesslevel'];
			$_SESSION['SYSTEMTYPE']=$row['systemtype'];
			$_SESSION['BRANCHID']=$row['branchid'];
			$_SESSION['COMPANY']=$row['companyid'];

		   //CREATE AUDIT DATE
		  include("code.php");
		  @$_AuditId=$code;
		  $_SQLAD=mysqli_query($con,"INSERT INTO tblauditdate(auditid,auditdate,status,deviceinformation,recordedby,branchid)
		  VALUES('$_AuditId',NOW(),'active','$_DeviceInfo','$_SESSION[USERID]','$_SESSION[BRANCHID]')");
		  if($_SQLAD){
		    $_SQLU=mysqli_query($con,"UPDATE tblauditdate ad SET ad.status='sealed' WHERE ad.status='active' AND date_format(ad.auditdate,'%d-%m-%Y')<>date_format(NOW(),'%d-%m-%Y')");
		    if($_SQLU){}
		  }
		  //Get the Audit Date
		  $_SESSION["AUDITDATE"]="";
		  $_SQLAD=mysqli_query($con,"SELECT * FROM tblauditdate ad WHERE date_format(ad.auditdate,'%d-%m-%Y')=date_format(NOW(),'%d-%m-%Y') AND ad.status='active'");
		  if($rowad=mysqli_fetch_array($_SQLAD,MYSQLI_ASSOC)){
		  $_SESSION["AUDITDATE"]=$rowad["auditdate"];
		  }

			if($row['status']=="block"){
			$_SESSION['Message']="<div style='color:red;text-align:center;padding:8px;text-transform:blink'>Account is blocked!! Please contact administrator</div>";
			}else{
				if($_AccessLevel=="administrator" && $_SystemType=="super_user"){
					header("location:super.php");
				}
				elseif($_AccessLevel=="administrator" && $_SystemType=="normal_user"){
					//header("location:admin.php");
					header("location:select-branch.php");
				}
				elseif($_AccessLevel=="user" && $_SystemType=="Student"){
					header("location:student-page.php");
				}
				elseif($_AccessLevel=="user" && $_SystemType=="Teacher"){
					header("location:teacher-page.php");
				}
				elseif($_AccessLevel=="user" && $_SystemType=="User"){
					header("location:user.php");
				}	
			}
		}
	}
	else
	{
		$_Error=mysqli_error($con);
		$_SESSION['Message']="<div style='color:red;text-align:center;padding:8px;'>Failed to login.$_Error. Try again!!</div>";
	}
}
?>

<html>
<head>
<?php
include("links.php");
?>
<?php
include("validation/header.php");
?>
</head>
<?php
include("backgroundphoto.php");
?>
<body style="background-image: url('images/logo/<?php echo $_BackgroundPhoto;?>');background-size:100%"> 
<?php
?>
	<!--Header-->
	<div class="index-header">
	<?php 
	include("header.php");
	?>
	</div>

<div class="main" align="center" style="">
		<!--Login-->
		<div class="login" align="left">
			
			<form id="formID" name="formID" method="post" action="index.php">
				<h3 style="color:royalblue" align="left"><img src="images/xsoft-logo.png" style="border:0px solid gray" width="55%" height="5%"> System Login</h3>
				<?php
			echo @$_SESSION['Message'];
			?>
			<label>User Name</label><br/>
			<input type="text" id="username" name="username" placeholder="Type Username" class="validate[required]"/><br/>
			<br/>
			<label>Password</label><br/>
			<input type="password" id="password" name="password" placeholder="Type Password" class="validate[required]"/>
			<br/>
			<br/>
<div align="center"><button class="button-save" id="login" name="login"><i class="fa fa-lock"></i> SECURITY LOGIN</button></div>
</form>
<br/>
    <p align="center" style="color:royalblue;font-family:tahoma;border-top:1px solid #dddddd;"><i class="fa fa-phone"></i> BTC: +233(0)342292121</p>
    <p align="center" style="font-size:10px;color:maroon;font-family:helvetica;">&copy 2020. XSCHOOL V2.20.1.2<br/> All Rights Reserved</p>

</div>
</div>
</body>
</html>