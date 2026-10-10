<?php
/**
 * Inline gtag() call with the Consent Mode default state.
 *
 * @package Go4Taste_Measure
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function g4t_measure_print_consent_default(): void {
    if ( ! g4t_measure_platform_enabled( 'consent-mode' ) ) {
        return;
    }

    $consent         = g4t_measure_consent_defaults();
    $wait_for_update = g4t_measure_consent_wait_for_update();

    if ( null !== $wait_for_update ) {
        $consent['wait_for_update'] = $wait_for_update;
    }

    $js = "\n"
        . "window.dataLayer = window.dataLayer || [];\n"
        . "function gtag() {\n"
        . "    dataLayer.push(arguments);\n"
        . "}\n"
        . "gtag('consent', 'default', " . wp_json_encode( $consent ) . ");\n"
        . "gtag('set', 'ads_data_redaction', " . wp_json_encode( g4t_measure_ads_data_redaction() ) . ");\n"
        . "gtag('set', 'url_passthrough', " . wp_json_encode( g4t_measure_url_passthrough() ) . ");\n";

    wp_print_inline_script_tag( $js, array( 'id' => 'g4t-measure-consent-default' ) );
}
