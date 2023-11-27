$(function() {
    const date = new Date();
    let newDate = new Date(date.getTime() + 5 * 60000);
    //newDate = new Date();
    // Format the date
    let day = newDate.getDate();
    if (day < 10) {
        day = '0' + day;
    }
    let month = newDate.getMonth() + 1;
    if (month < 10) {
        month = '0' + month;
    }
    let year = newDate.getFullYear();

    // Format the time
    let hours = newDate.getHours();
    if (hours < 10) {
        hours = '0' + hours;
    }
    let minutes = newDate.getMinutes();
    if (minutes < 10) {
        minutes = '0' + minutes;

    }
    let seconds = date.getSeconds();
    if (seconds < 10) {
        seconds = '0' + seconds;
    }
    // Create the formatted date and time strings
    let currentDate = `${year}-${month}-${day}`;
    let currentTime = `${hours}:${minutes}:00`;
    //let currentTime = `${hours}:${minutes}:${seconds}`;

    // Set the minimum attribute and initial value for date inputs
    document.getElementById('fecha_inicio').setAttribute('min', currentDate + 'T' + currentTime);
    document.getElementById('fecha_fin').setAttribute('min', currentDate + 'T' + currentTime);
    $('#fecha_inicio').val(currentDate + 'T' + currentTime);
    console.log(currentTime)
});
