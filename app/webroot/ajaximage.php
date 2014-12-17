<?php

session_start();
if (!(is_numeric($_SESSION['uida']) && $_SESSION['uida'] > 0)) exit();
session_write_close();


$path = "/uploads/";

$valid_formats = array("jpg", "png", "gif","jpeg");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
$name = $_FILES['photoimg']['name'];
$size = $_FILES['photoimg']['size'];
if(strlen($name))
{
list($txt, $ext) = explode(".", $name);
if(in_array($ext,$valid_formats))
{
if($size<(1024*1024)) // Image size max 1 MB
{
$actual_image_name = time().rand(1000,9999).".".$ext;
$tmp = $_FILES['photoimg']['tmp_name'];
if(move_uploaded_file($tmp, $path.$actual_image_name))
{
//mysql_query("UPDATE users SET profile_image='$actual_image_name' WHERE uid='$session_id'");
$r = array(
	"status"=>1,
	"imagename"=>$actual_image_name,
);
}
else
$r = array(
	"status"=>0,
	"msg"=>"failed",
);
}
else
$r = array(
	"status"=>0,
	"msg"=>"Maksymalna wielkość pliku 1 MB",
);
}
else
$r = array(
	"status"=>0,
	"msg"=>"Nieprawidłowy format pliku",
);
}
else
$r = array(
	"status"=>0,
	"msg"=>"Wybierz zdjęcie!",
);
}

header("Content-Type: application/json; charset='utf-8'");
echo json_encode($r);
exit;
