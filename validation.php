<?php
session_start();
$_SESSION['login_user'] = $name1;


$db = mysqli_connect("studentdb-maria.gl.umbc.edu","there2","there2","there2");

if (mysqli_connect_errno())
		exit("Error can not connect");
	if (!empty($_GET['user']) &&
		 !empty($_GET['password']))

$name1 = htmlspecialchars($_GET ['user']);
$pass1 = htmlspecialchars($_GET ['password']);

$s = "SELECT * from users where username = '$name1' && password = '$pass1'  ";

$result = mysqli_query($db , $s);
$num = mysqli_num_rows($result);

if ( $num == 1){
	$_SESSION['login_user'] = $name1;
	header("Location: https://swe.umbc.edu/~there2/is436/website/homepage.php");
die();

} else {
	header("Location:https://swe.umbc.edu/~there2/is436/website/login.php");



}

?>
