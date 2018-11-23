<?php
	if(isset($_POST['username'])) {
		$bottomPart = "";
		$middlePart = "";
		$host = "localhost";
		$user = "dbuser";
		$password = "goodbyeWorld";
		$database = "admissions";
		$conn = new mysqli($host, $user, $password, $database);
		session_start();
		if ($conn->connect_error) {
		die($conn->connect_error);
		}
		if(isset($_POST['exit'])) {

		session_destroy();
		//unset($_POST['save']);
		//unset($_POST['exit']);
		$_POST = array();
		header("Location: ../logInPage/firstpage.php");
		}
		if(isset($_POST['save'])) {

		foreach($_POST as $key => $value) {

		if($key != 'save' && $key != 'exit') {

		$newKey = str_replace("_", ".", $key);
		$stmt = $conn->prepare("UPDATE applications SET status = ? WHERE studentEmail=? AND schoolName=?");
		$stmt->bind_param("sss", $value, $newKey, $_SESSION['school']);
		$stmt->execute();
		}
		}
		unset($_POST['save']);
		} else {
		$stmt = $conn->prepare("SELECT school FROM users WHERE username=?");
		//$stmt->bind_param("s", $_SESSION['email']);
		$_SESSION['username'] = $_POST['username'];
		//$tempemail = 'counselor@umd.edu';
		$stmt->bind_param("s", $_SESSION['username']);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($school);
		$stmt->fetch();

		$_SESSION['school'] = $school;

		}





		$stmt = $conn->prepare("SELECT resume, transcript, studentEmail, status from applications, users WHERE applications.studentEmail=users.email AND applications.schoolName=? ORDER BY FIELD(status, 'pending', 'accepted', 'rejected')");
		$stmt->bind_param("s", $_SESSION['school']);
		$stmt->execute();
		$result = $stmt->get_result();
		while($row = $result->fetch_assoc()) {
		$middlePart .= '<tr><td>';
		$middlePart .= $row['studentEmail'].'</td>';
		$middlePart .= '<td><a href="'.$row['resume'].'" target="_blank">'.$row['resume'].'</a></td>';
		$middlePart .= '<td><a href="'.$row['transcript'].'" target="_blank">'.$row['transcript'].'</a></td>';
		//$middlePart .= '<td>'.$row['status'].'</td></tr>';
		//$middlePart .= '<td><select name="'.$row['studentEmail'].'">';
		if($row['status'] == 'pending') {
		$middlePart .= '<td><select name="'.$row['studentEmail'].'">';
		$middlePart .= '<option value="pending" selected>Pending</option>';
		$middlePart .= '<option value="accepted">Accept</option>';
		$middlePart .= '<option value="rejected">Reject</option>';
		}
		if($row['status'] == 'accepted') {
		$middlePart .= '<td><select name="'.$row['studentEmail'].'" disabled>';
		$middlePart .= '<option value="pending">Pending</option>';
		$middlePart .= '<option value="accepted" selected>Accept</option>';
		$middlePart .= '<option value="rejected">Reject</option>';
		}
		if($row['status'] == 'rejected') {
		$middlePart .= '<td><select name="'.$row['studentEmail'].'" disabled>';
		$middlePart .= '<option value="pending">Pending</option>';
		$middlePart .= '<option value="accepted">Accept</option>';
		$middlePart .= '<option value="rejected" selected>Reject</option>';
		}
		$middlePart .= '</select></td></tr>';
		}


		$bottomPart = <<<EOBODY
					</tbody>
				</table>
			</div>
			<div class="text-center"> 
			<input type="submit" name="save" value="Save" class="btn btn-primary">
			<input type="submit" name="exit" value="Exit" class="btn btn-primary">
			</div>

		</form>
		</div>
		</div>
		</body>
		</html>
EOBODY;

		$topPart = <<<EOBODY

		<!doctype html>
		<html>
		<head>
		<title>Counselor Portal</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		</head>
		<body>
		<div class="container-fluid">
		<div class="row">
		<div class="col-xl-8 offset-xl-2 py-5 text-center" >
			<h2>Applications</h2>
		</div>
		</div>
		<div>
		<form action="{$_SERVER["PHP_SELF"]}" method="post">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover table-condensed text-center">
					<thead>
						<tr>
						<th class="text-center">Email</th>
						<th class="text-center">Resume</th>
						<th class="text-center">Transcript</th>
						<th class="text-center">Status</th>
						</tr>
						
					</thead>
					<tbody>

					
EOBODY;

		echo $topPart.$middlePart.$bottomPart;
	}
?>