<?php
/**
 * Cookiebot feature entrypoint.
 *
 * @package Go4Taste_Measure
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/cookiebot-script.php';

function g4t_bootstrap_measure_cookiebot_feature(): void {
    // Right after the Consent Mode default (-1), before wp_robots (1) and gtm4wp (>= 1).
    add_action( 'wp_head', 'g4t_measure_print_cookiebot', 0 );
}

g4t_bootstrap_measure_cookiebot_feature();
