
$(document).ready(function() {

    // Validate Username
    $("#usercheck").hide();
    let usernameError = true;
    let emailError = true;
    $('#botonLogin').attr("disabled", emailError);

    const email = document.getElementById("inputEmail");
    email.addEventListener("blur", () => {
        let regex =/^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
        let s = email.value;
        if (regex.test(s)) {
            $("#usercheck").hide();
            emailError = false;
            $('#botonLogin').attr("disabled", emailError);
        } else {

            $("#usercheck").show();
            $("#usercheck").html("email incorrecto");
            emailError = true;
            $('#botonLogin').attr("disabled", emailError);
        }
    });
});


const togglePassword = document.querySelector('#togglePassword');

const password = document.querySelector('#password');
togglePassword.addEventListener('click', function(e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});

