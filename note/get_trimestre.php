<?php 
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');
    
    if (isset($_POST['classe_id'])) {
        $trimestres=getTrimestres($_POST['classe_id'],$listeTrimestres);
        
        if (empty($trimestres)) {
            echo "<option value='0'>Aucun  trimestre pour cette classe</option>";
            return;
        }
    }
    else {
         return;
    }
?>

<?php foreach ($trimestres as $trimestre) : ?>
<option value="<?php echo $trimestre['trimestre_id']?>">
    <?php echo $trimestre['trimestre']?>
</option>

<?php endforeach ?>