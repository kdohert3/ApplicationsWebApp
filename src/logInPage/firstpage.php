<!doctype html>
<html>
    <head> 
        <meta charset="utf-8" /> 
		<title>System Log In</title>
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="../signin.css?v=1" rel="stylesheet">
		
		<script>
			function alertUserCreate() {
				var x = document.getElementById("newPass").value;
				var y = document.getElementById("newPass2").value;
				if(x != y) {
					alert("Your passwords do not match!");
					return false;
				} else 
					return true;
			}
		</script>
	</head>

	<body>
		<?php 
			if(!isset($_SESSION)) 
				session_start();
			
			if(isset($_SESSION["tryAgain"]) && isset($_POST["username"]) && isset($_POST["password"])) {
				$host = "localhost";
				$user = "dbuser"; # Would this be alright?
				$password = "password"; # Would this be alright?
				$database = "admissions";
				$table = "users";
				
				$db_connection = new mysqli($host, $user, $password, $database);
				if ($db_connection->connect_error) 
					die($db_connection->connect_error);
				
				# Unfinished
				$hashed = password_hash(trim($_POST["password"], PASSWORD_DEFAULT);
				$sqlQuery = sprintf("select * from %s where username='%s' and password='%s'", $table, trim($_POST["username"], " "), $hashed, " "));
				$result = $db_connection->query($sqlQuery);
				
				if($result) {
					$numberOfRows = $result->num_rows;
					if ($numberOfRows != 0) {
						header("Location: login.php");
						exit;
					}
				} else 
					die("Retrieval failed: ". $db_connection->error);
			}
		?>
		
		<!--
		Issues to address:
			1. Where the files and bootstrap will be placed relative to each other.
			2. How I will avoid having students realize that there is no counselor / admin option using our current approach.
				2.5. My proposition is that the counselors and admins have a log in already and do not need to sign up to begin with.
			3. Coordinate with Kevin to do email confirmation if we can figure out a mail server. 
			4. Should we hash the password? 
			
		To Do List:
			1. Passwords should be hashed. Will have to change the storage space in SQL table. Let Michael know by recording steps to creation and sending it to him. 
			2. Need to check if username or password is already taken.
			3. Put a fieldset around the new log in portion.
			4. Email must have certain formats. Look into all UMD school systems.
		-->
		
		<header id="header">
			<h1 id="head">Maryland Universities Admissions Application</h1>
		</header>
		<!-- Action needed? -->
		<div id="left">
		<?php
			echo "<form name=\"log_in\" action=\"{$_SERVER["PHP_SELF"]}\" method=\"post\" class=\"form-signin\">";
			$_SESSION["tryAgain"] = true;
			
			if(isset($_POST["username"]) && isset($_POST["password"])) {
				echo "<h4 style='color:RED;'>Login Information Incorrect!</h4>";
			}
		?>
			<h2 id="secondHead" class="h3 mb-3 font-weight-normal">Log In</h2>
			<input type="text" class="form-control" name="username" maxlength="30" size="20" placeholder="User Name" required autofocus>
			<input type="password" class="form-control" name="password" maxlength="30" size="20" placeholder="Password" required>
			<input type="submit" value="Log In">
		</form>
		</div>
		
		<!-- Action needed? -->
		<div id="right">
		<form name="signUp" action="process.php" onsubmit="return alertUserCreate()" class="form-signin" method="post">
			<h2 id="thirdHead" class="h3 mb-3 font-weight-normal">New to the system? Create an account today!</h2>
			<!-- <fieldset> -->
			User Name
			<input type="text" class="form-control" name="newUsername" maxlength="30" placeholder="johndoe" required>
			Email
			<input type="email" class="form-control" name="userEmail" maxlength="30" placeholder="johndoe@email.com" required>
			Password
			<input type="password" id="newPass" class="form-control" name="newPassword" pattern=".{8,30}" title="Must be 8-30 characters" required>
			Confirm Password
			<input type="password" id="newPass2" class="form-control" name="newPasswordConfirm" pattern=".{8,30}" title="Must be 8-30 characters" required>
			<input type="submit" value="Create Account">
			<!-- </fieldset> -->
		</form>
		</div>
   </body>
</html>