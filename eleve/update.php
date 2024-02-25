<?php
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');


    if(!isset($_POST['eleve_id'])){
        exit("<div class='alert alert-danger container'>Impossible de proceder à  la modification</div>");
    }
    
    $mySchoolStatement=$mySchool->prepare("SELECT * FROM eleve WHERE eleve_id= ? LIMIT 1");
    $mySchoolStatement->execute(array($_POST['eleve_id']));
    $eleve=$mySchoolStatement->fetch(PDO::FETCH_ASSOC);

?>

<div class="modal d-block  position-absolute shadow shadow-md">
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
                                    Information de l'élève
                                </figcaption>
                            </div>
                            <!-- le champ de saisis pour le prenom -->
                            <div class="col-md-4 col-sm-auto">
                                <label for="prenom" class="form-label">Prenom</label>
                                <input type="text" class="form-control" id="prenom" required name="prenom"
                                    value="<?php echo @$eleve['prenom']?>" />
                            </div>

                            <!-- le champ de saisis pour le nom -->
                            <div class="col-md-4 col-sm-auto">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" required
                                    value="<?php echo @$eleve['nom']?>" />
                            </div>
                            <!-- le champ de saisis pour la date de naissance -->
                            <div class="col-md-4 col-sm-auto">
                                <label for="dt_naiss" class="form-label">Date de Naissance</label>

                                <input type="date" class="form-control" id="dt_naiss" name="dt_naiss" required
                                    value="<?php echo @$eleve['dat_naiss']?>" />
                            </div>

                            <!-- le champ de saisis pour le lieu de naissance -->
                            <div class="col-md-4 col-sm-auto">
                                <label for="lieu_naiss" class="form-label">Lieu de Naissance</label>
                                <input type="text" class="form-control" id="lieu_naiss" name="lieu_naiss" required
                                    value="<?php echo @$eleve['lieu_naiss']?>" />
                            </div>
                            <!-- le champ de saisis pour le sexe -->
                            <div class="col-md-2 col-sm-auto">
                                <label for="sexe" class="form-label">Sexe</label>
                                <select name="sexe" id="sexe" class="form-select" value="<?php echo @$eleve['sexe']?>">
                                    <option value="M" <?php  echo ($eleve['sexe']=="M")?'selected':''?>>M</option>
                                    <option value="F" <?php  echo ($eleve['sexe']=="F")?'selected':''?>>F</option>
                                </select>
                            </div>
                            <!-- le champ de saisis pour la classe-->
                            <div class="col-md-2 col-sm-auto">
                                <label for="classe" class="form-label">Classe</label>
                                <select name="classe" id="classe" class="form-select">
                                    <?php foreach ($listeClasses as $classe):?>
                                    <option value="<?php echo $classe['classe_id']?>"
                                        <?php  echo ($classe['classe_id']==$eleve['classe_id'])?'selected':''?>>
                                        <?php echo $classe['classe']?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <!-- le champ de saisis pour le numero de telephone -->
                            <div class="col-md-4 col-sm-auto">
                                <label for="num" class="form-label">Numero de Telephone</label>

                                <input type="text" class="form-control" id="num" name="num" required
                                    value="<?php echo @$eleve['numero']?>" />
                            </div>

                            <!-- le champ pour la selection d'images -->
                            <div class="col-12 row mt-3">
                                <div class="col col-12 col-md-6">
                                    <label for="photo" class="form-label">Portrait de l'élève</label>

                                    <input type="file" class="form-control" id="photo" name="photo" onchange="load()"
                                        onclick="load()">
                                    <input type="hidden" name="imagePath" id="imagePath"
                                        value="<?php echo $eleve['photo']?>">
                                    <input type="hidden" name="imageType" id="imageType"
                                        value="<?php echo $eleve['imageType']?>">

                                </div>


                                <div class="col col-12 col-md-4 offset-md-2 m-sm-auto">
                                    <img src="./../param/image.php?path=<?php echo $eleve['photo']?>&type=<?php echo $eleve['imageType']?>"
                                        alt="Photo de l'élève" id="portrait" class="d-block rounded rounded-2 shadow"
                                        style="width: 180px; height:180px; ">
                                </div>
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
                                <input type="text" class="form-control" id="nomP" name="nomP" required
                                    value="<?php echo @$eleve['nomP']?>" />
                            </div>
                            <!-- le champ de saisis pour le prenom du parent -->
                            <div class="col-md-4 col-sm-auto">
                                <label for="prenomP" class="form-label">Prenom</label>

                                <input type="text" class="form-control" id="prenomP" name="prenomP" required
                                    value="<?php echo @$eleve['prenomP']?>" />
                            </div>
                            <!-- le champ de saisis pour le numero de telephone du parent du parent -->
                            <div class="col-md-4 col-sm-auto">
                                <label for="numP" class="form-label">Numero de Telephone</label>

                                <input type="text" class="form-control" id="numP" name="numP" required
                                    value="<?php echo @$eleve['numeroP']?>" />
                            </div>

                        </section>


                    </form>
                </section>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="ajax3(<?php echo @$eleve['eleve_id']?>)">
                    Enregistrer
                </button>
                <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>