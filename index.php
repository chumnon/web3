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
<body
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

            //Connection
            $conn = new mysqli($servername, $username,$password,$db);

            //Verrification
            if ($conn ->connect_error){
                die("Erreur de connection: " . $conn->connect_error);
            }

            $conn->query('SET NAMES utf8');
            $sql = "SELECT id, nom, pays, role, img FROM jet";
            $utilisateur = "SELECT id, pseudo, email, mdp, droit FROM utilisateur";
            $result = $conn->query($sql);
            $predroit = $conn->query($utilisateur);
            $droit = $predroit->fetch_assoc();
            ?>
            <div class="container-fluid liste-jet">
                <div class="row ligne-jet">
                <?php
                if ($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        ?>
                            <div class="card unJet">
                                <img class="card-img-top" src="<?php echo $row['img'] ?>" alt="Card image" style="width:100%"/>
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $row['nom']?></h4>
                                    <p class="card-text">
                                        <?php echo $row['pays']?><br>
                                        <?php echo $row['role']?><br>
                                    </p>
                                    <?php
                                        if($droit["droit"] === "admin"){
                                            ?>
                                            <a href="modifier.php?id=<?php echo $row['id']?>" class="modifier">modifier</a>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        <?php
                    }
                } else {
                    echo "0 results";
                }
                ?>
                </div>  
            </div>
            <?php
                if($droit["droit"] === "admin"){
                ?>
                    <div class="container-fluid">
                        <div class= "row bar">
                            <div class="offset-md-4 offset-2 col-md-2 col-4">
                                <div class="optionStyle">
                                    <a class="optionBar" href="ajouter.php">Ajouter</a>
                                </div>
                            </div>

                            <div class="col-md-2 col-4" >
                                <div class="optionStyle">
                                    <a class="optionBar" href="supprimer.php">Supprimer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
        $conn->close();
        }
    ?>
</body>
</html>