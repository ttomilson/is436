<?php
	session_start();

	if(isset($_SESSION['login_user'])){
		$username = $_SESSION['login_user'];
	}

	?>

  <!DOCTYPE HTML>
  <html lang="en">
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

      <title> Tawle Event Planning </title>

			<link rel ="stylesheet" type="text/css" href="form.css" title="style" />
    </head>

    <body>

      <?php

        if ((isset($username)) && ($username == 'admin' || $username == 'emp'))  {
					$db = mysqli_connect("studentdb-maria.gl.umbc.edu","there2","there2","there2");

					if (mysqli_connect_errno())	exit("Error - could not connect to MySQL");
        ?>
				<h1> Edit Services Information </h1> <br/>

          <ul>
						<li> <a href = "https://swe.umbc.edu/~there2/is436/website/customerrequests.php" > View Customer Requests </a> </li>
						<li> <a href = "https://swe.umbc.edu/~there2/is436/website/viewinvoice.php" > View invoices </a> </li>
						<li> <a href = "https://swe.umbc.edu/~there2/is436/website/viewevents.php"> View and Edit Scheduled Events </a> </li>
						<li> <a href = "https://swe.umbc.edu/~there2/is436/website/customerinfo.php"> View and Edit Current Customer Information </a> </li>
	</ul>
          </ul>
          <br/>


					<?php
          $serviceid = $_GET['service'];
					//z
					$select_query = "SELECT * from services where service_id = $serviceid";

					$result = mysqli_query($db, $select_query);

					$row_array = mysqli_fetch_array($result);

          $service = $row_array["service_id"];
          $service_desc = $row_array["service_desc"];
          $service_total = $row_array["service_total"];
          $event= $row_array["event_id"];
					?>
					<h2> Current Service information </h2>
          <p> Service ID: <?php echo $service; ?>  <br/>
              Event ID: <?php echo $row_array["event_id"]; ?>  <br/>
              Service Description: <?php echo $row_array["service_desc"]; ?>  <br/>
              Service Total: <?php echo $row_array["service_total"]; ?> <br/>
          </p>
          <br/>
          <h2> Update Service Information </h2>

          <form method = "get" action = "updateservices.php">

            <label> Update Service Type/Description:
              <input type = "text" name = "servicedesc">
            </label>

            <br/>

            <label> Update Total Price of Service:
              <input type = "text" name = "servicetotal">
            </label>

            <br/>
            <br/>


						<input type = "hidden" name ="eventid" value='<?php echo $event?>'>
            <input type = "hidden" name ="serviceid" value='<?php echo $service?>'>
            <input type = "submit" name = "submit">

          </form>

<?php
        }
