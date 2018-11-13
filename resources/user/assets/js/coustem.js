$(document).ready(function() {
	
	"use strict";
	/* form validate */
	$.validate({
		'scrollToTopOnError' : false
	});
	// select box 
	if ($(".order-select").length == 1) {
		$(".order-select").selectbox();
	}
	if ($(".area-select").length == 1) {
		$(".area-select").selectbox();
	}
	if ($(".degree-select").length == 1) {
		$(".degree-select").selectbox();
	}
	if ($(".specialization-select").length == 1) {
		$(".specialization-select").selectbox();
	}
	// home page loader
	setTimeout(function(){
		$('body').addClass('loaded');
	}, 3000);
	
	// preparation slider call
	if ($(".preparation-view").length == 1) {
		var owl1 = $('.preparation-view');
		  owl1.owlCarousel({
			margin: 30,
			loop: true,
			items : 2,
			dots: true,
			nav: false,
			responsive: {
			  0: {
				items: 1,
				margin: 0,
			  },
			  768: {
				items: 2
			  }
			}
		});
	}
	
	// banner img in backgound 
	if ($(".banner.inner-page").length == 1)
	{
		var img_src = $(".banner.inner-page .banner-img").children("img").attr("src");
		$(".banner.inner-page .banner-img").css("background-image", 'url(' + img_src + ')');
		$(".banner.inner-page .banner-img").children("img").hide();
	}
	
	// feedback slider call
	if ($(".feedback-slider").length == 1) {
		var owl1 = $('.feedback-slider');
		  owl1.owlCarousel({
			margin: 0,
			loop: true,
			items : 1,
			dots: false,
			nav: true,
			navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
		});
	}
	
	// member slider Call
	if ($(".member-slider").length == 1) {
		var owl1 = $('.member-slider');
		  owl1.owlCarousel({
			margin: 0,
			loop: true,
			items : 3,
			dots: true,
			nav: false,
			responsive: {
			  0: {
				items: 1,
			  },
			  768: {
				items: 2
			  },
			  1200: {
				items: 3
			  }
			}
		});
	}
	
	// radio and check box js call
	$('.label_check, .label_radio').click(function(){
		setupLabel();
	});
	setupLabel(); 
	
	/* faq accordion */
	$(".faq-page .faq-slide").each(function() {
        $(this).children(".title").on('click',function(){
			if($(this).next(".faq-content").is(":visible"))
			{
				$(this).next(".faq-content").slideUp();
				$(this).removeClass("active");
				$(this).children(".fa").removeClass("fa-angle-down").addClass("fa-angle-right");
			}
			else
			{
				$(".faq-page .faq-slide .title").removeClass("active");
				$(".faq-page .faq-slide .title .fa").removeClass("fa-angle-down").addClass("fa-angle-right");
				$(".faq-page .faq-slide .faq-content").slideUp();
				$(this).addClass("active");
				$(this).children(".fa").removeClass("fa-angle-right").addClass("fa-angle-down");
				$(this).next(".faq-content").slideDown();
				
			}
		});
    });
	
	// check Out address change
	$(".step2 .check-slide .label_check").on('click',function(){
		if($(this).hasClass("c_on"))
		{
			$(".step2 .billing-add").show();
		}
		else
		{
			$(".step2 .billing-add").hide();
		}
	});
	
	// Galler Light box
	if ($(".gallery-grid").length == 1)
	{
		$(".fancybox").fancybox({ // Fancybox
			padding:5,
			helpers: {
				overlay: {
					locked: false
				}
			}
		});
	}
	
	// images galler filter
	var workFilter = $('.gallery-filter li');
	workFilter.on("click", function(){
		workFilter.removeClass('active');
		$(this).addClass('active');
	});
    if ($(".gallery-grid").length == 1)
	{
		$('.gallery-grid').filterizr();
	}
	
	// syllabus accident 
	$(".syllabus-view .main-point").click(function(){
		if($(this).next(".point-list").is(":visible"))	
		{
			$(this).next(".point-list").slideUp();
			$(this).removeClass("active");
		}
		else
		{
			$(this).next(".point-list").slideDown();
			$(this).addClass("active");
		}
	});
	
	// Testimonial slider Call
	if ($(".testimonial-view").length == 1) {
		var owl1 = $('.testimonial-view');
		  owl1.owlCarousel({
			margin: 30,
			loop: true,
			items : 3,
			dots: true,
			nav: false,
			responsive: {
			  0: {
				items: 1,
			  },
			  768: {
				items: 2
			  },
			  1200: {
				items: 3
			  }
			}
		});
	}
	
	if ($(".testimonial-view2").length == 1) {
		var owl1 = $('.testimonial-view2');
		  owl1.owlCarousel({
			margin: 30,
			loop: true,
			items : 2,
			dots: true,
			nav: false,
			responsive: {
			  0: {
				items: 1,
			  },
			  768: {
				items: 2
			  }
			}
		});
	}
	
	if ($(".testimonial-view3").length == 1) {
		var owl1 = $('.testimonial-view3');
		  owl1.owlCarousel({
			margin: 20,
			loop: true,
			items : 3,
			dots: true,
			nav: false,
			responsive: {
			  0: {
				items: 1,
			  },
			  768: {
				items: 2
			  },
			  1200: {
				items: 3
			  }
			}
		});
	}
	
	if ($(".testimonial-view4").length == 1) {
		var owl1 = $('.testimonial-view4');
		  owl1.owlCarousel({
			margin: 0,
			loop: true,
			items : 1,
			dots: true,
			nav: false,
		});
	}
	
	// datepicker call
	if ($("#datepicker1").length) {
		$('#datepicker1').datepicker();
	}
	
	// instructors slider call
	if ($(".instructors-slider").length == 1) {
		var owl1 = $('.instructors-slider');
		  owl1.owlCarousel({
			margin: 0,
			loop: true,
			items : 1,
			dots: false,
			nav: false,
			autoplay: true,
		});
	}
	
	// nav arrow set in moblie view
	$(".nav > li.sub-menu").each(function() {
        $(this).children("a").after("<span class='arrow'><i class='fa fa-plus'></i></span>");
    });
	$(".nav > li.sub-menu .arrow").click(function(){
		if($(this).next().is(":visible"))
		{
			$(this).children(".fa").removeClass("fa-minus");
			$(this).children(".fa").addClass("fa-plus");
			$(this).next().slideUp();
		}
		else
		{
			$(".nav > li.sub-menu .arrow .fa").removeClass("fa-minus");
			$(".nav > li.sub-menu .arrow .fa").addClass("fa-plus");
			$(".nav > li.sub-menu .arrow").next().slideUp();
			$(this).children(".fa").removeClass("fa-plus");
			$(this).children(".fa").addClass("fa-minus");
			$(this).next().slideDown();
		}
	});
	
	// comming soon counter
	if ($("#countdown_commigsoon").length == 1)
	{
		$("#countdown_commigsoon").countdown({ // Counter timer
				date: "01 May 2017 12:00:00", // Enter new date here
				format: "on"
		});
	}
	
	// comming soon page height
	if ($(".comming-soon").length == 1)
	{
		$(".comming-soon").css("min-height", $(window).height() +"px");
		$(window).resize(function(){
			$(".comming-soon").css("min-height", $(window).height() +"px");
		});
	}
	
	// index2 banner Slider
	if ($(".left-slider").length == 1) {
		var owl1 = $('.left-slider');
		  owl1.owlCarousel({
			margin: 0,
			loop: true,
			items : 1,
			dots: false,
			nav: true,
			autoplay: true,
		});
		$(".left-slider .item").each(function() {
            var img_src = $(this).children("img").attr("src");
			$(this).css("background-image","url('" + img_src + "')");
			$(this).children("img").hide();
        });
	}
	
	//reviews slider Call 
	if ($(".reviews-slider").length == 1) {
		var owl1 = $('.reviews-slider');
		  owl1.owlCarousel({
			margin: 30,
			loop: true,
			items : 2,
			dots: false,
			nav: true,
			autoplay: true,
			navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
			responsive: {
			  0: {
				items: 1,
			  },
			  768: {
				items: 1
			  },
			  991: {
				items: 2
			  }
			}
		});
	}
	// search open
	$(".search-box").click(function(){
		$(".search-blcok").fadeIn();
	});
	$(".close-icon").click(function(){
		$(".search-blcok").fadeOut();
	});
	
	// body scroll Top
	$("#goTop").on("click",function(e) {
		$("html, body").animate({ scrollTop: 0 }, 500);
	});
	
	// language Dropdown
	$(".language-select a").on("click",function(e) {
		if($(this).next(".language-list").is(":visible"))
		{
			$(this).next(".language-list").slideUp();
		}
		else
		{
			$(".right-link .accout-link").slideUp();
			$(this).next(".language-list").slideDown();
		}
	});
	
	// userProfile Dropdown
	$(".user-profileLink a").on("click",function(e) {
		if($(this).next(".accout-link").is(":visible"))
		{
			$(this).next(".accout-link").slideUp();
		}
		else
		{
			$(".right-link .language-list").slideUp();
			$(this).next(".accout-link").slideDown();
		}
	});
	
	//user account tab 
	$(".account-tab ul li a").each(function() {
		$(this).click(function(){
			var open_id = $(this).attr("id");
			if($("."+ open_id + "-con").is(":visible"))
			{
				
			}
			else
			{
				$(".account-tab ul li").removeClass("active");
				$(this).parents("li").addClass("active");
				$(".my-account .tab-content").slideUp();
				$("."+ open_id + "-con").slideDown();	
			}
		});
	});
	
	//Copyright Year
	var currentYear = (new Date).getFullYear();
	$("#footer .copy-right .year").text(currentYear);
});
// fiexd menu 
$(window).on('scroll', function() {
	if ($(window).scrollTop() > 50)
	{
		$(".top-arrow").fadeIn();
		$("#header").addClass("fiexd");
	}
	else
	{
		$(".top-arrow").fadeOut();
		$("#header").removeClass("fiexd");
	}
});

/* check and radio js start */
function setupLabel() {
	if ($('.label_check input').length) {
		$('.label_check').each(function(){ 
				$(this).removeClass('c_on');
			});
			$('.label_check input:checked').each(function(){ 
				$(this).parent('label').addClass('c_on');
			});                
		};
		if ($('.label_radio input').length) {
			$('.label_radio').each(function(){ 
				$(this).removeClass('r_on');
			});
			$('.label_radio input:checked').each(function(){ 
				$(this).parent('label').addClass('r_on');
			});
		};
};
	
	