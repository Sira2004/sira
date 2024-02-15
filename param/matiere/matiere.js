// la fonction pour recuperer les matieres crées
function getMatieres() {
  $.post({
    url: "get_matiere.php",
    success: function (reponse) {
      $("#listeMatieres").html(reponse);
    },
    error: function (error) {
      console.log(error.status);
    },
  });
}

// la fonction pour  afficher les données à modifier
function afficherAction(action, matiere_id) {
  $.post({
    url: "action_matiere.php",
    data: {
      action: action,
      matiere_id: matiere_id,
    },
    success: function (reponse) {
      $("#formulaire").css("display", "none");
      $("#actionResult").css("display", "block");
      $("#actionResult").html(reponse);
      $(".close").click(function () {
        if (action == "update") {
          $("#modal").hide(1000);
        }
        $("#actionResult").css("display", "none");
        $("#formulaire").css("display", "block");
      });
    },
    error: function (error) {
      console.log(error.status);
    },
  });
}

// la fonction pour la mis à jour
function doUpdate(matiere_id) {
  $.post({
    url: "post_update_matiere.php",
    data: {
      matiere_id: matiere_id,
      matiere: $("#matiere").val(),
      niveau: $("#niveau").val(),
    },
    success: function (reponse) {
      console.log(reponse);
      $("#modal").hide(1000);
      $("#actionResult").css("display", "none");
      $("#formulaire").css("display", "block");
      getMatieres();
    },
    error: function (error) {
      console.log(error.status);
    },
  });
}

// la fonction pour la suppression
function doDelete(matiere_id) {
  $.post({
    url: "post_delete_matiere.php",
    data: {
      matiere_id: matiere_id,
    },
    success: function (reponse) {
      console.log(reponse);
      $("#actionResult").css("display", "none");
      $("#formulaire").css("display", "block");
      getMatieres();
    },
    error: function (error) {
      console.log(error.status);
    },
  });
}
