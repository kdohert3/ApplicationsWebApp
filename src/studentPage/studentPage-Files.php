<?php


session_start();
$user = "AppUser";
$database = "admissions";
$dbpw = "testing";
$table_users = "users";
$db = connectToDB("localhost", $user, $dbpw, $database);
$sqlQuery = sprintf("select resume from ". $table_users. "where username = " .$_POST["Student_name"]);
// $resume = mysqli_query($db, $sqlQuery);
$resume = "../img/lorem-ipsum.pdf";
$sqlQuery = sprintf("select transcript from ". $table_users. "where username = " .$_POST["Student_name"]);
// $transcript = mysqli_query($db, $sqlQuery);
$transcript = "../img/lorem-ipsum.pdf";


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
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">'. (isset($_POST["Student_name"]) ? $_POST["Student_name"] : "Kevin Doherty") .'</a>
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
              
            </ul>

            
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div class="btn-toolbar mb-2 mb-md-0">
            </div>
          </div>

          
          <h2>Your Application files</h2>
          <div class = "row">
          <div class = "col">';


//TO-DO IF NO RESUME PRESENT
if ($resume) {
    $content = '<br/>
                <h5> Resume: </h5>
                 <embed src="'.$resume.'" width = 100% height = 1000px />';
} else {
    $content = '
                 <br/>
                 <h5>Upload Resume:</h5>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="resume" name = "resume" accept = ".pdf">
                            <label id = "resumeLabel" for= "resume" class="custom-file-label" >Choose File</label>
                    </div>';
}
$content .= '</div><div class = "col">';
if ($transcript) {
    $content .= '<br>
                <h5> Transcript: </h5>
                <embed src="'.$transcript.'"  width = 100% height = 1000px" />';
} else {
    $content .= '<br><h5>Upload Transcript:</h5>
                    <div class="custom-file">
                        <input type="file" required class="custom-file-input" id="transcript" accept = ".pdf">
                        <label id="transcriptLabel" class="custom-file-label" accept=".pdf">Choose file</label>
                    </div>';
}

$content .= '</div>
           </div>';
    

if (!$transcript || !$resume) {
    $content .= '<br/><br/>
                 <form action = "" method = "post"> 
                 <input type="button" id = "submitButton" name= "submitButton" class="btn btn-outline-primary" value="Submit new files" style = "width: 100%;"/>
                 </form>';
}
          
          
$bottom = '</div>
           </div>          
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
    <script> feather.replace()</script>
    <script>
    
    document.getElementById("resume").addEventListener( 'change', showResumeName );
    document.getElementById("transcript").addEventListener( 'change', showTranscriptName );
    
    function showResumeName(event) {
      var input = event.srcElement;
      var fileName = input.files[0].name;
      document.getElementById("resumeLabel").innerHTML = fileName;
    }

    function showTranscriptName(event) {
        var input = event.srcElement;
        var fileName = input.files[0].name;
        document.getElementById("transcriptLabel").innerHTML = fileName;
      }
    
    function getResumeValue() {
		var resumeField = document.getElementById("resume");
		prompt (resumeField.value);
        }

    function submitFileNames() {
    	var resumeField = document.getElementById("resume").value;
    	var transcriptField = document.getElementById("transcript").value;
    	
		var resumeArray = resumeField.split("\\");
    	var transcriptArray = transcriptField.split("\\");

    	var resumeName = resumeArray[resumeArray.length-1];
    	var transcriptName = transcriptArray[transcriptArray.length-1];
    	prompt(resumeName);
	}
     
      document.getElementById("submitButton").addEventListener("click", submitFileNames, false);
     
    </script>

    <!-- Graphs -->
    
  </body>
</html>
