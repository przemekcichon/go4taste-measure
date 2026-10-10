<?php
/**
 * Cookiebot uc.js loaded directly instead of through GTM.
 *
 * @package Go4Taste_Measure
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function g4t_measure_print_cookiebot(): void {
    if ( ! g4t_measure_platform_enabled( 'cookiebot' ) ) {
        return;
    }

    $cbid = g4t_measure_cookiebot_cbid();

    if ( '' === $cbid ) {
        return;
    }

    echo '<link rel="preconnect" href="' . esc_url( 'https://consent.cookiebot.com' ) . '">' . "\n";

    wp_print_script_tag(
        array(
            'id'                => 'Cookiebot',
            'src'               => 'https://consent.cookiebot.com/uc.js',
            'data-cbid'         => $cbid,
            'data-blockingmode' => g4t_measure_cookiebot_blocking_mode(),
            'type'              => 'text/javascript',
            'async'             => g4t_measure_cookiebot_async(),
        )
    );
}
