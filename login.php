<!DOCTYPE html>
<!-- mypage.html first lab      -->
<html lang="en">
<head>
	<title> Login </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel ="stylesheet" type="text/css" href="form.css" title="style" />
</head>

<body>
	<h1> Tawle's Event Planning <br /> </h1>

<div class="loginbox">

<h2> Login Here </h2>
	<form action= "validation.php" method= "get">

	<label >

		Username:
			<input type = "text" name = "user" size = "25" maxlength="25" class=  required>

	</label>

		<br />
		<br />

	<label >
		Password:
		<input type="password" id="pass" name="password"
	           minlength="7" required>
	</label>


	<br />
	<br />

	<input type = "submit" value=" Login"/>
</div>

</form>
</body>
</html>
