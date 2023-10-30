function iniciarMapa(){
    var latitud = -17.393610;
    var longitud = -66.145224;  
    
    coordenadas={
        lng: longitud,
        lat: latitud
    }
    generarMapa(coordenadas);
}

function generarMapa(){
    var mapa= new google.maps.Map(document.getElementById('mapa'),
    {
        zoom: 13,
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
            // Si se mantiene presionado durante 2 segundos
            var nuevaLatitud = event.latLng.lat();
            var nuevaLongitud = event.latLng.lng();
        
            marcador.setPosition(new google.maps.LatLng(nuevaLatitud, nuevaLongitud));
        
            document.getElementById("latitud").value = nuevaLatitud;
            document.getElementById("longitud").value = nuevaLongitud;
        }, 1000); // 2 segundos
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

$("#cargarcoordenadas").click(function(){
    var latitud = $("#latitud").val();
    var longitud =$("#longitud").val();

    coordenadas={
        lng: longitud,
        lat: latitud
    }
    generarMapa(coordenadas);
});