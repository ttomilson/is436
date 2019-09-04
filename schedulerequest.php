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

    if ((isset($username)) && ($username == 'admin' || $username == 'emp')){
      $db = mysqli_connect("studentdb-maria.gl.umbc.edu","there2","there2","there2");

      if (mysqli_connect_errno())	exit("Error - could not connect to MySQL");
?>
<!-- create forms to collect relevant information -->

        <h1> Schedule Event from Event Requests! </h1>

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
        <?php //get request_id from row array in customerrequest.php
          $reqs_id = $_GET['requestid'];
          //use request id , pass it from customerrequests.php to pull correct request info and cus_id

          $select_request = "SELECT* FROM customerrequests where $reqs_id = request_id";
          $select_result = mysqli_query($db, $select_request);

          if (!$select_result){
            echo "No request with that ID has been found";
          }
          else{
              $row_array = mysqli_fetch_array($select_result);
							$cus_id = $row_array["cus_id"];
            ?> <h3> Event Request Info: </h3>
              <p>
                Request ID: <?php echo $reqs_id ?><br/>
                Customer ID: <?php echo $row_array["cus_id"];?><br/>
                Event Description: <?php echo $row_array["event_description"];?><br/>
                Start Date: <?php echo $row_array["start_date"];?> <br/>
                End Date: <?php echo $row_array["end_date"];?><br/>
        <?php
          }
        ?>

        <form method = "GET" action = recordrequest.php>

            <p> Event Description:</p>
              <input type = "radio" name = "eventradio" value="wedding"> Wedding <br/>
              <input type = "radio" name = "eventradio" value="graduation"> Graduation <br/>
              <input type = "radio" name = "eventradio" value="party"> Party <br/>
              <input type = "radio" name = "eventradio" value="other"> Other <input type = text name = "otherfield"> <br/>
          <br/>

              <label> Event Start Date (MM/DD/YY)</label> <br/>
                <input type = "text" name = "eventstart">
              </label>

              <br/>
              <br/>

              <label> Event End Date (MM/DD/YY)</label> <br/>
                <input type = "text" name = "eventend">
              </label>

              <br/>
              <br/>

              <label> Base price:
                <input type="text" name="price">
              </label>


          <br/>
          <br/>
            <input type = "hidden" name ="customerid" value='<?php echo $cus_id?>'>

            <input type = "submit" name = "submit">
        </form>
        <?php
}
?>
