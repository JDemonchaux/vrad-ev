$(document).ready(function () {

    $('#datetimepicker1').datetimepicker({
        locale: 'fr',
        format: 'LT'
    });
    $('#datetimepicker2').datetimepicker({
        locale: 'fr',
        format: 'LT'
    });

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

    switch (type) {
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
    $(document).on('change', '.btn-file :file', function () {
        var input = $(this), numFiles = input.get(0).files ? input.get(0).files.length : 1, label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });
    $('.btn-file :file').on('fileselect', function (event, numFiles, label) {
        $("#inputFileRO").attr("placeholder", label);
        console.log(label);
    });


    /**
     * GANTT
     */
    $("#ressources").on('change', function () {
        var value = $(this).val();
        console.log(value);
        if (value == "") {
            $("tbody>tr").each(function () {
                $(this).show();
            });
        } else {
            $("tbody>tr").each(function () {
                if ($(this).hasClass(value)) {
                    $(this).show();
                }
                else {
                    $(this).hide();
                }
            });
        }
    });

    colorGantt();


});

function modalConfirmDelete(el) {
    var lien = $(el).data("href");
    $("#btDelete").attr("href", lien);
}

function modalModifTache(el) {

    var href = $(el).data("href");
    var ressource = $(el).data("ressource");
    var item = $(el).data("item");
    var nom = $(el).data("nom");
    var heure_debut = moment($(el).data("heure_debut"), "hh:mm");
    var heure_fin = moment($(el).data("heure_fin"), "hh:mm");
    var d = new Date();

    $('#datetimepicker3').remove();
    $('.datetimepicker3').append(createDateTimePicker("datetimepicker3", "heure_debut", "heure_debut"))
    $('#datetimepicker3').datetimepicker({
        locale: 'fr',
        format: 'LT',
        defaultDate: heure_debut
    });

    $('#datetimepicker4').remove();
    $('.datetimepicker4').append(createDateTimePicker("datetimepicker4", "heure_fin", "heure_fin"))
    $('#datetimepicker4').datetimepicker({
        locale: 'fr',
        format: 'LT',
        defaultDate: heure_fin
    });

    console.log(d.getHours())
    if (d.getHours() >= 22) {
        $("#datetimepicker3").find("input").attr("disabled", true);
        $("#datetimepicker4").find("input").attr("disabled", true);
    }

    $("#formModifTask").attr("action", href);
    $('#nomTache').html(nom);


    $('#ressource_modifier option[value=' + ressource + ']').prop('selected', true);
    $('#itm_modifier option[value=' + item + ']').prop('selected', true);


}

function clearModal() {
    console.log("clear");
    $("#formModifTask").attr("action", "");
    $('#nomTache').html("");
    $("#datetimepicker3").data("DateTimePicker").destroy();
    $("#datetimepicker4").data("DateTimePicker").destroy();
}

function createDateTimePicker(nom, id, name) {
    var el = '<div class="input-group date col-sm-4" id="' + nom + '">' +
        '<input type="text" class="form-control" name="' + name + '" id="' + id + '"/>' +
        '<span class="input-group-addon">' +
        '<span class="glyphicon glyphicon-calendar"></span>' +
        '        </span>' +
        '        </div>';

    return el;
}


function colorGantt() {
    $(".gantt>tbody>tr").each(function () {
        var dd = $(this).find('td.dd').html();
        var df = $(this).find('td.df').html();

        var tmp = dd.split(":");
        var hd = tmp[0];
        var md = tmp[1];
        var tmp2 = df.split(":");
        var hf = tmp2[0];
        var mf = tmp2[1];


        $(this).children("td").each(function () {
                if (hd == hf) {
                    if ($(this).data("heure") == hd) {
                        if ($(this).data("minute") < mf) {
                            $(this).addClass("colored");
                        }
                    }
                }
                //else if (parseInt(hd) + 1 == hf) {
                //    console.log($(this).data("heure") + ":" + $(this).data("minute"));
                //    if ($(this).data("minute") >= 0 && $(this).data("minute") <= 15) {
                //        $(this).addClass("colored");
                //    }
                //    if ($(this).data("minute") > 15 && $(this).data("minute") <= 30) {
                //        $(this).addClass("colored");
                //    }
                //    if ($(this).data("minute") > 30 && $(this).data("minute") <= 45) {
                //        $(this).addClass("colored");
                //    }
                //    if ($(this).data("minute") > 45 && $(this).data("minute") <= 60) {
                //        $(this).addClass("colored");
                //    }
                //}
                else if (hd < hf) {
                    if ($(this).data("heure") >= hd && $(this).data("heure") <= hf) {
                        if ($(this).data("heure") < hf && $(this).data("minute") >= md) {
                            $(this).addClass("colored");
                        } else if ($(this).data("heure") == hf) {
                            if ($(this).data("minute") < mf) {
                                $(this).addClass("colored");
                            }
                        }
                    }
                }
                else if (hd > hf) {
                    if ($(this).data("heure") == hd) {
                        if ($(this).data("minute") >= md) {
                            $(this).addClass("colored");
                        }
                    }
                    else if ($(this).data("heure") == hf) {
                        if ($(this).data("minute") < mf) {
                            $(this).addClass("colored");
                        }
                    }
                    else if ($(this).data("heure") <= hf) {
                        $(this).addClass("colored");
                    }
                    else if ($(this).data("heure") == parseInt(hd) + 1 || $(this).data("heure") == parseInt(hd) + 2 || $(this).data("heure") == parseInt(hd) + 3) {
                        $(this).addClass("colored");
                    }
                }
            }
        )
        ;
    });
}