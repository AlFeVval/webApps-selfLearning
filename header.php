<?php 
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <title>Remote laboratory login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
    </head>
<body>
    <header>
            <h3 class="lab">REMLAB</h3>
        <nav>
            <div class="wraper">
                <ul class="menu-main">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="discover.php">About me</a></li>
                    <li><a href="blog.php">Find blogs</a></li>
                    <?php
                        if(isset($_SESSION["USER_UID"])){
                            echo "<li><a href='profile.php'>". $_SESSION["USER_UID"] ."</a></li>";
                            echo "<li><a href='includes/logout.php'>Log out</a></li>";
                        }
                        else{
                            echo "<li><a href='signup.php'>Sign up</a></li>";
                            echo "<li><a href='login.php'>Log in</a></li>";    
                        }
                    ?>
                </ul>
            </div>   
        </nav>        
    </header>