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
