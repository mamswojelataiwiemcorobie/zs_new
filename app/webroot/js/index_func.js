//podświetlenie aktywnej strony w menu
		$("#nav a").each(function () {
			var path = window.location.pathname;
			var href = $(this).attr('href');
			if (href ===  path) {
				$(this).closest('li').addClass('active');
			}
		});  
		/* ---------------------------------------------------------------------- */
		/*	Carousel
		/* ---------------------------------------------------------------------- */
		$(window).load(function(){			
			$('#carousel-projects').carouFredSel({
			responsive: true,
			items       : {
		        width       : 300,
		        height      : 295,
	        visible     : {
	            min         : 1,
	            max         : 4
	        }
	    },
			width: '200px',
			height: '295px',
			auto: true,
			circular	: true,
			infinite	: false,
			prev : {
				button		: "#car_prev",
				key			: "left",
					},
			next : {
				button		: "#car_next",
				key			: "right",
						},
			swipe: {
				onMouse: true,
				onTouch: true
				},
			scroll: {
	        easing: "",
	        duration: 1200
	    }
		});
			});

		//CALL TESTIMONIAL ROTATOR
		$( function() {
			/*
			- how to call the plugin:
			$( selector ).cbpQTRotator( [options] );
			- options:
			{
				// default transition speed (ms)
				speed : 700,
				// default transition easing
				easing : 'ease',
				// rotator interval (ms)
				interval : 8000
			}
			- destroy:
			$( selector ).cbpQTRotator( 'destroy' );
			*/
			$( '#cbp-qtrotator' ).cbpQTRotator();
		} );

		//CALL PRETTY PHOTO
		$(document).ready(function(){
			$("a[data-gal^='prettyPhoto']").prettyPhoto({social_tools:'', animation_speed: 'normal' , theme: 'dark_rounded'});
		});

		//MASONRY
		$(document).ready(function(){
		var $container = $('#content');
		  $container.imagesLoaded( function(){
			$container.isotope({
			filter: '*',	
			animationOptions: {
			 duration: 750,
			 easing: 'linear',
			 queue: false,	 
		   }
		});
		});
		$('#filter a').click(function (event) {
			$('a.selected').removeClass('selected');
			var $this = $(this);
			$this.addClass('selected');
			var selector = $this.attr('data-filter');
			$container.isotope({
				 filter: selector
			});
			return false;
		});
		});

	//ROLL ON HOVER
		$(function() {
		$(".roll").css("opacity","0");
		$(".roll").hover(function () {
		$(this).stop().animate({
		opacity: .8
		}, "slow");
		},
		function () {
		$(this).stop().animate({
		opacity: 0
		}, "slow");
		});
		});