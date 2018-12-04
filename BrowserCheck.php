<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Browser Check</title>
</head>
<?php
//print_r(get_browser_properties());
?>

<?php 
function get_browser_properties(){

$browser =array();
$agent=$_SERVER['HTTP_USER_AGENT'];

if(stripos($agent,"firefox")!==false){
$browser['browser'] = 'Firefox';
$domain = stristr($agent, 'Firefox');
$split =explode('/',$domain);
$browser['version'] = $split[1];
}

if(stripos($agent,"MSIE")!==false){
$browser['browser'] = 'Internet Explorer';
$domain = stristr($agent, 'MSIE');
$split =explode(' ',$domain);
$browser['version'] = $split[1];
}

if(stripos($agent,"Chrome")!==false){
$browser['browser'] = 'Google Chrome';
$domain = stristr($agent, 'Chrome');
$split1 =explode('/',$domain);
$split =explode(' ',$split1[1]);
$browser['version'] = $split[0]; 
}

else if(stripos($agent,"Safari")!==false){
$browser['browser'] = 'Safari'; 
$domain = stristr($agent, 'Version');
$split1 =explode('/',$domain);
$split =explode(' ',$split1[1]);
$browser['version'] = $split[0]; 
}

return $browser['browser'];
}
?>

<?php
 $message = "";
 $browser = get_browser_properties();
 if($browser != "Google Chrome")
 {
	 $message = "Target Aqusition is not supported on this browser";
	 echo "<script type='text/javascript'>alert('$message');</script>";
 }
?>

<body>
<div class="container-fluid columns col-sm-4">
  <div class="panel">
    
  </div>
</div>
</body>
</html>
