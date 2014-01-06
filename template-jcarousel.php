<?php 
/**
  File Detail: NextGen jCarousel Template
  Plugin Name: NextGEN jCarousel Template
  Plugin URI: http://github.com/weldstudio/nextgen-jcarousel-template
  Author: The Weld Studio
  Author URI: http://www.theweldstudio.com
  Version: 0.1

Follow variables are useable :

	$gallery     : Contain all about the gallery
	$images      : Contain all images, path, title
	$pagination  : Contain the pagination content

@todo Add ability to set width etc

**/


if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }
if (!defined ('ABSPATH')) die ('No direct access allowed');
?><?php if (!empty ($gallery)) : ?>
<div class="jcarousel-wrapper">
	<div id="<?php echo $gallery->anchor ?>" class="jcarousel"><ul>
		<?php foreach ($images as $image) : ?>	
		 <li><img src="<?php echo $image->imageURL ?>" alt="<?php echo $image->alttext ?>" title="<?php echo $image->alttext ?>" /></li>
		<?php endforeach; ?>
	</ul></div>
	<a id="<?php echo $gallery->anchor ?>-prev" class="jcarousel-control-prev">&lsaquo;</a>
	<a id="<?php echo $gallery->anchor ?>-next" class="jcarousel-control-next">&rsaquo;</a>
	<p id="<?php echo $gallery->anchor ?>-page" class="jcarousel-pagination"></p>
</div>

<script type="text/javascript" defer="defer">
    jQuery(document).ready(function($) {
	    $(function() {
		var jcarousel = $('#<?php echo $gallery->anchor ?>');

		jcarousel
		    .on('jcarousel:reload jcarousel:create', function () {
			<?php /// Caculate optimum width ?>
			var width = jcarousel.innerWidth();
			var targetWidth = 150;

			var calc = int(width / targetWidth);
			console.log('width:' + width + ', target:' + targetWidth + ', calc:' + calc);
			width = width / calc;
			
			jcarousel.jcarousel('items').css('width', width + 'px');
		})
		.jcarousel({
			wrap: 'circular',
			animation: {
				duration: 2000,
				easing: 'ease'
			}
		})
		.jcarouselAutoscroll({
			interval: 0,
			target: '+=1',
			autostart: true
		})
		.hover(function() {
			jcarousel.jcarouselAutoscroll('stop');
		}, function() {
			jcarousel.jcarouselAutoscroll('start');
		});


		$('#<?php echo $gallery->anchor ?>-prev')
		    .jcarouselControl({
			target: '-=1'
		    });

		$('#<?php echo $gallery->anchor ?>-next')
		    .jcarouselControl({
			target: '+=1'
		    });

		$('#<?php echo $gallery->anchor ?>-page')
		    .on('jcarouselpagination:active', 'a', function() {
			$(this).addClass('active');
		    })
		    .on('jcarouselpagination:inactive', 'a', function() {
			$(this).removeClass('active');
		    })
		    .on('click', function(e) {
			e.preventDefault();
		    })
		    .jcarouselPagination({
			perPage: 1,
			item: function(page) {
			    return '<a href="#' + page + '">' + page + '</a>';
			}
		    });
	    });
    });	
</script>
<?php endif; ?>
