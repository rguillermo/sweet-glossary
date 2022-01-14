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
			'name'              => _x( 'Glossary', 'Glossary Custom Post Type Name Plural', $this->plugin_name, 'sweet-glossary' ),
			'singular_name'     => _x( 'Glossary', 'Glossary Custom Post Type Name Singular', $this->plugin_name, 'sweet-glossary' ),
			'add_new'			=> _x( 'New glossary', 'Add new glossary term', $this->plugin_name, 'sweet-glossary' ),
			'search_items'      => __( 'Search Glossary Terms', 'sweet-glossary' ),
			'all_items'         => __( 'Glossary', 'sweet-glossary' ),
			'edit_item'         => __( 'Edit Glossary term', 'sweet-glossary' ),
			'update_item'       => __( 'Update Glossary term', 'sweet-glossary' ),
			'add_new_item'      => __( 'New Glossary', 'sweet-glossary' ),
			'menu_name'         => __( 'Glossary', 'sweet-glossary' ),
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

		$slug = get_option( $this->plugin_name . '_slug', 'glossary' );

		$args   = array(
			'description' 	    => 'Glossary Terms',
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
			'has_archive'		=> false,
			'rewrite'           => [ 'slug' => $slug, 'pages' => false ],
		);
		register_post_type( 'glossary', $args );
	}

	/**
	 * Add glossary shortcode
	 *
	 * @since    1.0.0
	 */
	public function add_glossary_shortcode() {
		add_shortcode( 'sweetglossary', function() {
			// Get all glossary post types
			$args = array(
				'post_type' => 'glossary',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'orderby' => 'title',
				'order' => 'ASC',
			);

			$loop = new WP_Query( $args );

			$current_letter = '';
			$index_items = '';
			$index_item = '<div class="index-item">%s</div>';
			$index_list = '<ul>%s</ul>';
			$index_item_letter = '';
			$content = '<div class="index-search">';
			$content .= '<input type="search" id="glossary-search-box" class="search-icon" name="s" placeholder="Search in glossary">';
			$content .= '</div><div class="index-wrapper">';

			if ( $loop->have_posts() ) {

				while ( $loop->have_posts() ) :
					$loop->the_post();
					$initial = strtoupper( substr( get_the_title(), 0, 1 ) );

					if ( $initial != $current_letter ) {

						if ( $current_letter != '' ) {
							$content .= sprintf( $index_item, $index_item_letter . sprintf( $index_list, $index_items ) );
						}
						// reset
						$current_letter = $initial;
						$index_items = '';
						$index_item_letter = sprintf( '<div class="index-item-letter">%s</div>', $current_letter );
					}

					$index_items .= sprintf( '<li class><a href="%s">%s</a></li>', esc_url( get_permalink() ), get_the_title() );

				endwhile;

				$content .= sprintf( $index_item, $index_item_letter . sprintf( $index_list, $index_items ) );

			} else {
				$content .= '<div class="empty-glossary"><p>' . _x( 'We are preparing something amazing here. Check back later 🤓.', 'No glossary terms', 'sweet-glossary' ) . '</p>';
			}


			$content .= '</div>';

			wp_reset_postdata();

			return $content;
		});
	}

}
