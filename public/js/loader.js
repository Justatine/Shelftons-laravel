$(document).ready(function() {
    if (document.readyState !== "complete") {
      $("#loader").css("display", "block");
      $("body").css("visibility", "hidden");
    } else {
      setTimeout(function() {
      $("#loader").hide();
      $("body").css("visibility", "visible");
      }, 3000);
    }
  });


  $(document).ready(function() {
  var logincard = $('.logincard');
  logincard.delay(5000).fadeOut(2000);
});