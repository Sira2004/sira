// la fonction pour recuperer les classes crées
function getClasses() {
  $.post({
    url: "get_classe.php",
    data: {},
    success: function (reponse) {
      $("#listeClasses").html(reponse);
    },
    error: function (error) {
      console.log(error.status);
    },
  });
}

// la fonction pour  afficher les données à modifier
function afficherAction(action, classe_id) {
  $.post({
    url: "action_classe.php",
    data: {
      action: action,
      classe_id: classe_id,
    },
    success: function (reponse) {
      $("#validation").css("display", "none");
      $("#formulaire").css("display", "none");
      $("#actionResult").css("display", "block");
      $("#actionResult").html(reponse);
      $(".close").click(function () {
        $("#modal").hide(1000);
        $("#actionResult").css("display", "none");
        $("#formulaire").css("display", "block");
        $("#validation").css("display", "block");
      });
    },
    error: function (error) {
      console.log(error.status);
    },
  });
}

// la fonction pour la mis à jour
function doUpdate(classe_id) {
  $.post({
    url: "post_update_classe.php",
    data: {
      classe_id: classe_id,
      classe: $("#classe").val(),
      nombreEleve: $("#nombreEleve").val(),
    },
    success: function (reponse) {
      $("#modal").hide(1000);
      $("#actionResult").css("display", "none");
      $("#formulaire").css("display", "block");
      $("#validation").css("display", "block");
      getClasses();
    },
    error: function (error) {
      console.log(error.status);
    },
  });
}

// la fonction pour la suppression
function doDelete(classe_id) {
  $.post({
    url: "post_delete_classe.php",
    data: {
      classe_id: classe_id,
    },
    success: function (reponse) {
      console.log(reponse);
      $("#actionResult").css("display", "none");
      $("#formulaire").css("display", "block");
      $("#validation").css("display", "block");
      getClasses();
    },
    error: function (error) {
      console.log(error.status);
    },
  });
}
