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
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
var idInput = 1;

const misAuspiciadores = [];
function agregarRol(value) {
    value = capitalizeFirstLetter(value);
    const rolesList = document.getElementById("roles-list");
    console.log(value);
    if (value.trim() === "") {
        return;
    }
    const recipient = document.createElement("div");
    recipient.classList.add("recipient");
    //background-color: #ff8880;
    const recipientName = document.createElement("span");
    recipientName.textContent = value;
    recipient.style.backgroundColor = getColor();
    recipient.appendChild(recipientName);
    rolesList.appendChild(recipient);
}
function agregarPermisos(value) {

    const rolesList = document.getElementById("roles-list");
    console.log(value);
    if (value.trim() === "") {
        return;
    }
    const recipient = document.createElement("div");
    recipient.classList.add("recipient");
    //background-color: #ff8880;
    const recipientName = document.createElement("span");
    recipientName.textContent = value;
    recipient.style.backgroundColor = getColor();
    recipient.appendChild(recipientName);
    rolesList.appendChild(recipient);
}
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
    var index = misAuspiciadores.length - 1;
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
        delete misAuspiciadores[index];
    });

    recipient.appendChild(recipientName);
    recipient.appendChild(closeButton);
    recipientList.appendChild(recipient);
}
