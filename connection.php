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
            $sql = "SELECT id, pseudo, email, mdp, droit FROM utilisateur";
            $result = $conn->query($sql);

            $user = $mdp = "";
            $userErreur = $mdpErreur = "";
            $erreur = false;
        
            if($_SERVER['REQUEST_METHOD'] == "POST"){

                $codeTestNom = "SELECT * FROM utilisateur WHERE pseudo LIKE '" . $_POST['user'] . "'";
                $codeTestEmail = "SELECT * FROM utilisateur WHERE email LIKE '" . $_POST['user'] . "'";
                $codeTestMdp = "SELECT * FROM utilisateur WHERE mdp LIKE '" . sha1($_POST['mdp'],false) . "' AND pseudo OR email LIKE '" . $_POST['user']. "'";
                $testNom = $conn->query($codeTestNom);
                $testEmail = $conn->query($codeTestEmail);
                $testMdp = $conn->query($codeTestMdp);

                if(empty($_POST['user'])){
                    $userErreur = "L'utilisateur ne peut pas être vide";
                    $erreur  = true;
                } else if ($testNom->num_rows != 1 && $testEmail != 1){
                    $userErreur = "Cette utilisateur n'existe pas";
                    $erreur  = true;
                } else {
                    $user = trojan($_POST['user']);
                }

                if(empty($_POST['mdp'])){
                    $mdpErreur = "Le mot de passe ne peut pas être vide";
                    $erreur  = true;
                } else if ($testMdp->num_rows != 1){
                    $mdpErreur = "Le mot de passe est incorrect";
                    $erreur  = true;
                } else {
                    $pays = trojan($_POST['pays']);
                }
            }

            if ($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){
                ?>
                    <div class="container-fluid" style="text-align:center">
                        <h1>Ajouter</h1>
                        <div class="row" style="text-align:left">
                            <div class="offset-md-5 ">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                    Utilisateur (nom/email) : </br> <input type="text" name="nom" maxLength="40" value="<?php echo $pseudo;?>"><br>
                                    <p style="color:red;"><?php echo $userErreur; ?></p>
                                    Mots de passe : </br> <input type="text" name="pays" maxLength="25"><br>
                                    <p style="color:red;"><?php echo $mdpErreur; ?></p>
                                    <input type="submit">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php
            } else {


           
        $conn->close();
        }
    ?>
</body>
</html>