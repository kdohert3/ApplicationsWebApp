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
    <h1>Account Removal Successful</h1>
  </header>

  <center>
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

$username = $_POST["username"];

$sqlQuery = "DELETE FROM " + $table + " WHERE username = " +$username;
$result = $db_connection->query($sqlQuery);
if(!$result)
  die($db_connection->error);

$db_connection->close();

$body .= <<<EOBODY
Account associated with username <em>{$username}</em> has been removed.
</center>
</body>
</html>
EOBODY;

echo $title.$body;
