<?php 
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');

    if(!isset($_POST['cour_id'],$_POST['action'])){
        exit('Imposible de mener cet action');
    }
    
    // la recuperation de la cour avec l'id spécifier
    $cour_id=$_POST['cour_id'];
    $mySchoolStatement=$mySchool->prepare("SELECT * FROM cour WHERE cour_id=$cour_id LIMIT 1");
    $mySchoolStatement->execute();
    $cour=$mySchoolStatement->fetch(PDO::FETCH_ASSOC);
    // si le cour est introuvable
    if(!$cour) {
        echo" <div class='alert alert-danger alert-dismissible fade show w-auto ' role='alert'>
        <h6 class='text-danger text-center'>Ce cour est introuvable</h6> 
        <img src='./../illustration/courses.svg' alt='on a pas reusis' style='width:40%; display:block; margin:auto;'>
        <button type='button' class='btn-close close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        return;
    }

?>

<!-- Pour la mis à jour -->
<?php if($_POST['action']=="update"):?>


<div class="modal d-block w-100 shadow" style="position: static !important;">
    <div class="modal-dialog modal-md" id="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: var(--dashbordColor);">Modification De cour</h5>
                <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <form class="form row">
                    <div class="form-group col col-6">
                        <label for="classe">Classe</label>
                        <select name="classe" id="classe" class="form-select">
                            <?php foreach ($listeClasses as $classe):?>
                            <option value="<?php echo $classe['classe_id']?>"
                                <?php echo ($classe['classe_id']==$cour['classe_id'])?'selected':''?>>
                                <?php echo $classe['classe']?>
                            </option>
                            <?php endforeach?>
                        </select>
                    </div>
                    <div class="form-group col col-6">
                        <label for="matiere">Matière</label>
                        <select name="matiere" id="matiere" class="form-select " onchange="getProfesseur()">
                            <?php foreach ($listeMatiere as $matiere):?>
                            <option value="<?php echo $matiere['id']?>"
                                <?php echo($matiere['id']==$cour['matiere_id'])?'selected':'' ?>>
                                <?php echo $matiere['nom']?>
                            </option>
                            <?php endforeach?>
                        </select>
                    </div>

                    <div class="form-group col col-6">
                        <label for="prof">Professeur</label>
                        <select name="prof" id="prof" class="form-select ">

                        </select>
                    </div>
                    <div class="form-group col col-6">
                        <label for="coeficient">Coéficient</label>
                        <input class="form-control" type="number" name="coeficient" id="coeficient" max="10" min="1"
                            required value="<?php echo $cour['coeficient']?>">

                    </div>


                </form>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" onclick="doUpdate(<?php echo $cour_id?>)">
                    Enregistrer
                </button>
                <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<?php endif?>

<!-- la supression de la cour -->
<?php if($_POST['action']=='del'):?>
<div class="alert alert-warning alert-dismissible fade show w-auto " role="alert">
    <div class=" pt-3 pe-3">
        <div>
            <p>
                <i class="bi bi-exclamation-triangle text-danger"></i> La supression du cour
                <span class="text-danger"><?php echo getMatiere($cour['matiere_id'],$listeMatiere)?></span>
                entrenera la supression de toutes les notes
                reliès à cette dite cour
            </p>
            <h6 class="text-danger">Veuillez confiremer en cliquant sur Supprimer</h6>

        </div>
    </div>
    <div class="text-end w-100"><button type="button" class="btn btn-danger" id="del"
            onclick="doDelete(<?php echo $cour_id?>)">Supprimer</button></div>
    <button type="button" class="btn-close close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php 

?>
<?php endif?>