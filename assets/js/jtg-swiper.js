
jQuery(document).ready(function($) { 
	var mySwiper = new Swiper ('.swiper-container', {
		// Optional parameters
		direction: 'horizontal',
		loop: true,
		paginationClickable: true,
		nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev',
		pagination: '.swiper-pagination',
		effect: 'fade',
		autoplay: 2800,
		speed: 1500
	});
});