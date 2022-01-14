<?php

/**
 * Fired during plugin activation
 *
 * @link       https://techpecialist.com/
 * @since      1.0.0
 *
 * @package    Sweet_Glossary
 * @subpackage Sweet_Glossary/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Sweet_Glossary
 * @subpackage Sweet_Glossary/includes
 * @author     Techpecialist <dev@techpecialist.com>
 */
class Sweet_Glossary_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		// require_once SWEET_GLOSSARY_PATH . 'public/class-sweet-glossary-public.php';
		$plugin_public = new Sweet_Glossary_Public( PLUGIN_NAME, SWEET_GLOSSARY_VERSION );
		$plugin_public->register_cpt_glossary();
		flush_rewrite_rules();
	}

}
