<?php
//Adam
//include the Function file
include('../../Includes/Class.Functions.php');

//set new function
$fn = new Functions();

//call function to add new user
$fn->addUser();
$fn->checkLoginPage(); //If already logged in, send to the CMS page
?>

<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width">
    <title>Register </title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./registerstyle.css">
    <script src="https://kit.fontawesome.com/5c984a34de.js" crossorigin="anonymous"></script>

    <script src="/cordova.js"></script>
    <script src="../../cordova_plugins.js"></script>
    <script src="/native.js"></script>
</head>

<body onload="onLoad()">
    <!-- Main Content - Adam -->
    <div class="login">
        <form class="formlogin" action="" method="post">
            <a href="../Homepage/index.php"><i class="fas fa-arrow-left fa-2x"></i></a>
            <h2 class="formloginHeading">Register</h2>
            <!-- Show alert when a form fill is missing-->
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<p class="alert alert-danger" role="alert">' . $error . '</p>';
                }
            }
            ?>
            <!-- Map Icon-->
            <img class="imgRegister" src="../../Images/registerimage.png">
            <p class="formloginIntro">Let's create an account to start spying !</p>

            <input type="text" class="formControl" name="fullname" placeholder="Full name" required />

            <input type="text" class="formControl" name="username" placeholder="Email Address" required />

            <input type="password" class="formControl" name="password" placeholder="Password" required />

            <button class="btn btn-lg btn-block" name="register" type="submit">Register</button> <br />
            <p class="formloginIntro">Already have an account? <a href="./login.php" class="formloginIntro">Login Here!</a></p>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>