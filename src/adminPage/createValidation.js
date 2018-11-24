window.onsubmit=validateForm;

function validateForm() {
  var type = document.getElementById("type").value;
  var username = document.getElementById("username").value;
  var email = document.getElementById("email").value;
  var school = document.getElementById("school").value;
  var password = document.getElementById("password").value;
  var passwordConfirm = document.getElementById("confirmPassword").value;

  if (password !== passwordConfirm) {
    alert("Passwords entered do not match.");
    return false;
  }

  var confirm = "Do you want to submit the form data as entered?\n";
  confirm += "Type: " + type + "\n";
  confirm += "Username: " + username + "\n";
  confirm += "Email: " + email + "\n";
  confirm += "School: " + school + "\n";

  if (window.confirm(confirm)) {
    return true;
  } else {
    return false;
  }
}
