<?php 
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');

    $listeSearch=$listeCours;
    if(isset($_POST['keyWord'],$_POST['tableIndex']) && !empty($_POST['keyWord']) && !empty($_POST['tableIndex']) ){
        $listeSearch=[];
        $tableIndex=$_POST['tableIndex'];
        foreach($listeCours as $cour){
            if($cour[$tableIndex]==$_POST['keyWord']){
                $listeSearch[]=$cour;

            }
        }
    }
    if(empty($listeSearch)){
        echo" <h6 class='text-danger text-center'>Aucun cour trouvé </h6> 
        <img src='./../illustration/courses.svg' alt='on a pas reusis' style='width:40%; display:block; margin:auto;'>";
        return;
    }
?>

<!-- la recuperation des cours  -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>
                Nom Du Cour
            </th>
            <th>Classe</th>
            <th>coéficient</th>
            <th>Professeur</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>

        <?php foreach($listeSearch as $cour): ?>
        <tr>
            <td><?php echo getMatiere($cour['matiere_id'],$listeMatiere)?></td>
            <td><?php echo getClasse($cour['classe_id'],$listeClasses)?></td>
            <td><?php echo $cour['coeficient']?></td>
            <td><?php echo getProf($cour['professeur_id'],$listeProfesseurs)?></td>
            <td>
                <button class="btn btn-warning" id="update"
                    onclick="afficherAction('update',<?php echo $cour['cour_id']?>)"><i
                        class="bi bi-arrow-counterclockwise"></i></button>
                <button class="btn btn-danger" onclick="afficherAction('del',<?php echo $cour['cour_id']?>)"><i
                        class="bi bi-trash3"></i></button>

            </td>
        </tr>
        <?php endforeach?>
    </tbody>
</table>