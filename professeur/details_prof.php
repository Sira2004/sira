<?php
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');

    if(isset($_POST['professeur_id'])){
      $mySchoolStatement=$mySchool->prepare("SELECT * FROM professeur WHERE professeur_id= ? LIMIT 1");
      $mySchoolStatement->execute(array($_POST['professeur_id']));
      $professeur=$mySchoolStatement->fetch(PDO::FETCH_ASSOC);

    }
?>


<div class="modal d-block w-100 position-absolute shadow shadow-lg">
    <div class="modal-dialog modal-lg" id="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Details du professeur</h5>
                <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <section class="container my-5">
                    <div class="title text-end rounded rounded-3 bg-light">
                        <div class="image">
                            <img src="./../param/image.php?path=<?php echo $professeur['photo']?>&type=<?php echo $professeur['imageType']?>"
                                alt="" style="width: 150px;height: 150px;; top: -50px"
                                class="d-block rounded-circle m-auto shadow position-relative" />
                        </div>
                        <div class="action position-relative btn-group">
                            <button type="button" class="btn btn-dark"
                                onclick="modify(<?php echo $professeur['professeur_id']?>,'./update.php')">Modifier</button>
                            <button type="button" class="btn btn-dark">Imprimer</button>
                        </div>
                    </div>

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
                            <input type="text"
                                class="form-control border-0 bg-transparent border-bottom border-success border-2"
                                id="prenom" disabled name="prenom" value="<?php echo @$professeur['prenom']?>" />
                            <div class="valid-feedback">Looks good!</div>
                        </div>

                        <!-- le champ de saisis pour le nom -->
                        <div class="col-md-4 col-sm-auto">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text"
                                class="form-control border-0 bg-transparent border-bottom border-success border-2"
                                id="nom" name="nom" disabled value="<?php echo @$professeur['nom']?>" />
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!-- le champ de saisis pour la date de naissance -->
                        <div class="col-md-4 col-sm-auto">
                            <label for="dt_naiss" class="form-label">Date de Naissance</label>

                            <input type="text"
                                class="form-control border-0 bg-transparent border-bottom border-success border-2"
                                id="dt_naiss" name="dt_naiss" disabled value="<?php echo @$professeur['dat_naiss']?>" />
                        </div>

                        <!-- le champ de saisis pour le lieu de naissance -->
                        <div class="col-md-4 col-sm-auto">
                            <label for="lieu_naiss" class="form-label">Lieu de Naissance</label>
                            <input type="text"
                                class="form-control border-0 bg-transparent border-bottom border-success border-2"
                                id="lieu_naiss" name="lieu_naiss" disabled
                                value="<?php echo @$professeur['lieu_naiss']?>" />
                        </div>
                        <!-- le champ de saisis pour le sexe -->
                        <div class="col-md-2 col-sm-auto">
                            <label for="sexe" class="form-label">Sexe</label>
                            <input name="sexe" id="sexe"
                                class="form-control border-0 bg-transparent border-bottom border-success border-2"
                                value="<?php echo @$professeur['sexe']?>" disabled />
                        </div>
                        <!-- le champ de saisis pour le diplome-->
                        <div class="col-md-2 col-sm-auto">
                            <label for="diplome" class="form-label">Diplome</label>
                            <input type="text" name="diplome" id="diplome"
                                class="form-control border-0 bg-transparent border-bottom border-success border-2"
                                value="<?php echo $professeur['diplome']?>" disabled />
                        </div>
                        <!-- le champ de saisis pour la specialité -->
                        <div class=" col-auto">
                            <label for="specialite" class="form-label">Specialite</label>
                            <input type="text" name="specialite"
                                value=" <?php echo getMatiere($professeur['specialite_id'],$listeMatiere)?>"
                                class="form-control border-0 bg-transparent border-bottom border-success border-2"
                                disabled />
                        </div>


                        <!-- le champ de saisis pour le numero de telephone -->
                        <div class="col-md-4 col-sm-auto">
                            <label for="num" class="form-label">Numero de Telephone</label>

                            <input type="text"
                                class="form-control border-0 bg-transparent border-bottom border-success border-2"
                                id="num" name="num" disabled value="<?php echo $professeur['numero']?>" />
                        </div>
                    </section>

                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>