<?php
    //Adam
    //include the funtions file
	include( '../../Includes/Class.Functions.php' );

    //set new function
	$fn = new Functions();

    //call the function to check if user is logged in or not
	$fn->checkLoggedIn();
    $fn->addHuntGroup(); //function to add a hunt group
    $fn->addHuntMarkers(); //function to add hunt markers to group
    
    //get user's username displayed on the screen 
    $id = $_SESSION['username'];
    $loginID = $_SESSION['loginid'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width">
        <title>CMS</title>
        <!--Font Styles-->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Anonymous+Pro:wght@700&family=IBM+Plex+Serif&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <!--Bootstraps-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <!--Custom Style-->
        <link rel="stylesheet" href="./cmshome.css">

        <script src="https://kit.fontawesome.com/5c984a34de.js" crossorigin="anonymous"></script>

        <script src="/cordova.js"></script>
        <script src="../../cordova_plugins.js"></script>
        <script src="/native.js"></script>
    </head>

    <body onload="onLoad()">
        <!--Log in Info Box - Adam(php) & Linh(style)-->
        <header>
            <div class="login-info-box">
                <div class="login-info">
                    <h1>Customize your Hunt, </h1> <p class="username"><?php echo $id ?></p>
                </div>
                <div class="justify-content-center log-out-div">
                      <a href="https://aab.uogs.co.uk/Pages/Logout/logout.php" ><button id="logout" class="btn logout-button">Log Out</button></a>
                </div>
            </div>
        </header>

        <section>
            <div class="grid-container">
                <div class="grid-item forms">
                    <!--Create New Hunt Section - Adam(php) & Linh(style)-->
                    <div class="container-fluid px-1 py-4 mx-auto">
                        <div class="row d-flex justify-content-center">
                            <div class="col-xl-7 col-lg-8 col-md-9 col-11">
                                <div class="card">
                                    <h5 class="text-center mb-4">Create New Hunt</h5>
                                    <form class="form-card" method="post">
                                        <div class="row justify-content-between text-left">
                                            <div class="form-group col-12 flex-column d-flex"> <label class="form-control-label px-3">Treasure Hunt Name<span class="text-danger"> *</span></label>  <input type="text" class="form-control col-sm-10" id="treasureHuntName" name="treasureHuntName" placeholder="Treasure Hunt Name"> </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <button id="btn-submit-hunt" class="btn-submit-hunt" name="btn-submit-hunt" type="submit">Create Hunt</button>
                                        </div>
                                            <?php
                                            if(isset($errorHunt)) {
                                                foreach($errorHunt as $errorHunt) {
                                                    echo('<p>' . $errorHunt . '</p>');
                                                }
                                            }
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                     <!--Create New Hunt Markers Section - Adam(php) & Linh(style)-->
                    <div class="container-fluid px-1 py-5 mx-auto">
                        <div class="row d-flex justify-content-center">
                            <div class="col-xl-7 col-lg-8 col-md-9 col-11">
                                <div class="card">
                                    <h5 class="text-center mb-4">Create New Hunt Markers</h5>
                                    <form class="form-card" method="post">
                                        <div class="row justify-content-between text-left">
                                             <div class="row justify-content-between text-left">
                                                <div class="form-group col-12 flex-column d-flex"><label class="form-control-label px-3">Hunt Group<span class="text-danger"> *</span></label> <select id="huntGroup" name="huntGroup" class="form-select">
                                                    <option disabled selected hidden>Choose a Hunt to add to...</option></select><br></div></div>
                                            <div class="row justify-content-between text-left">     
                                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3"> Marker Name<span class="text-danger"> *</span></label><input type="text" class="form-control" id="markerName" name="markerName" placeholder="Marker Name"> </div>
                                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Marker Description<span class="text-danger">*</span></label><input type="text" class="form-control" id="markerDesc" name="markerDesc" placeholder="Marker Description"></div>
                                        </div>
                                        <div class="row justify-content-between text-left">
                                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Marker Latitude<span class="text-danger"> *</span></label><input type="text"class="form-control" id="markerLat" name="markerLat" placeholder="Marker Latitude"></div>
                                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Marker Longtitude<span class="text-danger"> *</span></label><input type="text" class="form-control" id="markerLng" name="markerLng" placeholder="Marker Longitude"> </div>
                                        </div>
                                        <div class="row justify-content-center">
                                             <button id="btn-submit-marker" class="btn-submit-marker" name="btn-submit-marker" type="submit">Create Marker</button>
                                            </div>

                                            <?php
                                                if(isset($errorMarker)) {
                                                    foreach($errorMarker as $errorMarker) {
                                                        echo('<p>' . $errorMarker . '</p>');
                                                    }
                                                }
                                            ?>
                                     </form>
                                </div>
                            </div>
                        </div>
                    </div>                        
                </div>
                </div>        
                
                 <!--Personal Hunt Section - Adam(php) & Linh(style)-->
                <div class="container-fluid px-1 py-5 mx-auto grid-item show-all-hunts">
                        <div class="row">
                            <div class="col-lg-7 mx-auto">
                                    <div class="card">
                                        <h5 class="text-center mb-4">Personal Hunt</h5>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Modify</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        try {
                                                            $query = $fn->getAllHunts($loginID); //get all the hunts relating to the user's login id and display all their hunts
                                                            while($row = $query->fetch()) {
                                                    ?>
                                                                    <tr id="hunt-<?php echo $row["treasure_hunt_id"] ?>">
                                                                        <td><?php echo $row["treasure_hunt_id"]; ?></td>
                                                                        <td><?php echo $row["treasure_hunt_name"]; ?></td>
                                                                        <td>
                                                                            <a href="./edithunt.php?id=<?php echo $row["treasure_hunt_id"]; ?>"><i class="fa fa-edit"></i></a>                                                               
                                                                              <a class="delete-hunt" id="<?php echo $row["treasure_hunt_id"]; ?>"> <i class="fa fa-trash"></i></a>                                                                   
                                                                        </td>                                  
                                                                    </tr>
                                                    <?php
                                                            }
                                                        } catch (PDOException $e) {
                                                            echo $e->getMessage();
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        
         <!--Navigation Menu - Adam -->
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