
<?php
	session_start();

	if(isset($_SESSION['login_user'])){
		$username = $_SESSION['login_user'];
	}

	?>

  <!DOCTYPE HTML>
  <!-- code written by Theresa Tomilson. Homepage of the VickyTawle Website -->
  <html lang="en">
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

      <title> Tawle Event Planning </title>

			<link rel ="stylesheet" type="text/css" href="form.css" title="style" />
    </head>

    <body>

      <?php

        if ((isset($username)) && ($username == 'admin' || $username = 'emp'))  {
        ?>
					<h1> Tawle Event Planning </h1>
          <ul>
						<li> <a href = "https://swe.umbc.edu/~there2/is436/website/customerrequests.php" > View Customer Requests </a> </li>
						<li> <a href = "https://swe.umbc.edu/~there2/is436/website/viewinvoice.php" > View invoices </a> </li>
						<li> <a href = "https://swe.umbc.edu/~there2/is436/website/viewevents.php"> View and Edit Scheduled Events </a> </li>
						<li> <a href = "https://swe.umbc.edu/~there2/is436/website/customerinfo.php"> View and Edit Current Customer Information </a> </li>
	</ul>
          </ul>

<?php
        }

        if ((isset($username)) && ($username != 'admin')){
        ?>
        <!-- create forms to collect relevant information -->

        <h1> Contact Vicky Tawle By Completing the Form Below! </h1>

        <form method = "GET" action = customerrequests.php
            <label >
          		First Name:
          			<input type = "text" name = "fname" size = "25" maxlength="25" class=  required>

          	</label>

          		<br />
          		<br />

          	<label >
          		Last Name:
          		<input type="text" name="lname">
          	</label>

            <br />
            <br />

            <label >
              Phone Number:
              <input type="text" name="phone">
            </label>

            <br/>
						<br/>

						<label >
							Email:
							<input type="text" name="email">
						</label>

						<br/>


            <p> Choose an Event Description:</p>
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
            <input type = "submit" name = "submit">
				</form>
        <?php
        }
?>
<!--if username is set but does not == admin and does not == emp -->
