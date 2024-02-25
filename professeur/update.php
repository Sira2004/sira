<?php
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');


    if(!isset($_POST['professeur_id'])){
        exit("<div class='alert alert-danger container'>Impossible de proceder à  la modification</div>");
    }
    
    $mySchoolStatement=$mySchool->prepare("SELECT * FROM professeur WHERE professeur_id= ? LIMIT 1");
    $mySchoolStatement->execute(array($_POST['professeur_id']));
    $professeur=$mySchoolStatement->fetch(PDO::FETCH_ASSOC);

?>

<div class="modal d-block w-100 position-absolute shadow shadow-xl" style=" z-index: 10;">
    <div class="modal-dialog modal-lg" id="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modification de l'élève</h5>
                <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- linscription -->
                <section class="container my-5 ">

                    <form name="inscription" class="form border p-2 text-primary" enctype="multipart/form-data">
                        <!-- la section conernant les informations de l'élève -->
                        <section class="row g-3">
                            <div class="col-12 text-center">
                                <blockquote class="blockquote">
                                    <img src="./../icon/graduate-avatar.png" alt="" style="width: 30px" />
                                </blockquote>
                                <figcaption class="blockquote-footer text-info h3">
                                    Information du professeur
                                </figcaption>
                            </div>
                            <!-- le champ de saisis pour le prenom -->
                            <div class="col-md-4 col-sm-auto">
                                <label for="prenom" class="form-label">Prenom</label>
                                <input type="text" class="form-control" id="prenom" required name="prenom"
                                    value="<?php echo @$professeur['prenom']?>" />
                            </div>

                            <!-- le champ de saisis pour le nom -->
                            <div class="col-md-4 col-sm-auto">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" required
                                    value="<?php echo @$professeur['nom']?>" />
                            </div>
                            <!-- le champ de saisis pour la date de naissance -->
                            <div class="col-md-4 col-sm-auto">
                                <label for="dt_naiss" class="form-label">Date de Naissance</label>

                                <input type="date" class="form-control" id="dt_naiss" name="dt_naiss" required
                                    value="<?php echo @$professeur['dat_naiss']?>" />
                            </div>

                            <!-- le champ de saisis pour le lieu de naissance -->
                            <div class="col-md-4 col-sm-auto">
                                <label for="lieu_naiss" class="form-label">Lieu de Naissance</label>
                                <input type="text" class="form-control" id="lieu_naiss" name="lieu_naiss" required
                                    value="<?php echo @$professeur['lieu_naiss']?>" />
                            </div>
                            <!-- le champ de saisis pour le sexe -->
                            <div class="col-md-2 col-sm-auto">
                                <label for="sexe" class="form-label">Sexe</label>
                                <select name="sexe" id="sexe" class="form-select"
                                    value="<?php echo @$professeur['sexe']?>">
                                    <option value="M">M
                                    </option>
                                    <option value="F">F
                                    </option>
                                </select>
                            </div>
                            <!-- le champ de saisis pour le diplome-->
                            <div class="col-md-4 col-sm-auto">
                                <label for="diplome" class="form-label">Diplôme</label>
                                <input type="text" class="form-control" name="diplome" id="diplome"
                                    value="<?php echo @$professeur['diplome']?>">
                            </div>
                            <!-- le champ pour les la specialité -->
                            <div class="col-md-4 col-sm-auto">
                                <label for="specialite" class="form-label">Specialité</label>
                                <select name="specialite" id="specialite" class="form-select">
                                    <?php foreach ($listeMatiere as $matiere):?>
                                    <option value="<?php echo $matiere['id']?>">
                                        <?php echo $matiere['nom']?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <!-- le champ de saisis pour le numero de telephone -->
                            <div class="col-md-4 col-sm-auto">
                                <label for="num" class="form-label">Numero de Telephone</label>

                                <input type="text" class="form-control" id="num" name="num" required
                                    value="<?php echo @$professeur['numero']?>" />
                            </div>

                            <!-- le champ pour la selection d'images -->
                            <div class="col-12 row mt-3">
                                <div class="col col-12 col-md-6">
                                    <label for="photo" class="form-label">Portrait de l'élève</label>

                                    <input type="file" class="form-control" id="photo" name="photo" onchange="load()"
                                        onclick="load()">
                                    <input type="hidden" name="imagePath" id="imagePath"
                                        value="<?php echo $professeur['photo']?>">
                                    <input type="hidden" name="imageType" id="imageType"
                                        value="<?php echo $professeur['imageType']?>">

                                </div>


                                <div class="col col-12 col-md-4 offset-md-2 m-sm-auto">
                                    <img src="./../param/image.php?path=<?php echo $professeur['photo']?>&type=<?php echo $professeur['imageType']?>"
                                        alt="Photo de l'élève" id="portrait" class="d-block rounded rounded-2 shadow"
                                        style="width: 180px; height:180px; ">
                                </div>
                            </div>




                    </form>
                </section>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success"
                    onclick="ajax3(<?php echo @$professeur['professeur_id']?>)">
                    Enregistrer
                </button>
                <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>