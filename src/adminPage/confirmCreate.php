<?php
$title = <<<EOBODY
<html>
  <head>
    <meta charset="utf-8">
    <title>adminPage</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="../signin.css?v=1" rel="stylesheet">
  </head>
EOBODY;

$body = <<<EOBODY
<body>
  <header id="header">
    <h1>Account Creation Successful</h1>
  </header>

  <center>
    <b>Information Provided:</b><br>
EOBODY;

session_start();

$host = "localhost";
$user = "dbuser";
$password = "password";
$database = "admissions";
$table = "users";

$db_connection = new mysqli($host, $user, $password, $database);
if ($db_connection->connect_error)
  die($db_connection->connect_error);

$type = $_POST["type"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$school = $_POST["school"];

$hashed = password_hash($password, PASSWORD_BCRYPT);

$sqlQuery = sprintf("insert into $table (email, usertype, school, resume, transcript, username, password) values ('%s', '%s', '%s', '%s', '%s', '%s', '%s')", $email, $type, $school, null, null, $username, $hashed);
$result = $db_connection->query($sqlQuery);
if(!$result)
  die($db_connection->error);

$db_connection->close();

$body .= <<< EOBODY
<em>User Type: </em> {$type} <br>
<em>Username: </em> {$username} <br>
<em>Email: </em> {$email} <br>
<em>School: </em> {$school}
</center>
</body>
</html>
EOBODY;

echo $title.$body;
 ?>
