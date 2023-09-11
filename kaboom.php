<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="style/style.css" rel="stylesheet">
</head>
<body>
    <?php
    if($_SESSION["connexion"] != true){
        ?>
        <h1>Vous n'êtes pas connecté</h1>
        <a href="connection.php">Page de connection</a>
        <?php
    } else {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $db = "avion";

        $id = $_GET['id'];

        //Connection
        $conn = new mysqli($servername, $username,$password,$db);

        //Verrification
        if ($conn ->connect_error){
            die("Erreur de connection: " . $conn->connect_error);
        }

        $conn->query('SET NAMES utf8');
        $sql = "SELECT id, nom, pays, role, img FROM jet";
        $result = $conn->query($sql);

        $supCommand = "DELETE FROM jet WHERE id = " . $id;
            if ($conn->query($supCommand) === TRUE) {
                $supConfirm = true;
            } else {
                ?><h1><?php echo "Error: " . $supCommand . "<br>" . $conn->error; ?></h1>
                <a class="optionBar" href="index.php">Liste des avions</a>
                <?php
            }
              
            ?>
                <div class="container-fluid" style="text-align:center">
                        <h1>Avion supprimer</h1>
                </div>
                <div class="container-fluid">
                    <div class= "row bar">
                        <div class="offset-md-4 offset-2 col-md-2 col-4">
                            <div class="optionStyle">
                                <a class="optionBar" href="index.php">Liste des avions</a>
                            </div>
                        </div>
        
                        <div class="col-md-2 col-4" >
                            <div class="optionStyle">
                                <a class="optionBar" href="supprimer.php">Supprimer un autre avion</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
        $conn->close();
    }
    ?>

</body>
</html>







