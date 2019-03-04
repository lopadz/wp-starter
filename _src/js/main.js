// @codekit-prepend quiet "vendor/jquery.matchHeight.js";
// @codekit-prepend quiet "../node_modules/headroom.js/dist/headroom.min.js";
// @codekit-prepend quiet "../node_modules/aos/dist/aos.js";


var header = document.querySelector("#sticky");

if(window.location.hash) {
header.classList.add("headroom--unpinned");
}

var headroom = new Headroom(header, {
	"offset": 25,
	tolerance : {
		up : 1000,
		down : 0
	}
});
headroom.init();


AOS.init({
	easing: 'ease-out-back',
	duration: 1000
});


jQuery(document).ready( function($) {

	// Page Fade-in
	$('.fade-in').addClass('visible');
	
	// Init Owl Carousel
	$('.owl-carousel').owlCarousel();


	var mq = window.matchMedia('(max-width: 767px)')
	mediaqueryresponse(mq) // call listener function explicitly at run time
	mq.addListener(mediaqueryresponse) // attach listener function to listen in on state changes

	function mediaqueryresponse() {
		if (mq.matches) {

			$('#main-menu').removeClass('show');

			$('.menu-button').on('click', function() {
				$(this).toggleClass('active');
				$('#main-menu').toggleClass('active').slideToggle();
			});

			// Resets on Media Query Change
			$('#main-menu > .menu-item-has-children').removeClass('active');
			$('#main-menu > .menu-item-has-children .sub-menu').removeAttr('style');

		} else {

			// Resets on Media Query Change
			$('.menu-button').unbind('click').removeClass('active');
			$('#main-menu').removeAttr('style').removeClass('active').addClass('show');
			$('#main-menu > .menu-item-has-children').removeClass('active');
			$('#main-menu > .menu-item-has-children .sub-menu').removeAttr('style');
		}
	}

	$('#main-menu > .menu-item-has-children').on('click', function() {
		$(this).toggleClass('active');
		var $el = $('.sub-menu',this);	
		$('#main-menu > .menu-item-has-children > .sub-menu').not($el).slideUp();
		$el.stop(true, true).slideToggle();
		return false;
	});
	$('#main-menu > .menu-item-has-children > .sub-menu > li').on('click',  function(e) {
		e.stopPropagation();
	});

	if ($('#back-to-top').length) {
		var scrollTrigger = 200, // px
			backToTop = function () {
				var scrollTop = $(window).scrollTop();
				if (scrollTop > scrollTrigger) {
					$('#back-to-top').addClass('show');
				} else {
					$('#back-to-top').removeClass('show');
				}
			};
		backToTop();
		$(window).on('scroll', function () {
			backToTop();
		});
		$('#back-to-top').on('click', function (e) {
			e.preventDefault();
			$('html,body').animate({
				scrollTop: 0
			}, 700);
		});
	}

});