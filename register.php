<html>
<title>Food To Love | Register</title>
<head>
    <link rel="icon" href="icon.png">
    <style>
        .error {
            color: red;
        }


        body {
            background: url("background5.jpg");
            background-size: cover;

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

        .box{
            position: absolute;
            top: 50%;
            left:50%;
            transform: translate(-50%, -50%);
            width: 400px;
            padding: 40px;
            background: rgba(0,0,0,.8);
            box-sizing: border-box;
            box-shadow: 0 15px 25px rgba(0,0,0,.5);
            border-radius: 10px;}
        .box h2{
            margin:0 0 30px;
            padding:0;
            color: #fff;
            text-align: center;
            font-family: "Arial Rounded MT Bold";
            font-size: 27px;

        }
        .box input[type="text"]{
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
        .box input[type="number"] {
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
        .box input[type="submit"]{
            background: transparent;
            border: none;
            outline: none;
            color: #fff;
            background: darkmagenta;
            padding: 15px 25px;
            cursor: pointer;
            border-radius: 5px;
            align: center;
            margin-left: 65px;
            font-size:15px;
        }

    </style>
</head>
<body>
<?php

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;

}

$servername = "localhost";
$username = "root";
$password = "root";
$database = "mydb";

//create connection
$connection = new mysqli($servername, $username, $password, $database);

$emer = $mbiemer = $mosha = $email = "";
$emerErr = $mbiemerErr = $moshaErr = $emailErr = "";
$allow=true;
$message="";

if (isset($_POST['submit'])) {
    if (empty($_POST["emer"])) {
        $emerErr = "Username is required.";
        $allow=false;
    } else {
        $emer = test_input($_POST["emer"]);
    }

    if (empty($_POST["mbiemer"])) {
        $mbiemerErr = "Lastname is required.";
        $allow=false;
    } else {
        $mbiemer = test_input($_POST["mbiemer"]);
    }

    if (empty($_POST["mosha"])) {
        $moshaErr = "Age is required.";
        $allow=false;
    } else {
        $mosha = test_input($_POST["mosha"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required.";
        $allow=false;
    } else {
        $email = test_input($_POST["email"]);
    }

    if($allow==true){
    $sql = "SELECT id FROM perdorues WHERE email='$email'";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        $message = "Exists";
        //Ekziston
    } else {
        //Nuk ekziston, shtoje si te ri
        $sql = "INSERT INTO perdorues (emri, mbiemri, mosha, email) VALUES ('$emer', '$mbiemer', '$mosha', '$email')";
        if ($connection->query($sql) == TRUE) {
           header("location:Login.php?success=You registered successfully");
            //Urime
        } else {
            echo mysqli_error($connection);
            $message = "Problem occurred";
            //Problem occurred
        }
    }
    }
}

?>

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


<form method="post" action="register.php">
    <div class="box">
        <h4 align="center" style="color:red;"><?php echo $message; ?></h4>
    <table cellpadding="2" cellspacing="2" align="center" border="0">
        <tr>
            <td><h2 style="text-align: center">Sign Up Here</h2></td>
        </tr>
        <tr>

            <td><input type="text" placeholder="Name" name="emer"></td>
            <td><span class="error">* <?php echo $emerErr; ?> </span><br><br></td>
        </tr>
        <tr>

            <td><input type="text" placeholder="Lastname" name="mbiemer"></td>
            <td><span class="error">* <?php echo $mbiemerErr; ?> </span><br><br></td>
        </tr>
        <tr>

            <td><input type="number" placeholder="Age" name="mosha"></td>
            <td><span class="error">* <?php echo $moshaErr; ?> </span><br><br></td>
        </tr>
        <tr>

            <td><input type="email" placeholder="Email" name="email"></td>
            <td><span class="error">* <?php echo $emailErr; ?> </span><br><br></td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="Sign up"></td>
        </tr>
    </table>
</form>

</body>
</html>