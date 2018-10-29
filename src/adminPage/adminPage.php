<?php
$head = <<<EOBODY
<!doctype html>
<html>
  <head>
    <title>Application System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
EOBODY;

$body = <<<EOBODY
<body>
  <div class="container-fluid">
    <h1>Create or Remove Users</h1>
    <form action="" method="post">
      <div class="form-group">
        <label for="userType">Type of User:</label>
        <select id="userType" name="userType" class="form-control">
          <option value=""></option>
          <option value="Counselor">Counselor</option>
          <option value="Administrator">Administrator</option>
          <option value="School">School</option>
        </select>
      </div>

      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" class="form-control" />
      </div>

      <div class="form-group">
        <label for"action">Action:</label>
        <input type="radio" id="action" name="action" value="Create" />Create
        <input type="radio" id="action" name="action" value="Remove" />Remove
      </div>

      <div class="form-group">
        <input type="submit" value="Submit" class="form-control">
      </div>
    </form>
  </div>
</body>
</html>
EOBODY;

echo $head.$body;
 ?>
