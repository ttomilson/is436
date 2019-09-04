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

        if ((isset($username)) && ($username == 'admin'))  {
					$db = mysqli_connect("studentdb-maria.gl.umbc.edu","there2","there2","there2");

					if (mysqli_connect_errno())	exit("Error - could not connect to MySQL");
        ?>
				<h1> Edit Customer Information </h1>

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

					//z
					$cus_id = $_GET['customerid'];
					$select_query = "SELECT * from customers where cus_id = $cus_id";

					$result = mysqli_query($db, $select_query);

					$row_array = mysqli_fetch_array($result);

									$dbun = $row_array["username"];
									$dbfname = $row_array["fName"];
									$dblname = $row_array["lName"];
									$dbphone = $row_array["phone_num"];
									$dbemail = $row_array["email"];
					?>
					<h2> Current Customer information </h2>
          <p> CustomerID: <?php echo $cus_id ?> <br/>
					 		First Name : <?php echo $dbfname?> <br/>
							Last Name: <?php echo $dblname?> <br/>
							Phone Number: <?php echo $dbphone?> <br/>
							Email: <?php echo $dbemail?> <br/> </p>
          <form method = "get" action = "updatecustomerinfo.php">

              <label> Update First Name:
                <input type = "text" name = "firstname">
              </label>

							<br/>

              <label> Update Last Name:
                <input type = "text" name = "lastname">
              </label>

							<br/>

              <label> Update Phone Number:
                <input type = "text" name = "phonenum">
              </label>

							<br/>

              <label> Update Email:
                <input type = "text" name = "email">
              </label>
							<br/>

							<input type = "hidden" name ="customerid" value='<?php echo $cus_id?>'>
              <input type = "submit" name = "submit">

          </form>
					<br/>
					<br/>

<?php
        }
