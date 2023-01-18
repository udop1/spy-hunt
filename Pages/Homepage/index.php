<?php
    //Linh
    //include the funtions file
	include( '../../Includes/Class.Functions.php' );

    //set new function
	$fn = new Functions();

    //call the function to check if user is logged in or not
	$fn->checkLoginPage();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width">
        <title>Spy Hunt Welcome</title>
        
        <!--Font styles-->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Anonymous+Pro:wght@700&family=IBM+Plex+Serif&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
         <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <!--Custom styles-->
        <link rel="stylesheet" href="./indexstyle.css">
        
        <script src="/cordova.js"></script>
        <script src="../../cordova_plugins.js"></script>
        <script src="/native.js"></script>
    </head>

    <body onload="onLoad()">
        <!--Header Logo - Adam -->
        <header>
            <img src="../../Images/spyhuntlogo.png" alt="logo">
        </header>
        
        <!--Sign Up/ Log In Button - Linh & Adam -->
        <section>
            <div class="login">
                <div class="loginbuttons">
                    <p class="logintitle anim-typewriter"><b>Welcome to Spy Hunt !</b></p>
                    <a class="btnSignup" href="../LoginRegister/register.php"><button>Sign Up</button></a>
                    <a class="btnLogin" target="_self" href="../LoginRegister/login.php"><button>Log In</button></a>
                    <p class="loginfooter">By using this application, you agree to our Terms of Use and Privacy Policy</p>
                </div>
            </div>
        </section>

        <footer>
            
        </footer>

    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    </body>
</html>