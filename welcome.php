<?php
session_start();

if (!$_SESSION['emer']) {
    header("location:login.php?notlogin=You are not logged in.");
} else {
    echo "<div class='header'>";
    echo "<h3'>Welcome " . $_SESSION["emer"] . "!   ";
    echo "<a href='logout.php'><input class='logout' type='button' value='Log out' name='logout'/></a></h3>";
    echo "</div>";

}
$message = "";
if (isset($_POST['upload'])) {
    $folder = "C:\wamp64\www\phptestmaria\images\\" . basename($_FILES['image']['name']);

    $connection = mysqli_connect("localhost", "root", "root", "mydb");
    $image = $_FILES['image']['name'];
    $tema = $_POST['tema'];
    $koment = $_POST['koment'];


    $sql = "INSERT INTO postim(id_u, tema, koment, image) VALUES (" . $_SESSION['user_id'] . ",'$tema', '$koment', '$image')";


    if (!mysqli_query($connection, $sql)) {
        $message = "Something went wrong.";
    } else {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $folder)) {
            $message = "Image uploaded successfully!";
        } else {
            $message = "There was a problem uploading image.";
        }
    }
}

?>

<html>
<title>Food To Love | Welcome</title>
<head>
    <link rel="icon" href="icon.png">
    <style>
        body{
            background-color: white;
        }


        .header{

            color: white;
            background: palevioletred;
            height: 40px;
            width: 100%;
            padding-top: 15px;
            padding-right: 5px;
            font-size: 20px;
            font-family: sans-serif;
            text-align: right;
        }

        .logout{
            background-color: black;
            border: none;
            color: white;
            padding: 5px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 10px;
            -webkit-transition-duration: 0.4s; /* Safari */
            transition-duration: 0.4s;
            /*margin-left: 75px;*/
        }


        form {
            width: 50%;
            margin-left: 125px;
            background-color: white;


        }

        form div {
            margin-top: 15px;
            background-color:white;
        }

        img {

            margin-right: 15px;
            width: 100%;
            height: auto;
            border: inset;

        }

        .button {
            background-color: darkmagenta;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            -webkit-transition-duration: 0.4s; /* Safari */
            transition-duration: 0.4s;
            border-radius: 12px;
            margin-left: 75px;
        }

        .button:hover {
            box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
        }

        #content {
            border: 2px ridge #FFA5A5;
            outline: 0;
            background-color: palevioletred;
            display: inline-block;
            width: 100%;

        }

        .tema {
            border: none;
            width: 173px;
            text-align: center;
            font-family: sans-serif;

        }

        .textarea {
            border: none;
            width: 302px;
            font-family: sans-serif;

        }

        .display {
            display: inline-block;
            padding: 1.25%;
            margin: 1.25%;
            width: 28%;
            border: 1px solid black;
            background-color: whitesmoke;
            box-shadow: 0 15px 25px rgba(0, 0, 0, .5);
            font-family: sans-serif;
            text-align: center;

        }

        .delete-button {
            background-color: black;
            border: none;
            color: white;
            padding: 9px 19px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            -webkit-transition-duration: 0.4s; /* Safari */
            transition-duration: 0.4s;
            border-radius: 50%;
            margin-right: 50px;
        }

        .delete-button:hover {
            box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
        }

        .div-upload {
            border: solid 1px;
            border-radius: 5px;
            width: 40%;
            margin-left: 410px;
            margin-bottom: 20px;
            margin-top:20px;
            background-color: white;

        }
        .topic{
            border: solid 1px;
            height: 25px;
        }
        .koment{
            border: solid 1px;
        }


    </style>
</head>
<body>
<div class="div-upload">
    <form method="post" action="welcome.php" enctype="multipart/form-data">

        <input type="hidden" name="size" value="1000000">
        <div class="file">
            <input type="file" name="image"></div>

        <div class="tema">
            <input type="text" name="tema" class="topic" placeholder="What's your topic?">
        </div>
        <div class="textarea">
            <textarea name="koment" class="koment" cols="40" rows="4" placeholder="Comment something here..."></textarea>
        </div>
        <div>
            <input class="button" type="submit" name="upload" value="Upload Image">
        </div>

    </form>
</div>
<div id="content">

    <?php
    include './db.php';

    if (isset($_POST['submitdelete'])) {
        $idPost = $_POST['del'];
        $query = "DELETE FROM postim WHERE id_p=$idPost";
        mysqli_query($conn, $query);
    }

    $sql = "SELECT * FROM postim WHERE id_u=" . $_SESSION['user_id'];
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result)) {
        echo "<div id='img_div' class='display'>";
        echo "<img class='imazh' src='images\\" . $row['image'] . "'>";
        echo "<div class='container'>";
        echo "<h2>" . $row['tema'] . "</h2>";
        echo "<p style='font-size:16px'>" . $row['koment'] . "</p>";
        $id = $row['id_p'];
        echo '<form style="background-color: whitesmoke;" method="post" action="welcome.php">';
        echo '<input type="hidden" id="del" name="del" value="' . $id . '">';
        echo '<input class="delete-button" type="submit" name="submitdelete" value="Delete">';
        echo '</form>';
        echo "</div>";
        echo "</div>";

    }

    ?>

</div>
</body>
</html>
