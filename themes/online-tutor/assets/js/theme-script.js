function online_tutor_openNav() {
  jQuery(".sidenav").addClass('show');
}
function online_tutor_closeNav() {
  jQuery(".sidenav").removeClass('show');
}

( function( window, document ) {
  function online_tutor_keepFocusInMenu() {
    document.addEventListener( 'keydown', function( e ) {
      const online_tutor_nav = document.querySelector( '.sidenav' );

      if ( ! online_tutor_nav || ! online_tutor_nav.classList.contains( 'show' ) ) {
        return;
      }

      const elements = [...online_tutor_nav.querySelectorAll( 'input, a, button' )],
        online_tutor_lastEl = elements[ elements.length - 1 ],
        online_tutor_firstEl = elements[0],
        online_tutor_activeEl = document.activeElement,
        tabKey = e.keyCode === 9,
        shiftKey = e.shiftKey;

      if ( ! shiftKey && tabKey && online_tutor_lastEl === online_tutor_activeEl ) {
        e.preventDefault();
        online_tutor_firstEl.focus();
      }

      if ( shiftKey && tabKey && online_tutor_firstEl === online_tutor_activeEl ) {
        e.preventDefault();
        online_tutor_lastEl.focus();
      }
    } );
  }
  online_tutor_keepFocusInMenu();
} )( window, document );

var btn = jQuery('#button');

jQuery(window).scroll(function() {
  if (jQuery(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

jQuery(document).ready(function() {
window.addEventListener('load', (event) => {
    jQuery(".loading").delay(2000).fadeOut("slow");
  });
})

btn.on('click', function(e) {
  e.preventDefault();
  jQuery('html, body').animate({scrollTop:0}, '300');
});

jQuery(document).ready(function() {
  var owl = jQuery('#top-slider .owl-carousel');
    owl.owlCarousel({
      margin: 0,
      nav: false,
      autoplay:true,
      autoplayTimeout:3000,
      autoplayHoverPause:true,
      loop: true,
      dots:false,
      navText : ['<i class="fa fa-lg fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-lg fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 1
        },
        1024: {
          items: 1
      }
    }
  })
})

jQuery(window).scroll(function() {
  var data_sticky = jQuery('.navigation_header').attr('data-sticky');

  if (data_sticky == "true") {
    if (jQuery(this).scrollTop() > 1){  
      jQuery('.navigation_header').addClass("stick_header");
    } else {
      jQuery('.navigation_header').removeClass("stick_header");
    }
  }
});