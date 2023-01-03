<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=salah_tols', 'root', '');
if(isset($_POST['connecter'])){
    $user=$_POST['email'];
    $mdp=$_POST['mdp'];
    if(!empty($user)&& !empty($mdp))
    {
        $req=$bdd->prepare("SELECT *FROM utilisateur WHERE user=? AND mdp=?");
        $req->execute(array($user,$mdp));
       $connecter=$req->rowCount();
        if($connecter == 1){
            $connecter=$req->fetch();
            $_SESSION['user']= $connecter['user'];
         
            header("Location: Page_principale.php?user=".$_SESSION['uesr']);
           

         


        }
        else 
        $messege="l'utilisateur n'exist pas";
    }
    else
        $messege="remplir tous les champs";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin:Log In</title>
    <link rel="stylesheet" href="Admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hepta+Slab:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>

    <div class="test">
        <div class="container">

            <form method="POST">
            <div class="messege">
                <?php 
                    if(isset($messege))
                    {
                        echo $messege;
                    }
                ?>
                
            </div>
                <main class="test2">
                    <main class="forme">
                        <h2>Nom D'utilisateur </h2>

                        <h2>Mot De Passe </h2>
                    </main>

                    <main class="forme2">
                        <input type="e-mail" name="email">

                        <input type="password" name="mdp">

                    </main>

                </main>

        </div>

        <button name="connecter">Se Connecter</button>

        </form>

    </div>




</body>

</html>