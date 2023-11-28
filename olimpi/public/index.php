<!DOCTYPE html>
<html>

<head lang="hu">
    <title>Rövidpályás gyorskorcsolya a téli olimpiai játékokon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="olimpia2018.css">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <form action="index.php" method="post">
        <label for="">Éremszerzők listája</label>
        <input type="text" name="country" placeholder="country">
        <input type="submit" name="submit">
    </form>
</body>

</html>

<?php
include("connect.php");

$sql = "SELECT * FROM sportagak";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row["varos"] . "<br>";
        echo $row["sportagneve"] . "<br>";
        echo $row["helyszin"] . "<br>";
        echo $row["versenyszamok"] . "<br>";
    };
} else {
    echo "No user found";
}

$sql = "SELECT * FROM helyezettek";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row["orszag"] . "<br>";
        echo $row["arany"] . "<br>";
        echo $row["ezust"] . "<br>";
        echo $row["bronz"] . "<br>";
    };
} else {
    echo "No user found";
}

if (isset($_POST["submit"])) {
    $text = filter_input(INPUT_POST, "country", FILTER_SANITIZE_SPECIAL_CHARS);
    if (empty($text)) {
        echo "irja ma valamit oda he";
    } else {
        $sql = "SELECT helyezes, SUM(arany + ezust + bronz) AS ermek
        FROM helyezettek WHERE orszag = '$text'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo $row["helyezes"] . "<br>";
                echo $row["ermek"] . "<br>";
            };
        } else {
            echo "No user found";
        }
    }
}

mysqli_close($conn);
?>