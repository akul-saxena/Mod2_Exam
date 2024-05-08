// Get form input elements and error placeholders
const firstName = document.getElementById("fname");
const lastName = document.getElementById("lname");
const nameError = document.getElementById("name-error");
const passwordInput = document.getElementById("password");
const rePasswordInput = document.getElementById("repassword");
const passwordError = document.getElementById("passwordError");
const form = document.getElementById("myForm");

// Regular expressions for validation
const nameRegex = /^[A-Za-z]+$/;
const passwordRegex =
  /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
const usernameRegex = /^(?![_\W]).{1,}[A-Za-z]+\d{1,}/;

// Function to validate name format
function checkNameFormat() {
  const fname = firstName.value;
  const lname = lastName.value;
  if (fname !== "" && !nameRegex.test(fname)) {
    nameError.innerHTML = "First name should contain only alphabets.";
    return false;
  } else if (lname !== "" && !nameRegex.test(lname)) {
    nameError.innerHTML = "Last name should contain only alphabets.";
    return false;
  } else {
    nameError.innerHTML = "";
    return true;
  }
}

// Function to validate password match
function checkPassword() {
  const password = passwordInput.value;
  const rePassword = rePasswordInput.value;

  if (password === rePassword) {
    passwordInput.style.borderColor = "green";
    rePasswordInput.style.borderColor = "green";
    passwordInput.style.borderWidth = "2px";
    rePasswordInput.style.borderWidth = "2px";
    passwordError.style.display = "none";
    return true;
  } else {
    passwordInput.style.borderColor = "red";
    rePasswordInput.style.borderColor = "red";
    passwordInput.style.borderWidth = "2px";
    rePasswordInput.style.borderWidth = "2px";
    passwordError.style.display = "block";
    return false;
  }
}

// Event listeners for input fields
passwordInput.addEventListener("input", checkPassword);
rePasswordInput.addEventListener("input", checkPassword);
firstName.addEventListener("input", checkNameFormat);
lastName.addEventListener("input", checkNameFormat);

// Event listener for form submission
form.addEventListener("submit", function (event) {
  // Prevent form submission if password doesn't match
  if (!checkPassword()) {
    event.preventDefault();
  }
});
