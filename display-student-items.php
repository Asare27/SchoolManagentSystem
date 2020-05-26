<div class="form-entry">
<?php
session_start();
	include("dbstring.php");
 if($_SESSION["SYSTEMTYPE"]=="super_user" || $_SESSION["SYSTEMTYPE"]=="normal_user"){
    
	@$_Student =trim($_GET['search-item']);

	$sql="SELECT * FROM tblsystemuser itm WHERE (itm.firstname LIKE '%$_Student%' AND itm.systemtype='Student') OR (itm.surname LIKE '%$_Student%' AND itm.systemtype='Student') OR (itm.othernames LIKE '%$_Student%' AND itm.systemtype='Student') OR  (itm.userid LIKE '%$_Student%' AND itm.systemtype='Student')  ORDER BY itm.firstname ASC";
	$result =mysqli_query($con,$sql);
 $count=mysqli_num_rows($result);

	echo "<table border='1'>";
  echo "<caption>$count Students Found</caption>";
    echo "<thead>";
    echo "<th colspan='3'>Action</th><th>Index Number</th><th>Full Name</th><th>Home Address</th><th>Next of Kin</th><th>Contact</th>";
    echo "</thead>";
    echo "<tbody>";
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
      echo "<tr>";
      echo "<td align='center'>";
     if($_SESSION["SYSTEMTYPE"]=="super_user" || $_SESSION["SYSTEMTYPE"]=="normal_user"){
    echo "<a  href='payments.php?userid=$row[userid]' title='Click for Payment ".$row['firstname']."'><i class='fa fa-money' style='color:green'></i> </a>";          
      }
     echo "</td>";
     echo "<td align='center'>";
     if($_SESSION["SYSTEMTYPE"]=="super_user" || $_SESSION["SYSTEMTYPE"]=="normal_user"){
      echo "<a  href='register_edit.php?edit_user=$row[userid]' title='Update Profile of ".$row['firstname']."'><i class='fa fa-edit' style='color:olive'></i> </a>";          
      }
      echo "</td>";
       echo "<td align='center'>";
     if($_SESSION["SYSTEMTYPE"]=="super_user" || $_SESSION["SYSTEMTYPE"]=="normal_user"){
      echo "<a  href='register.php?block_user=$row[userid]' title='Block ".$row['firstname']."'><i class='fa fa-user' style='color:red'></i> </a>";          
      }
      echo "</td>";

      echo "<td align='center'>";
      echo $row['userid'];
      echo "</td>";

      echo "<td>";
      echo strtoupper($row['firstname']." ".$row['othernames']." ".$row['surname']);
      echo "</td>";

      echo "<td>";
      echo $row['homeaddress'];
      echo "</td>";

      echo "<td>";
      echo $row['nextofkin_fullname'];
      echo "</td>";

      echo "<td align='center'>";
      echo $row['nextofkin_contact'];
      echo "</td>";
     
      echo "</tr>";
     }
    echo "</tbody>";
    echo "</table>";
	mysqli_close($con);
}
	?>
</div><br/>