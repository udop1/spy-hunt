<?php
// Linh
//include the funtions file
include('../../Includes/Class.Functions.php');

//set new function
$fn = new Functions();

//call the function to check if user is logged in or not
$fn->checkLoggedIn();

//get user's fullname displayed on the screen 
$fullname = $_SESSION['fullname'];

//get user's username displayed on the screen 
$id = $_SESSION['username'];
$loginID = $_SESSION['loginid'];
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Profile</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <!--Custom styles-->
  <link rel="stylesheet" href="./profilestyle.css">

  <script src="/cordova.js"></script>
  <script src="../../cordova_plugins.js"></script>
  <script src="/native.js"></script>
</head>

<body onload="onLoad()">
   <!--Profile - Linh --> 
  <header>
    <div class="headerDiv">
      <h1 class="profileHeading text-center">Profile</h1>
      <div class="background">
        <div class="profile_pic">
          <img src=https://kansai-resilience-forum.jp/wp-content/uploads/2019/02/IAFOR-Blank-Avatar-Image-1.jpg>
          <p class="title"><?php echo $fullname ?></p>
          <p class="sub_title"><?php echo $id ?></p>
        </div>
      </div>
    </div>
  </header>

  <!-- Log out Button - Linh -->
    <div class="col-md-12 text-center buttons-div">
         <a href="https://aab.uogs.co.uk/Pages/Logout/logout.php" >
             <button id="logout" class="logout-button">Log Out</button>
        </a>
    </div>
    
 <!-- Navigation Menu - Adam -->
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
              <b class="menuTexts">Customize</b>
            </div>
          </a>
    </div>
  </div>

  <!-- Bootstrap JS-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
</body>

</html>