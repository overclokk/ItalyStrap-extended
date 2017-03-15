<?php
/**
 * Widget_Factory API
 *
 * Instantiate the wdgets.
 *
 * @link www.italystrap.com
 * @since 2.4.0
 *
 * @package ItalyStrap
 */

namespace ItalyStrap\Widget;

if ( ! defined( 'ITALYSTRAP_PLUGIN' ) or ! ITALYSTRAP_PLUGIN ) {
	die();
}

use ItalyStrap\Event\Subscriber_Interface;

/**
 * Widget_Factory
 */
class Widget_Factory implements Subscriber_Interface {

	/**
	 * Returns an array of hooks that this subscriber wants to register with
	 * the WordPress plugin API.
	 *
	 * @hooked 'widgets_init' - 10
	 *
	 * @return array
	 */
	public static function get_subscribed_events() {

		return array(
			// 'hook_name'				=> 'method_name',
			'widgets_init'	=> array(
				'function_to_add'	=> 'widgets_init',
				'priority'			=> 10,
			),
			'monster-widget-config'	=> 'monster_widget',
		);
	}

	/**
	 * The plugin's options
	 *
	 * @var string
	 */
	private $options = '';

	/**
	 * List of all widget classes name.
	 *
	 * @var array
	 */
	private $widget_list = array();

	/**
	 * Fire the construct
	 */
	public function __construct( array $options = array() ) {
		$this->options = $options;

		$this->widget_list = array(
			'vcardwidget'				=> 'ItalyStrap\\Widget\\Vcard_Widget', // Deprecated
			// 'post_widget'				=> 'Widget_Posts2', // Deprecated
			'media_carousel_widget'		=> 'ItalyStrap\\Widget\\Carousel',
			'widget_posts'				=> 'ItalyStrap\\Widget\\Posts',
			'widget_vcard'				=> 'ItalyStrap\\Widget\\VCard', // New
			'widget_image'				=> 'ItalyStrap\\Widget\\Image', // New
			'widget_facebook_page'		=> 'ItalyStrap\\Widget\\Facebook_Page', // New
			'widget_breadcrumbs'		=> 'ItalyStrap\\Widget\\Breadcrumbs', // Beta
			'widget_grouped_posts'		=> 'ItalyStrap\\Widget\\Grouped_Posts', // Beta
			'widget_monster'			=> 'ItalyStrap\\Widget\\Monster', // Debug
		);
	}

	/**
	 * Add action to widget_init
	 * Initialize widget
	 */
	public function widgets_init() {

		foreach ( (array) $this->widget_list as $option_name => $class_name ) {
			if ( ! empty( $this->options[ $option_name ] ) ) {
				\register_widget( new $class_name );
			}
		}
	}

	/**
	 * monster-widget
	 *
	 * @param  array $widgets Widget configuration.
	 * @return array          New Widget configuration.
	 */
	public function monster_widget( $widgets ) {

		$new_widgets = array(
			array(
				'ItalyStrap\\Widget\\Carousel',
				array(
					'title'		=> __( 'Bootstrap Carousel', 'italystrap' ),
					'ids'		=> '2300,2298,2244',
				)
			),
			array(
				'ItalyStrap\\Widget\\Posts',
				array(
					'title'		=> __( 'ItalyStrap Posts', 'italystrap' ),
					'post_types'	=> 'post',
				)
			),
			array(
				'ItalyStrap\\Widget\\VCard',
				array(
					'title'		=> __( 'ItalyStrap VCard', 'italystrap' ),
				)
			),
			array(
				'ItalyStrap\\Widget\\Image',
				array(
					'title'		=> __( 'ItalyStrap Image', 'italystrap' ),
					'id'		=> '2300',
				)
			),
			array(
				'ItalyStrap\\Widget\\Facebook_Page',
				array(
					'title'		=> __( 'Facebook_Page', 'italystrap' ),
				)
			),
			array(
				'ItalyStrap\\Widget\\Breadcrumbs',
				array(
					'title'		=> __( 'Breadcrumbs', 'italystrap' ),
				)
			),
			array(
				'ItalyStrap\\Widget\\Taxonomies_Posts',
				array(
					'title'		=> __( 'Taxonomies_Posts', 'italystrap' ),
				)
			),
		);

		return wp_parse_args( $widgets, $new_widgets );
	}
}
