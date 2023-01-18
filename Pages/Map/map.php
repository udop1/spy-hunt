<?php
    //Adam
    //include the funtions file
	include( '../../Includes/Class.Functions.php' );

    //set new function
	$fn = new Functions();

    //call the function to check if user is logged in or not
	$fn->checkLoggedIn();
	
?>
<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Maps</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <!--Custom styles-->
        <link rel="stylesheet" href="./mapstyle.css"/>

        <script src="/cordova.js"></script>
        <script src="../../cordova_plugins.js"></script>
        <script src="/native.js"></script>
    </head>

    <body onload="onLoad()"> <!-- Main Content - Adam -->
        <!-- Select Hunt -->
        <div class="grid-container">
            <div id="select-hunt-area">
                <select class="form-select form-select-sm" name="select-hunt" id="select-hunt">
                    <option>Choose a Hunt...</option>
                </select>
            </div>
            
            <!-- Map -->
            <div id="map">
            </div>
            
            <!-- Navigation Menu-->
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
        </div>        

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAH5U-BEIQ2eTS4Ab3vnDZLoZllIgsyQgU&map_ids=8143edf6931c41&libraries=geometry&callback=initMap" async></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="./script.js"></script>
    </body>
</html>
