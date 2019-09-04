<?php
	session_start();

	if(isset($_SESSION['login_user'])){
		$username = $_SESSION['login_user'];
	}
?>
<!-- Written by Theresa Tomilson. Displays all messages sent to the user-->
<!DOCTYPE HTML>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

  <title> View Received Messages </title>

	<link rel ="stylesheet" type="text/css" href="form.css" title="style" />


</head>
<body>
  <!--navigation bar-->
  	<?php

  #appears only if variable username has been set by the session variable
  if ((isset($username)) && ($username == 'admin'))  {

		$db = mysqli_connect("studentdb-maria.gl.umbc.edu","there2","there2","there2");

		if (mysqli_connect_errno())	exit("Error - could not connect to MySQL");
  ?>
	<h1> Current Customers </h1>
    <ul>
			<li> <a href = "https://swe.umbc.edu/~there2/is436/website/customerrequests.php" > View Customer Requests </a> </li>
			<li> <a href = "https://swe.umbc.edu/~there2/is436/website/viewinvoice.php" > View invoices </a> </li>
			<li> <a href = "https://swe.umbc.edu/~there2/is436/website/viewevents.php"> View and Edit Scheduled Events </a> </li>
			<li> <a href = "https://swe.umbc.edu/~there2/is436/website/customerinfo.php"> View and Edit Current Customer Information </a> </li>
</ul>
  	</ul>
						<br/>

          </div>
          <br/>
          <br/>


    <?php
    //create select statement that pulls all customers

            $select_query = "SELECT * from customers";

            $result = mysqli_query($db, $select_query);

						$num_rows =  mysqli_num_rows($result);
							if($num_rows != 0){
			            ?>
					        <?php

									for($row_num = 0; $row_num < $num_rows; $row_num++){
										$row_array = mysqli_fetch_array($result);

										$dbcus = $row_array["cus_id"];
										$dbun = $row_array["username"];
										$dbfname = $row_array["fName"];
										$dblname = $row_array["lName"];
										$dbphone = $row_array["phone_num"];
										$dbemail = $row_array["email"];


						?>
										<div class = blackborder>
			                        <p>
																			 <span class = "underlineText">Cus ID:</span> <?php echo $dbcus; ?>  <br/>
																			 <span class = "underlineText">Username:</span> <?php echo $row_array["username"]; ?>  <br/>
			                                 <span class = "underlineText">First Name:</span> <?php echo $row_array["fName"]; ?> <br/>
			                                 <span class = "underlineText">Last Name:</span> <?php echo $row_array["lName"]; ?>  <br/>
			                                 <span class = "underlineText">Phone Number:</span>  <?php echo $row_array["phone_num"]; ?> <br/>
			                                 <span class = "underlineText">Email:</span>	<?php echo $row_array["email"]; ?> <br/>
			                                 <br/>
			                                 <br/>
			                                 <br/>
			                                 <a style = "float: right" href = "https://swe.umbc.edu/~there2/is436/website/editcustomerinfo.php?customerid=<?php echo $dbcus;?>"> [Edit Customer Information] </a>
			                        </p>


			                </div>
			                <br/>
			                <br/>
			                <br/>
							<?php
            }
				}
						 else{
						?>
							 <p class = "textAlignCenter"> Sorry, you have no customers! </p>
						 <?php
							 $error = mysqli_error($db);
							 print "<p> . $error . </p>";
							 exit;
						 }
}
        else{
					echo "You are not logged in";
				}
    ?>
</body>
</html>
