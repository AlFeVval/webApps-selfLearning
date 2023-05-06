<?php
    include_once "header.php"; 
?>

    <section class="signup-form">
        <h2>Sign Up</h2>
        <div class="signup-form-form">
            <form action="includes/signup.inc.php" method="post">
                <input type="text" name="name" placeholder="Full name">
                <input type="text" name="email" placeholder="Email">
                <input type="text" name="uid" placeholder="Username">
                <input type="password" name="pwd" placeholder="Password">
                <input type="password" name="pwdrepeat" placeholder="Repeat password">
                <button type="submit" name="submit">Sign up</button>
            </form>
            <?php 
                if(isset($_GET["error"])){
                    if($_GET["error"] == "emptyinput"){
                        echo "<p>Fill in all fields!<p>";
                    }
                    else if($_GET["error"] == "invaliduid"){
                        echo "<p>Choose a proper username, only alphanumeric!<p>";
                    }
                    else if($_GET["error"] == "invalidemail"){
                        echo "<p>Check your email, something went wrong!<p>";
                    }
                    else if($_GET["error"] == "passworddontmatch"){
                        echo "<p>Passwords doesn't match!<p>";
                    }
                    else if($_GET["error"] == "usernametaken"){
                        echo "<p>Choose another username, this already in use!<p>";
                    }
                    else if($_GET["error"] == "stmtfailed"){
                        echo "<p>Something went wrong, try again!<p>";
                    }
                    else if($_GET["error"] == "none"){
                        echo "<p>Congrats, you have signed up!<p>";
                    }
                }
            ?>
        </div>
    </section>

<?php
    include_once "footer.php"; 
?>