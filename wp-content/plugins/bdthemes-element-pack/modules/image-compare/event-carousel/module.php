<?php
namespace ElementPack\Modules\EventCarousel;

use ElementPack\Base\Element_Pack_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Element_Pack_Module_Base {

	public function get_name() {
		return 'event-carousel';
	}

	public function get_widgets() {
		$widgets = [
			'Event_Carousel',
		];

		return $widgets;
	}
}
