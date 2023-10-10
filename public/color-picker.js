// color-picker.js
document.addEventListener('DOMContentLoaded', function() {
    var colorPicker = document.getElementById('background-color');

    var backgroundSquare = document.getElementById('background-square');
    colorPicker.addEventListener('change', function() {
        var selectedColor = colorPicker.value;
        backgroundSquare.style.backgroundColor = selectedColor;
    });
});
