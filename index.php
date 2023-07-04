<?php

session_start();

if (isset($_SESSION['username'])) {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>

    <h1>Selamat Datang : <?php echo $_SESSION['username']; ?> | <a href="logout.php">Logout</a></h1>
    <br>
    <h1>Form</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input name="data" type="file">
        <input type="submit" value="upload">
    </form>
    <br>
    <br>
    <h1>List File : </h1>

    <?php
    $dir = "uploads/";
    $files = scandir($dir);
    for ($a = 2; $a < count($files); $a++) {
    ?>
    <a href="uploads/<?php echo $files[$a]; ?>"><?php echo $files[$a]; ?></a>
    <br>
    <?php
    }
    ?>




</body>

</html>








<?php

} else {
    header("Location: login.php");
    exit();
}

?>