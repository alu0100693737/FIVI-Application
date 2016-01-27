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
    
    watchID = null;
     var options = { frequency: 3000 };
     watchID = navigator.geolocation.watchPosition(onSuccess, onError, options);
    watchID = null;
    
    setTimeout(onDeviceReady, 5000);
}

    // onSuccess Geolocation
    //
function onSuccess(position) {
 var element = document.getElementById('geolocation');
 element.innerHTML = 'Latitude: '  + position.coords.latitude       + '<br />' +                               'Longitude: ' + position.coords.longitude                 + '<br />' +
          'Accuracy: '          + position.coords.accuracy;
}

    // clear the watch that was started earlier
    // 
    function clearWatch() {
        if (watchID != null) {
            navigator.geolocation.clearWatch(watchID);
            watchID = null;
        }
    }

    // onError Callback receives a PositionError object
    //
    function onError(error) {
      alert('code: '    + error.code    + '\n' +
            'message: ' + error.message + '\n');
    }
  
        



