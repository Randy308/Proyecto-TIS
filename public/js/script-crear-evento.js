$(document).ready(function () {
    $("#auspiciadoresSelect").selectmenu({
        change: function (event, data) {
            var selectedFont = data.item;
            //console.log(selectedFont)
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

function addRecipient(input) {
    const recipientList = document.getElementById("recipient-list");

    if (input.value.trim() === "") {
        return;
    }
    for (const auspiciador of misAuspiciadores) {
        if (auspiciador == input.value) {
            return;
        }
    }

    misAuspiciadores.push(input.value);

    const recipient = document.createElement("div");
    recipient.classList.add("recipient");
    //background-color: #ff8880;
    const recipientName = document.createElement("span");
    recipientName.textContent = input.value;
    recipient.style.backgroundColor = getColor();

    const closeButton = document.createElement("span");
    closeButton.classList.add("close-button");
    //<i class="bi bi-x"></i>
    const icono = document.createElement("i");
    icono.classList.add("bi", "bi-x");
    closeButton.appendChild(icono);
    //closeButton.textContent = "X";
    const formulario = document.getElementById("FormCrearEvento");
    var inputHidden = document.createElement("input");
    inputHidden.type = "hidden";
    inputHidden.name = "Auspiciadores[]";
    inputHidden.value = input.value;
    inputHidden.id = "InputOculto" + idInput;
    idInput++;
    formulario.appendChild(inputHidden);
    closeButton.addEventListener("click", function () {
        recipientList.removeChild(recipient);
        formulario.removeChild(inputHidden);
    });

    recipient.appendChild(recipientName);
    recipient.appendChild(closeButton);
    recipientList.appendChild(recipient);
}
