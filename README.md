# Go4Taste Measure

WordPress plugin for go4taste.pl/przepisy that outputs measurement and consent
tags early in `<head>`.

Platforms are enabled with constants in `wp-config.php`. There is no admin
panel. Without `G4T_MEASURE_PLATFORMS` the plugin outputs nothing.

## Configuration (`wp-config.php`)

Only `G4T_MEASURE_PLATFORMS` is required. Platform `cookiebot` also needs
`G4T_MEASURE_COOKIEBOT_CBID`. Everything else is optional. A missing constant,
or one with an invalid type or value, falls back to the default.

| constant | type | default (missing or invalid) | meaning |
|---|---|---|---|
| `G4T_MEASURE_PLATFORMS` | `array` | nothing is printed | enabled platforms: `'consent-mode'`, `'cookiebot'` |
| `G4T_MEASURE_CONSENT_DEFAULTS` | `array` | all 7 keys `'denied'` | overrides for `ad_personalization`, `ad_storage`, `ad_user_data`, `analytics_storage`, `functionality_storage`, `personalization_storage`, `security_storage` → `'granted'` / `'denied'`; unknown keys are ignored |
| `G4T_MEASURE_CONSENT_WAIT_FOR_UPDATE` | `int` (ms, ≥ 0) | no `wait_for_update` key in `consent default` | how long tags wait for a consent update |
| `G4T_MEASURE_ADS_DATA_REDACTION` | `bool` | `true` | `gtag('set', 'ads_data_redaction', …)` |
| `G4T_MEASURE_URL_PASSTHROUGH` | `bool` | `false` | `gtag('set', 'url_passthrough', …)` |
| `G4T_MEASURE_COOKIEBOT_CBID` | `string` (`[A-Za-z0-9-]`) | platform `cookiebot` prints nothing | Cookiebot `data-cbid` |
| `G4T_MEASURE_COOKIEBOT_BLOCKING_MODE` | `string` | `'manual'` | `data-blockingmode`: `'manual'` or `'auto'` |
| `G4T_MEASURE_COOKIEBOT_ASYNC` | `bool` | `true` | `async` attribute on the Cookiebot script |

Production example:

```php
define( 'G4T_MEASURE_PLATFORMS', array( 'consent-mode', 'cookiebot' ) );
define( 'G4T_MEASURE_COOKIEBOT_CBID', 'c03b21af-d095-4884-b122-6f5f7c9baf76' );
define( 'G4T_MEASURE_COOKIEBOT_BLOCKING_MODE', 'manual' );
```

All optional constants (values shown are examples, not defaults):

```php
define( 'G4T_MEASURE_CONSENT_DEFAULTS', array(
    'functionality_storage' => 'granted',
    'security_storage'      => 'granted',
) );
define( 'G4T_MEASURE_CONSENT_WAIT_FOR_UPDATE', 500 );
define( 'G4T_MEASURE_ADS_DATA_REDACTION', true );
define( 'G4T_MEASURE_URL_PASSTHROUGH', false );
define( 'G4T_MEASURE_COOKIEBOT_ASYNC', true );
```

Both blocks are printed on `wp_head` before gtm4wp: Consent Mode default at
priority `-1`, Cookiebot at `0`.

## Issues

Issues and decisions live in
[`przemekcichon/go4taste-przepisy-meta`](https://github.com/przemekcichon/go4taste-przepisy-meta/issues)
(label `repo:measure`).
