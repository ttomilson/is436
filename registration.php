<!DOCTYPE HTML>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

  <title> Record Customer Requests </title>

	<link rel ="stylesheet" type="text/css" href="form.css" title="style" />


</head>
<body>
<?php


$db = mysqli_connect("studentdb-maria.gl.umbc.edu","there2","there2","there2");


if (mysqli_connect_errno())
		exit("Error can not connect");

if (!empty($_GET['user']) &&
		 !empty($_GET['password'])&&
	 		!empty($_GET['email'])){

		$username =  mysqli_real_escape_string($db, htmlspecialchars($_GET ['user']));
		$email = mysqli_real_escape_string($db, htmlspecialchars($_GET ['email']));
		$pass = mysqli_real_escape_string($db, htmlspecialchars($_GET ['password']));


		$s = "SELECT * from users where username = '$username'";
		$s2 = "SELECT* from customers where email = '$email'";

		$result = mysqli_query($db , $s);
		$resultemail = mysqli_query ($db, $s2);

		$num = mysqli_num_rows($result);
		$num2 = mysqli_num_rows($resultemail);

		if ( ($num == 1) || ($num2 == 1)){
			echo ("This email/username is already in use. Try again");
		?>

		<script type='text/javascript'>
			alert("This email/username is already in use. Try again");
		 	return false;
		</script>
	<?php
		}

	 	else {

		$constructed_query = "INSERT INTO users (username, password) VALUES ('$username','$pass')";

			$result2 = mysqli_query($db,$constructed_query);


			if(!$result2){
				$message = "You could not be registered. Try again.";

				echo "<script type='text/javascript'>alert('$message');</script>";

				header("Location:https://swe.umbc.edu/~there2/is436/website/reg.html");

			}
			else{
			?>
				<script type='text/javascript'>
						var message = "You've successfully registered! Now log in to access website content!"
						alert('$message');
				</script>";
			<?php
				header("Location:https://swe.umbc.edu/~there2/is436/website/login.php");

		}

	}
}

else{

	echo "not all forms filled out";
}

?>
</body>
</html>
