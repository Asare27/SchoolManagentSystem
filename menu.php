<?php
include("check-login.php");
?>
<html>
<head>
    <script type="text/javascript">
function SearchItem(str)
{
  if(str=="")
  {
  document.getElementById("search-student").innerHTML="";
  return;
  }
  else
  {
    if(window.XMLHttpRequest)
    {
      xmlhttp = new XMLHttpRequest();
    }
    else
    {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function()
    {
      if(this.readyState==4 && this.status==200)
      {
        document.getElementById("search-student").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","display-student-items.php?search-item="+str,true);
    xmlhttp.send();
  }
}
</script>

<style>

button{
	background-color: transparent;
	border:0px solid gray;
	padding: 10px;
	cursor: pointer;
     font-size: 10px;
     font-family: sans-serif;

}
/* Style The dropdownNew Button */
.dropbtnNew {
    background-color: transparent;
    color: #222;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

/* The container <div> - needed to position the dropdownNew content */
.dropdownNew {
    position: relative;
    display: inline-block;
}

/* dropdownNew Content (Hidden by Default) */
.dropdownNew-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 130px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.3);

}

/* Links inside the dropdownNew */
.dropdownNew-content a {
    color: black;
    padding: 1px 5px;
    text-decoration: none;
    display: block;

}

/* Change color of dropdownNew links on hover */
.dropdownNew-content a:hover {background-color: #f1f1f1}

/* Show the dropdownNew menu on hover */
.dropdownNew:hover .dropdownNew-content {
    display: block;
}

/* Change the background color of the dropdownNew button when the dropdownNew content is shown */
.dropdownNew:hover .dropbtnNew {
    background-color: #fff;
}
</style>
<style type="text/css">
#searchbar{
    background-color: #ffffff;
    color:white;
    padding:10px;
    margin-top:-10px;
    margin-right: -20px;
    position: fixed;
    width:100%;
    border-bottom: 8px solid #eeeeee;
}
#searchbar input[type=text]{
    background-color: white;
    text-align: center;
    height: 35px;
    border:1px solid #ffffff;
    border-radius:4px;
    color:#666666;
    font-size: 100%;
}
#searchbar input[type=text]:hover{
    background-color: white;
    text-align: center;
    height: 35px;
    border:1px solid #ffffff;
    border-radius:4px;
    color:#222222;
}
#searchbar input[type=text]:focus{
    background-color: white;
    text-align: center;
    height: 35px;
    border:1px solid #ffffff;
    border-radius:4px;
    color:black;
}
</style>
</head>
<body>

<?php
if($_SESSION["SYSTEMTYPE"]=="Student")
{
}else{
?>
<div id="searchbar">
<div>
<input type="text" id="search_student" name="search_student" placeholder="Type Index Number/Firstname/Othernames/Surname" onkeyup="SearchItem(this.value)"/>
</div>
<div id="search-student" name="search-student"></div>
</div>
<?php
}
?>

<br/><br/>

	<div style="padding:2px;" align="right">

	<div class="dropdownNew">

<?php
if($_SESSION['ACCESSLEVEL']=="user" && $_SESSION['SYSTEMTYPE']=="User")
{
?>
<a href="user.php" title="Click To Home Page">  <button class="dropbtnNew"><i class="fa fa-home"></i> Home</button></a>
<?php
}
elseif($_SESSION['ACCESSLEVEL']=="user" && $_SESSION['SYSTEMTYPE']=="Teacher")
{
?>
  <a href="teacher-page.php" title="Click To Home Page">  <button class="dropbtnNew"><i class="fa fa-home"></i> Home</button></a>
<?php
}
 elseif($_SESSION['ACCESSLEVEL']=="user" && $_SESSION['SYSTEMTYPE']=="Student")
 {
 ?>
 <a href="student-page.php" title="Click To Home Page">  <button class="dropbtnNew"><i class="fa fa-home"></i> Home</button></a>
<?php
}
elseif($_SESSION['ACCESSLEVEL']=="administrator" && $_SESSION['SYSTEMTYPE']=="normal_user")
{
 ?>
<a href="admin.php" title="Click To Home Page">  <button class="dropbtnNew"><i class="fa fa-home"></i> Home</button></a>
<?php
}
elseif($_SESSION['ACCESSLEVEL']=="administrator" && $_SESSION['SYSTEMTYPE']=="super_user")
{
 ?>
<a href="super.php" title="Click To Home Page">  <button class="dropbtnNew"><i class="fa fa-home"></i> Home</button></a>
<?php
}
?>
  <div class="dropdownNew-content">
  
    <?php
