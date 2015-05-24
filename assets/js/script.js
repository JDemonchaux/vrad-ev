$(document).ready(function () {

  toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-full-width",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "0",
    "extendedTimeOut": "0",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }

  var type = $(".notification").attr("data-type");
  var message = $('.notification').attr('data-message');
  var dismiss = $('.notification').attr("data-dismiss");
  if (dismiss == 1) {
    toastr.options.timeOut = "5000";
    toastr.options.extendedTimeOut = "1000";
  }

  switch(type) {
    case "info":
    toastr.info(message);
    break;
    case "success":
    toastr.success(message);
    break;
    case "warning":
    toastr.warning(message);
    break
    case "error": 
    toastr.error(message);
    break;
  } 

  $(".carousel_sponsor > button").remove();
  $(".carousel_sponsor_vertical > button").remove();

  $("#ajouterGroupe").on('click', function () {
    $("#modalAjouterGroupe").modal();
  })
  $("#ajouterEcole").on("click", function () {
    $(".formEcole").slideDown("slow");
  })
  $("#fermerAjoutEcole").on("click", function () {
    $(".formEcole").slideUp("slow");
  })

  $("#ajouterEcole").on('click', function () {
    $("#modalAjouterEcole").modal();
  })

    /*
    *   VALIDATION DES FORMULAIRES
    */
    $("#formulaireInscriptionParticipant").validator();
    $("#formulaireInscriptionJury").validator();

    $("#sendFormAjoutGroupe").on('click', function (e) {
      e.preventDefault();
      $.ajax({
        url: $("#formAjoutGroupe").attr("action"),
        type: "POST",
        data: $("#formAjoutGroupe").serialize(),
        success: function (html) {
          window.location.href = window.location.href;
        }
      })

    });

    $("#sendFormAjouterEcole").on('click', function (e) {
      e.preventDefault();
      $.ajax({
        url: $("#formAjoutEcole").attr("action"),
        type: "POST",
        data: $("#formAjoutEcole").serialize(),
        success: function (html) {
          $(".selectSchool").html(html);
          $(".formEcole").slideUp("slow");
                //window.location.href = window.location.href;
              }
            })
    });

    $("#sendFormAjouterEcoleJury").on('click', function (e) {
      e.preventDefault();
      $.ajax({
        url: $("#formAjouterEcole").attr("action"),
        type: "POST",
        data: $("#formAjouterEcole").serialize(),
        success: function (html) {
                
                window.location.href = window.location.href;
              }
            })
    });


    function reloadSchool() {
      $.ajax({
        url: "https://vrad-ev.com/User_v1/Inscription/AJAX_reloadSchool",
        success: function (html) {

        }
      })
    }




    /*
    *   BOOTSTRAP INPUT TYPE FILE
    */
    $(document).on('change', '.btn-file :file', function () { var input = $(this), numFiles = input.get(0).files ? input.get(0).files.length : 1, label = input.val().replace(/\\/g, '/').replace(/.*\//, ''); input.trigger('fileselect', [numFiles, label]); });
    $('.btn-file :file').on('fileselect', function (event, numFiles, label) {
      $("#inputFileRO").attr("placeholder", label);
      console.log(label);
    });
  });