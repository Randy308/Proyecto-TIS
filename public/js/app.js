$(document).ready(function () {
    $.ajax({
        url: "/home",
        method: "POST",
        data: {
            id: 1,
            _token: $("input[name=_token]").val(),
        },
    }).done(function (res) {
        let jsonData = JSON.parse(res);
        crearTabla(jsonData)

    });
});
function redirigirAEditarEvento() {
    window.location.href = "{{ route('editar-evento') }}";
}
function crearTabla(jsonData){
    const content = document.getElementById("contenedor");
    let table = document.createElement("table");


     let cols = Object.keys(jsonData[0]);


     let thead = document.createElement("thead");
     let tr = document.createElement("tr");


     cols.forEach((item) => {
        let th = document.createElement("th");
        th.innerText = item;
        tr.appendChild(th);
     });
     thead.appendChild(tr);
     table.append(tr)


     jsonData.forEach((item) => {
        let tr = document.createElement("tr");


        let vals = Object.values(item);


        vals.forEach((elem) => {
           let td = document.createElement("td");
           td.innerText = elem;
           tr.appendChild(td);
        });
        table.appendChild(tr);
     });

     content.appendChild(table)
}
    function confirmarCancelacion() {
        if (confirm("¿Estás seguro de que deseas cancelar el evento?")) {
            // Redirige a la página de inicio o realiza otras acciones si el usuario confirma.
            window.location.href = "{{ route('index') }}";
        }
    }