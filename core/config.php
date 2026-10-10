<?php
/**
 * Reads and validates the G4T_MEASURE_* constants from wp-config.php.
 *
 * A missing or invalid constant falls back to its default.
 *
 * @package Go4Taste_Measure
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Whether a platform is listed in G4T_MEASURE_PLATFORMS.
 *
 * Without the constant no platform is enabled.
 */
function g4t_measure_platform_enabled( string $platform ): bool {
    if ( ! defined( 'G4T_MEASURE_PLATFORMS' ) || ! is_array( G4T_MEASURE_PLATFORMS ) ) {
        return false;
    }

    return in_array( $platform, G4T_MEASURE_PLATFORMS, true );
}

/**
 * Consent Mode default state, every key 'denied' unless overridden.
 *
 * Unknown keys and values other than 'granted'/'denied' are ignored.
 *
 * @return array<string, string>
 */
function g4t_measure_consent_defaults(): array {
    $defaults = array(
        'ad_personalization'      => 'denied',
        'ad_storage'              => 'denied',
        'ad_user_data'            => 'denied',
        'analytics_storage'       => 'denied',
        'functionality_storage'   => 'denied',
        'personalization_storage' => 'denied',
        'security_storage'        => 'denied',
    );

    if ( ! defined( 'G4T_MEASURE_CONSENT_DEFAULTS' ) || ! is_array( G4T_MEASURE_CONSENT_DEFAULTS ) ) {
        return $defaults;
    }

    foreach ( G4T_MEASURE_CONSENT_DEFAULTS as $key => $value ) {
        if ( isset( $defaults[ $key ] ) && in_array( $value, array( 'granted', 'denied' ), true ) ) {
            $defaults[ $key ] = $value;
        }
    }

    return $defaults;
}

/**
 * Consent Mode wait_for_update in milliseconds, or null when the key must be omitted.
 */
function g4t_measure_consent_wait_for_update(): ?int {
    if ( ! defined( 'G4T_MEASURE_CONSENT_WAIT_FOR_UPDATE' ) || ! is_int( G4T_MEASURE_CONSENT_WAIT_FOR_UPDATE ) ) {
        return null;
    }

    return G4T_MEASURE_CONSENT_WAIT_FOR_UPDATE >= 0 ? G4T_MEASURE_CONSENT_WAIT_FOR_UPDATE : null;
}

function g4t_measure_ads_data_redaction(): bool {
    return g4t_measure_bool_constant( 'G4T_MEASURE_ADS_DATA_REDACTION', true );
}

function g4t_measure_url_passthrough(): bool {
    return g4t_measure_bool_constant( 'G4T_MEASURE_URL_PASSTHROUGH', false );
}

/**
 * Cookiebot domain group ID, or '' when missing or malformed.
 */
function g4t_measure_cookiebot_cbid(): string {
    if ( ! defined( 'G4T_MEASURE_COOKIEBOT_CBID' ) || ! is_string( G4T_MEASURE_COOKIEBOT_CBID ) ) {
        return '';
    }

    return 1 === preg_match( '/^[A-Za-z0-9-]+$/', G4T_MEASURE_COOKIEBOT_CBID ) ? G4T_MEASURE_COOKIEBOT_CBID : '';
}

/**
 * Cookiebot data-blockingmode: 'manual' (default) or 'auto'.
 */
function g4t_measure_cookiebot_blocking_mode(): string {
    if ( defined( 'G4T_MEASURE_COOKIEBOT_BLOCKING_MODE' ) && in_array( G4T_MEASURE_COOKIEBOT_BLOCKING_MODE, array( 'manual', 'auto' ), true ) ) {
        return G4T_MEASURE_COOKIEBOT_BLOCKING_MODE;
    }

    return 'manual';
}

function g4t_measure_cookiebot_async(): bool {
    return g4t_measure_bool_constant( 'G4T_MEASURE_COOKIEBOT_ASYNC', true );
}

/**
 * Value of a boolean constant, or $default when it is missing or not a bool.
 */
function g4t_measure_bool_constant( string $name, bool $default ): bool {
    if ( defined( $name ) && is_bool( constant( $name ) ) ) {
        return constant( $name );
    }

    return $default;
}
