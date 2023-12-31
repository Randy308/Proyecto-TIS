$(function () {

    // Validate Username
    $("#auspiciadorcheck").hide();

    let auspiciadorError = true;

    $("#Auspiciador").on("input", function () {
        let regex = /^[a-zA-Z0-9 ]*$/;
        let s = $(this).val();
        if (regex.test(s)) {
            $("#auspiciadorcheck").hide();
            auspiciadorError = false;
            $('#CrearAuspiciador').prop("disabled", false);
        } else {
            $("#auspiciadorcheck").show();
            $("#auspiciadorcheck").html("nombre de auspiciador incorrecto");
            $('#CrearAuspiciador').prop("disabled", true);
            auspiciadorError = true;
        }
    });
    $('#roleCheck').hide();
    $("#NombreRol").on("input", function () {
        let regex = /^[a-zA-Z0-9 ]*$/;
        let s = $(this).val();
        if (regex.test(s)) {
            $("#roleCheck").hide();
            $("#roleCheck").html("");
            $('#crearRol').prop("disabled", false);
        } else {
            $("#roleCheck").show();
            $("#roleCheck").html("nombre de rol incorrecto");
            $('#crearRol').prop("disabled", true);
        }
    });


    $('#nombreEventoCheck').hide();
    $('#nextBtn').prop("disabled", true);
    $("#nombre_evento").on("input", function () {
        let regex = /^[a-zA-Z0-9 ]*$/;
        let s = $(this).val();
        if (regex.test(s)) {
            $("#nombreEventoCheck").hide();
            $("#nombreEventoCheck").html("");
            $('#nextBtn').prop("disabled", false);
        } else {
            $("#nombreEventoCheck").show();
            $("#nombreEventoCheck").html("nombre del evento incorrecto");
            $('#nextBtn').prop("disabled", true);
        }
        if (s.length < 4) {
            $("#nombreEventoCheck").show();
            $("#nombreEventoCheck").html("nombre del evento incorrecto, el titulo es demasiado corto");
            $('#nextBtn').prop("disabled", true);

        }
    });

    $('#tipo_eventoCheck').hide();
    $('#nextBtn').prop("disabled", true);
    $("#tipo_evento").on("input", function () {
        let regex = /^[a-zA-Z0-9 ]*$/;
        let s = $(this).val();
        if (regex.test(s)) {
            $("#tipo_eventoCheck").hide();
            $("#tipo_eventoCheck").html("");
            $('#nextBtn').prop("disabled", false);
        } else {
            $("#tipo_eventoCheck").show();
            $("#tipo_eventoCheck").html("nombre del tipo de evento incorrecto");
            $('#nextBtn').prop("disabled", true);
        }
        if (s.length < 2) {
            $("#tipo_eventoCheck").show();
            $("#tipo_eventoCheck").html("nombre del tipo de  evento incorrecto");
            $('#nextBtn').prop("disabled", true);

        }
    });

    $('#descripcionEventoCheck').hide();
    $("#descripcion_evento").on("input", function () {
        let regex = /^[a-zA-Z0-9 ]*$/;
        let s = $(this).val();
        if (regex.test(s)) {
            $("#descripcionEventoCheck").hide();
            $("#descripcionEventoCheck").html("");
            $('#nextBtn').prop("disabled", false);
        } else {
            $("#descripcionEventoCheck").show();
            $("#descripcionEventoCheck").html("descripcion del evento incorrecto");
            $('#nextBtn').prop("disabled", true);
        }
    });//telefonoCheck     id="formPhoneNumber"

    $('#telefonoCheck').hide();
    $("#formPhoneNumber").on("input", function () {
        let regex = /^[0-9]*$/;
        let s = $(this).val();
        if (regex.test(s)) {
            $("#telefonoCheck").hide();
            $("#telefonoCheck").html("");
            $('#crearUsuarioBoton').prop("disabled", false);
        } else {
            $("#telefonoCheck").show();
            $("#telefonoCheck").html("numero de telefono invalido");
            $('#crearUsuarioBoton').prop("disabled", true);
        }
        if (s.length <8) {
            $("#telefonoCheck").show();
            $("#telefonoCheck").html("numero de telefono invalido");
            $('#crearUsuarioBoton').prop("disabled", true);
        }
    });

    $('#nameCheck').hide();
    $("#formName").on("input", function () {
        let regex = /^[a-zA-Z0-9 ]*$/;
        let s = $(this).val();
        if (regex.test(s)) {
            $("#nameCheck").hide();
            $("#nameCheck").html("");
            $('#crearUsuarioBoton').prop("disabled", false);
        } else {
            $("#nameCheck").show();
            $("#nameCheck").html("El nombre no permite caracteres especiales");
            $('#crearUsuarioBoton').prop("disabled", true);
        }
        if (s.length ==0) {
            $("#nameCheck").show();
            $("#nameCheck").html("Este es un campo obligatorio");
            $('#crearUsuarioBoton').prop("disabled", true);

        }
    });


    $('#emailUserCheck').hide();
    $("#formEmail").on("input", function () {
        let regex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
        let s = $(this).val();
        if (regex.test(s)) {
            $("#emailUserCheck").hide();
            $("#emailUserCheck").html("");
            $('#crearUsuarioBoton').prop("disabled", false);
        } else {
            $("#emailUserCheck").show();
            $("#emailUserCheck").html("No es un email valido");
            $('#crearUsuarioBoton').prop("disabled", true);
        }
    });
});


$(document).ready(function () {
    var inputValue = $("#fecha_fin").val();
    console.log(inputValue)
    if (inputValue === "") {
        $('#nextBtn').prop("disabled", true);
    } else {
        $('#nextBtn').prop("disabled", false);
    }
});
