<?php
/**
 * Admin Page Functions
 *
 * @package    Widget_Importer_Exporter
 * @subpackage Functions
 * @copyright  Copyright (c) 2013, DreamDolphin Media, LLC
 * @link       https://github.com/stevengliebe/widget-importer-exporter
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since      0.1
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/******************************************
 * IMPORT/EXPORT PAGE
 ******************************************/

/**
 * Add import/export page under Tools
 *
 * Also enqueue JavaScript for this page only.
 *
 * @since 0.1
 */
function wie_add_import_export_page() {

	// Add page
	$page_hook = add_management_page(
		__( 'Widget Importer & Exporter', 'widget-importer-exporter' ), // page title
		__( 'Widget Import/Export', 'widget-importer-exporter' ), // menu title
		'manage_options', // capability
		'widget-importer-exporter', // menu slug
		'wie_import_export_page_content' // callback for displaying page content
	);

	// Enqueue JavaScript
 	add_action( 'admin_print_scripts-' . $page_hook, 'wie_enqueue_import_export_scripts' );

}

add_action( 'admin_menu', 'wie_add_import_export_page' ); // register post type

/**
 * Enqueue JavaScript for import/export page
 *
 * @since 0.1
 */
function wie_enqueue_import_export_scripts() {
	wp_enqueue_script( 'wie-main', WIE_URL . '/js/import-export.js', array( 'jquery' ), WIE_VERSION ); // bust cache on update
}

add_action( 'wp_enqueue_scripts', 'wie_enqueue_scripts' );


/**
 * Import/export page content
 *
 * @since 0.1
 */
function wie_import_export_page_content() {

	?>

	<div class="wrap">

		<?php screen_icon(); ?>

		<h2><?php _e( 'Widget Importer & Exporter', 'widget-importer-exporter' ); ?></h2>

		<h3 class="title"><?php _ex( 'Import Widgets', 'heading', 'widget-importer-exporter' ); ?></h3>

		<p>
			<?php _e( 'Please select a .json file to import.', 'widget-importer-exporter' ); ?>
		</p>

		<form method="post" action="">
		
			<?php wp_nonce_field( 'wie_import_nonce', 'wie_import_nonce' ); ?>

			<input type="file" name="wie_import_file" id="wie-import-file" />

			<?php submit_button( _x( 'Import Widgets', 'button', 'widget-importer-exporter' ) ); ?>

		</form>

		<h3 class="title"><?php _ex( 'Export Widgets', 'heading', 'widget-importer-exporter' ); ?></h3>

		<p>
			<?php _e( 'Click below to generate an importable .json file.', 'widget-importer-exporter' ); ?>
		</p>

		<p class="submit">
			<a href="<?php echo esc_url( admin_url( basename( $_SERVER['PHP_SELF'] ) . '?page=' . $_GET['page'] . '&export=1' ) ); ?>" id="wie-export-button" class="button button-primary"><?php _ex( 'Export Widgets', 'button', 'widget-importer-exporter' ); ?></a>
		</p>

	</div>

	<?php

}