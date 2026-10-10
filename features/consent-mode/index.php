<?php
/**
 * Consent Mode feature entrypoint.
 *
 * @package Go4Taste_Measure
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/consent-default.php';

function g4t_bootstrap_measure_consent_mode_feature(): void {
    // Before wp_robots (1) and gtm4wp (>= 1), and before Cookiebot (0).
    add_action( 'wp_head', 'g4t_measure_print_consent_default', -1 );
}

g4t_bootstrap_measure_consent_mode_feature();
