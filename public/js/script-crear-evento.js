$(document).ready(function () {
    $("#auspiciadoresSelect").selectmenu({
        change: function (event, data) {
            var selectedFont = data.item.value;
            addRecipient(selectedFont);
            var selectElement = document.getElementById("auspiciadoresSelect");
            selectElement.selectedIndex = 0;
        },
    });
});

function getColor() {
    return (
        "hsl(" +
        360 * Math.random() +
        "," +
        (25 + 70 * Math.random()) +
        "%," +
        (85 + 10 * Math.random()) +
        "%)"
    );
}

var idInput = 1;
const misAuspiciadores = [];


function addRecipient(value) {
    const recipientList = document.getElementById("recipient-list");

    if (value.trim() === "") {
        return;
    }

    for (const auspiciador of misAuspiciadores) {
        if (auspiciador == value) {
            console.log('ya existe el auspiciador')
            return;
        }
    }

    misAuspiciadores.push(value);
    var index = misAuspiciadores.length - 1;
    const recipient = document.createElement("div");
    recipient.classList.add("recipient");
    const recipientName = document.createElement("span");
    recipientName.textContent = value;
    recipient.style.backgroundColor = getColor();

    const closeButton = document.createElement("span");
    closeButton.classList.add("close-button");
    const icono = document.createElement("i");
    icono.classList.add("bi", "bi-x");
    closeButton.appendChild(icono);

    const formulario = document.getElementById("FormCrearEvento");
    var inputHidden = document.createElement("input");
    inputHidden.type = "hidden";
    inputHidden.name = "Auspiciadores[]";
    inputHidden.value = value;
    inputHidden.id = "InputOculto" + idInput;
    idInput++;
    formulario.appendChild(inputHidden);
    closeButton.addEventListener("click", function () {
        recipientList.removeChild(recipient);
        formulario.removeChild(inputHidden);
        delete misAuspiciadores[index];
    });

    recipient.appendChild(recipientName);
    recipient.appendChild(closeButton);
    recipientList.appendChild(recipient);
}
