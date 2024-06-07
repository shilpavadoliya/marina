$(".dropdown-menu").click(function(event){
	event.stopPropagation();
});
 
var swiper1 = new Swiper(".wymSwiper", {
	spaceBetween: 70,
	slidesPerView: 1,
	speed: 1000,
	loop: false,
	breakpoints: {
		640: {
		slidesPerView: 2,
		},
		768: {
		slidesPerView: 3,
		},
		1024: {
		slidesPerView: 5,
		},
	},
	// Navigation arrows
	navigation: {
		nextEl: '.wym-next',
		prevEl: '.wyp-prev',
	},
   
});

var swiper2 = new Swiper(".qaSwiper", {
	spaceBetween: 10,
	slidesPerView: 1.3,
	speed: 1000,
	loop: false,
	breakpoints: {
		640: {
		slidesPerView: 2.5,
		},
		768: {
		slidesPerView: 3.5,
		},
		1024: {
		slidesPerView: 4.5,
		},
	},
  
	// Navigation arrows
	navigation: {
		nextEl: '.qa-next',
		prevEl: '.qa-prev',
	},
   
});

var swiper3 = new Swiper(".testimonialSwiper", {
	spaceBetween: 0,
	slidesPerView: 1,
	speed: 1000,
	loop: false,
	breakpoints: {
		640: {
		slidesPerView: 1,
		},
		768: {
		slidesPerView: 1,
		},
		1024: {
		slidesPerView: 2,
		},
	},
  
	// Navigation arrows
	navigation: {
		nextEl: '.sbn',
		prevEl: '.sbp',
	},
   
});

var swiper4 = new Swiper(".advSwiper", {
	spaceBetween: 0,
	slidesPerView: 1,
	speed: 1000,
	loop: true,
	autoplay: {
	  delay: 2500,
	  disableOnInteraction: false,
	},

});

var swiper5 = new Swiper(".productPageThumbSwiper", {
	spaceBetween: 10,
	slidesPerView: 4,
	navigation: {
		nextEl: ".swiper-button-next",
		prevEl: ".swiper-button-prev",
	},

});
var swiper6 = new Swiper(".productPageSwiper", {
	spaceBetween: 10,
	thumbs: {
		swiper: swiper5,
	},
});

$(".toggle-password").click(function(e) {

	$(this).toggleClass("fa-eye fa-eye-slash");
	var input = $($(this).attr("toggle"));
	if (input.attr("type") == "password") {
	  input.attr("type", "text");
	} else {
	  input.attr("type", "password");
	}
});

$(".toggle-password2").click(function(e) {

	$(this).toggleClass("fa-eye fa-eye-slash");
	var input = $($(this).attr("toggle"));
	if (input.attr("type") == "password") {
	  input.attr("type", "text");
	} else {
	  input.attr("type", "password");
	}
});
$(".toggle-password3").click(function(e) {

	$(this).toggleClass("fa-eye fa-eye-slash");
	var input = $($(this).attr("toggle"));
	if (input.attr("type") == "password") {
	  input.attr("type", "text");
	} else {
	  input.attr("type", "password");
	}
});
$(".toggle-password4").click(function(e) {

	$(this).toggleClass("fa-eye fa-eye-slash");
	var input = $($(this).attr("toggle"));
	if (input.attr("type") == "password") {
	  input.attr("type", "text");
	} else {
	  input.attr("type", "password");
	}
});
