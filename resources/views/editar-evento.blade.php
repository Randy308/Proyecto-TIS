<!DOCTYPE html>
<html lang="es">

<head>

    <title>Editar Evento</title>

    @include('layouts/estilos')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/listEvent.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles-editar-evento.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css"
        integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>




    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')

            <div class="container pt-4" id="miContainer">
                <div class="d-flex justify-content-end mb-4"><a href="#" class="btn btn-danger btn-sm"
                        onclick="confirmarCancelacion()"><i class="bi bi-x-lg"></i></a></div>
                <div class="content ">

                    <div class="subcontent ">
                        <div class="c1 pb-4">
                            <div id="toolbar">

                                {{-- <button type="button" id="expand-h" class="btn btn-light "> <i
                                        class="bi bi-arrows-expand"></i></button>
                                <button type="button" id="contract-h" class="btn btn-light "><i
                                        class="bi bi-arrows-collapse"></i></button>
                                <button type="button" id="expand-w" class="btn btn-light "> <i
                                        class="bi bi-arrows-expand-vertical"></i></button>
                                <button type="button" id="contract-w" class="btn btn-light "><i
                                        class="bi bi-arrows-collapse-vertical"></i></button> --}}

                                {{-- <select id="zoom">
                                    <option selected disabled>Zoom</option>
                                    <option>50%</option>
                                    <option>75%</option>
                                    <option>90%</option>
                                    <option>100%</option>
                                    <option>125%</option>
                                    <option>150%</option>
                                    <option>200%</option>
                                </select> --}}
                                <select id="fontname" style="width: 300px">
                                    <option selected disabled>Fuente</option>
                                    <option style="font-family: Arial">Arial</option>
                                    <option style="font-family: 'Comic Sans MS'">Comic Sans MS</option>
                                    <option style="font-family: 'Courier New'">Courier New</option>
                                    <option style="font-family: Georgia">Georgia</option>
                                    <option style="font-family: Impact">Impact</option>
                                    <option style="font-family: 'Lucida Grande', sans-serif">Lucida Grande</option>
                                    <option style="font-family: 'Times New Roman'">Times New Roman</option>
                                    <option style="font-family: Verdana">Verdana</option>
                                    <!-- Fuentes adicionales -->
                                    <option style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif">
                                        Helvetica Neue</option>
                                    <option style="font-family: 'Trebuchet MS', Arial, sans-serif">Trebuchet MS</option>
                                    <option style="font-family: 'Palatino Linotype', 'Book Antiqua', Palatino, serif">
                                        Palatino Linotype</option>
                                    <option style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Segoe
                                        UI</option>
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
                                <button type="button" id="minuscula"><i class="bi bi-alphabet"></i></button>
                                <button type="button" id="mayuscula"><i class="bi bi-alphabet-uppercase"></i></button>
                                <button type="button" id="incrementarSize"><i class="bi bi-sort-up"></i></button>
                                <button type="button" id="disminuirSize"><i class="bi bi-sort-down"></i></button>
                                <button type="button" id="Negrita">B</button>
                                <button type="button" id="Italica">I</button>
                                <button type="button" id="Underline">U</button>
                                <button type="button" class=" btn btn-light" id="btnEditText"><i
                                        class="bi bi-pencil-fill"></i> Modificar Texto</button>
                                {{-- <div class="input-group">
                                    <select type="button" id="colorFondo" name="color" class="">
                                        <option selected disabled>Color de Fondo</option>
                                        <option value="#d3d3d3">Negro</option>
                                        <option value="#FF7F7F">Rojo</option>
                                        <option value="#FFFFED">Amarillo</option>
                                        <option value="#ADD8E6">Azul</option>
                                        <option value="#90ee90 ">Verde</option>


                                </select></div> --}}

                                <div>
                                    <input type="text" id="tituloTexto">
                                    <button type="button" class=" btn btn-light" id="agregarElemento">Agregar
                                        Texto</button>
                                </div>


                                <button type="button" id="trash-delete" class="btn btn-light">Borrar <i
                                        class="bi bi-trash3"></i></button>

                                <div class="input-group d-flex align-items-center">
                                    <label for="highlightColorPicker">Color de Fondo</label>

                                    <input type="color"class="form-control" id="highlightColorPicker"
                                        value="#0000">
                                </div>


                                {{-- <button type="button" class=" btn btn-light" data-toggle="modal"
                                    data-target="#modalSubirBanner"><i class="bi bi-floppy-fill"></i></button> --}}
                                <button type="button" class=" btn btn-light" id="btnStoreElement"><i
                                        class="bi bi-floppy-fill"></i> Crear Banner</button>

                                <button type="button" class=" btn btn-light" id="btnCloudSaveElement"><i
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
                                    @foreach ($fechasArray as $item)
                                        <div id="draggable{{ $loop->index + 4 }}" class="draggable "
                                            style="position: absolute;">
                                            {{ $item }}</div>
                                    @endforeach

                                @endif


                            </div>
                        </div>
                    </div>
                    <div class="subcontent-c2">


                        <div class="c3">
                            <div class="d-flex align-elements-center">
                                <p class="h6"> Lista de Auspiciadores: </p>

                            </div>
                            <div class="p-2">
                                <label for="formFile">Agregar imagen</label>
                                <input class="form-control form-control-sm" name="foto_perfil" type="file"
                                    id="formFile" ngf-pattern="'image/*'" accept="image/*" ngf-max-size="2MB">
                            </div>
                            <div class="card dropzone" id="contenedorTemporal">

                                {{-- <img src="{{ asset('/storage/image/img-default.jpeg') }}" class="ui-widget-content1"
                                    id="contenedorTemporal1" alt="123" width="100%" height="100%"> --}}
                                @if ($evento->auspiciadors->count())
                                    @foreach ($evento->auspiciadors as $item)
                                        <div style="margin: 0 5px">
                                            <img src="{{ asset($item->url) }}" alt="logo-banner-{{ $item->nombre }}"
                                                width="100%" height="100%"
                                                id="contenedorTemporal{{ $item->id }}"
                                                class="ui-widget-content1" />
                                        </div>
                                    @endforeach
                                @endif
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

    </div>

    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')
    <script>
        function confirmarCancelacion() {
            if (confirm("¿Estás seguro de que deseas salir? Todos los cambios no guardados se perderán.")) {
                window.location.href = "{{ route('misEventos', ['tab' => 2]) }}";
            }
        }
    </script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/dom-to-image.min.js') }}"></script>

    <script src="{{ asset('js/toolbar.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"
        integrity="sha256-c9vxcXyAG4paArQG3xk6DjyW/9aHxai2ef9RpMWO44A=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/gh/godswearhats/jquery-ui-rotatable@1.1/jquery.ui.rotatable.css">
    <script src="https://cdn.jsdelivr.net/gh/godswearhats/jquery-ui-rotatable@1.1/jquery.ui.rotatable.min.js"></script>
    <script>
        function generarImagenBanner() {
            let domNode = document.getElementById('containment-wrapper');
            let contForm = document.getElementById('nueva-imagen-banner');
            $('#containment-wrapper').css("overflow", "visible");
            $('#containment-wrapper').css("width", "900px");
            $('#containment-wrapper').css("height", "400px");
            $('#containment-wrapper .activo').css("border", "none");
            var scale = 2;
            var fileName = 'Test File';
            limpiar();
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

                });

        }
    </script>
    <script>
        function limpiar() {
            var iconos = document.querySelectorAll(
                ".ui-resizable-handle.ui-resizable-se.ui-icon.ui-icon-gripsmall-diagonal-se");
            for (const element of iconos) {
                element.style.backgroundImage = 'none';
            }
        }
        $(document).ready(function() {

            $(".containment-wrapper div.draggable").draggable({
                containment: "#containment-wrapper",
                scroll: true,
                cursor: "move",
            });

            $(".containment-wrapper .imgDrag").resizable({
                handles: 'ne, se, sw, nw'
            });
            $(".containment-wrapper .imgDrag").parent().draggable({
                containment: "#containment-wrapper",
                scroll: true,
                cursor: "pointer",
            });


            $(".containment-wrapper div.draggable").resizable({
                containment: "#containment-wrapper",
                handles: "n, e, s, w"
            });




            $("#btnStoreElement").on('click', function() {
                generarImagenBanner();
                var millisecondsToWait = 1000;
                setTimeout(function() {
                    if (confirm(
                            "¿Estás seguro de que deseas modificar el banner? No podrás realizar ediciones en el banner si no guardaste tu progreso previamente."
                        )) {

                        //salvarElementosBanner();
                        document.getElementById('FormUpdateBanner').submit();
                    } else {
                        console.log("presionaste Cancel!");
                    }
                }, millisecondsToWait);

                // document.getElementById('FormUpdateBanner').submit();
            });
            $("#btnCloudSaveElement").on('click', function() {
                salvarElementosBanner();
                var millisecondsToWait = 1000;
                setTimeout(function() {
                    if (confirm(
                            '¿Estás seguro de querer guardar tu progreso de edición? Ten en cuenta que si has agregado imágenes, estas no se guardarán '
                        )) {
                        document.getElementById('GuardarElementos').submit();
                        generarImagenBanner();

                    } else {
                        console.log("presionaste Cancel!");
                    }

                }, millisecondsToWait);

            });


        });
    </script>
</body>

</html>
