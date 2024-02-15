<?php 
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');
    
    if (isset($_POST['matiere_id'])) {
        $profs=getProfesseurs($_POST['matiere_id'],$listeProfesseurs);
        
        if (empty($profs)) {
            echo "<option >Pas de Professeur pour cette matère</option>";
            return;
        }
    }
    else {
         return;
    }
?>

<?php foreach ($profs as $prof) : ?>
<option value="<?php echo $prof['professeur_id']?>">
    <?php echo $prof['nom'].'  '.$prof['prenom'].' ('.$prof['numero'].')'?>
</option>

<?php endforeach ?>