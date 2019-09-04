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

      if ((isset($username)) && ($username == 'admin' ||$username == 'emp'))  {
        $db = mysqli_connect("studentdb-maria.gl.umbc.edu","there2","there2","there2");

        if (mysqli_connect_errno())	exit("Error - could not connect to MySQL");

        //initialize variable with value passed through editcustomerinfo.php
        $event_id = $_GET['eventid'];
      ?>

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

        <h1> Updated Event Information </h1> <br/> <br/>
      <?php
          if(!empty ($_GET['eventradio'])){

						$eventdesc = mysqli_real_escape_string($db, htmlspecialchars($_GET['eventradio']));
						$eventother = mysqli_real_escape_string($db, htmlspecialchars($_GET['otherfield']));


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

               $updateventdesc = "UPDATE event set event_type = '$eventradio'  where event_id = $event_id";
               $edescresult = mysqli_query($db, $updateventdesc);

               if (!$edescresult){
                 print("Error - query could not be executed");
                 $error = mysqli_error($db);
                 print "<p> . $error . </p>";
                 exit;
               }

                else{
                 echo "Updated event type: $eventradio <br/>";


                }

          }
          //update startdate
           if(!empty ($_GET['startdate'])){
               $newstart = mysqli_real_escape_string($db, htmlspecialchars($_GET['startdate']));

               $updatestart = "UPDATE event set start_date = '$newstart'  where event_id = $event_id";
               $startresult = mysqli_query($db, $updatestart);

               if (!$startresult){
                 print("Error - query could not be executed");
                 $error = mysqli_error($db);
                 print "<p> . $error . </p>";
                 exit;
               }

               else{
                 echo "Updated start date: $newstart<br/>";
               }
          }
          //update end date

          if(!empty ($_GET['enddate'])){
               $end= mysqli_real_escape_string($db, htmlspecialchars($_GET['enddate']));

               $updateend = "UPDATE event set end_date = '$end'
                							where event_id = $event_id";
               $endresult = mysqli_query($db, $updateend);

               if (!$endresult){
                 print("Error - query could not be executed");
                 $error = mysqli_error($db);
                 print "<p> . $error . </p>";
                 exit;
               }

               else{
                 echo "Updated end date: $end<br/>";
               }

          }
          //update email address
          if(!empty ($_GET['price'])){
               $newprice = mysqli_real_escape_string($db, htmlspecialchars($_GET['price']));

               $updateprice = "UPDATE event set res_total = '$newprice'
                where event_id = $event_id";
               $priceresult = mysqli_query($db, $updateprice);

               if (!$priceresult){
                 print("Error - query could not be executed");
                 $error = mysqli_error($db);
                 print "<p> . $error . </p>";
                 exit;
               }

               else{
                 echo "Updated price: $newprice<br/>";
               }


          }



    }
    else {
        echo ("Not logged in");

    }
