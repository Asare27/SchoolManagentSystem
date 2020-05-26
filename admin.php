<?php
session_start();
?>
<html>
<head>
<?php
include("links.php");
?>

</head>

<body class="body-style" style="background-color:#fff;">
	<div class="header">
	<?php

	include("menu.php");
	?>	
</div>

<div class="main-platform" align="center" ><br/>	
	<table border="0" width="100%">
		<tr>
			<td width="25%" valign="top" style="background-color:#fff;">
			
			<?php
			include("welcome.php");
			include("menuboard.php");
			?>	
			</td>

<td width="75%" valign="top">
<div class="form-entry">
<?php
include("dbstring.php");
$_SQL_EXECUTE=mysqli_query($con,"SELECT * FROM tblsystemuser WHERE date_format(registereddatetime,'%d-%m-%Y')=date_format(NOW(),'%d-%m-%Y') AND (systemtype='Student' OR systemtype='Teacher' OR systemtype='User') ORDER BY registereddatetime DESC");

//Registered clients
echo "<table width='100%' style='background-color:white'>";
				echo "<caption>DAILY REGISTRATION</caption>";
				echo "<thead><th colspan=2>TASK</th><th>STUDENT</th><th>GENDER</th><th>BIRTHDAY</th><th>TYPE</th><th>DATE/TIME</th><th>STATUS</th></thead>";
				echo "<tbody>";
				
				while($row=mysqli_fetch_array($_SQL_EXECUTE,MYSQLI_ASSOC)){
				echo "<tr>";
				echo "<td align='center'><a title='View $row[firstname] ($row[userid])' href='user-profile.php?view_user=$row[userid]'<i class='fa fa-book' style='color:blue'></i></a></td>";
				//echo "<td align='center'><a title='Delete $row[firstname] ($row[userid])' onclick=\"javascript:return confirm('Do you want to delete?');\" href='viewstudents.php?delete_user=$row[userid]'<i class='fa fa-times' style='color:red'></i></a></td>";
				echo "<td align='center'><a title='Edit $row[firstname] ($row[userid])' href='register_edit.php?edit_user=$row[userid]'<i class='fa fa-edit' style='color:green'></i></a></td>";
				//echo "<td>";
				if($row['status']=="active"){
				//echo"<a title='Block $row[firstname] ($row[userid])' href='viewstudents.php?block_user=$row[userid]'<i class='fa fa-user' style='color:orange'></i></a>";
					
			}else{
				//echo"<a title='Unblock $row[firstname] ($row[userid])' href='viewstudents.php?unblock_user=$row[userid]'<i class='fa fa-user' style='color:red'></i></a>";
				
			}
echo "<td>$row[firstname] $row[surname] $row[othernames]($row[userid])</td>";								
echo "<td align='center'>$row[gender]</td>";
echo "<td align='center'>$row[birthday]</td>";
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
?>
</form>
</td>
</tr>
</table><br/><br/>
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