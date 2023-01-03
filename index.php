<?php
$bdd = new PDO('mysql:host=localhost;dbname=salah_tols', 'root', '');
$req = $bdd->prepare("SELECT * FROM produits ORDER BY id DESC ");
$req->execute(array());

if(isset($_GET['q']) and !empty($_GET['q'])){
  $q=htmlspecialchars($_GET['q']);
  $req= $bdd->prepare("SELECT * FROM produits WHERE referenc like '%$q%'");
 $req->execute(array($q));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Hepta+Slab:wght@500;@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css" />
  <title>Document</title>
</head>

<body>
  <header>
    <div class="logo"></div>
    <div>
      <table>
        <tr>
          <th>
            <h1>Binvenue Chez Salah Tools</h1>
            <ul>
              <li>Tel : <span>0540006041</span></li>
              <li>Facebook : <span>salah tools</span></li>
              <li>E-mail : <span>salah@gmail.com</span></li>
            </ul>
          </th>
        </tr>
      </table>
    </div>
  </header>
  <div class="ser">
    <img src="chercher.png">
    <form method="GET">
      <input type="search" name="q">

    </form>
  </div>

  <div class="wrapper">
    <div class="conatiner">
      <?php if($req->rowCount()>0){?>
      <?php while ($produi = $req->fetch())
      { ?>
      <div class="box">
        <img src="images-produits./<?php echo $produi['image'] ?>" alt="">
        <h3>
          <?php echo $produi['referenc'] ?>
        </h3>
        <p>
          <?php echo $produi['descrip'] ?>
        </p>
      </div>
      <?php } ?>
      
      <?php } else { ?>
       <h3 > Acune réssulta pour: <?= $q ?>....</h3>
             <?php }?>
    </div>
  </div>
</body>

</html>