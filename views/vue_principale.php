<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>Document</title>
</head>
<body>

<!--cette inclusion me pose un prob car il ne traite que le contenu du dernier fichier inclus!!!   et je peux pas l'enlever car $contenu undefined-->
 <?php //include_once 'vue_create.php' ?>  <!-- c important malgré qu'avant ça ne posait pas prob 
 <?php //include_once 'vue_afficher.php' ?>
-->



<section class="main">

<div class="navbar">

    <div class="title">
        <p class="titre">JobFlash</p>
        <img src="" alt="" class="logo">
    </div>

    <ul class="parts">
        <li><a id="link1" href="create.php">Postuler</a></li>
        <li><a id="link2" href="afficher.php">Consulter</a></li>
    </ul>

</div>



<div class="content">
<?php echo $contenu ?>          
         

        

</div>





</section>
</body>
</html>