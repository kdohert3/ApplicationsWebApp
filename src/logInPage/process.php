<!doctype html>
<html>
    <head> 
        <meta charset="utf-8" /> 
		<title>System Log In</title>
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Will need to change -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	</head>

	<body>
		<?php 
			session_start();
			
			# This entire thing would have to go in Kevin's page
			# Entering data into the database
			$host = "localhost";
			$user = "dbuser"; # Would this be alright?
			$password = "password"; # Would this be alright?
			$database = "admissions";
			$table = "users";
			
			$db_connection = new mysqli($host, $user, $password, $database);
			if ($db_connection->connect_error) 
				die($db_connection->connect_error);
			
			$username = trim($_POST["newUsername"], " ");
			$password = trim($_POST["newPassword"], " ");
			$email = trim($_POST["userEmail"], " ");
			$usertype = 'student';
			
			# Should we hash the password?
			$sqlQuery = sprintf("insert into $table (email, usertype, school, resume, transcript, password, username) values ('%s', '%s', '%s', '%s', '%s', '%s', '%s')", $email, $usertype, null, null, null, $password, $username);
			$result = $db_connection->query($sqlQuery);
			if(!$result) 
				die($db_connection->error);
			
			$db_connection->close();
			
			# Sending the email - Throws an error
			# mail($email, 'Confirmation', 'Hi', 'From: mchuang@terpmail.umd.edu');
			# End
		?>
		
		<h1> Entry Added </h1>
		
		<!-- Will need to change -->
		<script src="bootstrap/jquery-3.2.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
   </body>
</html>