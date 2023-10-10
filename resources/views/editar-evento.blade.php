@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col mr-2" style="height:12.9cm;">
            <div class="row border mb-3" style="height:2.5cm;">
                
                <form action="#">
                    <fieldset>
                      <label for="color">Color Fondo</label>
                      <select name="color" id="color">
                        <option value="" selected="selected">Ninguno</option>
                        <option value="black">Black</option>
                        <option value="red">Red</option>
                        <option value="yellow">Yellow</option>
                        <option value="blue">Blue</option>
                        <option value="green">Green</option>
                      </select>
                    </fieldset>
                  </form>
                

            </div>
            <div class="row border mt-3" style="height:10cm;">
                
                <div id="containment-wrapper" class="ui-widget-content" style="height: 100%; width: 100%;">
                    <div id="draggable2" class="draggable ui-state-active" style="position: absolute;">2</div>
                    <div id="draggable3" class="draggable ui-state-active" style="position: absolute;">3</div>
                    <div id="draggable4" class="draggable ui-state-active" style="position: absolute;">4</div>
                    <div id="draggable5" class="draggable ui-state-active" style="position: absolute;">5</div>
                </div>
                
            </div>
        </div>
        <div class="imagescol2 col-3 border ml-2 px-3" style="height:12.9cm;">
            
            <div class="row">
                <div id="preview" class="col-3">
                    <a href="#" id="file-select" class="btn btn-default">
                        <svg xmlns="http://www.w3.org/2000/svg" height="100%" viewBox="0 -960 960 960" width="100%"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h360v80H200v560h560v-360h80v360q0 33-23.5 56.5T760-120H200Zm480-480v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80ZM240-280h480L570-480 450-320l-90-120-120 160Zm-40-480v560-560Z"/></svg>
                    </a>
                    {{-- <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNzEiIGhlaWdodD0iMTgwIj48cmVjdCB3aWR0aD0iMTcxIiBoZWlnaHQ9IjE4MCIgZmlsbD0iI2VlZSI+PC9yZWN0Pjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9Ijg1LjUiIHk9IjkwIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+MTcxeDE4MDwvdGV4dD48L3N2Zz4=" style="height: 40px; width:80px; opacity: 1;"/> --}}
                </div>
                <div id="preview2" class="col"><span class="alert alert-info" id="file-info">No hay archivo aún</span></div>
            </div>
            
            <form id="file-submit" enctype="multipart/form-data">
                <input id="file" name="file" type="file"/>
            </form>
            <a href="#" class="btn btn-primary" id="file-save"><svg xmlns="http://www.w3.org/2000/svg" height="100%" viewBox="0 -960 960 960" width="100%"><path d="M440-320v-326L336-542l-56-58 200-200 200 200-56 58-104-104v326h-80ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z" fill="white"/></svg></a>

        </div>
    </div>
    
    <div class="row border my-3">
        <div class="contenedorcategoria col">
            <div class="categoria my-1 ml-5 mr-2" style="display:inline-block;">Categoria:</div>
            <form class="" action="" style="display:inline-block;">
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
                <button type="button" class="btngrup btnact btn border">Activo</button>
                <button type="button" class="btngrup btnfin btn border">finalizado</button>
                <button type="button" class="btngrup btncan btn border">Cancelado</button>
            </div>
        </div>                
    </div>

    <div class="border my-3 text-center">
        <button type="button" class="btncancelar btn btn-secondary ">Cancelar</button>
        <button type="button" class="btnguardar btn btn-primary">Guardar</button>
    </div>

</div>
@endsection