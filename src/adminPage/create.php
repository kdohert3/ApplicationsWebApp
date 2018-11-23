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
    <b>Create an Administrator or Counselor below:</b>
    <br /> <br />


    <form action="confirmCreate.php" method="post">
      <div class="form-group" id="center">
        <label for="type">Administrator or Counselor:</label><br>
        <select id="type" name="type">
          <option value="administrator">Administrator</option>
          <option value="counselor">Counselor</option>
        </select>
      </div>

      <div class="form-group">
        <label for="username">User Name:</label><br>
        <input type="text" id="username" name="username" required>
      </div>

      <div class="form-group">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required>
      </div>

      <div class="form-group">
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required>
      </div>

      <div class="form-group">
        <label for="confirmPassword">Confirm Password:</label><br>
        <input type="password" id="confirmPassword" name="cofirmPassword" required>
      </div>

      <div class="form-group">
        <label for="school">School:</label><br>
        <input type="text" id="school" name="school">
      </div>

      <div class="form-group">
        <input type="submit" value="Create">
      </div>
    </form>

    </center>
  </body>
</html>
