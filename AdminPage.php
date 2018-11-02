<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Page</title>
<!--Bootstrap Styling-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<link href="Style.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<script>
function logout()
{
	location.replace('http://localhost/370_Project/login.php');
}
</script>
<div class="topnav">
  <input type="button" syle="float:right" value="Logout" onClick="logout()"/>
</div>
<!--Current Settings-->
<div class="container-fluid columns col-sm-4">
  <div class="panel">
    <h4>Current Settings</h4>
    <p>Allowed Speed: <?php echo "Speed";?></p>
    <p>Allowed Directions: <?php echo "Directions";?></p>
    <p>Sizes: <?php echo "Sizes";?></p>
    <p>Skin: <?php echo "skin";?></p>
    <p>Game Mode: <?php echo "Mode";?></p>
    <p>Time Limit: <?php echo "Limit";?></p>
  </div>
</div>

<div class="container-fluid col-sm-6">
   <div class="panel">
    <form method="post" action="">
      <table class="update">
         <tr>
           <td>Target Distance:</td>
           <td><input type="number" name="TDist"/></td>
         </tr>
         <tr>
           <td>Speed:</td>
           <td><input type="number" name="VSpeed"/></td>
         </tr>
         <tr>
           <td>Score Multiplier:</td>
           <td><input type+"number" name="ScoreMulti"/></td>
         </tr>
         <tr>
           <td>Size:</td>
           <td><input type="number" name="size"/></td>
         </tr>
         <tr>
           <td> Time:</td>
           <td><input type="number" name="time"/></td>
         </tr>
         <tr>
           <td>Change Skin:</td>
           <td><input type="file" name="ImgBrowse"></td>
         </tr>
         <tr>
           <td>Change Sound:</td>
           <td><input type="file" name="SoundBrowse"></td>
         </tr>
         <tr>
           <td>Game Mode:</td>
           <td>
             <select name="ModeSelect">
               <option Value="Default"/>
             </select>
           </td>
         </tr>
         <tr>
           <td></td>
           <td><input type="submit" value="Change Setting"/>
         </tr>
      </table>
  </form>
 </div>
</div>
<div class="container-fluid col-sm-4 columns">
  <div class="panel">
    <form method="post" action="">
      <table>
         <tr>
           <td><input type="button" value="Export to CSV"/></td>
         </tr>
         <tr>
           <td><input type="button" value="Delete Current Database"/></td>
         </tr>
         <tr>
           <td><input type="button" value="Restore Database"/></td>
         </tr>
      </table>
    </form>
  </div>
</div>
    
</body>
</html>