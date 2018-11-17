<!doctype html>
<html>
    <head> 
        <meta charset="utf-8" /> 
		<title>System Log In</title>
	</head>

	<body>
		<?php 
			session_start();
			$_SESSION = array();
			
			header("Location: logInPage/firstpage.php");
			exit;
		?>
	</body>
</html>