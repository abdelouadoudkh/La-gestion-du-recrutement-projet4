function print_values() {

  document.getElementById("inom").value = document.getElementById("nom").value;
  document.getElementById("iprenom").value = document.getElementById("prenom").value;
  document.getElementById("igenre").value = document.getElementById("genre").value;
  document.getElementById("idate").value = document.getElementById("dte").value;
  document.getElementById("iadresse").value = document.getElementById("adresse").value;
  document.getElementById("iville").value = document.getElementById("ville").value;
  document.getElementById("icodep").value = document.getElementById("codep").value;
  document.getElementById("itel1").value = document.getElementById("tel1").value;
  document.getElementById("itel2").value = document.getElementById("tel2").value;
  document.getElementById("imail1").value = document.getElementById("mail1").value;
}

function move_step(step) {

  hide_all("step");
  document.querySelector(step).classList.add('active');
  hide_all("nav-div");
  var step_active = step.split("-");
  step_active = parseInt(step_active[1]);
  console.log(step_active);
  for (var i = 1; i <= step_active; i++) {
    console.log(document.querySelector(".step-0" + i + "-nav"));
    document.querySelector(".step-0" + i + "-nav").classList.add("active");

  }
}

function hide_all(class_name) {
  var count = document.getElementsByClassName(class_name).length;
  for (var i = 0; i < count; i++) {
    document.getElementsByClassName(class_name)[i].classList.remove('active');

  }
}






$(function() {
  var overlay = $('<div id="overlay"></div>');
  overlay.show();
  overlay.appendTo(document.body);
  $('.popup').show();
  $('.close').click(function() {

    if ($('.check').prop("checked") == true) {
      $('.popup').hide();
      overlay.appendTo(document.body).remove();
    } else if ($(this).prop("checked") == false) {
      console.log("Checkbox is unchecked.");
    }

    return false;
  });
});



$(document).ready(function() {
  $('#agree').attr('disabled', 'disabled');

  $('#terms').scroll(function() {
    var text_h = $(this)[0].scrollHeight;
    var scroll_h = text_h - $(this).innerHeight();
    var scroll_top = $(this).scrollTop();

    if (scroll_top == scroll_h) {
      $('#agree').removeAttr('disabled');
    }
  });
});



$(function() {
  $('#picture').on('click', function() {
    $('#inpFile').trigger('click');
  });
});
