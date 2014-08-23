/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(function($){//semblable au window.onload: chargement du
    $('.month').hide(); 
    $('.months a:first').addClass('ast');
    $('.month:first').show();
     var current = 1, currentDate = new Date().getMonth()+1;
     
     if(currentDate != current){
            $('#month'+current).slideUp();
            $('#month'+currentDate).slideDown();
             $('.months a').removeClass('ast');
            $('.months a#linkMonth'+currentDate).addClass('ast'); 
            current = currentDate;
        }
            
     $('.months a').click(function(){ // MISE EN PLACE DES EVENEMENTS SUR CLICK
         var month = $(this).attr('id').replace('linkMonth','');
         if(month != current){
            $('#month'+current).slideUp();
            $('#month'+month).slideDown();
             $('.months a').removeClass('ast');
            $('.months a#linkMonth'+month).addClass('ast'); 
            current = month;
         }
         return false;
     });
}
);
