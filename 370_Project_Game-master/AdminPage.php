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
include 'createConnection.php';
$conn = ConnectToDB();
$query = 'SELECT * FROM `test_data` ';
$result = $conn->query($query);

//Reset all variables
$distanceNew = "";
$directionNew = "";
$velDirectionNew = "";
$speedNew = "";
$sizeNew = "";

$currentDataJSON = file_get_contents('currentData.json');
$currentData = json_decode($currentDataJSON, true);

$currentDirections = $currentData['0']["DIR"];
$currentVelDirections = $currentData['0']["VDIR"];
$currentDistances = $currentData['0']["DIST"];
$currentSpeed = $currentData['0']["SPEED"];
$currentSizes = $currentData['0']["SIZE"];


if ( $_SERVER["REQUEST_METHOD"] == "POST" and !isset($_POST['exportBtn']) 
										  and !isset($_POST['deleteBtn']) 
									      and !isset($_POST['restoreBtn'])) {
	if (!(empty($_POST['distanceField']))) {
		$distanceNew = $_POST['distanceField'];
		shell_exec("python changeDistance.py $distanceNew");
		$currentData['0']["DIST"] = $distanceNew;
		$currentDataJSON = json_encode($currentData);
		file_put_contents('currentData.json', $currentDataJSON);
		$currentSpeed = $speedNew;
		echo 'Wrote distance to file.';
	} 
	
	if (!(empty($_POST['directionField']))) {
		$directionNew = $_POST['directionField'];
		shell_exec("python changeDirection.py $directionNew");
		$currentData['0']["DIR"] = $directionNew;
		$currentDataJSON = json_encode($currentData);
		file_put_contents('currentData.json', $currentDataJSON);
		$currentDirection = $directionNew;
		echo 'Wrote direction to file.';
	} 
	
	if (!(empty($_POST['velocityDirectionField']))) {
		$velDirectionNew = $_POST['velocityDirectionField'];
		shell_exec("python changeVelocityDirection.py $velDirectionNew");
		$currentData['0']["VDIR"] = $velDirectionNew;
		$currentDataJSON = json_encode($currentData);
		file_put_contents('currentData.json', $currentDataJSON);
		$currentVelDirection = $velDirectionNew;
		echo 'Wrote velocity direction to file.';
	} 
	
	if (!(empty($_POST['sizeField']))) {
		$sizeNew = $_POST['sizeField'];
		shell_exec("python changeSize.py $sizeNew");
		$currentData['0']["SIZE"] = $sizeNew;
		$currentDataJSON = json_encode($currentData);
		file_put_contents('currentData.json', $currentDataJSON);
		$currentSize = $sizeNew;
		echo 'Wrote size to file.';
	} 
	
	if (!(empty($_POST['scoreField']))) {
		$scoreNew = $_POST['scoreField'];
		echo $scoreNew;
		$currentData['0']["SCORE"] = $scoreNew;
		$currentDataJSON = json_encode($currentData);
		file_put_contents('currentData.json', $currentDataJSON);
		$currentScore = $scoreNew;
		echo 'Wrote score to file.';
	}
	
	if (!(empty($_POST['speedField']))) {
		$speedNew = $_POST['speedField'];
		shell_exec("python changeSpeed.py $speedNew");
		$currentData['0']["SPEED"] = $speedNew;
		$currentDataJSON = json_encode($currentData);
		file_put_contents('currentData.json', $currentDataJSON);
		$currentSpeed = $speedNew;
		echo 'Wrote speed to file.';
	}
	
	if (!(empty($_POST['timeField']))) {
		$timeNew = $_POST['timeField'];
		$currentData['0']["TIME"] = $timeNew;
		$currentDataJSON = json_encode($currentData);
		file_put_contents('currentData.json', $currentDataJSON);
		$currentSpeed = $timeNew;
		echo 'Wrote time to file.';
	}  
	
	//Always refreshes page
	header("Refresh:0");
}else if( $_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST['exportBtn'])){
		echo 'Got export';		
		
		$myFile = "dataFile.csv";
		$fo = fopen($myFile, 'w') or die("can't open file");
		$columns = array("ID", "input", "age", "skill", "score", "theme", "Targets");
		$rows = array();
		$result = $conn->query($query);
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;    // Add the row to rows
		}
		fwrite($fo, json_encode($rows, JSON_PRETTY_PRINT));
		fclose($fo);
	
		if(file_exists($file)){
			header('Content-Type: text/csv');
			header('Content-Length: '.filesize($file));
			header('Content-Disposition: attachment; filename='.$file);
			readfile($file);
			exit;
		}
	}
	
	if(isset($_POST['deleteBtn'])){
		echo 'Got delete';		
		include '/db_connect/databaseController.php';
		DeleteData();
	}
	
	if(isset($_POST['restoreBtn'])){
		echo 'Got restore';		
		include '/db_connect/databaseController.php';
		$fileName = $_POST['restoreField'];
		RestoreTable($fileName);
	}
	
	// Create and get dataFile.csv ready to write.

}	
	
