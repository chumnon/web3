<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../style/style.css" rel="stylesheet">
</head>
<body>
    <?php
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
        $result = $conn->query($sql);

        $nom = "";
        $nomErreur = "";
        $erreur = "";

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $codeTestNom = "SELECT * FROM jet WHERE nom LIKE '" . $_POST['nom'] . "'";
            $Nom = $conn->query($codeTestNom);

            if(empty($_POST['nom'])){
                $nomErreur = "Le nom ne peut pas être vide";
                $erreur  = true;
            } else if ($Nom->num_rows === 0){
                $nomErreur = "Ce jet n'est pas enregistré";
                $erreur  = true;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){
            ?>
                <div class="container-fluid" style="text-align:center">
                    <h1>Entrez le nom du jet</h1>
                    <div class="row" style="text-align:left">
                        <div class="offset-md-5 ">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                Nom : <input type="text" name="nom" maxLength="40" value="<?php echo $nom;?>"><br>
                                <p style="color:red;"><?php echo $nomErreur; ?></p>
                                <input type="submit">
                            </form>
                        </div>
                    </div>
                </div>
            <?php
        } else {
            $row = $Nom->fetch_assoc();
            ?>
                <div class="container-fluid liste-jet">
                    <div class="row ligne-jet">
                        <div class="card unJet">
                            <img class="card-img-top" src="<?php echo $row['img'] ?>" alt="Card image" style="width:100%"/>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $row['nom']?></h4>
                                <p class="card-text">
                                    <?php echo $row['pays']?><br>
                                    <?php echo $row['role']?><br>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
        }
        $conn->close();
    ?>

        

</body>
</html>