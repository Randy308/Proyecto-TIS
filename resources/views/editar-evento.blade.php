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




            <div class="container px-4">
                <div class="row">
                    <div class="col mr-2" style="height:12cm;">
                        <div class="contenteditor row mb-3 p-2" style="height:2cm;">

                            <div class="toolbar" id="toolbar">
                                {{-- <button id="print">Print</button> --}}
                                <button id="undo">Deshacer</button>
                                <button id="redo">Rehacer</button>
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
                                <select id="fontname">
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
                            </div>

                            <fieldset>
                                <select id="colorFondo" name="color" class="">
                                    <option selected disabled>Color de Fondo</option>
                                    <option value="#d3d3d3">Negro</option>
                                    <option value="#FF7F7F">Rojo</option>
                                    <option value="#FFFFED">Amarillo</option>
                                    <option value="#ADD8E6">Azul</option>
                                    <option value="#90ee90 ">Verde</option>
                                </select>

                            </fieldset>

                        </div>

                        <div class="row mt-3" style="height:10cm;">

                            <div id="containment-wrapper" class="ui-widget-content containment-wrapper"
                                style="height: 100%; width: 100%;">
                                <div id="draggable2" class="draggable ui-state-active" style="position: absolute;">
                                    Imagen</div>
                                <div id="draggable3" class="draggable ui-state-active" style="position: absolute;">
                                   {{$evento->nombre_evento}}</div>
                                <div id="draggable4" class="draggable ui-state-active" style="position: absolute;"> {{$evento->fecha_inicio}}</div>
                                <div id="draggable5" class="draggable ui-state-active" style="position: absolute;"> {{$evento->fecha_fin}}</div>
                            </div>

                        </div>
                    </div>
                    <div class="imagescol2 col-3 border ml-2 px-3" style="height:12.4cm; width: 300px;">

                        <div class="row">
                            <div id="preview" class="col-3">
                                <a href="#" id="file-select" class="btn btn-default">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="100%" viewBox="0 -960 960 960"
                                        width="100%">
                                        <path
                                            d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h360v80H200v560h560v-360h80v360q0 33-23.5 56.5T760-120H200Zm480-480v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80ZM240-280h480L570-480 450-320l-90-120-120 160Zm-40-480v560-560Z" />
                                    </svg>
                                </a>
                                {{-- <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNzEiIGhlaWdodD0iMTgwIj48cmVjdCB3aWR0aD0iMTcxIiBoZWlnaHQ9IjE4MCIgZmlsbD0iI2VlZSI+PC9yZWN0Pjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9Ijg1LjUiIHk9IjkwIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+MTcxeDE4MDwvdGV4dD48L3N2Zz4=" style="height: 40px; width:80px; opacity: 1;"/> --}}
                            </div>
                            <div id="preview2" class="col"><span class="alert alert-info" id="file-info">No hay
                                    archivo
                                    aún</span></div>
                        </div>

                        <form id="file-submit" enctype="multipart/form-data">
                            <input id="file" name="file" type="file" />
                        </form>
                        <a href="#" class="btn btn-primary" id="file-save"><svg
                                xmlns="http://www.w3.org/2000/svg" height="100%" viewBox="0 -960 960 960"
                                width="100%">
                                <path
                                    d="M440-320v-326L336-542l-56-58 200-200 200 200-56 58-104-104v326h-80ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z"
                                    fill="white" />
                            </svg></a>
                        <div class="card dropzone" id="contenedorTemporal">
                            <img src="{{ asset('/storage/image/img-default.jpeg') }}" class="ui-widget-content"
                                id="contenedorTemporal1" alt="123">

                        </div>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="contenedorcategoria col">
                        <div class="categoria my-1 ml-5 mr-2" style="display:inline-block;">Categoria:</div>
                        <form class="" action="" style="display:inline-block; margin:0;">
                            <select name="" class="btnselect custom-select">
                                <option selected>Categoria</option>
                                <option value="">Diseño</option>
                                <option value="">Desarrollo</option>
                                <option value="">QA</option>
                                <option value="">Ciencia de datos</option>
                            </select>
                        </form>
                    </div>
                    <div class="col">
                        <div class="btn-group">
                            <div class="my-1 ml-5 mr-3">Estado:</div>
                            <button type="button" class="btngrup btnact btn">Activo</button>
                            <button type="button" class="btngrup btnfin btn">finalizado</button>
                            <button type="button" class="btngrup btncan btn">Cancelado</button>
                        </div>
                    </div>
                </div>

                <div class="mt-3 mb-0 text-center">
                    <button type="button" class="btncancelar btn btn-secondary ">Cancelar</button>
                    <button type="button" class="btnguardar btn btn-primary">Guardar</button>
                    <button type="button" class=" btn btn-primary" id="btnSaveElement">Descargar</button>
                    <input type="text" id="tituloTexto">
                    <button type="button" class=" btn btn-primary" id="agregarElemento">Agregar Texto</button>

                    {{-- <button type="button" class=" btn btn-primary" id="cambiarEstadoElemento">Cambiar</button> --}}
                </div>

            </div>




        </div>
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
                div.classList.add('ui-widget-content')
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
            $("#contenedorTemporal").on("click", ".ui-widget-content", function() {
                var id = $(this).attr("id");
                const childElement = document.getElementById(id);
                const parentElement = childElement.parentElement;
                if (childElement.tagName == "IMG") {
                    parentElement.remove();
                }

                // Remove the child from the current parent
                $(this).detach();

                // Add 'draggable' class
                $(this).addClass("draggable");

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
                    cursor: "move"
                });

            });

            $("#containment-wrapper").on("click", "div", function() {
                var id = $(this).attr("id");
                const childElement = document.getElementById(id);
                console.log("hola mundo")
                $('#containment-wrapper div').removeClass('activo');
                $('#containment-wrapper div').css("border", "");
                childElement.classList.toggle("activo");
                $(this).css("border", "1px solid black");


            });

            $(function() {
                $("#fontsize").selectmenu({
                    change: function(event, data) {
                        var elements = document.getElementsByClassName("activo");
                        Array.from(elements).forEach(function(element) {

                            $(element).css("font-size", data.item.value);
                            console.log(data.item.value);
                            console.log($(element).attr("id"));
                        });
                    },
                });
            });

            $(function() {
                $("#fontsize").selectmenu({
                    change: function(event, data) {
                        var elements = document.getElementsByClassName("activo");
                        Array.from(elements).forEach(function(element) {

                            $(element).css("font-size", data.item.value);
                            console.log(data.item.value);
                            console.log($(element).attr("id"));
                        });
                    },
                });


                $("#fontname").selectmenu({
                    change: function(event, data) {
                        var selectedFont = data.item.value;
                        var elements = document.getElementsByClassName("activo");
                        Array.from(elements).forEach(function(element) {
                            $(element).css("font-family", selectedFont);
                        });
                    },
                });

                $("#forecolor").selectmenu({
                    change: function(event, data) {
                        var selectedColor = data.item.value;
                        var elements = document.getElementsByClassName("activo");
                        Array.from(elements).forEach(function(element) {
                            $(element).css("color", selectedColor);
                        });
                    },
                });


                $("#hilitecolor").selectmenu({
                    change: function(event, data) {
                        var selectedBackgroundColor = data.item.value;
                        var elements = document.getElementsByClassName("activo");
                        Array.from(elements).forEach(function(element) {
                            $(element).css("background", selectedBackgroundColor);
                        });
                    },
                });

            });



        });
    </script>


    <script>
        $(document).ready(function() {

            $("#btnSaveElement").on('click', function() {
                domtoimage.toJpeg(document.getElementById('containment-wrapper'), {
                        quality: 0.97
                    })
                    .then(function(dataUrl) {
                        var link = document.createElement('a');
                        link.download = 'my-image-name.jpeg';
                        link.href = dataUrl;
                        link.click();
                    });
            });


        });
    </script>
</body>

</html>
