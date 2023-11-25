$(function () {
    // Validate Username
    $("#auspiciadorcheck").hide();
    
    let auspiciadorError = true;

    $("#Auspiciador").on("input", function () {
        let regex =/^[a-zA-Z0-9 ]*$/;
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
    $("#nombre_evento").on("input", function () {
        let regex = /^[a-zA-Z0-9 ]*$/;
        let s = $(this).val();
        if (regex.test(s)) {
            $("#nombreEventoCheck").hide();
            $("#nombreEventoCheck").html("");
            $('#crearEventoBoton').prop("disabled", false);
        } else {
            $("#nombreEventoCheck").show();
            $("#nombreEventoCheck").html("nombre del evento incorrecto");
            $('#crearEventoBoton').prop("disabled", true);
        }
    });

    $('#descripcionEventoCheck').hide();
    $("#descripcion_evento").on("input", function () {
        let regex = /^[a-zA-Z0-9 ]*$/;
        let s = $(this).val();
        if (regex.test(s)) {
            $("#descripcionEventoCheck").hide();
            $("#descripcionEventoCheck").html("");
            $('#crearEventoBoton').prop("disabled", false);
        } else {
            $("#descripcionEventoCheck").show();
            $("#descripcionEventoCheck").html("descripcion del evento incorrecto");
            $('#crearEventoBoton').prop("disabled", true);
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