<?php

ob_start();
?>
    <form action="update2.php" method="post">
    <input type="text" value="<?php echo $element->id ?>" name="id_skill" readonly>

    <input placeholder="Nouveau nom" type="text" value="<?php echo $element->nom ?>"  name="nom">
   
<!--
    <input type="text" value="<?php echo $element->niveau ?>" name="niveau">
-->
    
    
    <div class="choices">
    <label for="niveau">Niveau de Maîtrise :</label>
    <select id="niveau" name="niveau">
        <option value="debutant" <?php if ($element->niveau == 'debutant') echo 'selected' ?>>Débutant</option>
        <option value="intermediaire" <?php if ($element->niveau == 'intermediaire') echo 'selected' ?>>Intermédiaire</option>
        <option value="avance" <?php if ($element->niveau == 'avance') echo 'selected' ?>>Avancé</option>
    </select>
</div>
    
<input placeholder="Description" type="text" value="<?php echo $element->description ?>"  name="description">
    
    
    <input type="submit" name="envoyer">

    </form>

<?php $contenu = ob_get_clean(); ?>


<?php include_once 'views/vue_principale.php'; ?>