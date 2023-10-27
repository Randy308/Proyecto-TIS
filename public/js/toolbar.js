var contador = 2;
$(document).ready(function () {

    $("#agregarElemento").on("click", function () {
        var div = document.createElement("div");
        div.classList.add("ui-widget-content1");
        //var p = document.createElement('p');
        div.innerHTML = document.getElementById("tituloTexto").value;
        //div.appendChild(p)
        div.setAttribute("id", "elemntolista" + contador);
        contador++;
        $("#contenedorTemporal").append(div);
    });

    $("#contenedorTemporal img").resizable({
        containment: "#contenedorTemporal",
    });
    $("#contenedorTemporal").on("click", ".ui-widget-content1", function () {
        var id = $(this).attr("id");
        const childElement = document.getElementById(id);
        const parentElement = childElement.parentElement;
        if (childElement.tagName == "IMG") {
            parentElement.remove();
        }

        // Remove the child from the current parent
        $(this).detach();
        $(this).addClass("draggable");
        $(this).css("background", "whitesmoke");
        $(this).css("border", "none");
        // Add 'draggable' class

        // Append it to the new parent
        $("#containment-wrapper").append(this);

        // Make it draggable and resizable
        $("#" + id).css("position", "absolute");
        $("#" + id).resizable({
            containment: "#containment-wrapper",
            handles: "n, e, s, w",
        });

        $("#" + id).draggable({
            containment: "#containment-wrapper",
            scroll: true,
            cursor: "pointer",
        });
    });

    $("#containment-wrapper").on("click", "*", function () {
        var id = $(this).attr("id");
        const childElement = document.getElementById(id);
        console.log("hola mundo");
        $("#containment-wrapper *").removeClass("activo");
        $("#containment-wrapper *").css("border", "");
        childElement.classList.toggle("activo");
        $(this).css("border", "1px solid black");
    });

    $("#fontsize").selectmenu({
        change: function (event, data) {
            var elements = document.getElementsByClassName("activo");
            Array.from(elements).forEach(function (element) {
                $(element).css("font-size", data.item.value);
                var selectElement = document.getElementById("fontsize");
                selectElement.selectedIndex = 0;
            });
        },
    });
    $("#highlightColorPicker").on("input", function () {
        var circle = $("#containment-wrapper");
        const color = $('#highlightColorPicker').val();
        circle.css("background", color);

    });
    // $("#highlightColorPicker").selectmenu({
    //     change: function (event, data) {
    //         var circle = $("#containment-wrapper");
    //         circle.css("background", data.item.value);
    //     },
    // });

    $("#fontname").selectmenu({
        change: function (event, data) {
            var selectedFont = data.item.value;
            var elements = document.getElementsByClassName("activo");
            Array.from(elements).forEach(function (element) {
                $(element).css("font-family", selectedFont);
                var selectElement = document.getElementById("fontname");
                selectElement.selectedIndex = 0;
            });
        },
    });

    $("#forecolor").selectmenu({
        change: function (event, data) {
            var selectedColor = data.item.value;
            var elements = document.getElementsByClassName("activo");
            Array.from(elements).forEach(function (element) {
                $(element).css("color", selectedColor);
                var selectElement = document.getElementById("forecolor");
                selectElement.selectedIndex = 0;
            });
        },
    });

    $("#hilitecolor").selectmenu({
        change: function (event, data) {
            var selectedBackgroundColor = data.item.value;
            var elements = document.getElementsByClassName("activo");
            Array.from(elements).forEach(function (element) {
                $(element).css("background", selectedBackgroundColor);
                var selectElement = document.getElementById("hilitecolor");
                selectElement.selectedIndex = 0;
            });
        },
    });
    //

    $("#zoom").selectmenu({
        change: function (event, data) {
            var selectedBackgroundColor = data.item.value;
            var elements = document.getElementsByClassName("activo");
            Array.from(elements).forEach(function (element) {
                $(element).css("width", selectedBackgroundColor);
                var selectElement = document.getElementById("zoom");
                selectElement.selectedIndex = 0;
            });
        },
    });
    $("#expand-w").on("click", function () {
        var elements = document.getElementsByClassName("activo");
        Array.from(elements).forEach(function (element) {
            $(element).css("width", element.offsetWidth + 10);
            $(element).css("height", "auto");
        });
    });
    $("#expand-h").on("click", function () {
        var elements = document.getElementsByClassName("activo");
        Array.from(elements).forEach(function (element) {
            $(element).css("height", element.offsetHeight + 10);
            $(element).css("width", "auto");
        });
    });
    $("#contract-w").on("click", function () {
        var elements = document.getElementsByClassName("activo");
        Array.from(elements).forEach(function (element) {
            $(element).css("width", element.offsetWidth - 10);
            $(element).css("height", "auto");
        });
    });
    $("#contract-h").on("click", function () {
        var elements = document.getElementsByClassName("activo");
        Array.from(elements).forEach(function (element) {
            $(element).css("height", element.offsetHeight - 10);
            $(element).css("width", "auto");
        });
    });
    var boldflag = false;
    var italicflag = false;
    var underlineflag = false;
    $("#Negrita").on("click", function () {
        boldflag = boldflag ? false : true;
        var elements = document.getElementsByClassName("activo");
        Array.from(elements).forEach(function (element) {
            var selectedOption = $(element).css("font-weight");
            console.log(selectedOption);
            var option =
                selectedOption === "400" || !selectedOption ? "bold" : "normal";
            $(element).css("font-weight", option);
        });
    });
    $("#Italica").on("click", function () {
        italicflag = italicflag ? false : true;
        var elements = document.getElementsByClassName("activo");
        Array.from(elements).forEach(function (element) {
            var selectedOption = $(element).css("font-style");
            var option =
                selectedOption === "normal" || !selectedOption
                    ? "italic"
                    : "normal";
            $(element).css("font-style", option);
        });
    });
    $("#Underline").on("click", function () {
        underlineflag = underlineflag ? false : true;
        var elements = document.getElementsByClassName("activo");
        Array.from(elements).forEach(function (element) {
            var selectedOption = $(element).css("text-decoration-line");
            var option =
                selectedOption === "none" || !selectedOption
                    ? "underline"
                    : "none";
            $(element).css("text-decoration", option);
        });
    });
    $("#trash-delete").on("click", function () {
        var elements = document.getElementsByClassName("activo");
        Array.from(elements).forEach(function (element) {
            element.remove();
        });
    });
    $("#btnEditText").on("click", function () {
        var elements = document.getElementsByClassName("activo");
        Array.from(elements).forEach(function (element) {
            const $element = $(element);
            if (!($element.prop("nodeName").toLowerCase() === "img")) {
                var str = $(element).text().trim();
                let person = prompt("Modifique el nuevo contenido:", str);
                if (!(person == null || person == "")) {
                    str = person;
                }
                $(element).html(str);
            }
        });
    });

    $(function () {
        var contenedor = document.getElementById("containment-wrapper");
        const contForm = document.getElementById("GuardarElementos");
        const firstElementChild = contForm.firstElementChild;
        var numeroElemento = 1;
        var numeroImagen = 1;
        $("#btnSaveElement").on("click", function () {
            var elements = document.querySelectorAll(
                "#containment-wrapper .draggable",
            );
            contForm.innerHTML = "";
            contForm.appendChild(firstElementChild);
            Array.from(elements).forEach(function (element) {
                const $element = $(element); // Convert the DOM element to a jQuery object
                var myJSON;
                if ($element.prop("nodeName").toLowerCase() === "img") {
                    const elementoBanner = {
                        left: $element.css("left"),
                        top: $element.css("top"),
                        width: $element.css("width"),
                        height: $element.css("height"),
                        src:
                            "/storage" +
                            $element.attr("src").split("/storage").pop(),
                    };
                    myJSON = JSON.stringify(elementoBanner);
                    let input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "imagen" + numeroImagen;
                    numeroImagen++;
                    input.value = encodeURI(myJSON);
                    contForm.appendChild(input);
                } else {
                    const elementoBanner = {
                        text: $element.text().trim(),
                        left: $element.css("left"),
                        top: $element.css("top"),
                        "text-decoration": $element.css("text-decoration"),
                        "font-style": $element.css("font-style"),
                        background: $element.css("background"),
                        width: $element.css("width"),
                        height: $element.css("height"),
                        color: $element.css("color"),
                        "font-family": $element.css("font-family"),
                        "font-size": $element.css("font-size"),
                    };
                    myJSON = JSON.stringify(elementoBanner);
                    let input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "elemento" + numeroElemento;
                    numeroElemento++;
                    input.value = encodeURI(myJSON);
                    contForm.appendChild(input);
                }
                //console.log(myJSON);
            });
        });
    });
});
