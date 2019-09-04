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

  <title> Add Services to Event </title>

  <link rel ="stylesheet" type="text/css" href="form.css" title="style" />


</head>
<body>
<?php
  if ((isset($username)) && ($username == 'admin' ||$username == 'emp'))  {
    $db = mysqli_connect("studentdb-maria.gl.umbc.edu","there2","there2","there2");

    if (mysqli_connect_errno())	exit("Error - could not connect to MySQL");

    $eventid = $_GET['eventid'];
?>
    <h1> Tawle Event Planning </h1>
    <ul>
			<li> <a href = "https://swe.umbc.edu/~there2/is436/website/customerrequests.php" > View Customer Requests </a> </li>
			<li> <a href = "https://swe.umbc.edu/~there2/is436/website/viewinvoice.php" > View invoices </a> </li>
			<li> <a href = "https://swe.umbc.edu/~there2/is436/website/viewevents.php"> View and Edit Scheduled Events </a> </li>
			<li> <a href = "https://swe.umbc.edu/~there2/is436/website/customerinfo.php"> View and Edit Current Customer Information </a> </li>
</ul>
    </ul>
    <br/>
    <br/>

    <h3> Add Service to Event: </h3>
    <form method = "get" action = "addservices.php">


        <label> Service Type/Description
          <input type = "text" name = "servicedesc">
        </label>

        <br/>

        <label> Total Price of Service:
          <input type = "text" name = "servicetotal">
        </label>

        <br/>
        <br/>

        <input type = "hidden" name ="eventid" value='<?php echo $eventid?>'>
        <input type = "submit" name = "submit">

    </form>
  <?php


      if  (isset($_GET['servicedesc'])  && !empty($_GET['servicedesc']) &&
          isset($_GET['servicetotal'])  && !empty($_GET['servicetotal'])){

            //insert values into table

            $servicedesc = mysqli_real_escape_string($db, htmlspecialchars($_GET['servicedesc']));
            $service_total = mysqli_real_escape_string($db, htmlspecialchars($_GET['servicetotal']));

            $constructedinsert = "INSERT into services (service_desc, service_total,event_id) VALUES ('$servicedesc','$service_total', $eventid)";
            $result = mysqli_query($db, $constructedinsert);

            if(!$result){
              print("Error - query could not be executed");
              $error = mysqli_error($db);
              print "<p> . $error . </p>";
              exit;
            }
            else{
              print "<br/>Services have been added to event.";
            }

          }
}
?>

</body>
</html>
