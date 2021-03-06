/**
 * devportf Custom JS
 *
 * @package devportf
 *
 * Distributed under the MIT license - http://opensource.org/licenses/MIT
 */

function devportf_add_cat_URL(element){
    var data = jQuery(".ht-portfolio-cat-name.active").attr('data-filter');
    var cat = data.match(/\d+$/);
    if (cat) { 
        element.href = element.href.match(/^[^?]*/)[0] + '?dpcat=' + cat;
    } else {
        element.href = element.href.match(/^[^?]*/)[0];
    }
} 

jQuery(function($){

  if($('.ht-sticky-header').length > 0){
    $(window).scroll(function() {
        var lastScrollTop = 0;
        var $masthead = $('#ht-masthead');
        return function(){
          var scrollTop = $(window).scrollTop();   
          
          if(scrollTop > 94 ){
            var class2add = 'ht-sticky';
            if(scrollTop < lastScrollTop) {
                $masthead.removeClass('ht-up');
            } else {
                class2add += ' ht-up';
            }
            $masthead.addClass(class2add);
            
          }else{
            $masthead.removeClass('ht-sticky ht-up');
          }
          lastScrollTop = scrollTop;
        };
    }());
  }

  if($('#ht-bx-slider .ht-slide').length > 0){
    $('#ht-bx-slider').owlCarousel({
        autoplay : true,
        items : 1,
        loop : true,
        nav: true,
        dots : false,
        autoplayTimeout : 7000,
        animateOut: 'fadeOut'
    });
  }

  $('.ht-testimonial-slider').owlCarousel({
      autoplay : true,
      items : 1,
      loop : true,
      nav: true,
      dots : false,
      autoplayTimeout : 7000,
      navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
  });

  $(".ht_client_logo_slider").owlCarousel({
      autoplay : true,
      items : 5,
      loop : true,
      nav: false,
      dots : false,
	  autoplayTimeout : 7000,
      responsive : {
        0 : {
            items : 2,
        },
        768 : {
            items : 3,
        },
        979 : {
            items : 4,
        },
        1200 : {
            items : 5,
        }
      }   
  });
    
  $('.ht-portfolio-image').nivoLightbox();
  
  $('.ht-menu > ul').superfish({
      delay:       500,                            // one second delay on mouseout
      animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation
      speed:       'fast',                          // faster animation speed
  });
    
  $('.ht-service-excerpt h5').click(function(){
      $(this).next('.ht-service-text').slideToggle();
      $(this).parents('.ht-service-post').toggleClass('ht-active');
  });
  
  $('.ht-service-icon').click(function(){
      $(this).next('.ht-service-excerpt').find('.ht-service-text').slideToggle();
      $(this).parent('.ht-service-post').toggleClass('ht-active');
  });

  $('.toggle-bar').click(function(){
      $(this).next('.ht-menu').slideToggle();
  });

  setTimeout(function(){
    $.stellar({
      horizontalScrolling: false, 
      responsive: true,
    });
  }, 3000 );
  
  $('.ht-team-counter-wrap').waypoint(function() {
      setTimeout(function() {
          $('.odometer1').html($('.odometer1').data('count'));
      }, 500);
      setTimeout(function() {
          $('.odometer2').html($('.odometer2').data('count'));
      }, 1000);
      setTimeout(function() {
          $('.odometer3').html($('.odometer3').data('count'));
      }, 1500);
      setTimeout(function() {
          $('.odometer4').html($('.odometer4').data('count'));
      }, 2000);
      }, {
      offset: 800,
      triggerOnce: true
  });

  if($('.ht-sticky-header').length > 0){
    var onpageOffset = 74;
  }else{
    onpageOffset = 0
  }

  $('.ht-sticky-header .ht-menu').onePageNav({
    currentClass: 'current',
    changeHash: false,
    scrollSpeed: 750,
    scrollThreshold: 0.1,
    scrollOffset: onpageOffset
  });

 // *only* if we have anchor on the url
  if(window.location.hash) {
      $('html, body').animate({
          scrollTop: $(window.location.hash).offset().top - onpageOffset
      }, 1000 );        
  }

  $(window).scroll(function(){
      if($(window).scrollTop() > 300){
          $('#ht-back-top').removeClass('ht-hide');
      }else{
          $('#ht-back-top').addClass('ht-hide');
      }
  });

  $('#ht-back-top').click(function(){
      $('html,body').animate({scrollTop:0},800);
  });

  if( $('.ht-portfolio-posts').length > 0 ){

  var first_class = $('.ht-portfolio-cat-name.active').data('filter');
  //$('.ht-portfolio-cat-name:first').addClass('active');

  var $container = $('.ht-portfolio-posts').imagesLoaded( function() {
  
  $container.isotope({
      itemSelector: '.ht-portfolio',
      filter: first_class
  });
        
  var elems = $container.isotope('getFilteredItemElements');

  elems.forEach(function(item, index){
    if ( index == 0 || index == 4 ) {
      $( item ).addClass('wide');
      var bg = $(item).find('.ht-portfolio-image').attr('href');
      $( item ).find('.ht-portfolio-wrap').css('background-image', 'url('+bg+')');
    }else{
      $( item ).removeClass('wide');
    }
  });

  GetMasonary();

  setTimeout(function(){
    $container.isotope({
    itemSelector: '.ht-portfolio',
    filter: first_class,
  });
  },2000);

  $(window).on( 'resize', function () {
     GetMasonary();
  });

}); 
      
//$('.ht-portfolio-posts').on('click', 'devportf_portfolio_itemlink', function(element) {
//    element.href+='&cylnders=12';
//    
////    var str = "example12";
////    parseInt(str.match(/\d+$/)[0], 10);
//    
//})      

$('.ht-portfolio-cat-name-list').on( 'click', '.ht-portfolio-cat-name', function() {
  var filterValue = $(this).attr('data-filter');
  $container.isotope({ filter: filterValue });
       
    var elems = $container.isotope('getFilteredItemElements');
    
    elems.forEach(function(item, index){
      if ( index == 0 || index == 4 ) {
        $( item ).addClass('wide');
        var bg = $(item).find('.ht-portfolio-image').attr('href');
        $( item ).find('.ht-portfolio-wrap').css('background-image', 'url('+bg+')');
      }else{
        $( item ).removeClass('wide');
      }
    }); 

    GetMasonary();      
  
	  var filterValue = $(this).attr('data-filter');
	  $container.isotope({ filter: filterValue });
        
	  $('.ht-portfolio-cat-name').removeClass('active');
	  $(this).addClass('active');
});

function GetMasonary(){        
   var winWidth = window.innerWidth;   
   if (winWidth > 580) {
                   
      $container.find('.ht-portfolio').each(function () { 
          var image_width = $(this).find('img').width();
          if($(this).hasClass('wide')){
            $(this).find('.ht-portfolio-wrap').css( { 
                height : (image_width*2) + 15 + 'px'
            });
          }else{
            $(this).find('.ht-portfolio-wrap').css( { 
                height : image_width + 'px'
            });
          }
      }); 

  }else {
      $container.find('.ht-portfolio').each(function () { 
          var image_width = $(this).find('img').width();
          if($(this).hasClass('wide')){
            $(this).find('.ht-portfolio-wrap').css( { 
                height : (image_width*2) + 8 + 'px'
            });
          }else{
            $(this).find('.ht-portfolio-wrap').css( { 
                height : image_width + 'px'
            });
          }
      }); 
  }    
}

}

});

