function getTotals() {
  $.post({
    url: "get_total.php",
    data: {
      classe_id: $("#classe").val(),
    },
    success: function (reponse) {
      console.log(reponse);
      let totals = JSON.parse(reponse);
      $("#totalMatiere").val(totals.totalMatiere);
      $("#totalCoeficient").val(totals.totalCoeficient);
    },
    error: function (error) {
      console.log(error.status);
    },
  });
}
