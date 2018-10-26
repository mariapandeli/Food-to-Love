<?php
$msg="";
session_start();
if (isset($_POST['submit'])) {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $database = "mydb";
    $connection = mysqli_connect($servername, $username, $password, $database);
    $emer = $_POST['emer'];
    $email = $_POST['email'];

    $rez = mysqli_query($connection, "select * from perdorues where emri='$emer' and email='$email'");
    if (mysqli_num_rows($rez) == 1) {
        $row = mysqli_fetch_array($rez);
        $_SESSION["user_id"] = $row['id'];
        $_SESSION['emer'] = $emer;
        $_SESSION['admin'] = $row['roli'];
        if ($_SESSION['admin'] == 1) header("location:admin.php");
     else header('Location: welcome.php');
}
        else {
        $msg = "Email or password is incorrect.";

        }
}



?>

<html xmlns:align="http://www.w3.org/1999/xhtml">
<title>Food To Love | Login</title>
<head>
    <link rel="icon" href="icon.png"
</head>
<style>

    body {
        padding: 0;
        margin: 0;
        background-image: url('background.jpg');
        background-size: cover;
        font-family: sans-serif;
        opacity: 2;

    }
    .header {
        margin-top: 5px;
        margin-bottom:30px;
        overflow: hidden;
        background-color: white;
        padding: 20px 10px;
        border-radius: 10px;
        display: flex;
        flex-wrap: wrap;
        height: 50px;
    }

    .header a {
        float: left;
        color: black;
        text-align: center;
        padding: 12px;
        text-decoration: none;
        font-size: 22px;
        line-height: 25px;
        border-radius: 4px;
        margin-right:10px;

    }

    .header a.logo {
        font-size: 25px;
        font-weight: bold;

    }

    .logo {
        width: 130px;
        height: 59px;
        margin-left: 30px;
        margin-right: 30px;
        border:none;
        padding-bottom:10px;
    }

    .header a:hover {
        background-color: lightgray;
        color: black;
    }

    .header a.active {
        background-color: #f6626e;
        color: white;
    }

    @media screen and (max-width: 500px) {
        .header a {
            float: none;
            display: block;
            text-align: left;
        }

    }

    .menu-item {
        font-family: sans-serif;

    }
    .items a{
        margin-bottom: 40px;
        margin-top: 5px;
        margin-left: 30px;
        margin-right: 30px;
    }


    .box {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        padding: 40px;
        background: rgba(0, 0, 0, .8);
        box-sizing: border-box;
        box-shadow: 0 15px 25px rgba(0, 0, 0, .5);
        border-radius: 10px;
    }

    .box h2 {
        margin: 0 0 30px;
        padding: 0;
        color: #fff;
        text-align: center;
        font-family: "Arial Rounded MT Bold";
        font-size: 27px;

    }

    .box input[type="text"] {
        width: 100%;
        padding: 10px 0;
        font-size: 18px;
        margin-bottom: 30px;
        border: none;
        border-bottom: 1px solid #fff;
        outline: none;
        background: transparent;
        color: #fff;
    }

    .box input[type="email"] {
        width: 100%;
        padding: 10px 0;
        font-size: 18px;
        margin-bottom: 30px;
        border: none;
        border-bottom: 1px solid #fff;
        outline: none;
        background: transparent;
        color: #fff;
    }

    .box input[type="submit"] {
        background: transparent;
        border: none;
        outline: none;
        color: #fff;
        background: darkmagenta;
        padding: 15px 25px;
        cursor: pointer;
        border-radius: 5px;
        align: center;
        margin-left: 70px;
        font-size: 15px;
    }
       .message{
        color:white;
        font-size:13px;
           margin: 65px;
           border: none;


    }
</style>
<body>
<div class="header">
    <img class="logo" src="logo.svg"/>
    <div class="items">
        <a class="menu-item" href="home.php">Home</a>
        <a class="menu-item" href="#categories">Categories</a>
        <a class="menu-item" href="#recipes">Recipes</a>
        <a class="menu-item" href="#videos">Videos</a>
        <a class="menu-item" href="#ingredients">Ingredients</a>
        <a class="menu-item" href="#contact">Contact us</a>
        <a class="menu-item" href="#about">About</a>
    </div>
</div>

<h3 align:"center" style="color:red;"></h3>
<form method="post">
    <div class="box">
        <h5 align="center" style="color:red"><?php echo @$_GET['notlogin']; ?></h5>
        <h5 align="center" style="color:red"><?php echo @$_GET['success']; ?></h5>
        <h5 align="center" style="color:red;"><?php echo @$_GET['logout']; ?> </h5>
        <h5 align="center" style="color:red"><?php echo $msg; ?></h5>
        <table class="tabele" cellpadding="2" align="center" cellspacing="2" border="0">
            <tr>
                <td><h2>Login Here</h2></td>
            </tr>

            <tr>

                <td><input type="text" placeholder="Username" name="emer"></td>
            </tr>
            <tr>

                <td><input type="email" placeholder="Email" name="email"></td>
            </tr>
            <tr>

                <td><input type="submit" name="submit" style="margin-bottom: 20px;" value="Login"></td>
            </tr>
            <tr>
                <td><p style="font-size: 12px; color:#b3b3b3; margin-left: 28px;">Not registered? <a style="color:white; text-decoration: none" href="register.php">Create an account</a></p></td>
            </tr>
        </table>
    </div>
</form>

</body>

</html>