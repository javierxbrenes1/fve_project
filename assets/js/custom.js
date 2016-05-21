jQuery(function () {
        $(".Back").hide();
        
        $(window).scroll(function () {
            MostrarMenu();
        });
        
        document.oncontextmenu = function() {return false;} 
        
        $('.navbar-nav').on('click', function(){ 
        if($('.navbar-header .navbar-toggle').css('display') !='none'){
            $(".navbar-header .navbar-toggle").trigger( "click" );
        }
        });
       
	"use strict";
        $("#main-header-slider").find(".banner-slider").owlCarousel({        
            slideSpeed : 200,
            paginationSpeed : 800,
            rewindSpeed: 1000,
            pagination: true,
            singleItem:true,
			navigation : false,
			navigationText: [
			"<img src='assets/images/left-arrow.png' />",
			"<img src='assets/images/right-arrow.png' />"
			],
            transitionStyle : "fade",
			autoPlay: true,
        });
			
		            
	$(document).ready(function(){
		/* =================================
		   COUNTER                     
		=================================== */       
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
		
                
		$('.mobile-menu').meanmenu();
                
                
	
		$(".different_shipping_true").hide();
		$("#cc_different_shipping").on('click', function() {
			if($(this).is(":checked")) {
				$(".different_shipping_true").slideToggle();
			} else {
				$(".different_shipping_true").slideToggle();
			}
		});	
			
		
	});		    

    $('.share-post-container').on('click', function() {
        var next =  $(this).children('.social-links');
        var state = next.css('opacity');

        if( state == '0' ) {
            next.css({
                display: 'block'
            });
            next.animate({
                    opacity: '1',
                }, 300 );
        } else if ( state == '1' ) {
            next.animate({
                    opacity: '0',
            }, 300, function() {
                next.css({
                    display: 'none' });
                });
        }
    });
	$(function () {
		$('.payment_method_cheque_info').hide();
		$('.payment_method_cod_info').hide();
		$('.payment_method_paypal_info').hide();

		$("input[name=user-type]:radio").on('click', function () {

			if ($('input[name=user-type]:checked').val() == "Bank") {
				$('.payment_method_bacs_info').show();
				$('.payment_method_cheque_info').hide('fade');
				$('.payment_method_cod_info').hide('fade');
				$('.payment_method_paypal_info').hide('fade');

			} else if ($('input[name=user-type]:checked').val() == "Cheque") {
				
				$('.payment_method_bacs_info').hide('fade');
				$('.payment_method_cheque_info').show('fade');
				$('.payment_method_cod_info').hide('fade');
				$('.payment_method_paypal_info').hide('fade');
				
			} else if ($('input[name=user-type]:checked').val() == "COD") {
				
				$('.payment_method_bacs_info').hide('fade');
				$('.payment_method_cheque_info').hide('fade');
				$('.payment_method_cod_info').show('fade');
				$('.payment_method_paypal_info').hide('fade');
			
			}	else if ($('input[name=user-type]:checked').val() == "PayPal") {
				
				$('.payment_method_bacs_info').hide('fade');
				$('.payment_method_cheque_info').hide('fade');
				$('.payment_method_cod_info').hide('fade');
				$('.payment_method_paypal_info').show('fade');
			
			}
		});

	});
			
}());

$(window).on('beforeunload', function(){
  $(window).scrollTop(0);
});

function MostrarMenu()
{
    // Obtiene el alto del scroll
    var vlnScroll = $(this).scrollTop();
    // Si el scroll es mayor a 100
    if (vlnScroll > 100)
    // Muestra barra de menú
        $(".Back").fadeIn();
    else
    // Oculta la barra de menú
        $(".Back").fadeOut();
}