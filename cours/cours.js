function getProfesseur() {
  $.post({
    url: "get_prof.php",
    data: {
      matiere_id: $("#matiere").val(),
    },
    success: function (reponse) {
      console.log(reponse);
      $("#prof").html(reponse);
    },
    error: function (error) {
      console.log(error.status);
    },
  });
}

// la fonction pour recuperer les cours crées
function getCours(keyWord, tableIndex) {
  $.post({
    data: {
      keyWord: keyWord,
      tableIndex: tableIndex,
    },
    url: "get_cour.php",
    success: function (reponse) {
      $("#listeCours").html(reponse);
    },
    error: function (error) {
      console.log(error.status);
    },
  });
}
function load() {
  getProfesseur();
}

// la fonction pour  afficher les données à modifier
function afficherAction(action, cour_id) {
  $.post({
    url: "action_cour.php",
    data: {
      action: action,
      cour_id: cour_id,
    },
    success: function (reponse) {
      $("#actionResult").css("display", "block");
      $("#actionResult").html(reponse);
      if (action == "update") {
        getProfesseur();
      }
      $(".close").click(function () {
        if (action == "update") {
          $("#modal").hide(1000);
        }
        $("#actionResult").css("display", "none");
      });
    },
    error: function (error) {
      console.log(error.status);
    },
  });
}

// la fonction pour la mis à jour
function doUpdate(cour_id) {
  $.post({
    url: "update_cour.php",
    data: {
      cour_id: cour_id,
      classe: $("#classe").val(),
      matiere: $("#matiere").val(),
      prof: $("#prof").val(),
      coeficient: $("#coeficient").val(),
    },
    success: function (reponse) {
      $("#modal").hide(1000);
      $("#actionResult").html(reponse);

      getCours("", "");
      $(".close").click(function () {
        $("#actionResult").css("display", "none");
      });
    },
    error: function (error) {
      console.log(error.status);
    },
  });
}

// la fonction pour la suppression
function doDelete(cour_id) {
  $.post({
    url: "delete_cour.php",
    data: {
      cour_id: cour_id,
    },
    success: function (reponse) {
      console.log(reponse);
      $("#actionResult").css("display", "none");
      getCours("", "");
    },
    error: function (error) {
      console.log(error.status);
    },
  });
}

// le filtrage à travers la classe
function filterClass() {
  let keyWord = $("#classe").val();
  $("#prof").val("");
  $("#matiere").val("");
  getCours(keyWord, "classe_id");
}
// le filtrage à travers le professeur
function filterProf() {
  let keyWord = $("#prof").val();
  $("#matiere").val("");
  $("#classe").val("");
  getCours(keyWord, "professeur_id");
}
// le filtrage à travers la matière
function filterMatiere() {
  let keyWord = $("#matiere").val();
  $("#prof").val("");
  $("#classe").val("");
  getCours(keyWord, "matiere_id");
}

// le formatage du champ pour le coéficient
function formatCoeficient() {
  let min = 1;
  let max = 10;
  let coeficient = parseInt($("#coef").val());

  if (coeficient < min) {
    $(this).val(min || isNaN(coeficient));
  } else if (coeficient > max) {
    $(this).val(max);
  }
}
