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
        $service = $_GET['serviceid'];
        $eventid = $_GET['eventid'];
      ?>
      <h1> Updated Service Information </h1> <br/> <br/>

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
          if(!empty ($_GET['servicedesc'])){

						$servicedesc = mysqli_real_escape_string($db, htmlspecialchars($_GET['servicedesc']));

               $updateservicedesc = "UPDATE services set service_desc = '$servicedesc'  where service_id = $service";
               $result = mysqli_query($db, $updateservicedesc);

               if (!$result){
                 print("Error - query could not be executed");
                 $error = mysqli_error($db);
                 print "<p> . $error . </p>";
                 exit;
               }

                else{
                 echo "Updated service type/description: $servicedesc <br/>";


                }

          }
          //update startdate
           if(!empty ($_GET['servicetotal'])){
               $total = mysqli_real_escape_string($db, htmlspecialchars($_GET['servicetotal']));

               $newtotal = "UPDATE services set service_total = $total  where service_id = $service";
               $totalresult = mysqli_query($db, $newtotal);

               if (!$totalresult){
                 print("Error - query could not be executed");
                 $error = mysqli_error($db);
                 print "<p> . $error . </p>";
                 exit;
               }

               else{
                 //passed to invoice. select invoice service total and update it as well

                 echo "Updated service total: $total<br/>";

                 /*//$services_total = select sum (service_total) from services where service_id = $service;
                 //  $i_servicetotal = mysqli_query($db, $services_total);
                 //if (!i_servicetotal){
                         print("Error - query could not be executed");
                         $error = mysqli_error($db);
                         print "<p> . $error . </p>";
                         exit;
                  //}
                    else{
                        $updateinvoiceservice =  "update invoices set service_total =  $i_servicetotal where event_id = $event";
                        i_service_result =  mysqli_query($db, $updateinvoiceservice);

                  }
                 */
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
