$(document).ready(function(){
$('.has-multiple').hover(function(){
	$(this).addClass('comn-hover');
	$(this).find('.next').addClass('zoom');
}, function(){
	$(this).find('.next').removeClass('zoom');
	$(this).removeClass('comn-hover');
});
$('aside .job-types').removeClass('col-md-6 col-12 col-lg-4').addClass('col-md-12');
$('.platinum').slick({
  dots: true,
  slidesPerRow: 2,
  rows: 2,
  autoplay: true,
  autoplaySpeed: 5000,
  dots: false,
    prevArrow: false,
    nextArrow: false,
  responsive: [
  {
    breakpoint: 1024,
    settings: {
      slidesPerRow: 2,
      rows: 2,
    }
  }
]
});
$('.autoplay').slick({
	slidesToShow: 10,
  infinite: true,
	slidesToScroll: 1,
	autoplay: true,
	autoplaySpeed: 5000,
	responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
	});

  $('.carousel-inner .carousel-item:first-child').removeClass('carousel-item-next').addClass('active');
  $("#accordion button:first").trigger("click");
if($(".vticker").length > 0) {
  var dd = $('.vticker').easyTicker({
    direction: 'up',
    easing: 'easeInOutBack',
    speed: 'slow',
    interval: 4000,
    height: 'auto',
    visible: 2,
    mousePause: 1,
    controls: {
      up: '.up',
      down: '.down',
      toggle: '.toggle',
      stopText: 'Stop !!!'
    }
  }).data('easyTicker');
}

  $('.noticeplay').slick({
  dots: true,
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 5000,
  dots: false,
  responsive: [
  {
    breakpoint: 1024,
    settings: {
    slidesToShow: 2,
  slidesToScroll: 1,
    }
  },
  
  {
    breakpoint: 480,
    settings: {
    slidesToShow: 1,
  slidesToScroll: 1,
    }
  }
  
]
  
});
});

