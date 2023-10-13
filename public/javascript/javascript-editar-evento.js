$('#file-select').on('click', function(e) {
     e.preventDefault();
    $('#file').click();
});



$('input[type=file]').change(function() {
    var file = (this.files[0].name).toString();
    $('#file-info').text('');
    $('#file-info').text(file);
});
//Cambiar colores de los botones de Estado
$('.btngrup').click(function() {
    $('.btngrup').removeClass('active');
    $(this).addClass('active');
  });
//selectores manipulables
$( function() {
    $( "#draggable2" ).draggable({ containment: "#containment-wrapper", scroll: true, cursor: "move" });
    $( "#draggable2" ).resizable({containment: "#containment-wrapper"});
    $( "#draggable3" ).draggable({ containment: "#containment-wrapper", scroll: true, cursor: "move" });
    $( "#draggable3" ).resizable({containment: "#containment-wrapper"});
    $( "#draggable4" ).draggable({ containment: "#containment-wrapper", scroll: true, cursor: "move" });
    $( "#draggable4" ).resizable({containment: "#containment-wrapper"});
    $( "#draggable5" ).draggable({ containment: "#containment-wrapper", scroll: true, cursor: "move" });
    $( "#draggable5" ).resizable({containment: "#containment-wrapper"});
} );
//mostrar posiciones top y left
$(document).ready(function(){
    var $draggable2 = $("#draggable2");
    
    // Mostrar posición top y left
    var posicion = $draggable2.position();
    var top = posicion.top;
    var left = posicion.left;
    console.log("Top: " + top + "px, Left: " + left + "px");
    
    // Mostrar ancho y alto
    var ancho = $draggable2.width();
    var alto = $draggable2.height();
    console.log("Ancho: " + ancho + "px, Alto: " + alto + "px");
});
//cambiar color de fondo
$( function() {
    var circle = $( "#containment-wrapper" );
    $( "#colorFondo" ).selectmenu({
       change: function( event, data ) {
         circle.css( "background", data.item.value );
       }
     });
     
});
//
$( function() {
  var page = $( "#draggable2" );
  var basicControls = [ "#print", "#bold", "#italic", "#undo", "#redo" ];
  var valueControls = [ "#fontsize", "#forecolor", "#hilitecolor", "#backcolor", "fontname" ];

  $( "#print" ).button({
    "icon": "ui-icon-print",
    "showLabel": false
  });
  $( "#redo" ).button({
    "icon": "ui-icon-arrowreturnthick-1-e",
    "showLabel": false
  });
  $( "#undo" ).button({
    "icon": "ui-icon-arrowreturnthick-1-w",
    "showLabel": false
  });

  $( ".toolbar" ).controlgroup();
  $( "#zoom" ).on( "selectmenuchange", function() {
    page.css({ "zoom": $( this ).val() });
  })
  $( basicControls.concat( valueControls ).join( ", " ) ).on( "click change selectmenuchange",
    function() {
      document.execCommand(
        this.id,
        false,
        $( this ).val()
      );
    } );
  $( "form" ).on( "submit", function( event ) {
    event.preventDefault();
  });
} );



