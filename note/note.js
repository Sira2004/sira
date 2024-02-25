function getTrimestres() {
  $.post({
    url: "get_trimestre.php",
    data: {
      classe_id: $("#classe").val(),
    },
    success: function (reponse) {
      $("#trimestre").html(reponse);
      getCours();
    },
    error: function (error) {
      console.log(error.status);
    },
  });
}
function getCours() {
  $.post({
    url: "get_cour.php",
    data: {
      classe_id: $("#classe").val(),
    },
    success: function (reponse) {
      $("#cour").html(reponse);
      getEleves();
    },
    error: function (error) {
      console.log(error.status);
    },
  });
}
function get() {
  getTrimestres();
  getCours();
  getEleves();
}

function getEleves() {
  $.post({
    url: "get_eleve.php",
    data: {
      classe_id: $("#classe").val(),
      trimestre_id: $("#trimestre").val(),
      cour_id: $("#cour").val(),
      nom: $("#nom").val(),
    },
    success: function (reponse) {
      $("#listeEleves").html(reponse);
      formatNote();
    },
    error: function (error) {
      console.log(error.status);
    },
  });
}

function charger() {
  getTrimestres();

  getEleves();
}
function load() {
  getTrimestres();
}
function saveNotes() {
  let newNotes = [];
  $("#notes tbody tr").each(function () {
    console.log("bonjour");
    if ($(this).find(".accept").is(":checked")) {
      let note_id = $(this).find(".accept").val();
      let devoir = $(this).find(".devoir").val();
      let examen = $(this).find(".examen").val();

      newNotes.push({
        note_id: note_id,
        devoir: devoir,
        examen: examen,
      });

      // l'envois des notes à modifier
      $.post({
        url: "save_note.php",
        data: {
          notes: newNotes,
        },
        success: function (reponse) {
          getEleves();
          console.log(reponse);
        },
        error: function (error) {
          console.log(error.status());
        },
      });
    }
  });
}

function formatNote() {
  $(".devoir ,.examen").mask("00.00");
  $(".devoir").on("input", function () {
    var min = 0;
    var max = 20;
    var note = parseFloat($(this).val());
    if (note < min) {
      $(this).val(min.toFixed(2));
    } else if (note > max) {
      $(this).val(max.toFixed(2));
    }
  });
  $(".examen").on("input", function () {
    var min = 0;
    var max = 40;
    var note = parseFloat($(this).val());
    if (note < min) {
      $(this).val(min.toFixed(2));
    } else if (note > max) {
      $(this).val(max.toFixed(2));
    }
  });
}