//include("check-login.php");
//session_start();
if($_SESSION['ACCESSLEVEL']=="user" && $_SESSION['SYSTEMTYPE']=="User")
{
  ?>
<div id="admin" align="left" style="margin-top:5px;">
<a href="edit-account.php"><button><i class="fa fa-user" style="color:brown"></i> Edit Profile</button></a>
<a href="viewusers.php"><button><i class="fa fa-user" style="color:royalblue"></i> View Teachers</button></a>
<a href="viewstudents.php"><button><i class="fa fa-user" style="color:royalblue"></i> View Students</button></a>
<a href="register-student.php"><button><i class="fa fa-user" style="color:royalblue"></i> Register Student</button></a>
<a href="register-teacher.php"><button><i class="fa fa-user" style="color:royalblue"></i> Register Teacher</button></a>

<a href="upload-register.php"><button><i class="fa fa-upload" style="color:blue"></i> Upload Registers</button></a>
<a href="logout.php"><button><i class="fa fa-power-off" style="color:red"></i> Logout </button></a>
</div>
<?php
}
elseif($_SESSION['ACCESSLEVEL']=="user" && $_SESSION['SYSTEMTYPE']=="Teacher"){
 ?>
<div id="admin" align="left" style="margin-top:5px;">
<a href="edit-account.php"><button><i class="fa fa-user" style="color:brown"></i> Edit Profile</button></a>
<a href="logout.php"><button><i class="fa fa-power-off" style="color:red"></i> Logout </button></a>
</div>
<?php
}

elseif($_SESSION['ACCESSLEVEL']=="user" && $_SESSION['SYSTEMTYPE']=="Student"){
 ?>
<div id="admin" align="left" style="margin-top:5px;">
<a href="edit-account.php"><button><i class="fa fa-user" style="color:brown"></i> Edit Profile</button></a>
<a href="logout.php"><button><i class="fa fa-power-off" style="color:red"></i> Logout </button></a>
</div>
<?php
}

elseif($_SESSION['ACCESSLEVEL']=="administrator" && $_SESSION['SYSTEMTYPE']=="normal_user"){
 ?>
<div id="admin" align="left" style="margin-top:5px;">
<a href="edit-account.php"><button><i class="fa fa-user" style="color:brown"></i> Edit Profile</button></a>
<a href="blocked-users.php"><button><i class="fa fa-lock" style="color:royalblue"></i> Blocked Users</button></a>
<a href="register.php"><button><i class="fa fa-user" style="color:royalblue"></i> Register User</button></a>
<a href="register-student.php"><button><i class="fa fa-user" style="color:royalblue"></i> Register Student</button></a>
<a href="register-teacher.php"><button><i class="fa fa-user" style="color:royalblue"></i> Register Teacher</button></a>


<a href="upload-register.php"><button><i class="fa fa-upload" style="color:blue"></i> Upload Registers</button></a>

<a href="listusers.php"><button><i class="fa fa-user" style="color:royalblue"></i> View Users</button></a>
<a href="viewusers.php"><button><i class="fa fa-user" style="color:royalblue"></i> View Teachers</button></a>
<a href="viewstudents.php"><button><i class="fa fa-user" style="color:royalblue"></i> View Students</button></a>
<?php
echo "<a  onclick=\"javascript:return confirm('Do you want to clear database?');\" href='global_deletes.php'><button><i class='fa fa-book' style='color:green'></i> Empty Data </button></a>";
?>

<!--<a href="backup_db.php"><button class="btn-menu"><i class="fa fa-book" style="color:royalblue"></i> Backup </button></a>-->
<a href="logout.php"><button><i class="fa fa-power-off" style="color:red"></i> Logout </button></a>
</div>
<?php
}
elseif($_SESSION['ACCESSLEVEL']=="administrator" && $_SESSION['SYSTEMTYPE']=="super_user"){
 ?>
<div id="admin" align="left" style="margin-top:5px;">
<a href="edit-account.php"><button><i class="fa fa-user" style="color:brown"></i> Edit Profile</button></a>
<a href="blocked-users.php"><button><i class="fa fa-lock" style="color:royalblue"></i> Blocked Users</button></a>
<a href="register-super.php"><button ><i class="fa fa-user" style="color:maroon"></i> Register</button></a>
<a href="register-student.php"><button><i class="fa fa-user" style="color:royalblue"></i> Register Student</button></a>
<a href="register-teacher.php"><button><i class="fa fa-user" style="color:royalblue"></i> Register Teacher</button></a>

<a href="upload-register.php"><button><i class="fa fa-upload" style="color:blue"></i> Upload Registers</button></a>

<a href="listusers.php"><button><i class="fa fa-user" style="color:maroon"></i> View Users</button></a>
<a href="viewusers.php"><button><i class="fa fa-user" style="color:brown"></i> View Teachers</button></a>
<a href="viewstudents.php"><button><i class="fa fa-user" style="color:maroon"></i> View Students</button></a>
<a href="backup_db.php"><button><i class="fa fa-book" style="color:green"></i> Backup </button></a>
<a href="generateapikey.php"><button><i class="fa fa-book" style="color:green"></i> API KEY </button></a>

<?php
echo "<a  onclick=\"javascript:return confirm('Do you want to clear database?');\" href='global_deletes.php'><button><i class='fa fa-book' style='color:green'></i> Empty Data </button></a>";
?>
<a href="logout.php"><button><i class="fa fa-power-off" style="color:red"></i> Logout </button></a>
</div>
<?php
}
?>
</div>
</div>
</div>
</body>
</html>
