<?php

ini_set('display_errors', 1); 
error_reporting(-1);
session_start();
$user = "AppUser";
$database = "AppDB";
$dbpw = "testing";
$table_schools = "schools";
$table_applications = "applications";
$db = connectToDB("localhost", $user, $dbpw, $database);
$sqlQuery = sprintf("select * from ". $table_schools);
$result = mysqli_query($db, $sqlQuery);


if ( isset($_POST["applicationSubmit"])) {
    foreach($_SESSION["schoolNames"] as $name) {
        if (isset ($_POST[$name."CheckBox"])) {
//             prompt("insert into $table_applications values (\"NAMEFROMPOST\", \"$name\", \"pending\");");
            $sqlQuery = sprintf("insert into $table_applications values (\"NAMEFROMPOST\", \"$name\", \"pending\");");
            $result3 = mysqli_query($db, $sqlQuery);
        }
    }
}

$_SESSION["schoolNames"] = [];
$top = '<!doctype html>
<html lang="en">

  <head>
    <form action = "" method = "post">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Student Profile</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">'. (isset($_POST["Student_name"]) ? $_POST["Student_name"] : "TO-DO STUDENT NAME FROM POST") .'</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="../main.php">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid" style = "padding-top: 42px;">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="studentPage.php">
                  <span data-feather="home"></span>
                  Home <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="studentPage-Files.php">
                  <span data-feather="file"></span>
                  Files
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="studentPage-Apps.php">
                  <span data-feather="send"></span>
                  Applications
                </a>
              </li>
              
            </ul>

            
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div class="btn-toolbar mb-2 mb-md-0">
            </div>
          </div>

          
          <h2>University System of Maryland</h2>';

     $content = '<div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>School</th>
                  <th>School Image</th>
                  <th>Site</th>
                  <th>Enrollment</th>
                  <th style = "padding-left:14px;" >Apply </th>
                </tr>
              </thead>
              <tbody>';
while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    array_push($_SESSION["schoolNames"], $recordArray["schoolName"]);
    $content .= '<tr>
                  <td style = "vertical-align: middle">'.$recordArray["schoolName"].'</td>
                  <td style = "vertical-align: middle"><img src=../img/'.$recordArray["imagePath"].' style="width:60px"></td>
                  <td style = "vertical-align: middle"><a href="'.$recordArray["schoolSite"].'">'.$recordArray["schoolSite"].'</a></td>
                  <td style = "vertical-align: middle">'.$recordArray["Enrollment"].'</td>
                  <td style = "vertical-align: middle">';
                  
    $sqlQuery = sprintf("select * FROM $table_applications where studentEmail = \"NAMEFROMPOST\" and schoolName = \"".$recordArray["schoolName"]."\"");
    $result2 = mysqli_query($db, $sqlQuery);
    
    if (mysqli_num_rows($result2)!=0){
        $content.= '<h5>Applied<h5></td>';
    } else {
        $content.= '<input type = checkbox style = "margin-left: 25px;" name = '.$recordArray["schoolName"].'CheckBox ></td>';
    }
                  
                  
                  $content.= '</tr>';
}
$content .= '<tr>
                  <td style = "vertical-align: middle"></td>
                  <td style = "vertical-align: middle"></td>
                  <td style = "vertical-align: middle"></td>
                  <td style = "vertical-align: middle"></td>
                  <td style = "vertical-align: middle; padding-top: 18px;"> <input type="submit" name= "applicationSubmit" class="btn btn-outline-primary" value="Submit" /></td>
                </tr>';

    
$bottom = '

              </tbody>
            </table>
          </div>
          
          
           </form>
        </main>
      </div>
    </div>
';

echo $top.$content.$bottom;




function prompt($prompt_msg)
{
    echo ("<script type='text/javascript'> var answer = prompt('" . $prompt_msg . "'); </script>");
    
    $answer = "<script type='text/javascript'> document.write(answer); </script>";
    return ($answer);
}


function connectToDB($host, $user, $password, $database)
{
    $db = mysqli_connect($host, $user, $password, $database);
    if (mysqli_connect_errno()) {
        echo "Connect failed.\n" . mysqli_connect_error();
        exit();
    }
    return $db;
}
?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

  </body>
</html>
