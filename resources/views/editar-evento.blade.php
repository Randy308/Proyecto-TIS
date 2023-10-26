<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Evento</title>
    @include('layouts/estilos')

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/listEvent.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles-editar-evento.css') }}">
    <style>
        .navbar-custom {
            background-color: #007BFF;
            color: #fff;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">

</head>

<body>




    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')




            <div class="container pt-4">

                <div class="content ">
                    <div class="subcontent ">
                        <div class="c1 pb-4">
                            <div id="toolbar">

                                <button id="expand-h" class="btn btn-light "> <i
                                        class="bi bi-arrows-expand"></i></button>
                                <button id="contract-h" class="btn btn-light "><i
                                        class="bi bi-arrows-collapse"></i></button>
                                <button id="expand-w" class="btn btn-light "> <i
                                        class="bi bi-arrows-expand-vertical"></i></button>
                                <button id="contract-w" class="btn btn-light "><i
                                        class="bi bi-arrows-collapse-vertical"></i></button>
                                <button id="trash-delete" class="btn btn-light"><i class="bi bi-trash3"></i></button>
                                <select id="zoom">
                                    <option selected disabled>Zoom</option>
                                    <option>50%</option>
                                    <option>75%</option>
                                    <option>90%</option>
                                    <option>100%</option>
                                    <option>125%</option>
                                    <option>150%</option>
                                    <option>200%</option>
                                </select>
                                <select id="fontname" style="width: 300px">
                                    <option selected disabled>Fuente</option>
                                    <option>Arial</option>
                                    <option>Comic Sans MS</option>
                                    <option>Courier New</option>
                                    <option>Georgia</option>
                                    <option>Impact</option>
                                    <option>Lucida Grande</option>
                                    <option>Times New Roman</option>
                                    <option>Verdana</option>
                                </select>
                                <select id="fontsize">
                                    <option selected disabled>Tamaño</option>
                                    <option value="8px">8px</option>
                                    <option value="9px">9px</option>
                                    <option value="10px">10px</option>
                                    <option value="11px">11px</option>
                                    <option value="12px">12px</option>
                                    <option value="14px">14px</option>
                                    <option value="18px">18px</option>
                                    <option value="24px">24px</option>
                                    <option value="30px">30px</option>
                                    <option value="36px">36px</option>
                                    <option value="36px">39px</option>
                                    <option value="36px">42px</option>
                                    <option value="36px">45px</option>
                                </select>
                                <select id="hilitecolor" title="Background color">
                                    <option selected disabled>Resaltar</option>
                                    <option value="transparent">Ninguno</option>
                                    <option value="white">Blanco</option>
                                    <option value="red">Rojo</option>
                                    <option value="yellow">Amarillo</option>
                                    <option value="green">Verde</option>
                                    <option value="blue">Azul</option>
                                    <option value="grey">Gris</option>
                                    <option value="purple">Morado</option>
                                    <option value="orange">Naranja</option>
                                </select>
                                <select id="forecolor" title="Color">
                                    <option selected disabled>Color Letra</option>
                                    <option value="black">Negro</option>
                                    <option value="white">Blanco</option>
                                    <option value="red">Rojo</option>
                                    <option value="yellow">Amarillo</option>
                                    <option value="green">Verde</option>
                                    <option value="blue">Azul</option>
                                    <option value="#ccc">Gris</option>
                                    <option value="purple">Morado</option>
                                    <option value="orange">Naranja</option>
                                </select>
                                <button id="bold">B</button>
                                <button id="italic">I</button>
                                <button id="underline">U</button>
                                <select id="colorFondo" name="color" class="">
                                    <option selected disabled>Color de Fondo</option>
                                    <option value="#d3d3d3">Negro</option>
                                    <option value="#FF7F7F">Rojo</option>
                                    <option value="#FFFFED">Amarillo</option>
                                    <option value="#ADD8E6">Azul</option>
                                    <option value="#90ee90 ">Verde</option>
                                </select>

                                <input type="text" id="tituloTexto">
                                <button type="button" class=" btn btn-light" id="agregarElemento">Agregar
                                    Texto</button>
                                <button type="button" class=" btn btn-light" data-toggle="modal"
                                    data-target="#modalSubirBanner"><i class="bi bi-floppy-fill"></i></button>
                                <button type="button" class=" btn btn-light" id="btnSaveElement"><i
                                        class="bi bi-download"></i></button>
                            </div>

                        </div>
                        <div class="c2" style="height:400px">
                            <div id="containment-wrapper" class="ui-widget-content containment-wrapper"
                                style="height: 100%;">
                                <div id="draggable2" class="draggable" style="position: absolute;">
                                    Imagen</div>
                                <div id="draggable3" class="draggable" style="position: absolute;">
                                    {{ $evento->nombre_evento }}</div>
                                <div id="draggable4" class="draggable " style="position: absolute;">
                                    {{ $evento->fecha_inicio }}</div>
                                <div id="draggable5" class="draggable" style="position: absolute;">
                                    {{ $evento->fecha_fin }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="subcontent-c2">
                        <div class="cont-c1">
                            <div id="preview">
                                <a href="#" id="file-select-auspiciadores" class="btn btn-default">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="100%" viewBox="0 -960 960 960"
                                        width="100%">
                                        <path
                                            d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h360v80H200v560h560v-360h80v360q0 33-23.5 56.5T760-120H200Zm480-480v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80ZM240-280h480L570-480 450-320l-90-120-120 160Zm-40-480v560-560Z" />
                                    </svg>
                                </a>
                            </div>
                            <div id="preview2">
                                <p class="alert alert-info" id="file-info">No hay archivo
                                    aún</p>
                            </div>
                        </div>
                        <div class="c2">
                            <form id="file-submit" enctype="multipart/form-data">
                                <input id="file-auspiciadores" name="file" type="file" />
                                <a href="#" class="btn btn-primary" id="file-save"><svg
                                        xmlns="http://www.w3.org/2000/svg" height="100%" viewBox="0 -960 960 960"
                                        width="100%">
                                        <path
                                            d="M440-320v-326L336-542l-56-58 200-200 200 200-56 58-104-104v326h-80ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z"
                                            fill="white" />
                                    </svg></a>
                            </form>
                        </div>
                        <div class="c3">
                            <div class="card dropzone" id="contenedorTemporal">
                                <img src="{{ asset('/storage/image/img-default.jpeg') }}" class="ui-widget-content1"
                                    id="contenedorTemporal1" alt="123" width="100%" height="100%">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-c3">
                    <div class="subcontent">
                        <div class="m-3 text-center">
                            @include('layouts.actualizar-imagen-banner', ['evento' => $evento])
                        </div>
                    </div>




                </div>
            </div>




        </div>
    </div>
    <div id="contenedor-imagen">

    </div>
    @include('layouts/sidebar-scripts')
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/dom-to-image.min.js') }}"></script>
    <script src="{{ asset('js/javascript-editar-evento.js') }}"></script>
    <script>
        var contador = 2;
        $(document).ready(function() {
            $("#agregarElemento").on("click", function() {
                var div = document.createElement('div');
                div.classList.add('ui-widget-content1')
                //var p = document.createElement('p');
                div.innerHTML = document.getElementById('tituloTexto').value;
                //div.appendChild(p)
                div.setAttribute("id", "elemntolista" + contador);
                contador++;
                $("#contenedorTemporal").append(div);
            });

            $("#contenedorTemporal img").resizable({
                containment: "#contenedorTemporal"
            });
            $("#contenedorTemporal").on("click", ".ui-widget-content1", function() {
                var id = $(this).attr("id");
                const childElement = document.getElementById(id);
                const parentElement = childElement.parentElement;
                if (childElement.tagName == "IMG") {
                    parentElement.remove();
                }

                // Remove the child from the current parent
                $(this).detach();
                $(this).addClass("draggable");
                $(this).css("background", 'whitesmoke');
                $(this).css("border", 'none');
                // Add 'draggable' class



                // Append it to the new parent
                $("#containment-wrapper").append(this);

                // Make it draggable and resizable
                $("#" + id).css("position", "absolute");
                $("#" + id).resizable({
                    containment: "#containment-wrapper",
                    handles: "n, e, s, w"
                });

                $("#" + id).draggable({
                    containment: "#containment-wrapper",
                    scroll: true,
                    cursor: "pointer"
                });

            });

            $("#containment-wrapper").on("click", "*", function() {
                var id = $(this).attr("id");
                const childElement = document.getElementById(id);
                console.log("hola mundo")
                $('#containment-wrapper *').removeClass('activo');
                $('#containment-wrapper *').css("border", "");
                childElement.classList.toggle("activo");
                $(this).css("border", "1px solid black");


            });



            $(function() {
                $("#fontsize").selectmenu({
                    change: function(event, data) {
                        var elements = document.getElementsByClassName("activo");
                        Array.from(elements).forEach(function(element) {

                            $(element).css("font-size", data.item.value);
                            var selectElement = document.getElementById("fontsize");
                            selectElement.selectedIndex = 0;
                        });
                    },
                });


                $("#fontname").selectmenu({
                    change: function(event, data) {
                        var selectedFont = data.item.value;
                        var elements = document.getElementsByClassName("activo");
                        Array.from(elements).forEach(function(element) {
                            $(element).css("font-family", selectedFont);
                            var selectElement = document.getElementById("fontname");
                            selectElement.selectedIndex = 0;
                        });
                    },
                });

                $("#forecolor").selectmenu({
                    change: function(event, data) {
                        var selectedColor = data.item.value;
                        var elements = document.getElementsByClassName("activo");
                        Array.from(elements).forEach(function(element) {
                            $(element).css("color", selectedColor);
                            var selectElement = document.getElementById("forecolor");
                            selectElement.selectedIndex = 0;
                        });
                    },
                });


                $("#hilitecolor").selectmenu({
                    change: function(event, data) {
                        var selectedBackgroundColor = data.item.value;
                        var elements = document.getElementsByClassName("activo");
                        Array.from(elements).forEach(function(element) {
                            $(element).css("background", selectedBackgroundColor);
                            var selectElement = document.getElementById("hilitecolor");
                            selectElement.selectedIndex = 0;
                        });
                    },
                });
                //

                $("#zoom").selectmenu({
                    change: function(event, data) {
                        var selectedBackgroundColor = data.item.value;
                        var elements = document.getElementsByClassName("activo");
                        Array.from(elements).forEach(function(element) {
                            $(element).css("width", selectedBackgroundColor);
                            var selectElement = document.getElementById("zoom");
                            selectElement.selectedIndex = 0;
                        });
                    },
                });
                $('#expand-w').on("click", function() {
                    var elements = document.getElementsByClassName("activo");
                    Array.from(elements).forEach(function(element) {
                        $(element).css("width", element.offsetWidth + 10);
                        $(element).css("height", "auto");
                    });
                });
                $('#expand-h').on("click", function() {
                    var elements = document.getElementsByClassName("activo");
                    Array.from(elements).forEach(function(element) {
                        $(element).css("height", element.offsetHeight + 10);
                        $(element).css("width", "auto");
                    });
                });
                $('#contract-w').on("click", function() {
                    var elements = document.getElementsByClassName("activo");
                    Array.from(elements).forEach(function(element) {
                        $(element).css("width", element.offsetWidth - 10);
                        $(element).css("height", "auto");
                    });
                });
                $('#contract-h').on("click", function() {
                    var elements = document.getElementsByClassName("activo");
                    Array.from(elements).forEach(function(element) {
                        $(element).css("height", element.offsetHeight - 10);
                        $(element).css("width", "auto");
                    });
                });
                var boldflag = false;
                var italicflag = false;
                var underlineflag = false;
                $('#bold').on("click", function() {
                    boldflag = boldflag ? false : true;
                    var elements = document.getElementsByClassName("activo");
                    Array.from(elements).forEach(function(element) {
                        var option = boldflag ? 'bold' : 'normal'
                        $(element).css("font-weight", option);
                    });
                });
                $('#italic').on("click", function() {
                    italicflag = italicflag ? false : true;
                    var elements = document.getElementsByClassName("activo");
                    Array.from(elements).forEach(function(element) {
                        var option = italicflag ? 'italic' : 'normal'
                        $(element).css("font-style", option);
                    });
                });
                $('#underline').on("click", function() {
                    underlineflag = underlineflag ? false : true;
                    var elements = document.getElementsByClassName("activo");
                    Array.from(elements).forEach(function(element) {
                        var option = underlineflag ? 'underline' : 'none'
                        $(element).css("text-decoration", option);
                    });
                });
                $('#trash-delete').on("click", function() {

                    var elements = document.getElementsByClassName("activo");
                    Array.from(elements).forEach(function(element) {
                        element.remove();
                    });
                });
            });



        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"
        integrity="sha256-c9vxcXyAG4paArQG3xk6DjyW/9aHxai2ef9RpMWO44A=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <script>
        $(document).ready(function() {
            const domNode = document.getElementById('containment-wrapper');
            var contForm = document.getElementById('contenedor-imagen');
            $("#btnSaveElement").on('click', function() {
                $('#containment-wrapper').css("overflow", "visible");
                $('#containment-wrapper').css("width", "900px");
                var scale = 2;
                var fileName = 'Test File';

                domtoimage.toPng(domNode, {
                        width: domNode.clientWidth * scale,
                        height: domNode.clientHeight * scale,
                        style: {
                            transform: "scale(" + scale + ")",
                            transformOrigin: "top left"
                        }
                    })
                    .then(function(imgData) {

                        var link = document.createElement('a');
                        link.download = 'my-image-name.jpeg';
                        link.href = imgData;
                        link.click();
                        $('#containment-wrapper').css("overflow", "auto");
                        $('#containment-wrapper').css("width", "auto");
                    });

            });


        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            var contenedor = document.getElementById('containment-wrapper');
            var contForm = document.getElementById('contenedor-imagen');
            $("#btnSaveElement").on('click', function() {
                $('#containment-wrapper').css("overflow", "visible");
                $('#containment-wrapper').css("width", "900px");
                domtoimage.toJpeg(contenedor, {
                        quality: 0.97
                    })
                    .then(function(dataUrl) {
                        var link = document.createElement('a');
                        //link.download = 'my-image-name.jpeg';
                        link.href = dataUrl;
                        //link.click();
                        contForm.appendChild(link);
                        $('#containment-wrapper').css("overflow", "auto");
                        $('#containment-wrapper').css("width", "auto");
                    });

            });


        });
    </script> --}}
</body>

</html>
