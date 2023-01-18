//Adam

$(document).ready(function () { //When the document is ready
    function getAllTreasureHunts() { //Get all the treasure hunts
        var data = {getAllTreasureHunts: true};

        $.ajax({
            type: "POST",
            url: "../../Includes/Class.Actions.php",
            data: data,

            success: function (result) {
                console.log(result);
                var data = JSON.parse(result);
                console.log(result);

                $.each(data, function (index, value) { //For each input box, fill with the information from the database
                    $("#huntGroup").append(
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
    $("#huntGroup").change(function () {
        var selectedTreasureHunt = $(this).children("option:selected").val();

        var data = {
            getTreasureHuntInfo: true,
            treasureHuntID: selectedTreasureHunt,
        };

        $.ajax({
            type: "POST",
            url: "../../Includes/Class.Actions.php",
            data: data,

            success: function (result) {
                var data = JSON.parse(result);
                console.log(data);
            },

            error: function (e) {
                console.log(e.message);
            },
        });
    });
    getAllTreasureHunts(); //Call the function so it runs


    $(".delete-hunt").click(function(event) { //If click button pressed
        var c = confirm("Are you sure you want to delete this hunt?"); //Confirm if they want to delete the hunt

        if(c == true) { //If they do, get the ID of the current hunt
            var id = $(this).attr("id");
            var data = {
                "deleteHuntGroup" : true,
                "id" : id
            };

            $.ajax({ //Send ajax request to remove from the database, when successful delete the entry from the table
                type: "POST",
                url: "../../Includes/Class.Actions.php",
                data: data,
                success: function(result) {
                    console.log(result);
                    $("#hunt-" + id).remove();
                },
                error: function(e) {
                    console.log(e.message);
                }
            });

            return true;
        } else {
            return false;
        }
    });

    $(".delete-marker").click(function(event) { //If click button pressed
        var c = confirm("Are you sure you want to delete this marker?"); //Confirm if they want to delete the marker

        if(c == true) { //If they do, get the ID of the current marker
            var id = $(this).attr("id");
            var data = {
                "deleteHuntMarker" : true,
                "id" : id
            };

            $.ajax({ //Send ajax request to remove from the database, when successful delete the entry from the table
                type: "POST",
                url: "../../Includes/Class.Actions.php",
                data: data,
                success: function(result) {
                    console.log(result);
                    $("#marker-" + id).remove();
                },
                error: function(e) {
                    console.log(e.message);
                }
            });

            return true;
        } else {
            return false;
        }
    });
})