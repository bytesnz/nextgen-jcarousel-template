<?php

/*
  Plugin Name: NextGEN jCarousel Template
  Plugin URI: http://github.com/weldstudio/nextgen-jcarousel-template
  Description: Add a "jcarousel" template for the NextGen gallery. Use the shortcode [nggallery id=x template="jcarousel"] to display images as a carousel.
  Author: The Weld Studio
  Author URI: http://www.theweldstudio.com
  Version: 1.0
 */

if (!class_exists('NGGjCarouselTemplate')) {

    class NGGjCarouselTemplate {
        function NGGjCarouselTemplate() {
            add_action('wp_enqueue_scripts', array(&$this, 'load_scripts'));
            add_action('wp_enqueue_scripts', array(&$this, 'load_styles'));
            add_filter('ngg_render_template', array(&$this, 'add_template'), 10, 2);
        }

        function add_template($path, $template_name = false) {

            if ($template_name == 'jcarousel') {
                $path =  plugin_dir_path(__FILE__) . '/template-jcarousel.php';
            }

            return $path;
        }

        function load_styles() {
            wp_enqueue_style('tws-jcarousel', plugins_url('css/style.css', __FILE__), false, '0.1', 'all');
        }

        function load_scripts() {
            wp_enqueue_script('jcarousel', plugins_url('js/jcarousel-0.3.0/jquery.jcarousel.min.js', __FILE__), array('jquery'), '0.3.0');
            wp_enqueue_script('jcarousel-autoscroll', plugins_url('js/jcarousel-0.3.0/jquery.jcarousel-autoscroll.min.js', __FILE__), array('jquery', 'jcarousel'), '0.3.0');
        }

    }

    // Start this plugin once all other plugins are fully loaded
    add_action('plugins_loaded', create_function('', 'global $NGGjCarouselTemplate; $NGGjCarouselTemplate = new NGGjCarouselTemplate();'));
}
