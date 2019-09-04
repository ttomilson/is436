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

        //initialize variable with value passed through editcustomerinfo.php
        $cus_id = $_GET['customerid'];
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

        <h1> Updated Customer Information </h1> <br/> <br/>
      <?php
          if(!empty ($_GET['firstname'])){
               $newfName = mysqli_real_escape_string($db, htmlspecialchars($_GET['firstname']));

               $updatefName = "UPDATE customers set fName = '$newfName'  where cus_id = '$cus_id'";
               $fnameresult = mysqli_query($db, $updatefName);

               if (!$fnameresult){
                 print("Error - query could not be executed");
                 $error = mysqli_error($db);
                 print "<p> . $error . </p>";
                 exit;
               }

                else{
                 echo "Updated first name: $newfName <br/>";


                }

          }
          //update lastname
           if(!empty ($_GET['lastname'])){
               $newlName = mysqli_real_escape_string($db, htmlspecialchars($_GET['lastname']));

               $updatelName = "UPDATE customers set lName = '$newlName'
                where cus_id = '$cus_id'";
               $lNameresult = mysqli_query($db, $updatelName);

               if (!$lNameresult){
                 print("Error - query could not be executed");
                 $error = mysqli_error($db);
                 print "<p> . $error . </p>";
                 exit;
               }

               else{
                 echo "Updated last name: $newlName";
               }
          }
          //update phone number

          if(!empty ($_GET['phonenum'])){
               $newphone = mysqli_real_escape_string($db, htmlspecialchars($_GET['phonenum']));

               $updatephone = "UPDATE customers set phone_num = '$newphone'
                where cus_id = '$cus_id'";
               $phoneresult = mysqli_query($db, $updatephone);

               if (!$phoneresult){
                 print("Error - query could not be executed");
                 $error = mysqli_error($db);
                 print "<p> . $error . </p>";
                 exit;
               }

               else{
                 echo "Updated phone number: $newphone";
               }

          }
          //update email address
          if(!empty ($_GET['email'])){
               $newemail = mysqli_real_escape_string($db, htmlspecialchars($_GET['email']));

               $updateemail = "UPDATE customers set email = '$newemail'
                where cus_id = '$cus_id'";
               $emailresult = mysqli_query($db, $updateemail);

               if (!$emailresult){
                 print("Error - query could not be executed");
                 $error = mysqli_error($db);
                 print "<p> . $error . </p>";
                 exit;
               }

               else{
                 echo "Updated email: $newemail";
               }


          }



    }
    else {
        echo ("Not logged in");

    }
