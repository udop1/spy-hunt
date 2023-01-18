<?php
//Linh
//include the funtions file
include('../../Includes/Class.Functions.php');

//set new function
$fn = new Functions();

//call the log-in funciton created in the functions file
$fn->login();
$fn->checkLoginPage();
?>
<!doctype html>
<html>

<head>
    <!--<meta http-equiv="Content-Security-Policy" content="default-src *; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline' 'unsafe-eval'">-->
    <meta name="viewport" content="width=device-width">
    <title>Log In </title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./loginstyle.css">
    <script src="https://kit.fontawesome.com/5c984a34de.js" crossorigin="anonymous"></script>
    
    <script src="/cordova.js"></script>
    <script src="../../cordova_plugins.js"></script>
    <script src="/native.js"></script>
</head>

<body onload="onLoad()">
    <!-- Main Content - Linh -->
    <div class="login">
        <form class="formlogin" action="" method="post">
            <a href="../Homepage/index.php"><i class="fas fa-arrow-left fa-2x"></i></a>
            <h2 class="formloginHeading">Log in</h2>
            <!-- Lock Icon-->
            <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 172 172">
                <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                    <path d="M0,172v-172h172v172z" fill="none"></path>
                    <g fill="#fccf14">
                        <path d="M86,7.16667c-20.58426,0 -37.84782,14.66404 -42.11816,34.30762l14.01139,3.05143c2.89632,-13.32309 14.29103,-23.02572 28.10677,-23.02572c16.3127,0 28.66667,12.35397 28.66667,28.66667v7.16667h-71.66667c-7.88333,0 -14.33333,6.45 -14.33333,14.33333v71.66667c0,7.88333 6.45,14.33333 14.33333,14.33333h86c7.88333,0 14.33333,-6.45 14.33333,-14.33333v-71.66667c0,-7.88333 -6.45,-14.33333 -14.33333,-14.33333v-7.16667c0,-23.82063 -19.17936,-43 -43,-43zM86,93.16667c7.88333,0 14.33333,6.45 14.33333,14.33333c0,7.88333 -6.45,14.33333 -14.33333,14.33333c-7.88333,0 -14.33333,-6.45 -14.33333,-14.33333c0,-7.88333 6.45,-14.33333 14.33333,-14.33333z"></path>
                    </g>
                </g>
            </svg>
            <p class="formloginIntro">Let's log in to begin the hunt !</p>
            <input type="text" class="formControl" name="username" id="username" placeholder="Email Address" required="" autofocus="" />
            <input type="password" class="formControl" name="password" id="password" placeholder="Password" required="" />
            <label class="checkbox">
                <input type="checkbox" class="checkboxTick" value="rememberMe" id="rememberMe" name="rememberMe"> Remember me
            </label><br>
            <button class="btn btn-lg btn-block" name="login" type="submit">Login</button> <br />
            <p class="formloginIntro">Don't have an account? <a class="link" href="./register.php">Register Here!</a></p>
            <?php if ($error) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $error;
                    header("Refresh:5");
                    exit;
                    ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>