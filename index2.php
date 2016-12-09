<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>


<?php
$path = "./example-orders/";
$temp_files = scandir($path);

foreach($temp_files as $file) 
{
    if($file != "." && $file != ".." && $file != "Thumbs.db" && $file != basename(__FILE__)) 
    {
        
		
echo "http://www.digital-productions.be/dev/teamleader/example-orders/".$file;
echo '<br>';

$str1 = file_get_contents("http://www.digital-productions.be/dev/teamleader/example-orders/".$file);
$json1 = json_decode($str1, true); // decoderen van JSON naar een associative array
$json1b[] = $json1;

//echo '<pre>'; 
//print_r($json1);
//echo '</pre>';		

    }
}

echo '<pre>'; 
print_r($json1b);
echo '</pre>';		




?>

</body>
</html>
