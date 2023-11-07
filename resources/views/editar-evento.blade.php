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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css"
        integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    {{-- <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}"> --}}

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

                                <button type="button" id="expand-h" class="btn btn-light "> <i
                                        class="bi bi-arrows-expand"></i></button>
                                <button type="button" id="contract-h" class="btn btn-light "><i
                                        class="bi bi-arrows-collapse"></i></button>
                                <button type="button" id="expand-w" class="btn btn-light "> <i
                                        class="bi bi-arrows-expand-vertical"></i></button>
                                <button type="button" id="contract-w" class="btn btn-light "><i
                                        class="bi bi-arrows-collapse-vertical"></i></button>
                                <button type="button" id="trash-delete" class="btn btn-light"><i
                                        class="bi bi-trash3"></i></button>
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
                                    <option value="20px">20px</option>
                                    <option value="22px">22px</option>
                                    <option value="24px">24px</option>
                                    <option value="26px">26px</option>
                                    <option value="28px">28px</option>
                                    <option value="30px">30px</option>
                                    <option value="36px">36px</option>
                                    <option value="39px">39px</option>
                                    <option value="42px">42px</option>
                                    <option value="45px">45px</option>
                                    <option value="50px">50px</option>
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
                                    <option selected disabled>Color Letra </option>
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
                                <button type="button" id="Negrita">B</button>
                                <button type="button" id="Italica">I</button>
                                <button type="button" id="Underline">U</button>

                                {{-- <div class="input-group">
                                    <select type="button" id="colorFondo" name="color" class="">
                                        <option selected disabled>Color de Fondo</option>
                                        <option value="#d3d3d3">Negro</option>
                                        <option value="#FF7F7F">Rojo</option>
                                        <option value="#FFFFED">Amarillo</option>
                                        <option value="#ADD8E6">Azul</option>
                                        <option value="#90ee90 ">Verde</option>


                                </select></div> --}}
                                <button type="button" class=" btn btn-light" id="btnEditText"><i
                                        class="bi bi-pencil-fill"></i> Modificar</button>
                                <input type="text" id="tituloTexto">
                                <button type="button" class=" btn btn-light" id="agregarElemento">Agregar
                                    Texto</button>


                                <div class="input-group">
                                    <div class="input-group-text" id="btnGroupAddon">Color de Fondo</div>
                                    <input type="color"class="form-control" id="highlightColorPicker"
                                        value="#0000">
                                </div>


                                {{-- <button type="button" class=" btn btn-light" data-toggle="modal"
                                    data-target="#modalSubirBanner"><i class="bi bi-floppy-fill"></i></button> --}}
                                <button type="button" class=" btn btn-light" id="btnStoreElement" disabled><i
                                        class="bi bi-floppy-fill"></i> Aplicar cambios</button>

                                <button type="button" class=" btn btn-light" id="btnSaveElement"><i
                                        class="bi bi-arrow-repeat"></i> Sincronizar</button>
                                <button type="button" class=" btn btn-light" id="btnCloudSaveElement" disabled><i
                                        class="bi bi-cloud-arrow-up-fill"></i> Guardar progreso</button>
                            </div>

                        </div>
                        <div class="c2" style="height:400px ;width:900px;">
                            <div id="containment-wrapper" class="ui-widget-content containment-wrapper"
                                style="background-color: {{ $evento->background_color }}">
                                @if ($evento->elementoImagenBanners->count())
                                    @foreach ($evento->elementoImagenBanners as $item)
                                        <img id="imagenBanner{{ $item->id }}" class="draggable imgDrag"
                                            src="{{ $item->src }}" alt="imagenBanner{{ $item->id }}"
                                            style="position: absolute;top :{{ $item->top }};left:{{ $item->left }};width :{{ $item->width }};
                                    height:{{ $item->height }};">
                                    @endforeach
                                @endif
                                @if ($evento->elementosBanners->count())
                                    @foreach ($evento->elementosBanners as $items)
                                        <div class="draggable" id="itemDrag{{ $items->id }}"
                                            style="position: absolute;top :{{ $items->top }};left:{{ $items->left }};text-decoration :{{ $items->text_decoration }};font-style:{{ $items->font_style }};background :{{ $items->background }};color:{{ $items->color }};font-size :{{ $items->font_size }};left:{{ $items->left }};width :{{ $items->width }};height:{{ $items->height }};">
                                            {{ $items->text }}</div>
                                    @endforeach
                                @else
                                    <div id="draggable2" class="draggable" style="position: absolute;">Imagen</div>
                                    <div id="draggable3" class="draggable" style="position: absolute;">
                                        {{ $evento->nombre_evento }}</div>
                                    <div id="draggable4" class="draggable " style="position: absolute;">
                                        {{ $evento->fecha_inicio }}</div>
                                    <div id="draggable5" class="draggable" style="position: absolute;">
                                        {{ $evento->fecha_fin }}</div>
                                @endif


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
                                <p class="alert alert-info" id="file-info">No existe archivos</p>
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

                        </div>
                    </div>




                </div>
            </div>




        </div>
    </div>
    <div id="contenedor-imagen">
        <form id="FormUpdateBanner"
            action="{{ route('evento.banner.update', ['user' => auth()->user(), 'evento' => $evento->id]) }}"
            method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="imagen-banner" id="nueva-imagen-banner">

        </form>
        <form action="{{ route('crear-elementos-banner', ['evento' => $evento->id]) }}" id="GuardarElementos"
            method="POST">
            @csrf
            <input type="hidden" id="miBackgroundColor" name="background_color">
        </form>
        {{-- <div id="dialog" title="Basic dialog" style="display:none;">
            <p>This is the default dialog which is useful for displaying information. The dialog window can be moved,
                resized and closed with the &apos;x&apos; icon.</p>
        </div> --}}
    </div>

    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/dom-to-image.min.js') }}"></script>

    <script src="{{ asset('js/toolbar.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"
        integrity="sha256-c9vxcXyAG4paArQG3xk6DjyW/9aHxai2ef9RpMWO44A=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <script>
        $(document).ready(function() {
            const domNode = document.getElementById('containment-wrapper');
            var contForm = document.getElementById('nueva-imagen-banner');
            $(".containment-wrapper div.draggable").draggable({
                containment: "#containment-wrapper",
                scroll: true,
                cursor: "move",
            });
            $(".containment-wrapper .imgDrag").draggable({
                containment: "#containment-wrapper",
                scroll: true,
                cursor: "move",
            });
            $(".containment-wrapper div.draggable").resizable({
                containment: "#containment-wrapper",
                handles: "n, e, s, w"
            });

            $("#btnSaveElement").on('click', function() {
                $('#containment-wrapper').css("overflow", "visible");
                $('#containment-wrapper').css("width", "900px");
                $('#containment-wrapper').css("height", "400px");
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
                        //link.download = 'my-image-name.jpeg';
                        link.href = imgData;
                        //link.click();
                        contForm.value = imgData;


                        $('#btnStoreElement').removeAttr('disabled');
                        $('#btnCloudSaveElement').removeAttr('disabled');
                    });

            });
            $("#btnStoreElement").on('click', function() {
                // $('#dialog').css('display', 'block')
                // $(function() {
                //     $("#dialog").dialog({
                //         dialogClass: "no-close",
                //         buttons: [{
                //             text: "Cancelar",
                //             click: function() {
                //                 $(this).dialog("close");
                //             },
                //             text: "Guardar",
                //             click: function() {
                //                 document.getElementById('FormUpdateBanner').submit();
                //             }
                //         }]
                //     });

                // });
                if (confirm(
                        "¿Estás seguro de que deseas modificar el banner? No podrás realizar ediciones en el banner si no guardaste tu progreso previamente."
                    )) {
                    document.getElementById('FormUpdateBanner').submit();
                } else {
                    console.log("presionaste Cancel!");
                }
                // document.getElementById('FormUpdateBanner').submit();
            });
            $("#btnCloudSaveElement").on('click', function() {
                if (confirm('¿Estás seguro de guardar su progreso de edicionr? ')) {
                    document.getElementById('GuardarElementos').submit();
                } else {
                    console.log("presionaste Cancel!");
                }

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
