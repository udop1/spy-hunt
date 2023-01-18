<?php
//Linh
//include the funtions file
include('../../Includes/Class.Functions.php');

//set new function
$fn = new Functions();

//call the function to check if user is logged in or not
$fn->checkLoggedIn();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width">
  <title>Leaderboard</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <!--Custom styles-->
  <link rel="stylesheet" href="./leaderboardstyle.css">

  <script src="/cordova.js"></script>
  <script src="../../cordova_plugins.js"></script>
  <script src="/native.js"></script>
</head>

<body onload="onLoad()">
 <!-- Main layout - Linh -->
  <div id="leaderboard-area">
  <header>
    <img src="../../Images/leaderboard.png" alt="Leaderboard Header Image">
  </header>
      
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col"><b>#</b></th>
          <th scope="col"><b>Name</b></th>
          <th scope="col"><b>Username</b></th>
          <th scope="col"><b>Score</b></th>
        </tr>
      </thead>
      <tbody>
        <!-- Leaderboard Display - Adam -->
        <?php
          try {
            $query = $fn->getLeaderboardScore(); //Call the function to retrieve all user's score
            while($row = $query->fetch()) { //Loop through all rows to get all information
        ?>
              <tr>
                <th scope="row"><?php echo $row["login_id"]; ?></th>
                <td><?php echo $row["fullname"]; ?></td>
                <td><?php echo $row["username"]; ?></td>
                <td><?php echo $row["leaderboard_score"]; ?></td>
              </tr>
        <?php
            }
          } catch (PDOException $e) {
              echo $e->getMessage(); //If it doesn't work, send an error message
          }
        ?>
      </tbody>
    </table>
  </div>
  <!-- Main layout - Adam -->
<div id= "footer">
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
</footer>

  <!-- Bootstrap JS-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
</body>

</html>