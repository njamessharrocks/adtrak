(function($){

	$(document).ready(function(){

		
		if ($(window).width() < 1100) {
			$('.services-slider').slick({
				centerMode: false,
				variableWidth: false,
				infinite: false,
				autoplay: true,
				arrows: false,
				dots: false,
				slidesToShow: 2,
				slidesToScroll: 1,
				responsive: [
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 1
						}
					}
				]
			});	
		}
		
		var wh = $(window).height();
		var msh = $('#menu-secondary-nav').height();
		var navh = $('#masthead').height();
		var total = wh - msh - navh - 10;
		if(total < 900) {
			$('.hero-banner').css({
				'height' : total + 'px'
			});
		}
		else {
			$('.hero-banner').css({
				'height' : '900px'
			});
		}

		var cw = $(window).width();
		var mw = $('.contain').width();
		var totalw = (cw - mw) / 2;
		var colw = $('.col-8').width();
		var totalwidth = colw + totalw; 
		if(cw > 1600) {
			$('.hero-banner img').css({
				'width' : totalwidth + 'px'
			});
		}
		if(cw > 1100) {
			$('.services-list .heading').css({
				'padding-left' : totalw + 'px'
			});
		}

		$('#secondary-navigation .main-nav').append('<button class="greedyNavButton">MORE</button><ul class="hidden-links hidden"></ul>');

		var $nav = $('nav#secondary-navigation');
		var $btn = $('nav#secondary-navigation button ');
		var $vlinks = $('nav#secondary-navigation #menu-secondary-nav');
		var $hlinks = $('nav#secondary-navigation .hidden-links');
		var numOfItems = 0;
		var totalSpace = 0;
		var breakWidths = [];
		// Get initial state
		$vlinks.children().outerWidth(function(i, w) {
			totalSpace += w;
			numOfItems += 1;
			breakWidths.push(totalSpace);
		});
		var availableSpace, numOfVisibleItems, requiredSpace;
		function check() {
			// Get instant state
			availableSpace = $vlinks.width() - 10;
			numOfVisibleItems = $vlinks.children().length;
			requiredSpace = breakWidths[numOfVisibleItems - 1];

			// There is not enought space
			if (requiredSpace > availableSpace) {
				$vlinks.children().last().prependTo($hlinks);
				numOfVisibleItems -= 1;
				check();
				// There is more than enough space
			} else if (availableSpace > breakWidths[numOfVisibleItems]) {
				$hlinks.children().first().appendTo($vlinks);
				numOfVisibleItems += 1;
			}
			// Update the button accordingly
			$btn.attr("count", numOfItems - numOfVisibleItems);
			if (numOfVisibleItems === numOfItems) {
				$btn.addClass('hidden');
			} else $btn.removeClass('hidden');
		}
		// Window listeners
		$(window).resize(function() {
			check();
		});
		$btn.on('click', function() {
			$hlinks.toggleClass('hidden');
		});
		check();

		//file upload detection
		$("input:file").change(function (){
			$(this).addClass('file-uploaded');
		});

		//smooth scroll all anchor links
		$('a[href^="#"]').addClass('smooth-scroll');

	});

})(jQuery);
