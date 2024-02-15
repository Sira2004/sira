<?php
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');

    if(isset($_POST['eleve_id'])){
      $mySchoolStatement=$mySchool->prepare("SELECT * FROM eleve WHERE eleve_id= ? LIMIT 1");
      $mySchoolStatement->execute(array($_POST['eleve_id']));
      $eleve=$mySchoolStatement->fetch(PDO::FETCH_ASSOC);

    }
?>


<div class="modal d-block w-100 position-absolute shadow shadow-lg">
    <div class="modal-dialog modal-lg" id="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Details de l'élève</h5>
                <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <section class="container my-5">
                    <div class="title text-end rounded rounded-3 bg-light">
                        <div class="image">
                            <img src="./../param/image.php?path=<?php echo $eleve['photo']?>&type=<?php echo $eleve['imageType']?>"
                                alt="" style="width: 150px;height: 150px;; top: -50px"
                                class="d-block rounded-circle m-auto shadow position-relative" />
                        </div>
                        <div class="action position-relative btn-group">
                            <button type="button" class="btn btn-dark"
                                onclick="modify(<?php echo $eleve['eleve_id']?>,'./update.php')">Modifier</button>
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
                                Information de l'élève
                            </figcaption>
                        </div>
                        <!-- le champ de saisis pour le prenom -->
                        <div class="col-md-4 col-sm-auto">
                            <label for="prenom" class="form-label">Prenom</label>
                            <input type="text"
                                class="form-control border-0 bg-transparent border-bottom border-success border-2"
                                id="prenom" disabled name="prenom" value="<?php echo @$eleve['prenom']?>" />
                            <div class="valid-feedback">Looks good!</div>
                        </div>

                        <!-- le champ de saisis pour le nom -->
                        <div class="col-md-4 col-sm-auto">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text"
                                class="form-control border-0 bg-transparent border-bottom border-success border-2"
                                id="nom" name="nom" disabled value="<?php echo @$eleve['nom']?>" />
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!-- le champ de saisis pour la date de naissance -->
                        <div class="col-md-4 col-sm-auto">
                            <label for="dt_naiss" class="form-label">Date de Naissance</label>

                            <input type="text"
                                class="form-control border-0 bg-transparent border-bottom border-success border-2"
                                id="dt_naiss" name="dt_naiss" disabled value="<?php echo @$eleve['dat_naiss']?>" />
                        </div>

                        <!-- le champ de saisis pour le lieu de naissance -->
                        <div class="col-md-4 col-sm-auto">
                            <label for="lieu_naiss" class="form-label">Lieu de Naissance</label>
                            <input type="text"
                                class="form-control border-0 bg-transparent border-bottom border-success border-2"
                                id="lieu_naiss" name="lieu_naiss" disabled value="<?php echo @$eleve['lieu_naiss']?>" />
                        </div>
                        <!-- le champ de saisis pour le sexe -->
                        <div class="col-md-2 col-sm-auto">
                            <label for="sexe" class="form-label">Sexe</label>
                            <input name="sexe" id="sexe"
                                class="form-control border-0 bg-transparent border-bottom border-success border-2"
                                value="<?php echo @$eleve['sexe']?>" disabled />
                        </div>
                        <!-- le champ de saisis pour la classe-->
                        <div class="col-md-2 col-sm-auto">
                            <label for="classe" class="form-label">Classe</label>
                            <input type="text" name="classe"
                                value=" <?php echo getClasse($eleve['classe_id'],$listeClasses)?>"
                                class="form-control border-0 bg-transparent border-bottom border-success border-2"
                                disabled />
                        </div>

                        <!-- le champ de saisis pour le numero de telephone -->
                        <div class="col-md-4 col-sm-auto">
                            <label for="num" class="form-label">Numero de Telephone</label>

                            <input type="text"
                                class="form-control border-0 bg-transparent border-bottom border-success border-2"
                                id="num" name="num" disabled value="<?php echo @$eleve['numero']?>" />
                        </div>
                    </section>
                    <!--la section de l'information des parents  -->

                    <section class="row g-3 mt-3">
                        <div class="col-12 text-center">
                            <blockquote class="blockquote">
                                <img src="./../icon/parents.png" alt="" style="width: 30px" />
                            </blockquote>
                            <figcaption class="blockquote-footer text-success h3">
                                Information des parents
                            </figcaption>
                        </div>
                        <!-- le champ de saisis pour le nom du parent-->
                        <div class="col-md-4 col-sm-auto">
                            <label for="nomP" class="form-label">Nom</label>
                            <input type="text"
                                class="form-control border-0 bg-transparent border-bottom border-success border-2"
                                id="nomP" name="nomP" disabled value="<?php echo @$eleve['nomP']?>" />
                        </div>
                        <!-- le champ de saisis pour le prenom du parent -->
                        <div class="col-md-4 col-sm-auto">
                            <label for="prenomP" class="form-label">Prenom</label>

                            <input type="text"
                                class="form-control border-0 bg-transparent border-bottom border-success border-2"
                                id="prenomP" name="prenomP" disabled value="<?php echo @$eleve['prenomP']?>" />
                        </div>
                        <!-- le champ de saisis pour le numero de telephone du parent du parent -->
                        <div class="col-md-4 col-sm-auto">
                            <label for="numP" class="form-label">Numero de Telephone</label>

                            <input type="text"
                                class="form-control border-0 bg-transparent border-bottom border-success border-2"
                                id="numP" name="numP" disabled value="<?php echo @$eleve['numeroP']?>" />
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