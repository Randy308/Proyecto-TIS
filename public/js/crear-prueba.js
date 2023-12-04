var currentTab = 0;
document.addEventListener("DOMContentLoaded", function (event) {


    showTab(currentTab);

});

function showTab(n) {
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = 'Crear evento';
    } else {
        document.getElementById("nextBtn").innerHTML = 'Siguiente <i class="fa fa-angle-double-right"></i>';
    }
    fixStepIndicator(n)
}

function prev(n) {
    var x = document.getElementsByClassName("tab");
    if (currentTab == 0) {
        return
    }
    x[currentTab].style.display = "none";
    currentTab = currentTab - n;

    if (currentTab >= x.length) {

        document.getElementById("nextprevious").style.display = "none";
        document.getElementById("all-steps").style.display = "none";
        document.getElementById("register").style.display = "none";
        document.getElementById("text-message").style.display = "block";




    }
    showTab(currentTab);
}

function next(n) {
    var x = document.getElementsByClassName("tab");
    if (currentTab == (x.length - 1)) {
        document.getElementById("FormCrearEvento").submit();
        return
    }
    x[currentTab].style.display = "none";
    currentTab = currentTab + n;
    if (currentTab >= x.length) {

        document.getElementById("nextprevious").style.display = "none";
        document.getElementById("all-steps").style.display = "none";
        document.getElementById("register").style.display = "none";
        document.getElementById("text-message").style.display = "block";




    }
    showTab(currentTab);
}



function fixStepIndicator(n) {
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    x[n].className += " active";
}
$(document).ready(function () {
    // Oculta los campos adicionales al cargar la página
    $('#campos-adicionales input[type="text"]').hide();

    // Muestra u oculta los campos adicionales según el estado de los checkboxes
    $('input[type="checkbox"]').change(function () {
        var campoAsociado = $(this).next('input[type="text"]');
        campoAsociado.toggle(); // Muestra u oculta el campo según el estado del checkbox
    });

    // Muestra u oculta los campos adicionales al cambiar la opción en el menú desplegable
    $('#privacidad').change(function () {
        if ($(this).val() === 'con-restriccion') {
            $('#campos-adicionales').show();
        } else {
            $('#campos-adicionales').hide();
            // Oculta los campos adicionales si el tipo de evento no es "competencia_individual" ni "taller_individual"
            $('#eventoRequeridoGroup').hide();
            $('#mostrarEvento').prop('checked', false);
            $('#evento').hide();
        }
    });

    $('#tipo_evento').change(function () {
        var selectedTipoEvento = $(this).val();
        var eventoRequeridoGroup = $('#eventoRequeridoGroup');

        if (selectedTipoEvento === 'competencia_individual' || selectedTipoEvento ===
            'competencia_grupal') {
            eventoRequeridoGroup.show();
        } else {
            camposAdicionales.hide();
            eventoRequeridoGroup.hide();
            $('#mostrarEvento').prop('checked', false);
            $('#evento').hide();
        }
    });

    $('#mostrarEvento').change(function () {
        $('#evento').toggle(this.checked);
    });
    $('#campos-adicionales').hide();
    $('#privacidad').change(function () {
        if ($(this).val() === 'con-restriccion') {
            $('#campos-adicionales').show();
        } else {
            $('#campos-adicionales').hide();
        }
    });


    
});


