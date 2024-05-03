<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="style.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    
    <title>Document</title>
    
<style>


#errorMessage, #descriptionError{
        color: red;
        background-color: rgb(246, 209, 215);
        border: 1px solid red;
        border-radius: 10px;
        padding: 0 20%;
        
        width: 50%;
        margin-top: 0px;
        line-height: 30px;
        }

</style>
</head>
<body>
<?php ob_start(); ?>

<section id="skills" class="affichage">  
                <!--là g enlevé form pr que ces inputs seront envoyés avec les précédents  --> 
               
                
                
                <form id="myForm" action="stocker2.php" method="post" enctype="multipart/form-data">
                <h5 ><a href="#skills" id="link_skill">Compétences</a></h5>
                

                <input  value="<?php echo new_id2();?>" readonly type="text" placeholder="Identifiant" name="id_skill">
                <!--
                <div id="nouveau_id" nvid=<?//=new_id2()+1;?>></div>-->

                <?php 
// Récupérer l'identifiant de l'URL
$id_cand = isset($_GET['id']) ? $_GET['id'] : ''; 

// Vérifier si l'identifiant de l'URL est vide, si c'est le cas, utiliser une valeur par défaut
if(empty($id_cand)) {
    $id_cand = get_last_id_cand(); // Remplacez "valeur_par_defaut" par la valeur que vous souhaitez utiliser
}
?>
                <input type="" name="id_candidature" value="<?php echo $id_cand; ?>">

                <input id="test"  type="text" placeholder="Nom" name="nom" >
                <div id="errorMessage" ></div>

                <div class="choices">
                <label for="niveau">Niveau de Maîtrise :</label>
                <select id="niveau" name="niveau">
                    <option value="debutant">Débutant</option>
                    <option value="intermediaire">Intermédiaire</option>
                    <option value="avance">Avancé</option>
                </select>
                </div>

                <input id="descriptionInput" type="text" placeholder="Description" name="description"  >
                <span id="descriptionError" class="error-message"></span> <!-- Élément pour afficher le message d'erreur -->
                
                <input type="button" value="Tout voir" class="btn_see_skills" onclick="window.location.href='see_skills.php';">



    
                <input type="submit" value="Enregister" class="add_btn">
                </form>
                <div class="skillscontainer"></div>
</section>





<?php $contenu = ob_get_clean(); ?>


<?php include_once 'vue_principale.php'; ?>
 <!--         
<script src="scripttest.js"></script>-->
</body>
</html>
