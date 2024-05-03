<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>



<?php ob_start(); 



?>

<section id="postuler">
    <form action="stocker.php" method="post" enctype="multipart/form-data">


        <input id="id_input" value="<?php echo new_id(); /*echo $nouvel_id;*/ ?>" readonly type="text" name="id" placeholder="Identifiant">
        <?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer la valeur de l'ID depuis $_POST
    $id_candidature = $_POST['id'];}
?>           

<input type="hidden" name="id_offre" value="1">
<!--value="<?php echo (isset($_GET['id_offre']) ? $_GET['id_offre'] : ''); ?>"-->
<!--Assurez-vous simplement de passer l'identifiant de l'offre en tant que paramètre 'id_offre' dans l'URL lorsque vous utilisez ce formulaire. Par exemple, lorsque vous créez le lien vers cette page, ajoutez le paramètre 'id_offre' avec la valeur appropriée dans l'URL.-->
<!--<a href="votre_page.php?id_offre=123">Lien vers votre page</a>-->
<!--c'est-à-dire je dois juste par exemple si je vais intégrer avec l'entité offre qui est celle de l'ami elle doit quand je clique sur postuler par exemple Lady de l'offre sera envoyé en URL il a destination sera ma page et comme ça je peux le récupérer-->
        <input readonly id="date" type="date" name="date" >
                
        <div class="cv">
        <input type="file" name="cv">
        <div class="info">
        <i class="icon fa-solid fa-upload"></i>
        <span>Télécharger votre cv</span>
        </div>
        </div>

        <div class="lettre">
        <input type="file" name="lettre">
        <div class="info">
        <i class="icon fa-solid fa-upload"></i>
        <span>Poser votre lettre de motivation</span>
                
                </div>
              </div>  
            
              
        <!--<h5 ><a href="skills.php" id="link_skill">Compétences</a></h5>-->

        <!-- Lien vers la page de compétences avec l'ID de la candidature passé en tant que paramètre 
        <h5><a href="skills.php?id_candidature=<?php //echo $id_candidature; ?>" id="link_skill">Compétences</a></h5>-->

        <!-- Dans la boucle foreach où vous affichez les candidatures 
            <td><a href="skills.php?id=<?//= $element->id ?>">compétences</a></td>-->



            <input name='submit' type="submit" value="Ajouter" class="add_btn"> 




            <!-- Lien vers la page des compétences avec l'identifiant de la candidature -->
        <h5><a href="skills.php?id=<?php echo $id_candidature; ?>" id="link_skill">Compétences</a></h5>
        
        


                   
         

    </form>
</section> 

<?php $contenu = ob_get_clean(); ?>

<?php include_once 'vue_principale.php'; ?>


<script src="scripttest.js"></script>
</body>
</html>