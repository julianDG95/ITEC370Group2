<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
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
	echo FindUser();
}

function FindUser()
{	
	$User = htmlspecialchars($_POST['UName']);
    $Pass = htmlspecialchars($_POST['PWord']);
	$file = fopen("loginInfo.csv","r");
	$success = false;
	while (($row = fgetcsv($file, 0, ",")) !== FALSE)
	{
		if($row[0] == $User && $row[1] == $Pass)
		{	
			$success = true;
			header( 'Location: http://localhost/370_Project/AdminPage.php' );
		}
	}
	return $success;
}
?>
<div class="login">
<form action="" method="post" id="LoginForm">
    <table width="200" align="center" id="login" class="TLogin">
       <tr>
         <td>Username:</td>
       </tr>
       <tr>
         <td><input type="text" id="uName" name="UName"/></td>
       </tr>
       <tr>
         <td>Password:</td>
       </tr>
       <tr>
         <td><input type="password" id="pWord" name="PWord"/></td>
       </tr>
       <tr>
         <td><button type="submit" name="submit">Login</button></td>
       </tr>
    </table>
</form>
</div>
</body>
</html>