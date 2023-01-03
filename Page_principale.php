<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=salah_tols', 'root', '');
if (!isset($_SESSION['user']))
{
    header("location: Admin.php");
}
else
{
    if (isset($_POST['btn_ajouter']))
    {
        $referenc = $_POST['referanc'];
        $descrip = $_POST['descrip'];
        $mot = "yassin";

        if (!empty($referenc) && !empty($descrip))
        {

            if (strpos($referenc, '#') !== false || strpos($referenc, '&') !== false || strpos($referenc, '~') !== false || strpos($referenc, '"') !== false || strpos($referenc, '_') !== false || strpos($referenc, '``') !== false || strpos($referenc, '^') !== false)
            {
               $messege= "SVP eviter d'utiliser les carectaire suivant:(#,&,~,_,``,^)";

            }
            else
            {
                $req = $bdd->prepare("SELECT * FROM produits WHERE referenc=? descrip=? ");
                $req->execute(array($referenc, $descrip));


                if ($req->rowCount() == 1)
                {
                    $messege = "produit déja existe";
                }
                else
                {

                    if (isset($_FILES['image']))
                    {
                        $imag_nom = $_FILES['image']['name']; //On récupère le nom de l'image
                        $tmp_nom = $_FILES['image']['tmp_name']; //Nous définissons un nom temporaire
                        $time = time(); //On récupère l'heure actuelle
                        // On renomme l'image
                        $nouveau_nom_imag = $time . $imag_nom;
                        // On déplace l'image dans le dossier images_prouits
                        $deplacer_imag = move_uploaded_file($tmp_nom, "images-produits/" . $nouveau_nom_imag);

                        if ($deplacer_imag)
                        {
                            //si l'image a été déplacer:
                            //inseron le reférance , la déscription et l'image
                            $req2 = $bdd->prepare("INSERT INTO produits(referenc,descrip,image) VALUES(?,?,?)");
                            $req2->execute(array($referenc, $descrip, $nouveau_nom_imag));
                            $messege2="Produit ajouté !";
                        }
                        else
                        {
                            $messege = "inserer votre image SVP";
                        }
                    }
                  
                }


            }
        }
        else
            $messege = "SVP remplire tous les champs";
    }

    $req3 = $bdd->prepare("SELECT * FROM produits");
    $req3->execute(array());
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin:Page De configuration </title>
    <link rel="stylesheet" href="Page_principale1.css">
    <link rel="stylesheet" href="Page_principale2.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hepta+Slab:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="jquery-3.6.0.min.js"></script>
    <script src="Page_principale.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    
</head>

<body>

    
    <button class="ajouter">Ajouter Produit</button>
    <button class="supprimer">Liste Des Produits</button>
    <div class="line"></div>
    <p id="hello">Hello Sir,</p>

   
            <?php 
               if (isset($messege))
                {
                    ?>
                     <div class="message">
                     <h2>Ereur :</h2>
                     <?php
                     echo $messege;
                     ?>
                    <button class="click-message">Ok</button>
                    </div>
                    <?php } ?>
                    <?php 
               if (isset($messege2))
                {
                    ?>
                     <div class="message">
                     <!-- <h2>Ereur :</h2> -->
                     <?php
                     echo $messege2;
                     ?>
                    <button class="click-message">Ok</button>
                    </div>
                    <?php } ?>
              


    <!-- ====================================== Ajouter Produit ============================================-->



    <div class="ajouter-produit">

        <div class="formulaire1">
            <h2>Ajouter photo</h2> 
            <h2>Ajouter Référence</h2>
            <h2>Ajouter Déscription</h2>
        </div>

        <span class="line2"></span>

        <form method="POST" enctype="multipart/form-data">
            <div class="formulaire2">
                <main>
                    <div class="imgcontainer">
                        <figure class="image-container">
                            <img id="chosen-image">
                        </figure>
                        <figcaption id="file-name"></figcaption>
                        <input type="file" name="image" id="upload-button" accept="image/*">
                    </div>

                    <label for="upload-button"> <i class="fas fa-upload"></i>&nbsp;</label>
                </main>

                <script src="script.js"></script>

                <input class="text" name="referanc" type="text">
                <textarea cols="30" rows="10" name="descrip"></textarea>
            </div>


            <button class="btnajout" name="btn_ajouter" >Ajouter</button>

        </form>

    </div>




    <!-- ============================================ Supprimer Produit =====================================================-->


    <div class="liste-produits">

        <div class="listepro">

            <table>

            <?php while ($produit = $req3->fetch())
                { ?>
                <tr>
                    <td class="ref">
                        <h2>
                            <?php echo $produit['referenc'] ?>
                        </h2>
                    </td>
                    <td class="btnsupp"><button> <a onclick="return confirm('vous les veux suprimer cette commande!!!!')" href="supprimer produit.php?ref=<?= $produit['referenc'] ?>">supprimer</a></button></td>

                </tr>
                <?php } ?>


            </table>


        </div>

    </div>



</body>

</html>