<?php
/**
 * Plugin Name:       Go4Taste Measure
 * Plugin URI:        https://github.com/przemekcichon/go4taste-measure
 * Description:       Consent Mode defaults and Cookiebot early in &lt;head&gt;. Configured with G4T_MEASURE_* constants in wp-config.php.
 * Version:           0.1.0
 * Requires at least: 6.4
 * Requires PHP:      7.4
 * Author:            Go4Taste Techlab
 * Author URI:        https://go4taste.pl/techlab/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       go4taste-measure
 *
 * @package Go4Taste_Measure
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'GO4TASTE_MEASURE_VERSION', '0.1.0' );
define( 'GO4TASTE_MEASURE_PATH', plugin_dir_path( __FILE__ ) );

require_once GO4TASTE_MEASURE_PATH . 'core/config.php';
require_once GO4TASTE_MEASURE_PATH . 'features/consent-mode/index.php';
require_once GO4TASTE_MEASURE_PATH . 'features/cookiebot/index.php';
