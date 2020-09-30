//Wow
new WOW().init();

// header scrolled

 // Header scroll class
 $(window).scroll(function() {
  if ($(this).scrollTop() > 100) {
    $('header').addClass('header-scrolled');
  } else {
    $('header').removeClass('header-scrolled');
  }
});

if ($(window).scrollTop() > 100) {
  $('header').addClass('header-scrolled');
}
// Sticky Header
$(function(){
  $(window).scroll(function(){
    var winTop = $(window).scrollTop();
    if(winTop >= 80){
      $("header").addClass("sticky");
    }else{
      $("header").removeClass("sticky");
    }//if-else
  });//win func.
});//ready func.

// Featured Carousel
$('#team-carousel').owlCarousel({
  rtl:true,
  autoplay: true,
  autoplayTimeout:5000,
  loop:true,
  margin:30,
  nav:true,
  
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 2
      },
      1000: {
        items:3
      }
  }
});    

//Opacity 0
// $("#single-nav").hide();

$(window).scroll(function() {

    if ($(this).scrollTop()>180)
     {
        $('#single-nav').fadeIn();
     }
    else
     {
      $('#single-nav').fadeOut();
     }
 });

//Show Hide
var toggle = function() {

	var showDiv = jQuery('#show').show();

	jQuery('#samp').hide();

	// var mydiv = document.getElementById('show');

	// if (mydiv.style.display === 'block' || mydiv.style.display === ''){
	//   mydiv.style.display = 'none';

	// console.log('Here');

	//  }else{
	//   mydiv.style.display = 'block'
	// }
	};

  // $('#myModal').on('shown.bs.modal', function () {
  //   $('#myInput').trigger('focus')
  // })

  // date picker
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
// collapse
$(".open-button").on("click", function() {
  $(this).closest('.collapse-group').find('.collapse').collapse('show');
});

$(".close-button").on("click", function() {
  $(this).closest('.collapse-group').find('.collapse').collapse('hide');
});



// Tooltip
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


// scroll
offsetHeight = 150;

$('body').scrollspy({ 
  target: '#single-nav',
  offset: offsetHeight
});

// Add smooth scrolling on all links inside the navbar
$("#single-nav a").on('click', function(event) {
// Make sure this.hash has a value before overriding default behavior
  if (this.hash !== "") {
  // Prevent default anchor click behavior
    event.preventDefault();
    // Store hash
    var hash = this.hash;
    // Using jQuery's animate() method to add smooth page scroll
    // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
    $('html, body').animate({
        scrollTop: $(hash).offset().top-110
    }, 800, function(){
   
      // Add hash (#) to URL when done scrolling (default click behavior)
      // window.location.hash = hash;
    });
  }  // End if
});


//navbar
$(".btn-group, .dropdown").hover(
    function () {
        $('>.dropdown-menu', this).stop(true, true).fadeIn("fast");
        $(this).addClass('open');
    },
    function () {
        $('>.dropdown-menu', this).stop(true, true).fadeOut("fast");
        $(this).removeClass('open');
    });


    // Magnific popup

    $(document).ready(function() {
      $('.popup-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
          enabled: true,
          navigateByImgClick: true,
          preload: [0,1] // Will preload 0 - before current, and 1 after the current image
        },
        image: {
          tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
          titleSrc: function(item) {
            return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
          }
        }
      });
    });
//Back to top
jQuery(document).ready(function ($) {
$(document).ready(function(){
     $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
     });
        jQuery(document).ready(function ($) {
        $('#back-to-top').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
});
});


