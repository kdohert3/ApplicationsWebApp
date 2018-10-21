<?php

$top = '<!doctype html>
<html lang="en">

  <head>
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
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">'. (isset($_POST["Student_name"]) ? $_POST["Student_name"] : "Student name placeholder") .'</a>
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

          
          <h2>Your Application files</h2>';
//TO-DO IF NO RESUME PRESENT
if (isset($_POST["applicationEssay"])) {
    $content = '<embed src="file_name.pdf" width="800px" height="2100px" />';
} else {
    $content = '
                 <br/>
                 <h5>Upload Resume:</h5>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="applicationEssay">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>';
}
$content .= '<br/><br/><br/>';
if (isset($_POST["transcript"])) {
    $content .= '<embed src="file_name.pdf" width="800px" height="2100px" />';
} else {
    $content .= '<h5>Upload Transcript:</h5>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="transcript">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>';
}

          
          
$bottom = '          
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

    <!-- Graphs -->
    
  </body>
</html>
