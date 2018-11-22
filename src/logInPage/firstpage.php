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
			# Make sure the others use a $session_start() of some sort!
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
				
				$userName = trim($_POST["username"]);
				$sqlQuery = sprintf("select password, usertype from %s where username='%s'", $table, $userName);
				$result = $db_connection->query($sqlQuery);
				
				if($result) {
					$numberOfRows = $result->num_rows;
					if ($numberOfRows != 0) {
						$result->data_seek(0);
						$row = $result->fetch_array(MYSQLI_ASSOC);
						if($userName != "mainAdmin") {
							if(password_verify(trim($_POST["password"]), $row['password'])) {
								if($row['usertype'] == "student")
									header("Location: ../studentPage/studentPage.php");
								else if($row['usertype'] == "counselor")
									header("Location: ../counselorPage/counselorPage.php");
								else
									header("Location: ../adminPage/adminPage.php");
								exit;
							}
						} else {
							if($row['password'] == "password") {
								header("Location: ../adminPage/adminPage.php");
								exit;
							}
						}
					}
				} else 
					die("Retrieval failed: ". $db_connection->error);
			}
		?>
		
		<header id="header">
			<h1 id="head">Maryland Universities Admissions Application</h1>
		</header>
		<div id="left">
		<?php
			echo "<form name=\"log_in\" action=\"{$_SERVER["PHP_SELF"]}\" method=\"post\" class=\"form-signin\">";
			$_SESSION["tryAgain"] = true;
			
			if(isset($_POST["username"]) && isset($_POST["password"])) 
				echo "<h4 style='color:RED;'>Login Information Incorrect!</h4>";
		?>
			<h2 id="secondHead" class="h3 mb-3 font-weight-normal">Log In</h2>
			<input type="text" class="form-control" name="username" maxlength="30" size="20" placeholder="User Name" required autofocus>
			<input type="password" class="form-control" name="password" maxlength="30" size="20" placeholder="Password" required>
			<input type="submit" value="Log In">
		</form>
		</div>
		
		<div id="right">
		<form name="signUp" action="process.php" onsubmit="return alertUserCreate()" class="form-signin" method="post">
		<?php
			if(isset($_SESSION["creationFail"]) && $_SESSION["creationFail"]) {
				echo "<h4 style='color:RED;'>Account Creation Failed...!</h4>";
				$_SESSION["creationFail"] = false;
			}
		?>
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