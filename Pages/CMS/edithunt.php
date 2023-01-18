<?php
    //include the funtions file
    include('../../Includes/Class.Functions.php');

    //set new function
    $fn = new Functions();

    //call the function to check if user is logged in or not
    $fn->checkLoggedIn();

    $fn->editHunt(); //function to edit the hunt information

    $id = $_SESSION['username'];
    $loginID = $_SESSION['loginid'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width">
    <title>CMS</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Anonymous+Pro:wght@700&family=IBM+Plex+Serif&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="./cmshome.css">

    <script src="https://kit.fontawesome.com/5c984a34de.js" crossorigin="anonymous"></script>

    <script src="/cordova.js"></script>
    <script src="../../cordova_plugins.js"></script>
    <script src="/native.js"></script>
</head>

<body onload="onLoad()"> <!-- Main Body - Adam -->
    <header>
        <div class="login-info-box">
            <div class="login-info">
                <h1>Customize your Hunt</h1>
                <p class="username"><?php echo $id ?></p>
            </div>
            <div class="justify-content-center log-out-div">
                <a href="https://aab.uogs.co.uk/Pages/Logout/logout.php"><button id="logout" class="btn logout-button">Log Out</button></a>
            </div>
        </div>
    </header>
    <section> <!-- Main Content - Adam -->
        <div class="grid-container">
            <div class="container-fluid px-1 py-5 mx-auto grid-item show-all-hunts">
                <div class="col-lg-9 mx-auto">
                    <div class="card">
                        <form class="form-card" method="post">
                            <h5>Hunt Name</h5>
                            <?php
                            try {
                                $query = $fn->getTreasureHuntByID($_GET["id"]); //Get the treasure hunt information that matches the information sent in the URL
                                while ($row = $query->fetch()) {
                            ?>
                                    <input type='hidden' name='treasureHuntID' value='<?php echo $row["treasure_hunt_id"]; ?>'>
                                    <input type="text" class="form-control" id="treasureHuntName" name="treasureHuntName" placeholder="Treasure Hunt Name" value="<?php echo $row["treasure_hunt_name"]; ?>">
                            <?php
                                }
                            } catch (PDOException $e) {
                                echo $e->getMessage();
                            }
                            ?>
                            <div class="table-responsive">
                                <table>
                                    <h5>Marker<h5>
                                    <tr>
                                        <th><!--ID--></th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Delete</th>
                                    </tr>
                                    <?php
                                    try {
                                        $query = $fn->getTreasureHuntInfoByID($_GET["id"]); //Get the treasure hunt information the matches the information sent in the URL and current hunt
                                        while ($row = $query->fetch()) {
                                    ?>
                                            <tr id="marker-<?php echo $row["hunt_info_id"] ?>">
                                                <td>
                                                    <input type='hidden' class="form-control" name='huntInfoID[<?php echo $row["hunt_info_id"]; ?>]' value='<?php echo $row["hunt_info_id"]; ?>'>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="markerName" name="markerName[<?php echo $row["hunt_info_id"]; ?>]" placeholder="Marker Name" value="<?php echo $row["info_name"]; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="markerDesc" name="markerDesc[<?php echo $row["hunt_info_id"]; ?>]" placeholder="Marker Description" value="<?php echo $row["info_description"]; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="markerLat" name="markerLat[<?php echo $row["hunt_info_id"]; ?>]" placeholder="Marker Latitude" value="<?php echo $row["info_lat"]; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="markerLng" name="markerLng[<?php echo $row["hunt_info_id"]; ?>]" placeholder="Marker Longitude" value="<?php echo $row["info_lng"]; ?>">
                                                </td>
                                                <td class="text-center"><a class="delete-marker" id="<?php echo $row["hunt_info_id"]; ?>"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                    <?php
                                        }
                                    } catch (PDOException $e) {
                                        echo $e->getMessage();
                                    }
                                    ?>
                                </table>
                            </div><br>
                            <div class="col-md-12 text-center button-div">
                                <button id="btn-submit-edit" class="btn-submit-edit" name="btn-submit-edit" type="submit">Update Hunt</button>

                                <?php
                                if (isset($editError)) { //Show any errors
                                    foreach ($editError as $editError) {
                                        echo ('<p>' . $editError . '</p>');
                                    }
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Navigation Bar - Adam -->
    <div id="footer">
        <div id="menu">
            <a href="../Profile/profile.php">
                <div>
                    <img class="menuIcons" src="../../Images/menu_profile.png" alt="Profile Icon">
                    <b class="menuTexts">Profile</b>
                </div>
            </a>
            <a href="../Map/map.php">
                <div>
                    <img class="menuIcons" src="../../Images/menu_map.png" alt="Map Icon">
                    <b class="menuTexts">Map</b>
                </div>
            </a>
            <a href="../Leaderboard/leaderboard.php">
                <div>
                    <img class="menuIcons" src="../../Images/menu_leaderboard.png" alt="Leaderboard Icon">
                    <b class="menuTexts">Leaderboard</b>
                </div>
            </a>
            <a href="../CMS/cmshome.php">
                <div>
                    <img class="menuIcons" src="../../Images/menu_cms.png" alt="Customize Icon">
                    <b class="menuTexts">Customise</b>
                </div>
            </a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="./script.js"></script>
</body>

</html>