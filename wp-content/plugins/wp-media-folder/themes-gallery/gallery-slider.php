<?php
/* Prohibit direct script loading */
defined('ABSPATH') || die('No direct script access allowed!');
wp_enqueue_script('wpmf-gallery');
wp_enqueue_script(
    'wpmf-gallery-flexslider',
    plugins_url('assets/js/display-gallery/flexslider/jquery.flexslider.js', dirname(__FILE__)),
    array('jquery'),
    '2.0.0',
    true
);
wp_enqueue_style(
    'wpmf-flexslider-style',
    plugins_url('assets/css/display-gallery/flexslider.css', dirname(__FILE__)),
    array(),
    '2.4.0'
);

$class_default = array();
$class_default[] = 'gallery flexslider carousel wpmfflexslider';
$class_default[] = 'gallery-link-' . $link;
$class_default[] = 'wpmf-has-border-radius-' . $img_border_radius;
$class_default[] = 'wpmf-gutterwidth-' . $gutterwidth;
if ((int) $columns === 1) {
    $class_default[] = 'wpmf-gg-one-columns';
} else {
    $class_default[] = 'wpmf-gg-multiple-columns';
}

$shadow = 0;
$style = '<style>';
if ($img_shadow !== '') {
    if ((int) $columns > 1) {
        $style .= '#' . $selector . ' .wpmf-gallery-item:hover {box-shadow: ' . $img_shadow . ' !important; transition: all 200ms ease;}';
        $shadow = 1;
    }
}

if ((int) $gutterwidth === 0) {
    $shadow = 0;
}
if ($border_style !== 'none') {
    if ((int) $columns === 1) {
        $style .= '#' . $selector . ' .wpmf-gallery-item img {border: ' . $border_color . ' '. $border_width .'px '. $border_style .';}';
    } else {
        $style .= '#' . $selector . ' .wpmf-gallery-item {border: ' . $border_color . ' '. $border_width .'px '. $border_style .';}';
    }
} else {
    $border_width = 0;
}
$style .= '</style>';
$output = '<div class="wpmf-gallerys">';
$output .= '<div id="' . $selector . '" data-id="' . $selector . '" data-gutterwidth="' . $gutterwidth . '" 
 class="' . implode(' ', $class_default) . '" data-wpmfcolumns="' . $columns . '" data-auto_animation="' . esc_html($autoplay) . '" data-border-width="' . $border_width . '" data-shadow="' . $shadow . '">';

$output .= $style;
$output .= '<ul class="slides wpmf-slides">';
$i = 0;
$pos = 1;

foreach ($gallery_items as $item_id => $attachment) {
    $sizes = image_get_intermediate_size($attachment->ID, $size);
    if (!$sizes) {
        $sizes = wp_get_attachment_metadata($attachment->ID);
    }

    if (empty($sizes['height']) || empty($sizes['width'])) {
        continue;
    }
    $post_title = htmlentities($attachment->post_title);
    $post_excerpt = htmlentities($attachment->post_excerpt);

    $caption_lightbox = wpmfGetOption('caption_lightbox_gallery');
    if (!empty($caption_lightbox)) {
        $lb_title = $post_excerpt;
    } else {
        $lb_title = $post_title;
    }

    $link_target = get_post_meta($attachment->ID, '_gallery_link_target', true);
    $img = wp_get_attachment_image_src($item_id, $size);
    if (!$img) {
        continue;
    }

    list($src, $width, $height) = $img;
    $alt = trim(strip_tags(get_post_meta($item_id, '_wp_attachment_image_alt', true))); // Use Alt field first
    $image_output = '<img src="' . $src . '" alt="' . $alt . '" />';

    $current_theme = get_option('current_theme');
    if (isset($current_theme) && $current_theme === 'Gleam') {
        $tclass = 'fancybox';
    } else {
        $tclass = '';
    }

    if (!empty($link)) {
        if ($customlink) {
            $url = get_post_meta($item_id, _WPMF_GALLERY_PREFIX . 'custom_image_link', true);
            if ($url === '') {
                $url = get_attachment_link($item_id);
            }

            $image_output = '<a class="' . $tclass . '" href="' . $url . '"
             target="' . $link_target . '">' . $image_output . '</a>';
        } elseif ('post' === $link) {
            $url = get_attachment_link($item_id);
            $image_output = '<a class="' . $tclass . '" href="' . $url . '"
             target="' . $link_target . '">' . $image_output . '</a>';
        } elseif ('file' === $link) {
            $lightbox = 1;
            $imgs_urls = wp_get_attachment_image_src($item_id, $targetsize);
            $url = $imgs_urls[0];
            $remote_video = get_post_meta($item_id, 'wpmf_remote_video_link', true);
            if (!empty($remote_video)) {
                $image_output = '<a class="' . $tclass . ' isvideo" data-lightbox="' . $lightbox . '"
                 href="' . $remote_video . '" target="' . $link_target . '" title="' . esc_attr($post_title) . '">
                 ' . $image_output . '</a>';
            } else {
                $image_output = '<a class="' . $tclass . ' not_video"
                 data-lightbox="' . $lightbox . '" href="' . $url . '"
                  target="' . $link_target . '" data-title="' . esc_attr($lb_title) . '" title="' . esc_attr($post_title) . '">' . $image_output . '</a>';
            }
        } else {
            $image_output = '<img src="' . $src . '" alt="' . $alt . '" />';
        }
    }

    $orientation = ($sizes['height'] > $sizes['width']) ? 'portrait' : 'landscape';
    if ((int)$columns === 1) {
        $output .= "<li class='wpmf-gg-one-columns wpmf-gallery-item item'>";
    } else {
        $output .= "<li class='wpmf-gallery-item item'>";
    }
    $output .= '<div class="wpmf-gallery-icon ' . $orientation . '">' . $image_output . '</div>';
    if (trim($post_excerpt) || trim($post_title)) {
        $output .= "<div class='wpmf-front-box top'>";
        $output .= '<a>';
        $output .= "<span class='title'>" . wptexturize($post_title) . ' </span>';
        $output .= "<span class='caption'>" . wptexturize($post_excerpt) . '</span>';
        $output .= '</a>';
        $output .= '</div>';
    }

    $output .= '</li>';
    $pos++;
}


$output .= '</ul>';
$output .= '</div></div>';
