// la fonctoin asynchronne qui permet d'afficher les infomations de l'élève
function ajax(id) {
  $.ajax({
    type: "POST",
    url: "./details_eleve.php",
    data: {
      eleve_id: id,
    },
    success: function (reponse) {
      $("#details").css("display", "block");
      $("#details").html(reponse);

      $(".close").click(function () {
        $("#modal").hide(1000);
        $("#details").css("display", "none");
      });
    },
    error: function () {
      alert("Les informations sont introuvables");
    },
  });
}

// la fonction pour charger la photo
function load() {
  $("#photo").on("change", function () {
    let photo = this;
    let img = $("#portrait");
    let reader = new FileReader();
    reader.onload = function (e) {
      img.attr("src", e.target.result);
    };
    reader.readAsDataURL(photo.files[0]);
  });
}

// la fonction pour afficher les informations à modifer
function modify(id, url) {
  $.post({
    url: url,
    data: {
      eleve_id: id,
    },
    success: function (reponse) {
      $("#details").css("display", "block");
      $("#details").html(reponse);

      $(".close").click(function () {
        $("#modal").hide(1000);
        $("#details").css("display", "none");
      });
    },
  });
}

// la fonction pour modifier les données de l'utilsateur
function ajax3(id) {
  formulaire = new FormData();
  // la recuperation des valeurs des champs à modifier
  formulaire.append("nom", $("#nom").val());
  formulaire.append("prenom", $("#prenom").val());
  formulaire.append("dt_naiss", $("#dt_naiss").val());
  formulaire.append("lieu_naiss", $("#lieu_naiss").val());
  formulaire.append("sexe", $("#sexe").val());
  formulaire.append("classe", $("#classe").val());
  formulaire.append("num", $("#num").val());
  formulaire.append("nomP", $("#nomP").val());
  formulaire.append("prenomP", $("#prenomP").val());
  formulaire.append("numP", $("#numP").val());
  formulaire.append("eleve_id", id);
  // la recuperation de l'image
  let photo = $("#photo")[0].files[0];
  formulaire.append("imagePath", $("#imagePath").val());
  formulaire.append("imageType", $("#imageType").val());
  formulaire.append("photo", photo);
  $.post({
    url: "./post_update.php",
    data: formulaire,
    processData: false,
    contentType: false,
    success: function (reponse) {
      $("#details").css("display", "block");
      $("#details").html("");

      setTimeout(function () {
        $("#change").css("display", "none");
      }, "3000");
    },
  });
}
