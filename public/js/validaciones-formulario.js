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
            $("#nombreEventoCheck").html("nombre del evento incorrecto");
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
            $("#nameCheck").html("nombre incorrecto");
            $('#crearUsuarioBoton').prop("disabled", true);
        }
    });

    $('#costoCheck').hide();
    $("#costo").on("input", function () {
        let regex = /^[0-9]+$/; // Permitir solo números enteros
        let s = $(this).val();

        if (regex.test(s)) {
            $("#costoCheck").hide();
            $("#costoCheck").html("");
            $('#nextBtn').prop("disabled", false);
        } else {
            $("#costoCheck").show();
            $("#costoCheck").html("Costo del evento incorrecto. Ingrese solo números.");
            $('#nextBtn').prop("disabled", true);
        }
    });
    $('#cantidadMinimaCheck').hide();

    $("#cantidad_minima").on("input", function () {
        let regex = /^[0-9]+$/;
        let s = $(this).val();

        if (regex.test(s)) {
            $("#cantidadMinimaCheck").hide();
            $("#cantidadMinimaCheck").html("");
            $('#nextBtn').prop("disabled", false);
        } else {
            $("#cantidadMinimaCheck").show();
            $("#cantidadMinimaCheck").html("Cantidad mínima de participantes incorrecta");
            $('#nextBtn').prop("disabled", true);
        }
    });
    $('#cantidadMaximaCheck').hide();

    $("#cantidad_maxima").on("input", function () {
        let regex = /^[0-9]+$/;
        let s = $(this).val();

        if (regex.test(s)) {
            $("#cantidadMaximaCheck").hide();
            $("#cantidadMaximaCheck").html("");
            $('#nextBtn').prop("disabled", false);
        } else {
            $("#cantidadMaximaCheck").show();
            $("#cantidadMaximaCheck").html("Cantidad máxima de participantes incorrecta");
            $('#nextBtn').prop("disabled", true);
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
            $("#emailUserCheck").html("nombre incorrecto");
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
