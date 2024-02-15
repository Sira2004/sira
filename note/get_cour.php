<?php 
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');
    
    if (isset($_POST['classe_id'])) {
        $cours=getCours($_POST['classe_id'],$listeCours);
        
        if (empty($cours)) {
            echo "<option value='0'>Aucun  Cour pour cette classe</option>";
            return;
        }
    }
    else {
         return;
    }
?>

<?php foreach ($cours as $cour) : ?>
<option value="<?php echo $cour['cour_id']?>">
    <?php echo getMatiere($cour['matiere_id'],$listeMatiere)?>
</option>

<?php endforeach ?>