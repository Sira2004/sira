<?php 
    include_once('./../../config/mysql.php');
    include_once('./../../varriable.php');
    include_once('./../../function.php');

    if(!isset($_POST['matiere_id'],$_POST['action'])){
        exit('Imposible de mener cet action');
    }
    
    // la recuperation de la matiere avec l'id spécifier
    $matiere_id=$_POST['matiere_id'];
    $mySchoolStatement=$mySchool->prepare("SELECT * FROM matiere WHERE id=$matiere_id LIMIT 1");
    $mySchoolStatement->execute();
    $matiere=$mySchoolStatement->fetch(PDO::FETCH_ASSOC);
    if(!$matiere) exit('Cette dite matiere est introuvable');

?>

<!-- Pour la mis à jour -->
<?php if($_POST['action']=="update"):?>


<div class="modal d-block w-100 shadow" style="position: static !important;">
    <div class="modal-dialog modal-md" id="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: var(--dashbordColor);">Modification De matiere</h5>
                <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <form class="form">
                    <div class="form-group">
                        <label for="matiere">Nom de la matiere</label>
                        <input type="text" class="form-control" name="matiere" id="matiere" required
                            value="<?php echo $matiere['nom']?>" />
                    </div>
                    <div class="form-group">
                        <label for="niveau">Niveau D'étude</label>
                        <input type="text" class="form-control" name="niveau" id="niveau" required
                            value="<?php echo $matiere['niveau']?>" />
                    </div>


                </form>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" onclick="doUpdate(<?php echo $matiere_id?>)">
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

<!-- la supression de la matiere -->
<?php if($_POST['action']=='del'):?>
<div class="alert alert-warning alert-dismissible fade show w-auto " role="alert">
    <div class=" pt-3 pe-3">
        <div>
            <p>
                <i class="bi bi-exclamation-triangle text-danger"></i> La supression de la matiere
                <span class="text-danger"><?php echo $matiere['nom']?></span>
                entrenera la supression de tous les cours et notes
                reliès à cette dite matiere
            </p>
            <h6 class="text-danger">Veuillez confiremer en cliquant sur Supprimer</h6>

        </div>
    </div>
    <div class="text-end w-100"><button type="button" class="btn btn-danger" id="del"
            onclick="doDelete(<?php echo $matiere_id?>)">Supprimer</button></div>
    <button type="button" class="btn-close close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php 

?>
<?php endif?>