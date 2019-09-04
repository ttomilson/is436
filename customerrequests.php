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

  <title> Record Customer Requests </title>

	<link rel ="stylesheet" type="text/css" href="form.css" title="style" />


</head>
<body>
  <h1> Customer Requests </h1>


  <?php
  //insert customer info into customer table. option only available to customers.
  if ((isset($username)) && ($username != 'admin')){

      $db = mysqli_connect("studentdb-maria.gl.umbc.edu","there2","there2","there2");

      if (mysqli_connect_errno())	exit("Error - could not connect to MySQL");

      if (isset($_GET['fname'])  && !empty($_GET['fname']) &&
          isset($_GET['lname'])  && !empty($_GET['lname']) &&
          isset($_GET['phone'])  && !empty($_GET['phone']) &&
          isset($_GET['email'])  && !empty($_GET['email']) &&
          isset($_GET['eventstart'])  && !empty($_GET['eventstart']) &&
          isset($_GET['eventend'])  && !empty($_GET['eventend']) &&
          isset($_GET['eventradio'])  && !empty($_GET['eventradio'])){

            $fname = mysqli_real_escape_string($db, htmlspecialchars($_GET['fname']));
            $lname = mysqli_real_escape_string($db, htmlspecialchars($_GET['lname']));
            $phone= mysqli_real_escape_string($db, htmlspecialchars($_GET['phone']));
            $email = mysqli_real_escape_string($db, htmlspecialchars($_GET['email']));
            $eventdesc= mysqli_real_escape_string($db, htmlspecialchars($_GET['eventradio']));
            $eventother = mysqli_real_escape_string($db, htmlspecialchars($_GET['otherfield']));
            $eventstart = mysqli_real_escape_string($db, htmlspecialchars($_GET['eventstart']));
            $eventend = mysqli_real_escape_string($db, htmlspecialchars($_GET['eventend']));




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
            //check if user already has a row in the customer table
            $cus_check = "SELECT* from customers where username = '$username'";
            $cus_check_result = mysqli_query($db, $cus_check);
						$cus_array = mysqli_fetch_array($cus_check_result);
						$cus_id = $cus_array['cus_id'];
            $num_rows =  mysqli_num_rows($cus_check_result);


            //if the customer already exists, then insert columns into customer request
                if($num_rows != 0){


                $cusrequest_insert = "INSERT INTO customerrequests (event_description, start_date, end_date, cus_id)
                                      VALUES ('$eventradio', '$eventstart', '$eventend', '$cus_id')";

                $cus_request = mysqli_query($db, $cusrequest_insert);


            //if query runs, then tell user their request has been sent
                if(!$cus_request){
                  echo "Your request could not be sent. Try again.";
                  $error = mysqli_error($db);
                  print "<p> . $error . </p>";
                  exit;
                  }

                else{
                  echo "Your request has been sent. Tawle Planning Company will contact you with more information.";

                }
            }
            //if customer doesn't already exist in the customer table then insert it into
            // table and insert request into customerrequests table.
              else{ //else if num_rows = 0

                  $cus_info_insert= "INSERT INTO customers (fName, lName, phone_num, email, username)
                                      VALUES ('$fname','$lname','$phone', '$email', '$username')";
                  $result = mysqli_query($db, $cus_info_insert);


                      if(! $result){
                        print("Error - query could not be executed");
                        $error = mysqli_error($db);
                        print "<p> . $error . </p>";
                        exit;
                      }

                      else {
                        print "";
                      }


                  $cusrequest_insert = "INSERT INTO customerrequests (event_description, start_date, end_date, cus_id)
	                                      VALUES ('$eventradio', '$eventstart', '$eventend', '$cus_id')";

                  $cus_request = mysqli_query($db, $cusrequest_insert);

                  //if query runs, then tell user their request has been sent
                      if(!$cus_request){
                        echo "Your request could not be sent from second if. Try again.";
												print("Error - query could not be executed");
												$error = mysqli_error($db);
												print "<p> . $error . </p>";
												exit;
                        }

                      else{
                        echo "Your request has been sent. Tawle Planning Company will contact you with more information.";
                      }




              }
  }
  else{
    echo "not all fields filled";
  }
}

  else if (!isset($username)){
      ?>
      <div class = "blackBackground">

          <h1 class = "top"> Tawle Event Planning </h1>
          <br/>

      </div>

          <br/>
          <br/>

          <p> You are not logged in, click <a href = "https://swe.umbc.edu/~there2/is436/website/login.php">here</a> to log in. </p>`
      <?php
  }

	else if ((isset($username)) && ($username == 'admin' || $username == 'emp')){
?>

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
		$db = mysqli_connect("studentdb-maria.gl.umbc.edu","there2","there2","there2");

		if (mysqli_connect_errno())	exit("Error - could not connect to MySQL");


		$select_cus_requests = "SELECT * from customerrequests";
		$select_result =  mysqli_query($db, $select_cus_requests);

		 if(!$select_result){
			?>
				<p class = "textAlignCenter"> Sorry, you have no requests! </p>
			<?php
				$error = mysqli_error($db);
				print "<p> . $error . </p>";
				exit;
			}
			else{
				$cus_result =  mysqli_num_rows($select_result);

				for($row_num = 0; $row_num < $cus_result; $row_num++){
					$row_array = mysqli_fetch_array($select_result);

					$dbreq = $row_array['request_id'];
					?>

					<div class = "blackborder">
					<p>
							Request ID: <?php echo $row_array['request_id'];?> <br/>
							CustomerID: <?php echo $row_array['cus_id'];?> <br/>
							Event Description:  <?php echo $row_array['event_description'];?> <br/>
							Start Date:  <?php echo $row_array['start_date'];?> <br/>
							End Date:  <?php echo $row_array['end_date'];?> <br/>
							<br/>
							<br/>
							<br/>
						<?php

						//check to see if request id has been transferred
							$checkforevent = "SELECT* from event where request_id = $dbreq";
							$eventresult = mysqli_query($db, $checkforevent);
							$req_rows =  mysqli_num_rows($eventresult);

									if($req_rows!=0){ ?>
											<a style = "float: right" href = "https://swe.umbc.edu/~there2/is436/website/viewevents.php?requestid=<?php echo $dbreq;?>"> [View Event] </a>

								<?php	}
									else{ ?>
										<a style = "float: right" href = "https://swe.umbc.edu/~there2/is436/website/schedulerequest.php?requestid=<?php echo $dbreq;?>"> [Schedule New Event] </a>
								<?php	}
								?>
		 			</p>

				</div>
				<br/>
				<br/>

<?php

			}
		}
}
  ?>
</body>
</html>
