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
<!--Should be a validation check here ( in javascript block) -->

<script>
//Sends user back to login page
function logout()
{
	location.replace('http://localhost/370_Project/login.php');
}
</script>


<?php
//Reset all variables
$distanceNew = "";
$directionNew = "";
$speedNew = "";
$sizeNew = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST['distanceField'])) {
		$distanceNew = "";
	}else {
		$distanceNew = $_POST['distanceField'];
		shell_exec("python changeDistance.py $distanceNew");
		echo 'Wrote distance to file.';
	} 
	if (empty($_POST['directionField'])) {
		$directionNew = "";
	}else {
		$directionNew = $_POST['directionField'];
		shell_exec("python changeDirection.py $directionNew");
		echo 'Wrote direction to file.';
	} 
	if (empty($_POST['sizeField'])) {
		$sizeNew = "";
	}else {
		$sizeNew = $_POST['sizeField'];
		shell_exec("python changeSize.py $sizeNew");
		echo 'Wrote size to file.';
	} 
	if (empty($_POST['speedField'])) {
		$speedNew = "";
	}else {
		$speedNew = $_POST['speedField'];
		shell_exec("python changeSpeed.py $speedNew");
		echo 'Wrote speed to file.';
	} 
}  
?>


<div class="topnav">
  <input type="button" syle="float:right" value="Logout" onClick="logout()"/>
</div>
<!--Current Settings-->
<div class="container-fluid columns col-sm-4">
  <div class="panel">
    <h4>Current Settings</h4>
    <p>Allowed Speed: <?php echo "Speed";?></p>
    <p>Allowed Directions: <?php echo "Directions";?></p>
    <p>Allowed Distances: <?php echo "distanceField";?></p>
    <p>Sizes: <?php echo "Sizes";?></p>
    <p>Skin: <?php echo "skin";?></p>
    <p>Game Mode: <?php echo "Mode";?></p>
    <p>Time Limit: <?php echo "Limit";?></p>
  </div>
</div>

<div class="container-fluid col-sm-6">
   <div class="panel">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <table class="update">
         <tr>
           <td>Speed:</td> <!--Changes allowed speed interval, must be (0-999)-(0-999) --> 
           <td><input type="text" name="speedField" pattern="[0-9]{1,3}[-]{0,1}[0-9]{0,3}" value="" placeholder="#-#"/></td> 
         </tr>
         <tr>
           <td>Direction:</td>
           <td><input type="text" name="directionField" pattern="[N, E, S, W, NE, NW, SE, SW]{1}[[,][N, E, S, W, NE, NW, SE, SW]]" placeholder="XX"/></td>
         </tr>
	 <tr>
	 	<td>Distance:</td>
		<td><input type="text" name="distanceField" value="" placeholder="#"/></td>
	</tr>
         <tr>
           <td>Score Multiplier:</td> <!-- Changes score modifier, must be a decimal value that will multiply the default score per target clicked--> 
           <td><input type="number" name="ScoreMulti" pattern="[0-9]{1}[.]{1,1}[0-9]{1,3}" placeholder="#.#"/></td>
         </tr>
         <tr>
           <td>Size:</td> <!-- Changes range of sizes, if only one size is allowed set both values to the same value-->
           <td><input type="text" name="sizeField" placeholder="#-#"/></td>
         </tr>
         <tr>
           <td>Time:</td> <!-- Set seconds, only allows 1-3 digits-->
           <td><input type="text" name="timeField" pattern="[0-9]{1,3}" placeholder="#-#"/></td>
         </tr>
         <tr>
           <td>Change Skin:</td> <!-- Choose skin via radio button -->
           <td><input type="radio" name="skinRadioBtn"> Skin</td>
         </tr>
         <tr>
           <td>Change Sound:</td>`
           <td><input type="file" id="SoundBrowse"></td>
         </tr>
         <tr>
           <td>Game Mode:</td>
           <td>
             <select name="ModeSelect">
               <option value="Default">Default</option>
             </select>
           </td>
         </tr>
         <tr>
           <td></td>
           <td><input type="submit" name="submit" value="Change Settings"/>
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
<?php
echo $distanceNew
?>    
</body>
</html>