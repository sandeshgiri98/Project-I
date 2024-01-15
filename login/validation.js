var email = document.forms['form']['email'];
var password = document.forms['form']['password'];

var email_error = document.getElementById('email-error');
var password_error = document.getElementById('pass-error');

email.addEventListener('textInput', emailVerify);
password.addEventListener('textInput', passVerify);

function validate() {
    if (email.value.length < 9) {
        email.style.border = "1px solid red";
        email_error.style.display = "block";
        email.focus();
        return false;
    }
    if (password.value.length < 1) {
        password.style.border = "1px solid red";
        password_error.style.display = "block";
        password.focus();
        return false;
    }
}

function emailVerify() {
    if (email.value.length >= 8) {
        email.style.border = "1px solid silver";
        email_error.style.display = "none";
        return true;
    }
}

function passVerify() {
    if (password.value.length >= 8) {
        password.style.border = "1px solid silver";
        password_error.style.display = "none";
        return true;
    }
}