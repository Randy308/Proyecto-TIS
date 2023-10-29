$(function () {
    // Validate Username
    $("#usercheck").hide();
    let emailError = true;
    let passError = true;

    $("#inputEmail").on("input", function () {
        let regex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
        let s = $(this).val();
        if (regex.test(s)) {
            $("#usercheck").hide();
            emailError = false;
        } else {
            $("#usercheck").show();
            $("#usercheck").html("Email incorrecto");
            emailError = true;
        }
        comprobar(emailError, passError);
    });

    $("#password").on("input", function () {
        var s = $(this).val().length;
        passError = s < 4;
        comprobar(emailError, passError);
        console.log("El tamaño es igual a " + s);
    });
});

function comprobar(emailError, passError) {
    console.log(emailError + '   ' + passError);
    if (emailError === false && passError === false) {
        $("#botonLogin").prop("disabled", false);
    } else {
        $("#botonLogin").prop("disabled", true);
    }
}


const togglePassword = document.querySelector("#togglePassword");

const password = document.querySelector("#password");
togglePassword.addEventListener("click", function (e) {
    // toggle the type attribute
    const type =
        password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);

    // toggle the eye slash icon
    this.classList.toggle("fa-eye-slash");
});
