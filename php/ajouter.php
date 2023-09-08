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

        $nom = $pays = $role = $img = "";
        $nomErreur = $paysErreur = $roleErreur = $imgErreur = "";
        $erreur = false;
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $codeTestNom = "SELECT * FROM jet WHERE nom LIKE '" . $_POST['nom'] . "'";
            $testNom = $conn->query($codeTestNom);

            if(empty($_POST['nom'])){
                $nomErreur = "Le nom ne peut pas être vide";
                $erreur  = true;
            } else if ($testNom->num_rows >= 1){
                $nomErreur = "Ce nom est déjà pris";
                $erreur  = true;
            } else {
                $nom = trojan($_POST['nom']);
            }

            if(empty($_POST['pays'])){
                $paysErreur = "Le pays ne peut pas être vide";
                $erreur  = true;
            } else {
                $pays = trojan($_POST['pays']);
            }

            if(empty($_POST['role'])){
                $roleErreur = "Le role ne peut pas être vide";
                $erreur  = true;
            } else {
                $role = trojan($_POST['role']);
            }

            if(empty($_POST['img'])){
                $imgErreur = "Vous devez mettre une image";
                $erreur  = true;
            } else {
                $img = trojan($_POST['img']);
            }
        }

        if ($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){
            ?>
                <div class="container-fluid" style="text-align:center">
                    <h1>Ajouter</h1>
                    <div class="row" style="text-align:left">
                        <div class="offset-md-5 ">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                Nom : <input type="text" name="nom" maxLength="40" value="<?php echo $nom;?>"><br>
                                <p style="color:red;"><?php echo $nomErreur; ?></p>
                                Pays : <input type="text" name="pays" maxLength="25" value="<?php echo $pays;?>"><br>
                                <p style="color:red;"><?php echo $paysErreur; ?></p>
                                Rôle : <input type="text" name="role" maxLength="25" value="<?php echo $role;?>"><br>
                                <p style="color:red;"><?php echo $roleErreur; ?></p>
                                Image : <input type="text" name="img" value="<?php echo $img;?>"><br>
                                <p style="color:red;"><?php echo $imgErreur; ?></p>
                                <input type="submit">
                            </form>
                        </div>
                    </div>
                </div>
            <?php
        } else {
            $envoye = "INSERT INTO jet (id, nom, pays, role, img) VALUES (NULL, '" . $nom . "', '" . $pays . "', '" . $role . "', '" . $img . "');";
            if ($conn->query($envoye) === TRUE) {
                ?>
                    <div class="container-fluid" style="text-align:center">
                        <h1>Avion enregistrer</h1>
                    </div>
                    <div class="container-fluid">
                        <div class= "row bar">
                            <div class="offset-md-4 offset-2 col-md-2 col-4">
                                <div class="optionStyle">
                                    <a class="optionBar" href="../index.php">Liste des avions</a>
                                </div>
                            </div>
        
                            <div class="col-md-2 col-4" >
                                <div class="optionStyle">
                                    <a class="optionBar" href="../php/ajouter.php">Ajouter un autre avion</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
            } else {
                ?>
                <h1><?php echo "Error: " . $envoye . "<br>" . $conn->error; ?></h1>
                <a class="optionBar" href="../index.php">Liste des avions</a>
                <?php
            }
        }
    
        function trojan($data){
            $data = trim($data); //Enleve les caractères invisibles
            $data = addslashes($data); //Mets des backslashs devant les ' et les  "
            $data = htmlspecialchars($data); // Remplace les caractères spéciaux par leurs symboles comme ­< devient &lt;
                
            return $data;
        }

        $conn->close();
    ?>   

</body>
</html>