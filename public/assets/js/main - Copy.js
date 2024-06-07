
$(document).ready(function () {
	let btn = document.querySelector(".addToCart .mainBtn");
	let counterWrapper = document.querySelector(".addToCart .counterWrapper");
	$('.addToCart .mainBtn').click(function () {
		var $input = $(this).parent().find('input');
		$input.val(1);
		$input.change();
		if (counterWrapper.style.display = "none") {
			counterWrapper.style.display = "block";
			btn.style.display = "none";
		}
		return false;
	});
	$('.minus').click(function () {
		var $input = $(this).parent().find('input');
		var count = parseInt($input.val()) - 1;
		count = count < 0 ? 0 : count;
		$input.val(count);
		$input.change();
		if (count == 0) {
			btn.style.display = "block";
			counterWrapper.style.display = "none"
		}
		return false;
	});
	$('.plus').click(function () {
		var $input = $(this).parent().find('input');
		$input.val(parseInt($input.val()) + 1);
		$input.change();
		return false;
	});
});

var swiper1 = new Swiper(".wymSwiper", {
	spaceBetween: 10,
	slidesPerView: 5,
	speed: 1000,
	loop: false,
  
	// Navigation arrows
	navigation: {
		nextEl: '.wym-next',
		prevEl: '.wyp-prev',
	},
   
});

var swiper2 = new Swiper(".qaSwiper", {
	spaceBetween: 10,
	slidesPerView: 4.5,
	speed: 1000,
	loop: false,
  
	// Navigation arrows
	navigation: {
		nextEl: '.qa-next',
		prevEl: '.qa-prev',
	},
   
});

var swiper3 = new Swiper(".testimonialSwiper", {
	spaceBetween: 0,
	slidesPerView: 2,
	speed: 1000,
	loop: false,
  
	// Navigation arrows
	navigation: {
		nextEl: '.sbn',
		prevEl: '.sbp',
	},
   
});