document.addEventListener("deviceready", onDeviceReady, false);
var watchID = null;
function onDeviceReady() {
    //var options = { frequency: 3000 };
    watchID = navigator.globalization.dateToString(
    new Date(),
    function (date) { 
        var element = document.getElementById('globalization');
        element.innerHTML =  date.value + '<br/>';
        },
    function () { alert('Error getting dateString\n'); },
    { formatLength: 'full', selector: 'date and time'}
);
    setTimeout(onDeviceReady, 5000);
}


 


