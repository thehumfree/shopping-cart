<?php
include_once("db/db.php");
//////////////////////////// login account ///////////////////////////
if (isset($_POST["login"])) {
    $uname = trim($_POST["username"]);
    $pass = trim($_POST["password"]);
    if ($_POST["role"]==1) {
        $query = "SELECT * FROM farmer WHERE username = '{$uname}'";
        $sql = $conn->query($query);
        if ($sql->num_rows > 0) {
            $row = $sql->fetch_assoc();
            $verify = password_verify($pass, $row["password"]);
            if ($verify) {
                $_SESSION["id"] = $row["fid"];
                $_SESSION["username"] = $row["username"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["role"] = $row["role"];
                header("Location:farmer/addProduct.php");
            } else {
                echo("Wrong Username or Password");
            }
        } else {
            echo("Farmer Account Not Found!! Create An Account and Login");
        }
    } else {
        $query = "SELECT * FROM buyer WHERE username = '{$uname}'";
        $sql = $conn->query($query);
        if ($sql->num_rows > 0) {
            $row = $sql->fetch_assoc();
            $verify = password_verify($pass, $row["password"]);
            if ($verify) {
                $_SESSION["id"] = $row["bid"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["username"] = $row["username"];
                $_SESSION["role"] = $row["role"];
                header("Location:buyer/buyerProfile.php");
            } else {
                echo("Wrong Username or Password");
            }
        } else {
            echo("Buyer Account Not Found!! Create An Account and Login");
        }
    }
}

/////////////////////register account/////////////////////////////////////
if (isset($_POST["register"])) {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $hashpassword = password_hash($password, PASSWORD_DEFAULT);
    $role = $_POST["role"];
    if ($role == 1) {
        //checks if farmer exist using the email
        $check = "SELECT * FROM farmer WHERE username = '$username'";
        $sqlcheck = $conn->query($check);

        //if user exist, echo message and redirect back to register page
        if ($sqlcheck->num_rows >0) {
            echo "<script type='text/javascript'>
            alert('Username already exist!');
            window.location.href = 'index.php?#login';
        </script>";
        } else {
            //if user doesnt exist carry on with registration
            $query ="INSERT INTO farmer(username, email, password, role) ";
            $query.="VALUE('$username', '$email', '$hashpassword', '$role')";
            $sql= $conn->query($query);
            if ($sql) {
                echo "<script type='text/javascript'>
                alert('Registration was successful! press ok to be redirected to login page');
                window.location.href = 'index.php?#login';
            </script>";
            } else {
                header("Location:./index.php");
            }
        }
    } else {
        //checks if buyer exist using the email
        $check = "SELECT * FROM buyer WHERE username = '$username'";
        $sqlcheck = $conn->query($check);

        //if buyer exist, echo message and redirect back to register page
        if ($sqlcheck->num_rows > 0) {
            echo "<script type='text/javascript'>
            alert('Email Address already exist!');
            window.location.href = 'index.php?#register';
            </script>";
        } else {
            //if buyer doesnt exist carry on with registration
            $query ="INSERT INTO buyer(username, email, password, role) ";
            $query.="VALUE('$username', '$email', '$hashpassword', '$role')";
            $sql= $conn->query($query);
            if ($sql) {
                echo "<script type='text/javascript'>
                alert('Registration was successful! press ok to be redirected to login page');
                window.location.href = 'index.php?#login';
                </script>";
            } else {
                header("Location:./index.php?#register");
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login And Registration Form</title>
    <link rel="stylesheet" href="custom/index.css">
</head>
<body>
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Log In</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>
            <div class="social-icons">
                <img src="images/facebook.png">
                <img src="images/instagram.png">
                <img src="images/twitter.png">
    
            </div>
            <form id="login" class="input-group" method="POST">
                <input type="radio" id="farmer" name="role" value="1">
                <label for="farmer">Login as a farmer</label><br>
                <input type="radio" id="buyer" name="role" value="2">
                <label for="buyer">Login as a buyer</label><br>
                <input type="text" class="input-field" placeholder="User Id" name="username" required>
                <input type="text" class="input-field" placeholder="Enter Password" name="password" required>
                <input type="checkbox" class="check-box"><span> Remember Password</span>
                <button type="submit" class="submit-btn" name="login">Log In</button>

            </form>

            <form id="register" class="input-group" method="POST">
                <input type="radio" id="farmer" name="role" value="1">
                <label for="farmer">Register as a farmer</label><br>
                <input type="radio" id="buyer" name="role" value="2">
                <label for="buyer">Register as a buyer</label><br>
                <input type="text" class="input-field" placeholder="User Id" name="username" required>
                <input type="email" class="input-field" placeholder="Email Id" name="email" required>
                <input type="text" class="input-field" placeholder="Enter Password" name="password" required>
                <input type="checkbox" class="check-box" required><span> I agree to the terms & conditions</span>
                <button type="submit" class="submit-btn" name="register">Register</button>

            </form>
        </div>        
    
    </div>
    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("btn");

        function register(){
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";


        }
        function login(){
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0";


        }

    </script>
</body>
</html>