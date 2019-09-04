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

  <title> View Scheduled Events </title>

	<link rel ="stylesheet" type="text/css" href="form.css" title="style" />


</head>
<body>
  <!--navigation bar-->
  	<?php

  #appears only if variable username has been set by the session variable
  if ((isset($username)) && ($username == 'admin' ||$username == 'emp'))  {

		$db = mysqli_connect("studentdb-maria.gl.umbc.edu","there2","there2","there2");

		if (mysqli_connect_errno())	exit("Error - could not connect to MySQL");
  ?>
		<h1> Scheduled Events </h1>

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
		if (!isset($_GET['requestid'])){
					$select_query = "SELECT* from event";

					$result = mysqli_query($db, $select_query);

					$num_rows =  mysqli_num_rows($result);
						if($num_rows != 0){

							for($row_num = 0; $row_num < $num_rows; $row_num++){
								$row_array = mysqli_fetch_array($result);

							$dbcus = $row_array["cus_id"];
							$event_id = $row_array["event_id"];
							$eventtype = $row_array["event_type"];
							$startdate = $row_array["start_date"];
							$enddate = $row_array["end_date"];
							$price = $row_array["res_total"];


			?>
									<div class = "blackborder">
														<p>
																Customer ID: <?php echo $dbcus; ?>  <br/>
																Event ID: <?php echo $row_array["event_id"]; ?>  <br/>
																Event Type: <?php echo $row_array["event_type"]; ?> <br/>
																Start Date: <?php echo $row_array["start_date"]; ?>  <br/>
																End Date:  <?php echo $row_array["end_date"]; ?> <br/>
																Base Price:	<?php echo $row_array["res_total"]; ?> <br/>
																 <br/>
																 <br/>
																 <br/>
																 <a style = "float: right" href = "https://swe.umbc.edu/~there2/is436/website/viewinvoice.php?eventid=<?php echo $event_id;?>"> [View Invoice of Event] </a>
																 <a style = "float: right" href = "https://swe.umbc.edu/~there2/is436/website/viewservices.php?eventid=<?php echo $event_id;?>"> [View Services Rendered for Event] </a>
																 <a style = "float: right" href = "https://swe.umbc.edu/~there2/is436/website/addservices.php?eventid=<?php echo $event_id;?>"> [Add Services to Event] </a>
																 <a style = "float: right" href = "https://swe.umbc.edu/~there2/is436/website/editevent.php?eventid=<?php echo $event_id;?>"> [Edit Event Information] </a>
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
					 <p class = "textAlignCenter"> Sorry, you have no reservations! </p>
				 <?php
					 $error = mysqli_error($db);
					 print "<p> . $error . </p>";
					 exit;
				 }
		}

		else {
			//if request id is set from query string do the following
			$requestid = $_GET['requestid'];

			$select_query = "SELECT* from event where request_id = $requestid";
			$result = mysqli_query($db, $select_query);

			$num_rows =  mysqli_num_rows($result);
				if($num_rows != 0){

					for($row_num = 0; $row_num < $num_rows; $row_num++){

								$row_array = mysqli_fetch_array($result);
								$dbcus = $row_array["cus_id"];
								$event_id = $row_array["event_id"];
								$eventtype = $row_array["event_type"];
								$startdate = $row_array["start_date"];
								$enddate = $row_array["end_date"];
								$price = $row_array["res_total"];


	?>
							<div class = "blackborder">
												<p>
														Customer ID: <?php echo $dbcus; ?>  <br/>
														Event ID: <?php echo $row_array["event_id"]; ?>  <br/>
														Event Type: <?php echo $row_array["event_type"]; ?> <br/>
														Start Date: <?php echo $row_array["start_date"]; ?>  <br/>
														End Date:  <?php echo $row_array["end_date"]; ?> <br/>
														Base Price:	<?php echo $row_array["res_total"]; ?> <br/>
														 <br/>
														 <br/>
														 <br/>
														 <a style = "float: right" href = "https://swe.umbc.edu/~there2/is436/website/viewinvoice.php?eventid=<?php echo $event_id;?>"> [View Invoice of Event] </a>
														 <a style = "float: right" href = "https://swe.umbc.edu/~there2/is436/website/viewservices.php?eventid=<?php echo $event_id;?>"> [View Services Rendered for Event] </a>
														 <a style = "float: right" href = "https://swe.umbc.edu/~there2/is436/website/addservices.php?eventid=<?php echo $event_id;?>"> [Add Services to Event] </a>
														 <a style = "float: right" href = "https://swe.umbc.edu/~there2/is436/website/editevent.php?eventid=<?php echo $event_id;?>"> [Edit Event Information] </a>
													</p>


									</div>
												<br/>
												<br/>
												<br/>
								<?php


						}
					}
				}
			}
        else{
					echo "You are not logged in";
				}
    ?>
</body>
</html>
