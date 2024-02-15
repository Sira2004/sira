<?php 
    include_once('./../../config/mysql.php');
    include_once('./../../varriable.php');
    include_once('./../../function.php');

    if(!isset($_POST['classe_id'],$_POST['action'])){
        exit('Imposible de mener cet action');
    }
    
    // la recuperation de la classe avec l'id spécifier
    $classe_id=$_POST['classe_id'];
    $mySchoolStatement=$mySchool->prepare("SELECT * FROM classe WHERE classe_id=$classe_id LIMIT 1");
    $mySchoolStatement->execute();
    $classe=$mySchoolStatement->fetch(PDO::FETCH_ASSOC);
    if(!$classe) exit('Cette dite classe est introuvable');

?>

<!-- Pour la mis à jour -->
<?php if($_POST['action']=="update"):?>


<div class="modal d-block  shadow " style="position: static !important;">
    <div class="modal-dialog modal-md" id="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: var(--dashbordColor);">Modification De Classe</h5>
                <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>

                    <form action=" #" class="form row" method="post" onsubmit="getClasses()">
                        <div class="form-group">
                            <label for="classe">Nom de la Classe</label>
                            <input type="text" class="form-control" name="classe" id="classe" required
                                value="<?php echo $classe['classe']?>" />
                        </div>
                        <div class="form-group">
                            <label for="nombreEleve">Nombre d'élèves</label>
                            <input type="number" class="form-control" name="nombreEleve" id="nombreEleve" required
                                value="<?php echo $classe['nombreEleve']?>" />
                        </div>


                    </form>

                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" onclick="doUpdate(<?php echo $classe_id?>)">
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

<!-- la supression de la classe -->
<?php if($_POST['action']=='del'):?>
<div class="alert alert-warning alert-dismissible fade show w-auto " role="alert">
    <div class=" pt-3 pe-3">
        <div>
            <p>
                <i class="bi bi-exclamation-triangle text-danger"></i> La supression de la classe
                <span class="text-danger"><?php echo $classe['classe']?></span>
                entrenera la supression de tous les élèves
                inscris dans cette dite classe
            </p>
            <h6 class="text-danger">Veuillez confiremer en cliquant sur Supprimer</h6>

        </div>
    </div>
    <div class="text-end w-100"><button type="button" class="btn btn-danger" id="del"
            onclick="doDelete(<?php echo $classe_id?>)">Supprimer</button></div>
    <button type="button" class="btn-close close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php 

?>
<?php endif?>