?>

<h3 align="center">Target Acquisition Administrative Panel</h3>
<div class="topnav">
<ul>
  <li><a href="admin.php">Game Data</a></li>
  <li style="float:right"><input type="button" syle="float:right" value="Logout" onClick="logout()"/></li>
</ul>
</div>
<br />
<!--Current Settings-->
<div class="container-fluid columns col-sm-4">
  <div class="panel">
    <h4>Current Settings</h4>
    <p>Allowed Speed: <?php echo $currentSpeed;?></p>
    <p>Allowed Directions: <?php echo $currentDirections;?></p>
	<p>Allowed Velocity Directions: <?php echo $currentVelDirections;?></p>
    <p>Allowed Distances: <?php echo $currentDistances;?></p>
    <p>Sizes: <?php echo $currentSizes;?></p>
  </div>
</div>

<div class="container-fluid col-sm-6">
   <div class="panel">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <table align="center" class="update">
         <tr>
           <td>Speed:</td> <!--Changes allowed speed interval, must be (0-999)-(0-999) --> 
           <td><input type="text" name="speedField" pattern="[0-9]{1,3}[-]{0,1}[0-9]{0,3}" value="" placeholder="#-#"/></td> 
         </tr>
         <tr>
           <td>Direction:</td>
           <td><input type="text" name="directionField" pattern="[N, E, S, W, NE, NW, SE, SW]{1}[[,][N, E, S, W, NE, NW, SE, SW]]" placeholder="XX"/></td>
         </tr>
		 <tr>
           <td>Velocity Direction:</td>
           <td><input type="text" name="velocityDirectionField" pattern="[N, E, S, W, NE, NW, SE, SW]{1}[[,][N, E, S, W, NE, NW, SE, SW]]" placeholder="XX"/></td>
         </tr>
	 <tr>
	 	<td>Distance:</td>
		<td><input type="text" name="distanceField" value="" placeholder="#-#"/></td>
	</tr>
         <tr>
           <td>Size:</td> <!-- Changes range of sizes, if only one size is allowed set both values to the same value-->
           <td><input type="text" name="sizeField" /></td>
         </tr>
         <tr>
           <td colspan="2"><input type="submit" name="submit" value="Change Settings"></td>
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
           <td><input type="submit" class="button" name='exportBtn' value="Export to CSV"/></td>
         </tr>
         <tr>
           <td><input type="submit" name='deleteBtn' value="Delete Current Database"/></td>
         </tr>
         <tr>
           <td><input type="submit" name='restoreBtn' value="Restore Database"/></td>
		   <td>File to restore:</td>
		   <tc><input type="text" name='restoreField' value=""/></td>
         </tr>
      </table>
    </form>
  </div>
</div>
</body>
</html>