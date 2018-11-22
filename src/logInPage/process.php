<!doctype html>
<html>
    <head> 
        <meta charset="utf-8" /> 
		<title>System Log In</title>
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>

	<body>
		<?php 
			session_start();
			
			# Entering data into the database
			$host = "localhost";
			$user = "dbuser";
			$password = "password"; // POINT THIS OUT
			$database = "admissions";
			$table = "users";
			
			$db_connection = new mysqli($host, $user, $password, $database);
			if ($db_connection->connect_error) 
				die($db_connection->connect_error);
			
			$username = trim($_POST["newUsername"], " ");
			$password = trim($_POST["newPassword"], " ");
			$email = trim($_POST["userEmail"], " ");
			$usertype = 'student';
			
			$hashed = password_hash($password, PASSWORD_BCRYPT);
			$sqlQuery = sprintf("insert into $table (email, usertype, school, resume, transcript, password, username) values ('%s', '%s', '%s', '%s', '%s', '%s', '%s')", $email, $usertype, null, null, null, $hashed, $username);
			$result = $db_connection->query($sqlQuery);
			if(!$result) {
				$_SESSION["creationFail"] = true;
				header("Location: firstpage.php");
			} else {
				$_SESSION["creationFail"] = false;
				$_SESSION["tryAgain"] = false;
				header("Location: ../studentPage/studentPage.php");
			}
			
			$db_connection->close();
		?>
   </body>
</html>