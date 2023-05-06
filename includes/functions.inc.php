<?php
    function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat){
        $result;
        if(empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function invalidUid($username){
        $result;
        if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function invalidEmail($email){
        $result;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function pwdMatch($pwd, $pwdRepeat){
        $result;
        if($pwd !== $pwdRepeat){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function uidExist($conn, $username, $email){
        $sql = "SELECT * FROM users WHERE USERS_UID = ? OR USERS_EMAIL = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            //If there an error
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);

        $result_data = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($result_data)){
            //grab the data with the user name, return true send us to login form
            return $row;
        }
        else{
            $result = false;
            return $result;
        }
        
        mysqli_stmt_close($stmt);
    }

    function createUser($conn, $name, $email, $username, $pwd){
        $sql = "INSERT INTO users (USERS_NAME, USERS_EMAIL, USERS_UID, USERS_PWD) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            //If there an error
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        //Secure password, to prevent hacker attacks
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../signup.php?error=none");
        exit();
    }

    function emptyInputLogin($username, $pwd){
        $result;
        if(empty($username) || empty($pwd)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function loginUser($conn, $username, $pwd){
        $uidExist = uidExist($conn, $username, $username);

        if($uidExist === false){
            header("location: ../login.php?error=usererror");
            exit();
        }

        $pwdHashed = $uidExist["USERS_PWD"];
        $checkPwd = password_verify($pwd, $pwdHashed);

        if($checkPwd === false){
            header("location: ../login.php?error=badpwd");
            exit();
        }
        else if($checkPwd === true){
            session_start();
            $_SESSION["USER_ID"] = $uidExist["USERS_ID"];
            $_SESSION["USER_UID"] = $uidExist["USERS_UID"];
            header("location: ../index.php");
            exit();
        }
    }