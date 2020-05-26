<?php
session_start();
?>
<html>
<head>
<?php
include("links.php");
?>
</head>
<body class="body-style">
<div class="header">
<?php
include("menu.php");
?>		
</div>
<br/>
<div class="main-platform" align="center" >
<table border="0" width="100%">
<tr>
<td width="25%" valign="top">
<?php
include("welcome.php");
include("menuboard.php");
?>	
</td>
<td width="50%" valign="top">	
</td>
<td width="25%" valign="top">
</td>
</tr>
</table>
</div>
</body>
</html>