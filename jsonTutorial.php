<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<form action="jsonTutorial.php" method="post">
   Id:
   <input type="text" name="inputID" placeholder="Enter ID"/>
   <br />
   Size:
   <input type="text" name="inputSize" placeholder="Enter Size"/>
   <br />
   <button type="submit" id="sub" name="Submit">Submit</button>
</form>
<?php
$jsonObj = file_get_contents('tutorialObj.json');
$data = json_decode($jsonObj, true);

function setSize($id, $size)
{
	foreach($data as $key => $input)
	{
		if($input['ID']==$id)
		{
			$data[$key]['Size'] = $size;
		}
	}
}
$newJsonObj = json_encode($data);
file_put_contents('tutorialObj.json');
?>
<br />
<br />
<?php
 $ID = $_POST["inputID"];
 $NewSize = $_POST["inputSize"];
 echo "Id: " . $ID;
 echo "New Size: " . setSize($ID,$NewSize);
?>
</body>
</html>