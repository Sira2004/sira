<?php 
    include_once('config/mysql.php');
    include_once('varriable.php');
    include_once('function.php');
    
    ?>

<link rel="stylesheet" href="<?php echo $rootUrl?>css/bootstrap.css" />
<link rel="stylesheet" href="<?php echo $rootUrl?>entete.css" />
<link rel="stylesheet" href="<?php echo $rootUrl?>bootstrap-icons-1.11.2/font/bootstrap-icons.min.css" />

<header>
    <!-- l'entete pour le logo et boutton d'ouverture du menu -->
    <section id="entete" class="position-fixed bg-light ">
        <nav class="navbar bg-body-tertiary h-100">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <!-- le boutton d'ouverture du menu -->
                <div class="mobile d-lg-none">
                    <label class="buttons__burger navbar-toggler" for="burger" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                        aria-label="Toggle navigation">
                        <input class="d-none" />

                        <span></span>
                        <span></span>
                        <span></span>
                    </label>
                </div>
                <div>
                    <a class="navbar-brand" href="#">

                        My-School
                    </a>
                </div>
                <form class=" d-none d-lg-flex " role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-outline-success" type="submit">
                        Search
                    </button>
                </form>
                <div class="dropdown">
                    <img src="<?php echo $rootUrl. 'icon\param.png'?>" class="dropdown-toggle" data-bs-toggle="dropdown"
                        data-bs-auto-close="outside" width="30" style="cursor: pointer;">
                    <ul class="dropdown-menu dropdown-menu-end text-success shadow">
                        <li>
                            <a href="<?php echo $rootUrl. 'param/classe/create_classe.php'?>"
                                class="dropdown-item">Créer une
                                classe</a>
                        </li>
                        <li>
                            <a href="<?php echo $rootUrl. 'param/matiere/create_matiere.php'?>"
                                class="dropdown-item">Ajouter
                                une
                                matière</a>
                        </li>

                    </ul>
                </div>


            </div>
        </nav>
    </section>
    <section class="dshbord">
        <nav class="navbar fixed-top">
            <div class="container-fluid">
                <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                    aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">
                            Dashboroad
                        </h5>
                        <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

                            <!-- le lien pour la page d'acceuil -->
                            <li class="nav-item choise">
                                <a class="nav-link active link" aria-current="page"
                                    href="<?php echo $rootUrl?>index.php"><i class="bi bi-house-fill"></i> Tableau
                                    De Bord</a>
                            </li>

                            <!-- le lien pour la section eleve -->
                            <li class="nav-item dropdown" style="margin-bottom:16px; padding:4px;">

                                <a class="nav-link link dropdown-toggle" href="" data-bs-toggle="dropdown"
                                    aria-expanded="false"><i class="bi bi-backpack-fill"></i> Eleve</a>
                                <!-- les sous liens pour la section eleve -->
                                <ul class="dropdown-menu">
                                    <!-- le lien d'inscription -->
                                    <li class="mb-3"><a class="dropdown-item dropdown-choise " id="inscription"
                                            href="<?php echo $rootUrl?>eleve/inscription_eleve.php">
                                            <i class="bi bi-person-add"></i>
                                            Inscription</a></li>
                                    <!-- lien de recherche -->
                                    <li class="mb-3">
                                        <a class="dropdown-item dropdown-choise"
                                            href="<?php echo $rootUrl?>eleve/recherche-eleve.php">
                                            <i class="bi bi-search"></i>
                                            Recherche
                                        </a>
                                        <!-- le lien pour la mensualité -->
                                    </li>
                                    <li class="mb-3"><a class="dropdown-item dropdown-choise" href="#"><i
                                                class="bi bi-cash-coin"></i> Mensualité</a></li>
                                </ul>

                            </li>

                            <!-- le lien pour la section professeur -->
                            <li class="nav-item dropdown" style="margin-bottom:16px; padding:4px;">

                                <a class="nav-link link dropdown-toggle" href="" data-bs-toggle="dropdown"
                                    aria-expanded="false"><i class="bi bi-person-fill"></i> Professeur</a>
                                <!-- les sous liens pour la section professeur -->
                                <ul class="dropdown-menu">
                                    <!-- le lien de création -->
                                    <li class="mb-3"><a class="dropdown-item dropdown-choise" id="addProf"
                                            href="<?php echo $rootUrl?>professeur/create_professeur.php">
                                            <i class="bi bi-file-plus"></i>
                                            Ajout de Prof</a></li>
                                    <!-- le lien de recherche -->
                                    <li class="mb-3"><a class="dropdown-item dropdown-choise" id="searchProf"
                                            href="<?php echo $rootUrl?>professeur/recherche_prof.php"><i
                                                class="bi bi-search"></i>
                                            Recherche</a></li>
                                </ul>
                            </li>

                            <!-- le lien pour la section des cours -->
                            <li class="nav-item dropdown" style="margin-bottom:16px; padding:4px;">

                                <a class="nav-link link dropdown-toggle" href="" data-bs-toggle="dropdown"
                                    aria-expanded="false"><i class="bi bi-person-fill"></i> Cours</a>
                                <!-- les sous liens pour la section cour -->
                                <ul class="dropdown-menu">
                                    <!-- le lien de création de cour -->
                                    <span class="dropdown-header">Cours</span>
                                    <li class="mb-3"><a class="dropdown-item dropdown-choise" id="addMatiere"
                                            href="<?php echo $rootUrl?>cours/create_cour.php">
                                            <i class="bi bi-file-plus"></i>
                                            Ajout De Cour</a></li>
                                    <!-- le lien de recherche -->
                                    <li class="mb-3"><a class="dropdown-item dropdown-choise" id="searchProf"
                                            href="<?php echo $rootUrl?>cours/liste_cour.php"><i
                                                class="bi bi-search"></i>
                                            Voir la liste</a></li>


                                    <hr class="dropdown-divider">
                                    <span class="dropdown-header">Trimestres</span>
                                    <!-- le lien de création de cour -->
                                    <li class="mb-3"><a class="dropdown-item dropdown-choise"
                                            href="<?php echo $rootUrl?>trimestre/create_trimestre.php">
                                            <i class="bi bi-file-plus"></i>
                                            Créer un Trimestre</a></li>
                                </ul>
                            </li>


                            <!-- le lien pour la section des notes  -->
                            <li class="nav-item dropdown" style="margin-bottom:16px; padding:4px;">

                                <a class="nav-link link dropdown-toggle" href="" data-bs-toggle="dropdown"
                                    aria-expanded="false"><i class="bi bi-stickies-fill"></i> Notes</a>
                                <!-- les sous liens pour la section professeur -->
                                <ul class="dropdown-menu">
                                    <!-- le lien pour la generation des notes -->
                                    <li class="mb-3"><a class="dropdown-item dropdown-choise"
                                            href="<?php echo $rootUrl?>note/note.php">
                                            <i class="bi bi-person-add"></i>
                                            Génération</a></li>
                                    <!-- le lien de recherche -->
                                    <li class="mb-3">
                                        <a class="dropdown-item dropdown-choise"
                                            href="<?php echo $rootUrl?>note/liste_note.php">
                                            <i class="bi bi-search"></i> Voir La Liste
                                        </a>
                                    </li>
                                </ul>

                            </li>

                            <!-- le lien pour la section école -->
                            <li class="nav-item choise">
                                <a class="nav-link link" href="#"><i class="bi bi-receipt-cutoff"></i> Ecole</a>
                            </li>

                            <!-- le section pour les paramètres -->
                            <li class="nav-item choise">
                                <a class="nav-link link" href="#"><i class="bi bi-gear-fill"></i> Paramètre</a>
                            </li>

                            <!-- la section pour les emplis du temps -->
                            <li class="nav-item choise">
                                <a class="nav-link link" href="#"><i class="bi bi-alarm-fill"></i> Emplois Du
                                    Temps</a>
                            </li>

                            <li class="nav-item choise bottom-0 text-danger mb-0">
                                <a class="nav-link link text-danger" href="#"><i class="bi bi-box-arrow-left"></i>
                                    Quitter</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </section>
</header>