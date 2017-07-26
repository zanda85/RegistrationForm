/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {
    
    $("*[data-required='true']").change(function () {
        var id = $(this).attr('id');
        if (!$(this).val()) {
            $(this).parents("div.form-group").addClass('has-error');
            $('#' + id + '-error').removeClass('hidden');
        } else {
            $(this).parents("div.form-group").removeClass('has-error');
            $('#' + id + '-error').addClass('hidden');

        }
        $('#continue').prop('disabled', disableSubmit());
    });

    disableSubmit = function () {
        var ok = true;
        $("*[data-required='true']").each(function (index) {
            ok = ok && ($(this).val().trim() != "");
        });

        return  $('.has-error').is(':visible') ||
                !ok;
    };

    $('#continue').prop('disabled', disableSubmit());

    var invoice = $("input[name='invoice']:checked");
    var country = $("#country");
    var birthDate = $("#birthDate");
    
    if(birthDate){
        birthDate.datepicker({
        dateFormat : 'mm/dd/yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
      });
    }

    // for italian people we need the cf, for foreign people the id number

    var checkNation = function (country, invoice) {
        var val = country.val();
        switch (invoice.val()) {
            case 'personal':
                 $("#vat").attr('data-required', false).val('').parent().parent().hide();
                if (val == null || val == '') {
                    // no value selected
                    $("#cf").attr('data-required', false).parent().parent().hide();
                    $("#idNumber").attr('data-required', false).parent().parent().hide();
                } else if (val == "IT") {
                    $("#cf").attr('data-required', true).parent().parent().show();
                    $("#idNumber").attr('data-required', false).val('').parent().parent().hide();
                } else {
                    $("#cf").attr('data-required', false).val('').parent().parent().hide();
                    $("#idNumber").attr('data-required', true).parent().parent().show();
                }
                break;

            case 'organization':
                $("#cf").attr('data-required', false).val('').parent().parent().hide();
                $("#idNumber").attr('data-required', false).val('').parent().parent().hide();
                $("#vat").attr('data-required', true).parent().parent().show();
                break;
        }

    };

    if (invoice && country) {
        checkNation(country, invoice);
        $('#continue').prop('disabled', disableSubmit());
        $("#country").change(function () {
            checkNation($(this), $("input[name='invoice']:checked"));
            $('#continue').prop('disabled', disableSubmit());
        });
        $("input[name='invoice']").change(function(){
            checkNation($("#country"), $(this));
            $('#continue').prop('disabled', disableSubmit());
        });
    }

    

    var spinners = $(".spinner");
    if (spinners.length > 0)
        spinners.spinner().width(50);
    $('#continue').prop('disabled', disableSubmit());
    
});
