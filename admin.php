<html>
<title>Food To Love | Admin</title>
<head>
    <link rel="icon" href="icon.png"
</head>
<style>
    body {
        background: white;}

    .head {
        color: black;
        background: white;
        height: 40px;
        width: 100%;
        padding-top: 1px;
        padding-bottom: 20px;
        padding-right: 5px;
        font-size: 20px;
        font-family: sans-serif;
        text-align: right;

    }



    .tabele {
        background-color: snow;
        width: 100%;
        font-size: 15px;
        text-align: center;
        margin: auto;
        font-family: sans-serif;
        margin-top: 20px;

    }

    .tabele, td th {
        border: 0.5px solid white;
        border-collapse: collapse;
    }

    th {
        background-color: #c32442;
        color: white;
        font-size: 17px;
    }

    tr:nth-child(odd) {
        background-color: #F0F0F0;
    }

    .button {
        margin-top: 10px;
        margin-bottom: 0.25px;
        /*background-color: #4CAF50; */
        border: none;
        color: white;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        -webkit-transition-duration: 0.4s; /* Safari */
        transition-duration: 0.4s;
        cursor: pointer;
    }

    .button {
        background-color: white;
        color: black;
        border: 2px solid crimson;
    }

    .button:hover {
        background-color: crimson;
        color: white;
    }

    .logout {
        background-color: black;
        border: none;
        color: white;
        padding: 7px 13px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        -webkit-transition-duration: 0.4s; /* Safari */
        transition-duration: 0.4s;
        border-radius: 5px;
        margin-right: 10px;
    }
    .logout:hover{
        color:black;
        background-color: white;
    }

    .display {
        display: inline-block;
        padding: 1.25%;
        margin: 1.25%;
        width: 28%;
        border: 2px groove;
        background-color: white;
        box-shadow: 0 15px 25px rgba(0, 0, 0, .5);
        font-family: sans-serif;
        text-align: center;

    }

    #content {
        border: 2px ridge crimson;
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
        margin-left: 10px;
    }

    .delete-button:hover {
        box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
    }


</style>



<?php
include './db.php';
session_start();
$empty = "";

if ($_SESSION['admin'] == 0) header("welcome.php");
else {
    echo "<div class='head'>";
    echo "<h3 style='background-color: white; color:black; text-align:right; font-size:20px; font-family: sans-serif;''>Welcome " . $_SESSION["emer"] . "!   ";
    echo "<a href='logout.php'><input class='logout' type='button' value='Log out' name='logout'/></a></h3>";
    echo "</div>";

}

if (isset($_POST['delete'])) {
    $newId = $_POST['del'];
    $query = "DELETE FROM perdorues WHERE id=$newId";
    mysqli_query($conn, $query);
}

if (isset($_POST['edit'])) {
    $sql = "UPDATE perdorues SET emri='" . $_POST['emri'] . "', mbiemri='" . $_POST['mbiemri'] . "', email='" . $_POST['email'] . "', mosha='" . $_POST['mosha'] . "' WHERE id=" . $_POST['del'];
    mysqli_query($conn, $sql);
}

$query = "SELECT * FROM perdorues";
$rez = mysqli_query($conn, $query);

echo '<table class="tabele" border="1">
     <tr>
      <th>Delete</th>
      <th>Emer</th>
       <th>Mbiemer</th>
        <th>Email</th>
        <th>Mosha</th>
        <th>Edit</th>
        </tr>';

while ($row = mysqli_fetch_array($rez)) {
    $idRow = $row['id'];
    echo "<tr>";
    echo '<form method="post" action="admin.php">';
    echo '<td>
          <input type="hidden" id="del" name="del" value="' . $idRow . '">
          <input class="button" type="submit" name="delete" value="Delete">
          </td>';
    echo '<td> <input type="text" name="emri" value="' . $row['emri'] . '"</td>';
    echo '<td> <input type="text" name="mbiemri" value="' . $row['mbiemri'] . '"</td>';
    echo '<td> <input type="text" name="email" value="' . $row['email'] . '"</td>';
    echo '<td> <input type="text" name="mosha" value="' . $row['mosha'] . '"</td>';
    echo '<td>
          <input type="hidden" id="edit" name="edit" value="' . $idRow . '">
          <input class="button" type="submit" name="edit" value="Edit">
          </td>';
    echo "</form>";
    echo "</tr>";
}
echo '</table>';

?>

<div id="content">
    <h1 style="background-color: white; color: black; text-align: center;">User's Posts</h1>

    <?php
    include './db.php';

    if (isset($_POST['submitdelete'])) {
        $idPost = $_POST['del'];
        $query = "DELETE FROM postim WHERE id_p=$idPost";
        mysqli_query($conn, $query);
    }

    $sql = "SELECT * FROM postim INNER JOIN perdorues ON id_u=perdorues.id";
    $result = mysqli_query($conn, $sql);

    while ($array = mysqli_fetch_array($result)) {
        echo "<div id='img_div' class='display'>";
        echo "<h3><span style='color:crimson;'>User: </span>" . $array['emri'] . "</h3>";
        echo "<img class='imazh' src='images\\" . $array['image'] . "'>";
        echo "<div class='container'>";
        echo "<h2>" . $array['tema'] . "</h2>";
        echo "<p style='font-size:16px'>" . $array['koment'] . "</p>";
        $id = $array['id_p'];
        echo '<form style="background-color: whitesmoke;" method="post" action="admin.php">';
        echo '<input type="hidden" id="del" name="del" value="' . $id . '">';
        echo '<input class="delete-button" type="submit" name="submitdelete" value="Delete">';
        echo '</form>';
        echo "</div>";
        echo "</div>";
    }


    mysqli_close($conn);

    ?>
</div>
</html>
