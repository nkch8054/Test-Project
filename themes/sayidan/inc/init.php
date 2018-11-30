<?php
/**
 * Sayidan Engine Room.
 * This is where all Theme Functions runs.
 *
 * @package sayidan
 */

/**
 * Setup.
 * Enqueue styles, register widget regions, etc.
 */
require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/custom-css.php';

/**
 * Helpers.
 */
//require get_template_directory() . '/inc/helpers/frontend.php';

/**
 * Sayidan Shortcodes.
 */
require get_template_directory() . '/inc/shortcodes/stories.php';
require get_template_directory() . '/inc/shortcodes/newsletter.php';
require get_template_directory() . '/inc/shortcodes/sliders.php';
require get_template_directory() . '/inc/shortcodes/sliders_item.php';
require get_template_directory() . '/inc/shortcodes/fact.php';
require get_template_directory() . '/inc/shortcodes/share.php';
require get_template_directory() . '/inc/shortcodes/career_list.php';
require get_template_directory() . '/inc/shortcodes/summary.php';
require get_template_directory() . '/inc/shortcodes/summary_item.php';
require get_template_directory() . '/inc/shortcodes/header.php';
require get_template_directory() . '/inc/shortcodes/header_texts.php';
require get_template_directory() . '/inc/shortcodes/our_story.php';
require get_template_directory() . '/inc/shortcodes/our_story_item.php';
require get_template_directory() . '/inc/shortcodes/map.php';
require get_template_directory() . '/inc/shortcodes/events.php';
require get_template_directory() . '/inc/shortcodes/event_single.php';
require get_template_directory() . '/inc/shortcodes/block.php';
//require get_template_directory() . '/inc/shortcodes/gallery.php';
require get_template_directory() . '/inc/shortcodes/info.php';
require get_template_directory() . '/inc/shortcodes/text.php';
require get_template_directory() . '/inc/shortcodes/directory.php';
require get_template_directory() . '/inc/shortcodes/blog.php';
require get_template_directory() . '/inc/shortcodes/slider.php';
require get_template_directory() . '/inc/shortcodes/buttons.php';
//require get_template_directory() . '/inc/shortcodes/contact.php';


require get_template_directory() . '/inc/shortcodes/sayidan-aboutus.php';
require get_template_directory() . '/inc/shortcodes/sayidan-summary2.php';
require get_template_directory() . '/inc/shortcodes/sayidan-banner.php';
require get_template_directory() . '/inc/shortcodes/sayidan-stories.php';
require get_template_directory() . '/inc/shortcodes/sayidan-newsletter.php';
require get_template_directory() . '/inc/shortcodes/sayidan-application.php';
require get_template_directory() . '/inc/shortcodes/sayidan-career.php';
require get_template_directory() . '/inc/shortcodes/sayidan-contact.php';
require get_template_directory() . '/inc/shortcodes/sayidan-gallery.php';
require get_template_directory() . '/inc/shortcodes/sayidan-slider.php';
require get_template_directory() . '/inc/shortcodes/sayidan-singleevent.php';
require get_template_directory() . '/inc/shortcodes/sayidan-info.php';
require get_template_directory() . '/inc/shortcodes/sayidan-blocks.php';
require get_template_directory() . '/inc/shortcodes/sayidan-twitter.php';
require get_template_directory() . '/inc/shortcodes/sayidan-events.php';
require get_template_directory() . '/inc/shortcodes/sayidan-directory.php';
require get_template_directory() . '/inc/shortcodes/sayidan-news.php';
require get_template_directory() . '/inc/shortcodes/sayidan-ourstory.php';
require get_template_directory() . '/inc/shortcodes/sayidan-map.php';