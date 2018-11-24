<html>
  <head>
    <meta charset="utf-8">
    <title>adminPage</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="../signin.css?v=1" rel="stylesheet">
  </head>

  <body>
    <header id="header">
      <h1>Administrator Page</h1>
    </header>

    <center>
    <b>Remove an Administrator or Counselor below:</b>
    <br /> <br />

    <form action="confirmRemove.php" method="post">
      <div class="form-group">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required>
      </div>

      <div class="form-group">
        <input type="submit" value="Remove">
      </div>
    </form>
    </center>
  </body>
</html>
