(function ($) {
	"use strict";
	
	////////////////////////////////////////////////////
	// 13. Swiper Js
	var it_text_slider = new Swiper(".it-text-slider-active", {
		loop: true,
		freemode: true,
		slidesPerView: 'auto',
		spaceBetween: 0,
		centeredSlides: true,
		allowTouchMove: false,
		speed: 2500,
		autoplay: {
		  delay: 1,
		  disableOnInteraction: true,
		},
	  });
	
	////////////////////////////////////////////////////
	// 13. Swiper Js
	var it_text_slider = new Swiper(".it-brand-active", {
		loop: true,
		freemode: true,
		slidesPerView: 'auto',
		spaceBetween: 85,
		centeredSlides: true,
		allowTouchMove: false,
		speed: 2500,
		autoplay: {
		  delay: 1,
		  disableOnInteraction: true,
		},
	  }); 	  

	////////////////////////////////////////////////////
	//  Swiper Js
	const testimonialswiper = new Swiper('.it-testimonial-active', {
		speed:1500,
		loop: true,
		slidesPerView: 1,
        spaceBetween: 35,
		autoplay: true,
		breakpoints: {
			'1400': {
				slidesPerView: 1,
			},
			'1200': {
				slidesPerView: 1,
			},
			'992': {
				slidesPerView: 1,
			},
			'768': {
				slidesPerView: 1,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		pagination: {
			el: ".it-testimonial-dots",
			clickable:true,
		},	
		navigation: {
			prevEl: '.arrow-prev',
			nextEl: '.arrow-next',
		},		
		
	  });
	////////////////////////////////////////////////////
	//  Swiper Js
	const testimonial3swiper = new Swiper('.it-testimonial-active-3', {
		speed:1500,
		loop: true,
		slidesPerView: 2,
        spaceBetween: 35,
		autoplay: true,
		breakpoints: {
			'1400': {
				slidesPerView: 2,
			},
			'1200': {
				slidesPerView: 2,
			},
			'992': {
				slidesPerView: 2,
			},
			'768': {
				slidesPerView: 1,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		pagination: {
			el: ".it-testimonial-dots",
			clickable:true,
		},	
		navigation: {
			prevEl: '.arrow-prev',
			nextEl: '.arrow-next',
		},		
		
	  });

	////////////////////////////////////////////////////
	//  Swiper Js
	const testimonial2swiper = new Swiper('.it-testimonial-active-2', {
		speed:1500,
		loop: true,
		slidesPerView: 1,
        spaceBetween: 35,
		autoplay: true,
		breakpoints: {
			'1400': {
				slidesPerView: 1,
			},
			'1200': {
				slidesPerView: 1,
			},
			'992': {
				slidesPerView: 1,
			},
			'768': {
				slidesPerView: 1,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		navigation: {
			prevEl: '.arrow-prev',
			nextEl: '.arrow-next',
		},		
		
	  });
	////////////////////////////////////////////////////
	//  Swiper Js
	const postboxswiper = new Swiper('.postbox-thumb-slider-active', {
		speed:1500,
		loop: true,
		slidesPerView: 1,
        spaceBetween: 0,
		autoplay: true,
		breakpoints: {
			'1400': {
				slidesPerView: 1,
			},
			'1200': {
				slidesPerView: 1,
			},
			'992': {
				slidesPerView: 1,
			},
			'768': {
				slidesPerView: 1,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		navigation: {
			prevEl: '.postbox-arrow-prev',
			nextEl: '.postbox-arrow-next',
		},		
		
	  });

	////////////////////////////////////////////////////
	//  Swiper Js
	const teamswiper = new Swiper('.it-team-active', {
		speed:1500,
		loop: true,
		slidesPerView: 3,
        spaceBetween: 35,
		autoplay: true,
		breakpoints: {
			'1200': {
				slidesPerView: 3,
			},
			'992': {
				slidesPerView: 2,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		navigation: {
			prevEl: '.arrow-prev',
			nextEl: '.arrow-next',
		},
		
		
	});

	////////////////////////////////////////////////////
	//  Swiper Js
	const portfolioswiper = new Swiper('.it-portfolio-active', {
		speed:1500,
		loop: true,
		slidesPerView: 4,
        spaceBetween: 35,
		autoplay: true,
		breakpoints: {
			'1400': {
				slidesPerView: 4,
			},
			'1200': {
				slidesPerView: 3,
			},
			'992': {
				slidesPerView: 2,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		navigation: {
			prevEl: '.arrow-prev',
			nextEl: '.arrow-next',
		},
		
		
	});

	////////////////////////////////////////////////////
	//  Swiper Js
	const portfolio2swiper = new Swiper('.it-portfolio-active-2', {
		speed:1500,
		loop: true,
		slidesPerView: 5,
        spaceBetween: 35,
		autoplay: true,
		breakpoints: {
			'1600': {
				slidesPerView: 5,
			},
			'1400': {
				slidesPerView: 4,
			},
			'1200': {
				slidesPerView: 4,
			},
			'992': {
				slidesPerView: 3,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		navigation: {
			prevEl: '.arrow-prev',
			nextEl: '.arrow-next',
		},
		
		
	});
	////////////////////////////////////////////////////
	//  Swiper Js
	const portfolio3swiper = new Swiper('.it-portfolio-active-3', {
		speed:1500,
		loop: true,
		slidesPerView: 3,
        spaceBetween: 35,
		autoplay: true,
		breakpoints: {
			'1400': {
				slidesPerView: 3,
			},
			'1200': {
				slidesPerView: 3,
			},
			'992': {
				slidesPerView: 2,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		navigation: {
			prevEl: '.arrow-prev',
			nextEl: '.arrow-next',
		},
		
		
	});
	////////////////////////////////////////////////////
	//  Swiper Js
	const serviceswiper = new Swiper('.it-service-active', {
		speed:1500,
		loop: true,
		slidesPerView: 4,
        spaceBetween: 35,
		autoplay: true,
		breakpoints: {
			'1400': {
				slidesPerView: 4,
			},
			'1200': {
				slidesPerView: 3,
			},
			'992': {
				slidesPerView: 2,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		navigation: {
			prevEl: '.arrow-prev',
			nextEl: '.arrow-next',
		},
		
		
	});

	////////////////////////////////////////////////////
	//  Swiper Js
	const sliderswiper = new Swiper('.it-slider-active', {
		slidesPerView: 1,
		loop: true,
		autoplay: true,
		effect:'fade',
		autoplay: {
			delay: 4500,
		},
		breakpoints: {
			'1400': {
				slidesPerView: 1,
			},
			'1200': {
				slidesPerView: 1,
			},
			'992': {
				slidesPerView: 1,
			},
			'768': {
				slidesPerView: 1,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		navigation: {
			prevEl: '.arrow-prev',
			nextEl: '.arrow-next',
		},
		
		
	});


})(jQuery);