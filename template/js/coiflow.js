$(document).ready(function($){
    function bgAfter(){
		$('.after_right').each(function(){
			var thisE = $(this);
			var afterleft = thisE.offset().left;
			var afterW = thisE.outerWidth();
			var afterRight = ($(window).width() - (afterleft + afterW));
			thisE.find('.after_content').css({width:afterRight+'px'});
		});
	}
	bgAfter();
	$(window).resize(function(){
		bgAfter();
	});
	$('.pie-chart').each(function(){
		var barcolor = $(this).attr('data-border');
		var percent = $(this).attr('data-percent-border');
		var datatype = $(this).attr('data-type');
		$(this).pieChart({
			barColor: percent,
			trackColor: barcolor,
			lineCap: 'round',
			lineWidth: 8,
			onStep: function (from, to, percent) {
				$(this.element).find('.pie-value').text(Math.round(percent) + datatype);
			}
		})
	})
	
	$('.menu a[href*="#"]').bind('click', function(e) {
			e.preventDefault(); // prevent hard jump, the default behavior

			var target = jQuery(this).attr("href"); // Set the target as variable

			// perform animated scrolling by getting top-position of target-element and set it as scroll target
			if(jQuery(target).length){
				jQuery('html, body').stop().animate({
						scrollTop: jQuery(target).offset().top
				}, 600,);
			}
		});
	$(".backto_top[href='#top']").click(function() {
	  $("html, body").animate({ scrollTop: 0 }, "slow");
	  return false;
	});
	
	
});