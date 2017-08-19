<?php
/**
 * Abstract class for custom query
 *
 * This is the abstract class for the custom query used in widget and shortcode to display post type
 *
 * @since 2.0.0
 *
 * @version 1.0.0
 *
 * @package ItalyStrap
 */

namespace ItalyStrap\Query;

use \WP_Query;
use ItalyStrap\Excerpt\Excerpt;
use ItalyStrap\Config\Config;

/**
 * Query Class for widget and shortcode
 */
abstract class Query implements Query_Interface {

	/**
	 * WordPress query object.
	 *
	 * @var WP_Query
	 */
	protected $query;

	/**
	 * WordPress query object.
	 *
	 * @var object
	 */
	protected $args;

	/**
	 * WordPress global $post
	 *
	 * @var object
	 */
	protected $post;

	/**
	 * Set an array with post to be escluded from loop
	 *
	 * @var array
	 */
	protected $posts_to_exclude = array();

	/**
	 * Declare this variable static and call it only one time
	 *
	 * @var array
	 */
	protected static $sticky_posts;

	/**
	 * The context of this instance works
	 *
	 * @var string
	 */
	protected $context;

	protected $excerpt;

	/**
	 * Constructor.
	 *
	 * @param WP_Query $query The standard query of WordPress.
	 */
	function __construct( WP_Query $query, Excerpt $excerpt, Config $config, $context = 'posts' ) {

		$this->excerpt = $excerpt;
		$this->query = $query;
		$this->config = $config;

		$this->theme_mod = $this->config->all();

		global $post;
		$this->post = $post;

		if ( ! isset( self::$sticky_posts ) ) {
			self::$sticky_posts = get_option( 'sticky_posts' );
		}

		if ( ! isset( $context ) ) {
			$context = 'main';
		}

		if ( ! is_string( $context ) ) {
			throw new InvalidArgumentException( __( 'Context name must be a string', 'italystrap' ) );
		}

		$this->context = $context;

	}

	/**
	 * Initialize the repository.
	 *
	 * @uses PHP 5.3
	 *
	 * @return self
	 */
	public static function init( $context = 'posts' ) {

		return new self( new WP_Query(), new Excerpt( new Config() ), new Config(), $context );

	}

	/**
	 * Get the global post
	 *
	 * @return object Return the global objesct post
	 */
	public function get_global_post() {
		return $this->post;
	}

	/**
	 * Get arguments from widget attributes
	 *
	 * @param  array $args Arguments from widget.
	 */
	public function get_widget_args( $args ) {

		$this->args = $this->get_attributes( $args );

	}

	/**
	 * Get arguments from shortcode attributes
	 *
	 * @param  array $args Arguments from shortcode.
	 */
	public function get_shortcode_args( $args ) {

		$this->args = $this->get_attributes( $args );

	}

