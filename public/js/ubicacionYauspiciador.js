function iniciarMapa(){
    var latitud = $("#latitud").val();
    var longitud = $("#longitud").val();
    coordenadas={
        lng: longitud,
        lat: latitud
    }
    generarMapa(coordenadas);

    let autocomplete;
    autocomplete= new google.maps.places.Autocomplete(
        document.getElementById('autocomplete'),
        {
            types:['establishment'],
            componentRestrictions:{'country':['AU']},
            fields:['place_id','geometry','name']
        });
}

function generarMapa(){
    var mapa= new google.maps.Map(document.getElementById('mapa'),
    {
        zoom: 14,
        center: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
    });

    marcador =new google.maps.Marker({
        map: mapa,
        draggable:true,
        position: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
    });

    marcador.addListener('dragend',function(event){
        document.getElementById("latitud").value=this.getPosition().lat();
        document.getElementById("longitud").value=this.getPosition().lng();
    });

    var mousedown = false;
    mapa.addListener('mousedown', function(event) {
        mousedown = true;
        temporizador = setTimeout(function() {
            // Si se mantiene presionado durante 1 segundos
            var nuevaLatitud = event.latLng.lat();
            var nuevaLongitud = event.latLng.lng();
        
            marcador.setPosition(new google.maps.LatLng(nuevaLatitud, nuevaLongitud));
        
            document.getElementById("latitud").value = nuevaLatitud;
            document.getElementById("longitud").value = nuevaLongitud;
        }, 1000); // 1 segundos
    });

    mapa.addListener('mouseup', function(event) {
        mousedown = false;
        clearTimeout(temporizador);
    });
} 
//--------------------------
$("#mostrarMap").click(function() {
    $("#contenedormap").css("display", "block");
    $('#fondotransparente').css("display", "block");
});
$("#adiosMap").click(function() {
    $("#contenedormap").css("display", "none");
    $('#fondotransparente').css("display", "none");
});

$("#latitud, #longitud").on("input", function() {
    var latitud = $("#latitud").val();
    var longitud = $("#longitud").val();

    coordenadas = {
        lng: longitud,
        lat: latitud
    }

    generarMapa(coordenadas);
});
//-----------------botones imgauspiciadores
$("#file-select-auspiciadores").on("click", function (e) {
    e.preventDefault();
    $("#file-auspiciadores").click();
});

$("input#file-auspiciadores[type=file]").change(function () {
    var file = this.files[0].name.toString();
    $("#file-info").text("");
    $("#file-info").text(file);
});

