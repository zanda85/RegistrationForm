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
   
   $(".spinner").spinner().width(50);
});