	/**
	 * Get the correct path for template parts
	 *
	 * @return string Return the path
	 */
	public function get_template_part( $path = '' ) {

		$template_dir_name = apply_filters( 'italystrap_template_dir_name', 'templates' );

		/**
		 * Standard
		 * Legacy
		 * Card
		 * Masonry
		 *
		 * Da gestire
		 * Template standard per posts + eventuali altri template preimpostati
		 * Possibilità di poter aggiungere template anche da plugin
		 *
		 * Possibilità
		 */

		// d( $this->config );
		// d( $this->args['template'] );
		// 'thematic-areas-home'

		$templates = array(
			// 'name'	=> 'fullpath/of/the/template.php'
			'standard'	=> $template_dir_name . DS . 'posts/standard.php',
			'legacy'	=> $template_dir_name . DS . 'posts/legacy.php',
			'custom'	=> null,
		);

		$context = 'posts';

		// $templates = apply_filters( "italystrap_{$context}_templates_name_registered", $templates );
		$templates = apply_filters( 'italystrap_posts_templates_name_registered', $templates );

		$templates = array_merge( $templates, array(
			'loop'	=> $template_dir_name . DS . 'posts/loop.php',
		) );

		// d( locate_template( $templates['standard'] ) );
		// d( $templates['loop'] );
		// d( locate_template( $templates['legacy'] ) );
		// d( locate_template( $templates[ $this->args['template'] ] ) );
	
		// $this->args['template'] = 'thematic-areas-home';
		
		$locate_template = array(
			$templates[ $this->args['template'] ],
		);

		// d( file_exists( 'E:\xampp\htdocs\helpcode/wp-content/themes/italystrap/templates\posts/standard.php' ) );

		// $locate_template = 'E:\xampp\htdocs\helpcode/wp-content/themes/italystrap/templates\posts/standard.php';
		// d( 'Cerco nel tema', $templates[ $this->args['template'] ] );
		/**
		 * Cerca se è presente il file nel tema figlio e poi nel tema genitore
		 * Se lo trova restituisce il full path del file da caricare.
		 *
		 * @var string
		 */
		if ( $template_file_full_path = locate_template( $locate_template ) ) {
			return $template_file_full_path;
		}
		// d( 'Nel tema not found, continuo a cercare', $templates[ $this->args['template'] ] );
		/**
		 * Posso registrare un file template anche da plugin e
		 * verifico qui dopo la verifica del tema
		 * Il file deve essere registrato con il full path
		 * Però non potrà essere sovrascritto dal tema
		 */
		if ( file_exists( $templates[ $this->args['template'] ] ) ) {
			return $templates[ $this->args['template'] ];
		}

		/**
		 * Se non c'è nessun file in temi o plugin
		 * ritorno il file selezionato dal widget e presente
		 * nel plugin e ritorno il full path
		 */
		if ( file_exists( ITALYSTRAP_PLUGIN_PATH . $templates[ $this->args['template'] ] ) ) {
			return ITALYSTRAP_PLUGIN_PATH . $templates[ $this->args['template'] ];
		}

		/**
		 * Se nessuno dei controlli precedenti ha funzionato
		 * ritorno il valore di default
		 */
		return ITALYSTRAP_PLUGIN_PATH . DS . $templates['standard'];

		// d( $this->config );
		// d( $this->args['template'] );

		// $template_path = ITALYSTRAP_PLUGIN_PATH . '/templates/legacy.php';

		// if ( 'custom' === $this->args['template'] ) {

		// 	$custom_template_path = '/templates/' . $this->args['template_custom'] . '.php';

		// 	if ( locate_template( $custom_template_path ) ) {

		// 		$template_path = STYLESHEETPATH . $custom_template_path;

		// 	} else {

		// 		$template_path = ITALYSTRAP_PLUGIN_PATH . '/templates/standard.php';

		// 	}
		// } elseif ( 'standard' === $this->args['template'] ) {

		// 	$template_path = ITALYSTRAP_PLUGIN_PATH . '/templates/standard.php';

		// } else {

		// 	$template_path = ITALYSTRAP_PLUGIN_PATH . '/templates/legacy.php';

		// }

		// return apply_filters( "italystrap_{$this->context}_template_path", $template_path, $this->args );
		// include \ItalyStrap\Core\get_template( '/templates/content-post.php' );
		// include \ItalyStrap\Core\get_template( '/templates/posts/loop.php' );
		return \ItalyStrap\Core\get_template( '/templates/content-post.php' );
	}

	/**
	 * Output the query result
	 *
	 * @return string The HTML result
	 */
	public function output() {}

	/**
	 * Render the query result
	 *
	 * @return string The HTML result
	 */
	public function render(){}

	/**
	 * Get posts id by views.
	 * This function is forked from Jetpack.
	 * It functions only if jetpack is actived.
	 *
	 * @param  array      $args   The widget arguments.
	 *
	 * @return array/null         Return an array of posts id
	 *                            or null if none are found.
	 */
	protected function get_posts_ids_by_views( $args ) {

		if ( ! function_exists( 'stats_get_csv' ) ) {
			return null;
		}

		/**
		 * Filter the number of days used to calculate Top Posts for the Top Posts widget.
		 * We do not recommend accessing more than 10 days of results at one.
		 * When more than 10 days of results are accessed at once, results should be cached via the WordPress transients API.
		 * Querying for -1 days will give results for an infinite number of days.
		 *
		 * @module widgets
		 *
		 * @since 3.9.3
		 *
		 * @param int 2 Number of days. Default is 2.
		 * @param array $args The widget arguments.
		 */
		$days = (int) apply_filters( 'italystrap_top_posts_days', 2, $args );

		/** Handling situations where the number of days makes no sense - allows for unlimited days where $days = -1 */
		if ( 0 === $days || false === $days ) {
			$days = 2;
		}

		$post_view_posts = stats_get_csv( 'postviews', array( 'days' => absint( $days ), 'limit' => 11 ) );

		if ( ! $post_view_posts ) {
			return array();
		}

		$post_view_ids = array_filter( wp_list_pluck( $post_view_posts, 'post_id' ) );

		if ( ! $post_view_ids ) {
			return null;
		}

		return (array) array_map( 'absint', $post_view_ids );
	}
}
