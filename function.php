<?php 

    //la fonction pour rechercher des cours à l'aide d'un id de la classe
    function getEleves( int $classe_id,array $listeEleves):array{
        $elevesValid=[];
        foreach ($listeEleves as $eleve) {
            if ($eleve['classe_id']==$classe_id) {
                    $elevesValid[]=$eleve;
            }
           
        }
        return $elevesValid;
        
    } 
    // la  verification si un élève existe dans la liste 
    function isExisteEleve(array $list1,array $list2):bool 
    {
        foreach($list1 as $eleve){
            if($eleve['prenom']==$list2['prenom'] && $eleve['nom']==$list2['nom'] && $eleve['dat_naiss']==$list2['dt_naiss'] &&
                $eleve['lieu_naiss']==$list2['lieu_naiss'] && $eleve['sexe']==$list2['sexe'] &&
                $eleve['classe_id']==$list2['classe'])
            {
                return true;
            }
        }
        return false;
    }

    // le nombre de genre
    function numberSexe(array $liste, string $sexe):int
    {
        $nombre=0;
        foreach($liste as $eleve){
            if($eleve['sexe']==$sexe)$nombre++;
        }
        return $nombre;
    }

    // le nombre inscris
    function getNumberInscrits(int $classe_id,array $listeEleves):int
    {
        $nombre=0;
    
     foreach($listeEleves as $eleve){
        if($eleve['classe_id']==$classe_id){
                $nombre++;
        }
     }
        return $nombre;
    }
    
      // la verification si une classe existe dans la liste
      function isExisteClasse(array $list1,array $list2):bool 
      {
          foreach($list1 as $classe){
              if(strtoupper($classe['classe'])==strtoupper($list2['classe']))
              {
                  return true;
                  break;
              }
          }
          return false;
      }
    // la fonction pour chercher la classe d'un élève
    function getClasse(string $classe_id,array $listeClasse):string
    {
       
                foreach($listeClasse as $classe){
                    if($classe['classe_id']==$classe_id){
                        return $classe['classe'];
                    }
                }
                return 'not class';
    }


      // la verification si une classe existe dans la liste
      function isExisteMatiere(array $list1,array $list2):bool 
    {
        
          foreach($list1 as $matiere){
              if(strtoupper($matiere['nom'])==strtoupper($list2['nom']))
              {
                  return true;
                  
              }
          }
          return false;
        
      }

    
    // la fonction pour chercher la classe d'un élève
    function getMatiere(string $matiere_id,array $listeMatiere):string
    {
       
                foreach($listeMatiere as $matiere){
                    if($matiere['id']==$matiere_id){
                        return $matiere['nom'];
                    }
                }
                return 'not matiere';
    }

  // la  verification si un élève existe dans la liste 
  function isExisteProf(array $list1,array $list2):bool 
  {
      foreach($list1 as $eleve){
          if($eleve['prenom']==$list2['prenom'] && $eleve['nom']==$list2['nom'] && $eleve['dat_naiss']==$list2['dt_naiss']
           &&$eleve['lieu_naiss']==$list2['lieu_naiss'] && $eleve['sexe']==$list2['sexe'] && $eleve['diplome']==$list2['diplome'])
          {
              return true;
          }
      }
      return false;
  }
//la fonction pour rechercher un professeur à l'aide d'une matière
function getProfesseurs( int $matiere_id,array $listeProfesseurs):array{
    $profValid=[];
    foreach ($listeProfesseurs as $prof) {
        if ($prof['specialite_id']==$matiere_id) {
                $profValid[]=$prof;
        }
       
    }
    return $profValid;
    
} 

  // la fonction pour chercher un porfesseur
  function getProf(string $prof_id,array $listeProfesseurs):string
  {
     
              foreach($listeProfesseurs as $prof){
                  if($prof['professeur_id']==$prof_id){
                      return $prof['prenom'].'-'.$prof['nom'].' ( '. $prof['numero'].' )';
                  }
              }
              return 'Pas de professeur';
  }

  //la fonction pour rechercher des cours à l'aide d'un id de la classe
function getCours( int $classe_id,array $listeCours):array{
    $coursValid=[];
    foreach ($listeCours as $cour) {
        if ($cour['classe_id']==$classe_id) {
                $coursValid[]=$cour;
        }
       
    }
    return $coursValid;
    
}

  // la fonction pour chercher un porfesseur
  function getCourInClasse(int $cour_id,int $classe_id,array $listeCours):bool
  {
     
              foreach($listeCours as $cour){
                  if($cour['cour_id']==$cour_id && $cour['classe_id']=$classe_id){
                      return true;
                  }
              }
              return false;
  }

// la fonction pour renvoyer le nombre total de coéficient
function getTotalCoeficient(array $listeCours):int{
    $total=0;
    foreach ($listeCours as $cour) {
        $total=$total+$cour['coeficient'];
    }
    return $total;
}

  // la  verification si un cour existe dans la liste 
  function isExisteCour(array $list1,array $list2):bool 
  {
      foreach($list1 as $cour){
          if($cour['matiere_id']==$list2['matiere'] && $cour['classe_id']==$list2['classe'] ){
              return true;
          }
      }
      return false;
  }
  
//la fonction pour voir si trimestre existe dejà dans la liste
function isExisteTrimestre(array $list1,array $list2):bool 
  {
      foreach($list1 as $trimsestre){
          if($trimsestre['trimestre']==$list2['trimestre'] && $trimsestre['classe_id']==$list2['classe'] ){
              return true;
          }
      }
      return false;
  }
//la fonction pour rechercher des trimestres à l'aide d'un id de la classe
function getTrimestres( int $classe_id,array $listeTrimestres):array{
    $trimestresValid=[];
    foreach ($listeTrimestres as $trimestre) {
        if ($trimestre['classe_id']==$classe_id) {
                $trimestresValid[]=$trimestre;
        }
       
    }
    return $trimestresValid;
    
} 


      // la fonction pour verifier si une images est vailde
      function isValidImage($image):string
      {
                 // la verification du ficher envoyé par l'utilisateur
                 if(isset($_FILES[$image]) && $_FILES[$image]['error']==0){
                  $photo=$_FILES[$image];
                      if($photo['size']<6000000){
                          $listeExtension=['png','jpeg','jpg'];
                          $infoPhoto=pathinfo($photo['name']);
                          if(in_array(strtolower($infoPhoto['extension']) ,$listeExtension))
                          {
                              return 'valid';
                          }else return"type";
  
                      }else return "size";
  
              } else return "error";
      }
  
    // la fonction pour voir une photo existe
    function isExisteImage(array $liste,$image):bool{
        foreach($liste as $eleve){
            if($eleve['photo']==$image)
            return true;
        }
        return false;

    }


    // la fonction pour calculer la note toral
    function getNoteTotal($devoir,$examen,$coeficient){
        $total=(($devoir+$examen)/3)*$coeficient;
        return $total;
    }
?>