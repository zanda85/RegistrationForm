/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function() {
   
   disableSubmit = function(){
       var ok = true;
       $("*[data-required='true']").each(function(index){
           ok = ok && ($(this).val().trim() != "");
       });
       
       return  $('.has-error').is(':visible') || 
               ! ok;
   };
   
   $('#continue').prop('disabled', disableSubmit());
   
   var country = $("#country");
   
   // for italian people we need the cf, for foreign people the id number
   
   var checkNation = function(country){
       var val = country.val();
        if(val == null || val == ''){
            // no value selected
            $("#cf").attr('data-required', false).parent().parent().hide();
            $("#idNumber").attr('data-required', false).parent().parent().hide();
        }else if(val == "IT"){
            $("#cf").attr('data-required', true).parent().parent().show();
            $("#idNumber").attr('data-required', false).val('').parent().parent().hide();
        }else{
            $("#cf").attr('data-required', false).val('').parent().parent().hide();
            $("#idNumber").attr('data-required', true).parent().parent().show();
        }
   };
   
   if(country){
        checkNation(country);
        $("#country").change(function(){
            checkNation($(this));
        });
    }
   
   $("*[data-required='true']").change(function(){
       var id = $(this).attr('id');
       if(!$(this).val()){
           $(this).parents("div.form-group").addClass('has-error');
           $('#' + id + '-error').removeClass('hidden');
       }else{
           $(this).parents("div.form-group").removeClass('has-error');
           $('#' + id + '-error').addClass('hidden');
            
       }
       $('#continue').prop('disabled', disableSubmit());
   });
   
   var spinners = $(".spinner");
   if(spinners)
        spinners.spinner().width(50);
});
