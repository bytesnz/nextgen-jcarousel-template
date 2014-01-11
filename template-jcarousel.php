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
<div id="<?php echo $gallery->anchor ?>-wrapper" class="jcarousel-wrapper">
	<div id="<?php echo $gallery->anchor ?>" class="jcarousel"><ul>
		<?php foreach ($images as $image) : ?>	
			<li>
				<a href="<?php echo $image->imageURL ?>" title="<?php echo $image->alttext ?>" data-src="<?php echo $image->imageURL ?>" data-thumbnail="<?php echo $image->thumbnailURL ?>" data-image-id="<?php echo $image->id ?>" data-title="<?php echo $image->alttext ?>" data-description="" class="ngg-fancybox" rel="<?php echo $displayed_gallery_id ?>">
					<img src="<?php echo $image->thumbnailURL ?>" alt="<?php echo $image->alttext ?>" title="<?php echo $image->alttext ?>" />
				</a>
			</li>
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
			var targetWidth = 120;

			var calc = ~~(width / targetWidth);
			width = width / calc;
			
			jcarousel.jcarousel('items').css('width', width + 'px');
		})
		.jcarousel({
			wrap: 'circular',
			animation: {
				duration: 2000,
				easing: 'linear'
			}
		})
		.jcarouselAutoscroll({
			interval: 0000,
			target: '+=1',
			autostart: true
		});

		$('#<?php echo $gallery->anchor ?>-wrapper')
		.mouseenter(function() {
			jcarousel
				.jcarousel('options', {
					animation: {
						duration: 200,
						easing: 'linear'
					}
				})
				.jcarouselAutoscroll('stop');
		})
		.mouseleave(function() {
			jcarousel
				.jcarousel({
					animation: {
						duration: 2000,
						easing: 'linear'
					}
				})
				.jcarouselAutoscroll('start');
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
