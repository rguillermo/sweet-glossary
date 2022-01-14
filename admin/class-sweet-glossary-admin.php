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
	 * Register glossary settings
	 *
	 * @since    1.0.0
	 */
	public function register_glossary_settings() {
		add_settings_section(
			$this->plugin_name . '_settings',
			_x( 'Customize Sweet Glossary base slug', 'Settings option', $this->plugin_name ),
			array( $this, 'settings_description_cb' ),
			'permalink'
		);

		add_settings_field(
			$this->plugin_name . '_slug',
			_x( 'Glossary base slug', 'Settings header', $this->plugin_name ),
			array( $this, 'settings_fields_cb' ),
			'permalink',
			$this->plugin_name . '_settings'
		);

		register_setting(
			'permalink',
			$this->plugin_name . '_slug',
			array(
				'type'		=> 'string',
				'default'	=> 'glossary'
			)
		);

	}

	/**
	 * Settings description callback
	 *
	 * @since    1.0.0
	 */
	public function settings_description_cb() {
		$translation_context = 'Settings description';
		$site_url = get_site_url();
		$from = $site_url . '/<strong>glossary</strong>/sample-term';
		$to = $site_url . '/<strong>my-custom-slug</strong>/sample-term';

		$description = '<p>';
		$description .= _x( 'Here you can change the base slug of your glossary terms.', $translation_context, $this->plugin_name );
		$description .= '</p><p>';
		$description .= _x( 'For example:', $translation_context );
		$description .= '<span class="setting-example">';
		$description .= _x( 'From:', $translation_context, $this->plugin_name ) . ' ' . $from;
		$description .= '</span><span class="setting-example">';
		$description .= _x( 'To:', $translation_context, $this->plugin_name ) . ' ' . $to;
		$description .= '</span>';
		$description .= '</p><p>';
		$description .= _x( 'The default slug is', $translation_context, $this->plugin_name ) . ' <strong>"glossary"</strong>.';
		$description .= '</p>';

		echo $description;
	}

	/**
	 * Settings fields callback
	 *
	 * @since    1.0.0
	 */
	public function settings_fields_cb() {
		$name = $this->plugin_name . '_slug';
		$slug = get_option( $name, 'glossary' );
		$input = sprintf( '<input type="text" class="regular-text code" name="%s" id="%s" value="%s">', $name, $name, $slug );
		echo $input;
	}

	/**
	 * Update glossary settings in DB
	 *
	 * @since    1.0.0
	 */
	public function update_glossary_settings() {
		$option_name = $this->plugin_name . '_slug';

		if( isset($_POST['permalink_structure']) && isset( $_POST[$option_name] ) ){

			$slug = wp_unslash( $_POST[$option_name] );
			update_option( $option_name,  $slug );

		  }
	}

}
