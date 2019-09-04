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
				<h1> Edit Event Information </h1> <br/> <br/>

          <ul>
						<li> <a href = "https://swe.umbc.edu/~there2/is436/website/customerrequests.php" > View Customer Requests </a> </li>
						<li> <a href = "https://swe.umbc.edu/~there2/is436/website/viewinvoice.php" > View invoices </a> </li>
						<li> <a href = "https://swe.umbc.edu/~there2/is436/website/viewevents.php"> View and Edit Scheduled Events </a> </li>
						<li> <a href = "https://swe.umbc.edu/~there2/is436/website/customerinfo.php"> View and Edit Current Customer Information </a> </li>
	</ul>
          </ul>
          <br/>
          <br/>
          <br/>

					<?php
          $eventid = $_GET['eventid'];
					//z
					$select_query = "SELECT * from event where event_id = $eventid";

					$result = mysqli_query($db, $select_query);

					$row_array = mysqli_fetch_array($result);

          $dbcus = $row_array["cus_id"];
          $event_id = $row_array["event_id"];
          $eventtype = $row_array["event_type"];
          $startdate = $row_array["start_date"];
          $enddate = $row_array["end_date"];
          $price = $row_array["res_total"];
					?>
					<h2> Current Event information </h2>
          <p> Customer ID: <?php echo $dbcus; ?>  <br/>
              Event ID: <?php echo $row_array["event_id"]; ?>  <br/>
              Event Type: <?php echo $row_array["event_type"]; ?> <br/>
              Start Date: <?php echo $row_array["start_date"]; ?>  <br/>
              End Date:  <?php echo $row_array["end_date"]; ?> <br/>
              Base Price:	<?php echo $row_array["res_total"]; ?> <br/>

          <form method = "get" action = "updateevent.php">

              <p> Update Event Type: </p>
                <input type = "radio" name = "eventradio" value="wedding"> Wedding <br/>
                <input type = "radio" name = "eventradio" value="graduation"> Graduation <br/>
                <input type = "radio" name = "eventradio" value="party"> Party <br/>
                <input type = "radio" name = "eventradio" value="other"> Other <input type = text name = "otherfield"> <br/>

							<br/>

              <label> Update Start Date (MM/DD/YY):
                <input type = "text" name = "startdate">
              </label>

							<br/>

              <label> Update End Date  (MM/DD/YY):
                <input type = "text" name = "enddate">
              </label>

							<br/>

              <label> Update Base Price:
                <input type = "text" name = "price">
              </label>
							<br/>

							<input type = "hidden" name ="eventid" value='<?php echo $event_id?>'>
              <input type = "submit" name = "submit">

          </form>

<?php
        }
