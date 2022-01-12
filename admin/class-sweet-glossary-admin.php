<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://techpecialist.com/
 * @since      1.0.0
 *
 * @package    Sweet_Glossary
 * @subpackage Sweet_Glossary/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sweet_Glossary
 * @subpackage Sweet_Glossary/admin
 * @author     Techpecialist <dev@techpecialist.com>
 */
class Sweet_Glossary_Admin {

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
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	*/
	private $option_name = 'sweetglossary_setting';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sweet-glossary-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sweet-glossary-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Output the plugin HTML for settings area.
	 *
	 * @since    1.0.0
	 */
	public function options_page_html() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		?>
		<div class="wrap">
		  <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
		  <form action="options.php" method="post">
			<?php
			settings_errors();
			settings_fields( $this->plugin_name );
			do_settings_sections( $this->plugin_name );
			submit_button( __( 'Save', 'sweetglossary' ) );
			?>
		  </form>
		</div>
		<?php
	}

	/**
	 * Register settings fields.
	 *
	 * @since    1.0.0
	 */
	public function register_sweet_glossary_settings() {
		// Add archive page section
		add_settings_section(
			$this->option_name . '_archive',
			__( 'Glossary archive page settings', 'sweetglossary' ),
			array( $this, $this->option_name . '_archive_cb' ),
			$this->plugin_name
		);

		// Add title field
		add_settings_field(
			$this->option_name . '_title',
			__( 'Title', 'sweetglossary' ),
			array( $this, $this->option_name . '_title_cb' ),
			$this->plugin_name,
			$this->option_name . '_archive',
			array( 'label_for' => $this->option_name . '_title' )
		);

		// Add content field
		add_settings_field(
			$this->option_name . '_content',
			__( 'Content', 'sweetglossary' ),
			array( $this, $this->option_name . '_content_cb' ),
			$this->plugin_name,
			$this->option_name . '_archive',
			array( 'label_for' => $this->option_name . '_content' )
		);

		// Add searchbox placeholder field
		add_settings_field(
			$this->option_name . '_placeholder',
			__( 'Search box placeholder', 'sweetglossary' ),
			array( $this, $this->option_name . '_sb_placeholder_cb' ),
			$this->plugin_name,
			$this->option_name . '_archive',
			array( 'label_for' => $this->option_name . '_cplaceholder' )
		);

		register_setting( $this->plugin_name, $this->option_name . '_title' );
		register_setting( $this->plugin_name, $this->option_name . '_content' );
		register_setting( $this->plugin_name, $this->option_name . '_placeholder' );
	}

	/**
	 * Render HTML for the archive settings section
	 *
	 * @since    1.0.0
	 */
	public function sweetglossary_setting_archive_cb() {
		echo '<p>' . __( 'Fill the content for glossary archive page to improve the SEO', 'sweetglossary' ) . '</p>';
	}


	/**
	 * Callback to output the glossary archive title field
	 *
	 * @since    1.0.0
	 */
	public function sweetglossary_setting_title_cb() {
		$title = get_option($this->option_name . '_title', __( 'Glossary terms', 'sweetglossary' ));
		echo '<input type="text" name="' . $this->option_name . '_title" value="' . $title . '">';
	}

	/**
	 * Callback to output the glossary archive content field
	 *
	 * @since    1.0.0
	 */
	public function sweetglossary_setting_content_cb() {
		$content = get_option($this->option_name . '_content');
		wp_editor( $content, $this->option_name . '_content' );
	}

	/**
	 * Callback to output the glossary archive search box placeholder
	 *
	 * @since    1.0.0
	 */
	public function sweetglossary_setting_sb_placeholder_cb() {
		$placeholder = get_option($this->option_name . '_placeholder', __( 'Search in glossary', 'sweetglossary' ) );
		echo '<input type="text" name="' . $this->option_name . '_placeholder" value="' . $placeholder . '">';
	}

	/**
	 * Register Sweet Glossary menu.
	 *
	 * @since    1.0.0
	 */
	public function add_sweet_glossary_menu() {
		add_submenu_page(
			'options-general.php',
			'Sweet Glossary Settings',
			'Glossary',
			'manage_options',
			$this->plugin_name,
			array( $this, 'options_page_html' ),
		);
	}

	/**
	 * Add link to settings page.
	 *
	 * @since    1.0.0
	 */
	public function add_settings_link( $links ) {
		$mylinks = array(
			'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">Settings</a>',
		);
		return array_merge( $links, $mylinks );
	}

}
