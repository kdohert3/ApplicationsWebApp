window.onsubmit=validateForm

function validateForm() {
  var username = document.getElementById("username").value;

  var confirm = "Do you want to remove user with username " + username + "?";

  if (window.confirm(confirm)) {
    return true;
  } else {
    return false;
  }
}
