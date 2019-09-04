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

  <title> View Services of Events </title>

	<link rel ="stylesheet" type="text/css" href="form.css" title="style" />


</head>
<body>
  <!--navigation bar-->
  	<?php

  #appears only if variable username has been set by the session variable
  if ((isset($username)) && ($username == 'admin' || $username == 'emp'))  {

		$db = mysqli_connect("studentdb-maria.gl.umbc.edu","there2","there2","there2");

		if (mysqli_connect_errno())	exit("Error - could not connect to MySQL");
  ?>
    <h2> Services Attached to Event </h2>
    <ul>
			<li> <a href = "https://swe.umbc.edu/~there2/is436/website/customerrequests.php" > View Customer Requests </a> </li>
			<li> <a href = "https://swe.umbc.edu/~there2/is436/website/viewinvoice.php" > View invoices </a> </li>
			<li> <a href = "https://swe.umbc.edu/~there2/is436/website/viewevents.php"> View and Edit Scheduled Events </a> </li>
			<li> <a href = "https://swe.umbc.edu/~there2/is436/website/customerinfo.php"> View and Edit Current Customer Information </a> </li>
</ul>
						<br/>

          </div>
          <br/>
          <br/>
      <?php

            $eventid = $_GET['eventid'];

            $serviceselect = "SELECT * from services where event_id = $eventid";
            $result = mysqli_query($db, $serviceselect);

            $num_rows =  mysqli_num_rows($result);

							if($num_rows != 0){

									for($row_num = 0; $row_num < $num_rows; $row_num++){
										$row_array = mysqli_fetch_array($result);

										$dbservice = $row_array["service_id"];


						?>
										<div class = "blackborder">
			                        <p>
																			Service ID: <?php echo $row_array["service_id"]; ?>  <br/>
																			Event ID: <?php echo $row_array["event_id"]; ?>  <br/>
			                                Service Description: <?php echo $row_array["service_desc"]; ?> <br/>
                                      Service Total: <?php echo $row_array["service_total"]; ?> <br/>

			                                 <br/>
			                                 <br/>
			                                 <br/>
			                                 <a style = "float: right" href = "https://swe.umbc.edu/~there2/is436/website/editservices.php?service=<?php echo $dbservice;?>"> [Edit Service Information] </a>
			                        </p>
                      </div>
                      <br/>
                      <br/>
            <?php
                }
                }
                else{
                  echo "No services rendered for event";
                }
        }
