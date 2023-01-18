//Adam
// Set Variables
var map, infoWindow;

var infos = [];
var proxCircles = [];
var infoWindowsContent = [];

function initMap() { //Initialise Map
    map = new google.maps.Map(document.getElementById("map"), {
        center: {
            lat: 51.8863996,
            lng: -2.1591553
        },
        zoom: 13,
        mapId: '8143edf6931c41',
    });
    
    var marker = new google.maps.Marker({ //Create user position marker
        position: {
            lat: 51.8863996,
            lng: -2.1591553
        },
        map: map,
        icon: {
            url: "../../Images/mapmarker.png", //Assign an image to the marker
            scaledSize: new google.maps.Size(32, 32)
        },
        title: 'Test',
    });

    
    infoWindow = new google.maps.InfoWindow(); //Create a new infoWindow

    if(navigator.geolocation) { //If the browser has location permissions
        var options = {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        };
        function success(position) { //And the location permissions can be successfully accessed
            navigator.geolocation.getCurrentPosition( //Get the users current position
                (position) => {
                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };

                    marker.setPosition(pos); //Move the user marker to that position
                    //map.setCenter(pos);
                },
                () => { //If there is an issue getting the user's current location, call a function and place the info window in the center
                    handleLocationError(true, infoWindow, map.getCenter());
                }
            );
            
            var currentPos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude); //Get the current position of the user
            var bounds = new google.maps.LatLngBounds(); //Make a new latitude longitude boundary
            var currentProxTitleArray = []; //An array containing the user's current proximity marker title
            var currentProxTitle; //Variable to store that title
            
            $.each(proxCircles, function(index, value) { //For each proximity circle
                var result = proxCircles.filter(function(c) { //Filter through to find the one the user is in
                    if(circleContainsMarker(currentPos,c)) {
                        return c;
                    }
                })
                var placeFound = (result.length > 0); //Make the result true or false
                if(placeFound) { //If found, push the titles to the array (if they are inside it will hold the title, if not undefined)
                    currentProxTitleArray.push(result[index]);
                    //console.log(`You're inside ${result[index].title}`);
                    //alert(`You're inside ${result[index].title}`);
                } else {
                    //console.log("You're not inside a circle!");
                    //alert("You're not inside a circle!");
                    google.maps.event.clearListeners(infos[currentMarkerIndex], 'click'); //If they aren't inside the proximity, remove the click detection so they can't see the info
                }
                bounds.extend(currentPos); //See if the bounds extend to the current location of the user
            });
            currentProxTitle = currentProxTitleArray[0].title; //Get the first title in the array (this will always be the one they are in as the others are undefined)
            for(var i=0; i < infos.length; i++) { //search marker array for current proximity marker title
                if (infos[i].title == currentProxTitle) { //If one of the titles matches the current title, get it's index
                    currentMarkerIndex = i;
                }
            }

            infos[currentMarkerIndex].addListener("click", function (e) { //Add a listener event to that specific marker index
                infoWindow.setContent(infoWindowsContent[currentMarkerIndex]);
                infoWindow.setPosition(infos[currentMarkerIndex].getPosition());
                infoWindow.open(map, infos[currentMarkerIndex]);
            });
        }
    } else { //If the browser doesn't have location permissions, call a function and place the info window in the center
        handleLocationError(false, infoWindow, map.getCenter());
    }

    function error(error) { //If an error is called, return the error
        console.warn("Error(" + error.code + "): " + error.message);
    }

    navigator.geolocation.watchPosition(success, error, options); //Call the success or error functions every time the user's permission changes
}

function circleContainsMarker(point, circle) { //Return if the marker is inside a proximity circle
    var radius = circle.getRadius();
    var center = circle.getCenter();
    return (google.maps.geometry.spherical.computeDistanceBetween(point, center) <= radius)
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) { //If there is an error getting the user's location, return an error into the info window center screen
    infoWindow.setPosition(pos);
    infoWindow.setContent(
        browserHasGeolocation ?
        "Error: The Geolocation service failed." :
        "Error: Your browser doesn't support geolocation."
    );

    infoWindow.open(map);
}

$(document).ready(function () { //When the document is ready
    function getAllTreasureHunts() { //Retrieve all the treasure hunts
        var data = {getAllTreasureHunts: true};

        $.ajax({ //Send an ajax request to get all the treasure hunt groups
            type: "POST",
            url: "../../Includes/Class.Actions.php",
            data: data,

            success: function (result) {
                console.log(result);
                var data = JSON.parse(result);
                console.log(result);

                $.each(data, function (index, value) {
                    $("#select-hunt").append( //Append the treasure hunt groups to the map dropdown selection
                        $("<option/>", {
                            value: data[index].treasure_hunt_id,
                            text: data[index].treasure_hunt_name,
                        })
                    );
                });
            },

            error: function (e) {
                console.log(e.message);
            },
        });
    }

    $("#select-hunt").change(function () { //If the selection changes, update the map with the new marker information relating to that specific group
        var selectedTreasureHunt = $(this).children("option:selected").val();

        var data = {
            getTreasureHuntInfo: true,
            treasureHuntID: selectedTreasureHunt,
        };

        $.ajax({ //Send an ajax request to get the marker information relating to that specific group
            type: "POST",
            url: "../../Includes/Class.Actions.php",
            data: data,

            success: function (result) {
                var data = JSON.parse(result);
                console.log(data);
                plotInfoOnMap(data); //If successful, plot info on map
            },

            error: function (e) {
                console.log(e.message);
            },
        });
    });

    function plotInfoOnMap(data) { //Function to plot the markers and information on the map
        if (infos.length > 0) { //If the markers array has nothing inside (a hunt hasn't been selected) clear the map
            $.each(infos, function (index, value) {
                infos[index].setMap(null);
            });
            $.each(proxCircles, function (index, value) {
                proxCircles[index].setMap(null);
            });

            infos = [];
            proxCircles = [];
        }

        $.each(data, function (index, value) { //For each marker retrieved
            var infoPosition = new google.maps.LatLng( //Set it's position
                data[index].info_lat,
                data[index].info_lng
            );

            var info = new google.maps.Marker({ //Create a marker for everything to go into
                position: infoPosition,
                map: map,
                title: data[index].info_name,
            });

            var proxCircle = new google.maps.Circle({ //Create a proximity circle to detect if the user is inside
                strokeColor: "#FF0000",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#FF0000",
                fillOpacity: 0.35,
                map: map,
                center: infoPosition,
                radius: 10, //metres
                title: data[index].info_name
            });

            infoWindowsContent.push("<h1>" + data[index].info_name + "</h1>" + "<p>" + data[index].info_description + "</p>"); //Put the information relating to that marker inside an infowindow
            infos.push(info); //Put the marker in the information array
            proxCircles.push(proxCircle); //put the circle in the circle array
        });
    }

    getAllTreasureHunts(); //Call the function so it runs
})

$(document).ready(function () { //Another check to see if the document is ready (can't be in the above as settimeout makes the function wait)
    setTimeout (function(){ //Every minute, add how long the user has been on the page for to the leaderboard (score)
        var data = {addLeaderboardScore:true};
        $.ajax({
            type: "POST",
            url: "../../Includes/Class.Actions.php",
            data: data,

            success: function () {
                console.log("Score added to Leaderboard");
                onDeviceReady().vibrateDevice();
            },

            error: function (e) {
                console.log(e.message);
            },
        })       
    }, 60000);
})