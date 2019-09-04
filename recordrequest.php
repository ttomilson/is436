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

  <title> Schedule Event Requests </title>

	<link rel ="stylesheet" type="text/css" href="form.css" title="style" />


</head>
<body>
  <h1> Schedule Event Requests </h1>
  <?php
  //schedule and event; insert event details into events table. only accessible by admin.
  if ((isset($username)) && ($username == 'admin')){?>
<ul>
		<li> <a href = "https://swe.umbc.edu/~there2/is436/website/customerrequests.php" > View Customer Requests </a> </li>
		<li> <a href = "https://swe.umbc.edu/~there2/is436/website/viewinvoice.php" > View invoices </a> </li>
		<li> <a href = "https://swe.umbc.edu/~there2/is436/website/viewevents.php"> View and Edit Scheduled Events </a> </li>
		<li> <a href = "https://swe.umbc.edu/~there2/is436/website/customerinfo.php"> View and Edit Current Customer Information </a> </li>
</ul> <?php

      $db = mysqli_connect("studentdb-maria.gl.umbc.edu","there2","there2","there2");

      if (mysqli_connect_errno())	exit("Error - could not connect to MySQL");

      if (isset($_GET['customerid'])  && !empty($_GET['customerid']) &&
          isset($_GET['price'])  && !empty($_GET['price']) &&
          isset($_GET['eventstart'])  && !empty($_GET['eventstart']) &&
          isset($_GET['eventend'])  && !empty($_GET['eventend']) &&
          isset($_GET['eventradio'])  && !empty($_GET['eventradio'])){

            $cus_id = $_GET['customerid'];
            echo "$cus_id Hello";
            $eventdesc= mysqli_real_escape_string($db, htmlspecialchars($_GET['eventradio']));
            $eventother = mysqli_real_escape_string($db, htmlspecialchars($_GET['otherfield']));
            $eventstart = mysqli_real_escape_string($db, htmlspecialchars($_GET['eventstart']));
            $eventend = mysqli_real_escape_string($db, htmlspecialchars($_GET['eventend']));
            $price = mysqli_real_escape_string($db, htmlspecialchars($_GET['price']));



            //switch statement to determine what was chosen for event desc

            switch ($eventdesc){

                case "wedding":
                  $eventradio = "Wedding";
                  break;
                case "graduation":
                  $eventradio = "Graduation";
                  break;
                case "party":
                  $eventradio = "Party";
                  break;
                case "other":
                  $eventradio = $eventother;
                  break;
            }


            //insert statement

            $event_insert = "INSERT into event (event_type, start_date, end_date, res_total, cus_id) VALUES
                              ('$eventradio', '$eventstart','$eventend', '$price', $cus_id)";
            $eventinsertresult = mysqli_query($db, $event_insert);



            if(!$eventinsertresult){
              echo "Your request could not be sent. Try again.";
              $error = mysqli_error($db);
              print "<p> . $error . </p>";
              exit;
              }

            else{

              ?>
              <p>
                Event has been scheduled. Click <a href ="https://swe.umbc.edu/~there2/is436/website/viewevents.php">here</a> to view all scheduled events. </p>
              <?php
            }
        }
}
?>
</body>
</html>
