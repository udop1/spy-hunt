// example.js file
// Wait for device API libraries to load
//
function onLoad() {
    document.addEventListener("deviceready", onDeviceReady, false);
}

// device APIs are available
//
function onDeviceReady() {
    document.addEventListener("pause", onPause, false);
    document.addEventListener("resume", onResume, false);
    document.addEventListener("menubutton", onMenuKeyDown, false);
    // Add similar listeners for other events

    function vibrateDevice() {
        //console.log(navigator.vibrate(1000));
        //alert("vibrate test");
        navigator.vibrate(1000);
    }
    return {
        vibrateDevice: vibrateDevice
    };
}

function onPause() {
    // Handle the pause event
}

function onResume() {
    // Handle the resume event
}

function onMenuKeyDown() {
    // Handle the menubutton event
}

// listen for uncaught cordova callback errors
window.addEventListener("cordovacallbackerror", function (event) {
    // event.error contains the original error object
});