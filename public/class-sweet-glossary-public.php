<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://techpecialist.com/
 * @since      1.0.0
 *
 * @package    Sweet_Glossary
 * @subpackage Sweet_Glossary/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Sweet_Glossary
 * @subpackage Sweet_Glossary/public
 * @author     Techpecialist <dev@techpecialist.com>
 */
class Sweet_Glossary_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sweet_Glossary_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sweet_Glossary_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sweet-glossary-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sweet_Glossary_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sweet_Glossary_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sweet-glossary-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register glossary post type.
	 *
	 * @since    1.0.0
	 */
	public function register_cpt_glossary() {
		$labels = array(
			'name'              => _x( 'Glossary', 'Glossary Custom Post Type Name Plural', $this->plugin_name ),
			'singular_name'     => _x( 'Glossary', 'Glossary Custom Post Type Name Singular', $this->plugin_name ),
			'add_new'			=> _x( 'New glossary', 'Add new glossary term', $this->plugin_name ),
			'search_items'      => __( 'Search Glossary Terms' ),
			'all_items'         => __( 'Glossary' ),
			'edit_item'         => __( 'Edit Glossary term' ),
			'update_item'       => __( 'Update Glossary term' ),
			'add_new_item'      => __( 'New Glossary' ),
			'menu_name'         => __( 'Glossary' ),
		);
		$supports = array(
			'title',
			'editor',
			'comments',
			'revisions',
			'trackbacks',
			'author',
			'excerpt',
			'page-attributes',
			'thumbnail',
			'post-formats'
		);
		$args   = array(
			'description' 	    => 'Glossary Post Typesdlgfhwsloehgwoeghwoe',
			'labels'            => $labels,
			'public'			=> true,
			'hierarchical'		=> true,
			'exclude_from_search'	=> false,
			'publicly_queryable'	=> true,
			'show_ui'           => true,
			'show_in_menu'		=> 'edit.php',
			'show_in_nav_menus'	=> true,
			'show_in_admin_bar'	=> true,
			'show_in_rest'		=> true,
			'rest_base'			=> 'glossary',
			'supports'			=> $supports,
			'has_archive'		=> 'glossary',
			'rewrite'           => [ 'slug' => 'glossary', 'pages' => false ],
		);
		register_post_type( 'glossary', $args );
	}

	/**
	 * Include archive glossary template.
	 *
	 * @since    1.0.0
	 */
	public function template_glossary_archive( $template ) {
		if ( is_post_type_archive('glossary') ) {
			return SWEET_GLOSSARY_PATH . 'includes/template/archive-glossary.php';
		}

		return $template;
	}

	/**
	 * Order glossary posts by title.
	 *
	 * @since    1.0.0
	 */
	public function order_glossary_posts( $query ) {
		if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'glossary' ) ) {
			$query->set( 'orderby', 'title' );
			$query->set( 'order', 'ASC' );
			$query->set( 'posts_per_page', -1 );
		}
	}

}
