<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Password</title>
<!--Bootstrap Styling-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="Style.css" rel="stylesheet" type="text/css"/>
</head>
<body onLoad="ClearForm();">
<script>
function ClearForm()
{
  document.getElementById("LoginForm").reset();
	document.getElementById("uName").value= "";
	document.getElementById("pWord").value= ""; 
}
</script>
<?php 
if(isset($_POST['submit']))
{	
	echo changePass();
}

function changePass()
{	
	$User = htmlspecialchars($_POST['UName']);
  $Pass = hash("sha256", $_POST['PWord']);
	$list = array($User,$Pass);
	$file = fopen("loginInfo.csv", "w+");
	foreach($list as $line)
	{
		fputcsv($file,explode(',',$line));
	}
	fclose($file);
	header( 'Location: http://localhost/370_Project/login.php' );
}
?>
<br />
<div class="login">
<form action="" method="post" id="LoginForm">
    <table width="200" align="center" id="login" class="TLogin">
       <tr>
         <td>Username:</td>
       </tr>
       <tr>
         <td><input type="text" id="uName" name="UName"/></td>
       </tr>
         <td>New Password:</td>
       </tr>
       <tr>
         <td><input type="password" id="newPWord" name="PWord"/></td>
       </tr>
       <tr>
         <td><button type="submit" name="submit">Change Password</button></td>
       </tr>
    </table>
</form>
</div>
</body>
</html>
