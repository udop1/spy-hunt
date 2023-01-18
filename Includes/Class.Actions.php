<?php
	//Adam
	include('./Class.Functions.php');
	
	$fn = new Functions();

	if(isset($_POST["getAllTreasureHunts"])) { //Get ajax request and run function
		$treasureHunts = $fn->getAllTreasureHunts();
		echo json_encode($treasureHunts);
	}

	if(isset($_POST["getTreasureHuntInfo"])) { //Get ajax request and run function
		$treasureHuntInfo = $fn->getTreasureHuntInfo($_POST["treasureHuntID"]);
		echo json_encode($treasureHuntInfo);
	}

	if(isset($_POST["deleteHuntGroup"])) { //Get ajax request and run function
		$fn->deleteHuntGroup($_POST["id"]);
		echo "Hunt Group Deleted";
	}

	if(isset($_POST["deleteHuntMarker"])) { //Get ajax request and run function
		$fn->deleteHuntMarker($_POST["id"]);
		echo "Hunt Marker Deleted";
	}
    
    if(isset($_POST["addLeaderboardScore"])) { //Get ajax request and run function
        $fn->addLeaderboardScore();
    }
?>