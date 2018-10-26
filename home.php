<?php
session_start();
?>


<!DOCTYPE html>
<html>
<title>Food To Love | Home</title>
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="icon" href="icon.png">

</head>
<style type="text/css">

    .header-slider {
        width: 100%;
        height: 300px;
    }

    body {
        background-color: white;
        float: none;
    }

    .header {
        margin-top: 10px;
        overflow: hidden;
        background-color: white;
        padding: 20px 10px;
        border-radius: 10px;
        display: flex;
        flex-wrap: wrap;
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
        margin-right: 10px;

    }

    .header a.logo {
        font-size: 25px;
        font-weight: bold;

    }

    .logo {
        width: 130px;
        height: 130px;
        margin-left: 30px;
        margin-right: 30px;
        border: none;
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

    .items a {
        margin-bottom: 25px;
        margin-top: 40px;
        margin-left: 30px;
        margin-right: 30px;
    }

    .display {
        display: inline-block;
        padding: 1.25%;
        margin: 1.25%;
        width: 28%;
        border: 1px groove;
        background-color: white;
        box-shadow: 0 15px 25px rgba(0, 0, 0, .5);
        font-family: sans-serif;
        text-align: center;

    }

    #content {
        border: 2px ridge;
        outline: 0;
        background-color: #fadadd;
        display: inline-block;
        width: 100%;
        margin-top: 1.25%;

    }

    img {

        margin-right: 15px;
        width: 100%;
        height: auto;
        border: inset;

    }

    .upvote {
        background-color: forestgreen;
        border: none;
        color: white;
        padding: 8px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        border-radius: 12px;
        border: solid 1px black;
        margin-left: 155px;

    }

    .upvote:hover {
        background-color: limegreen;
        color: white;
    }

    .downvote{
        background-color: black;
        border: none;
        color: white;
        padding: 7px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 15px;
        cursor: pointer;
        border-radius: 12px;
        border: solid 1px black;
        margin-left: 145px;
    }

    .downvote:hover {
        background-color: dimgrey;
        color: white;
    }

    .read-more {
        color: black;
        margin-left: 25px;


    }

    .read-more:hover {
        color: dimgray;
    }

    i {
        border: solid green;
        border-width: 0 3px 3px 0;
        display: inline-block;
        padding: 3px;
    }

    .right {
        transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
    }

    .footer {
        position: static;
        width: 100%;
        height: 25px;
        background-color: #f4adb4;
        color: black;
    }


</style>
<div class="header-slider">
    <img class="mySlides" src="slide5.jpg" style="width:100%; height:300px">
    <img class="mySlides" src="slide2.jpg" style="width:100%; height:300px">
    <img class="mySlides" src="slide4.jpg" style="width:100%; height:300px">
    <img class="mySlides" src="slide1.png" style="width:100%; height:300px">
    <img class="mySlides" src="slide6.jpg" style="width:100%; height:300px">
    <img class="mySlides" src="slide7.jpg" style="width:100%; height:300px">
</div>


<div class="header">
    <img class="logo" src="logo.svg"/>
    <div class="items">
        <a class="menu-item active" href="#home">Home</a>
        <a class="menu-item" href="#categories">Categories</a>
        <a class="menu-item" href="#recipes">Recipes</a>
        <a class="menu-item" href="#videos">Videos</a>
        <a class="menu-item" href="#ingredients">Ingredients</a>
        <a class="menu-item" href="#about">About</a>
        <a style="background-color: #fadadd; border: 1px rosybrown ridge; " href="logout.php">Logout</a>
    </div>
</div>

<script type="text/javascript">
    var myIndex = 0;
    carousel();
    myfunction();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > x.length) {
            myIndex = 1
        }
        x[myIndex - 1].style.display = "block";
        setTimeout(carousel, 2000); // Change image every 2 seconds
    }
</script>
<div id="content">
    <h1 style="background-color: transparent; color: black; text-align: center; font-family: Apple Chancery, cursive;">Share
        your favorite recipe! ♥ </h1>
    <?php
    include './db.php';

    $class = $text="";

    if(isset($_POST['upvote'])){
        $id_post=$_POST['upvotep'];
        $query="SELECT COUNT(*) FROM upvotes WHERE id_postim=".$id_post." AND id_user= " .$_SESSION['user_id'];
        $rez=mysqli_query($conn, $query);
        $row=mysqli_fetch_array($rez);
        if($row[0]==0){
            mysqli_query($conn, "INSERT INTO upvotes(id_user, id_postim) VALUES (".$_SESSION['user_id'].",".$id_post.")");
            }
            else{
            mysqli_query($conn, "DELETE FROM upvotes WHERE id_postim=".$id_post." AND id_user=".$_SESSION['user_id']);
        }
    }

    $sql = "SELECT * FROM postim INNER JOIN perdorues ON id_u=perdorues.id";
    $result = mysqli_query($conn, $sql);


    while ($array = mysqli_fetch_array($result)) {
        $query1="SELECT COUNT(*) FROM upvotes WHERE id_postim=".$array['id_p']." AND id_user=" .$_SESSION['user_id'];
        $rez1=mysqli_query($conn, $query1);
        $row1=mysqli_fetch_array($rez1);
        if ($row1[0]==0){
            $text = "Upvote ⇧";
            $class = "upvote";
        }
        else {
            $text = "Downvote ⇩";
            $class = "downvote";
        }
        echo "<div id='img_div' class='display'>";
        echo "<h3><span style='color:crimson;'>User: </span>" . $array['emri'] . "</h3>";
        echo "<img class='imazh' src='images\\" . $array['image'] . "'>";
        echo "<div class='container'>";
        echo "<h2>" . $array['tema'] . "</h2>";
        echo "<p style='font-size:16px'>" . $array['koment'] . "</p>";
        echo '<form style="background-color: white;" method="post" action="home.php">';
        echo '<input type="hidden" name="upvotep" value="' . $array['id_p'] . '">';
        echo '<input type="submit" class="'.$class.'" name="upvote" value="'.$text.'">';
        echo "<a class='read-more' href='recipes.php'>Read full recipe  <i class='right'></i></a>";
        echo '</form>';
        echo "</div>";
        echo "</div>";
    }


    mysqli_close($conn);

    ?>
</div>

<div class="footer">
    <p style="color:black; text-align:center; padding-top:5px"><b>

            Food to Love. Copyright©
            <script>document.write(new Date().getFullYear())</script>
            . All rights reserved.
        </b></p>

</div>
</html>