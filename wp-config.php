<?php
/**
 * Configurarea de bază WordPress.
 *
 * Fișierul wp-config.php este utilizat pentru configurarea WordPress.
 * Editează valorile de mai jos conform configurației tale locale (baza de date etc.).
 *
 * @package WordPress
 */

// ** Setările bazei de date - Obțineți aceste informații de la furnizorul de hosting ** //
/** Numele bazei de date pentru WordPress */
define( 'DB_NAME', 'wordpress' );

/** Utilizatorul bazei de date MySQL */
define( 'DB_USER', 'root' );

/** Parola bazei de date MySQL */
define( 'DB_PASSWORD', '' );

/** Hostname-ul MySQL */
define( 'DB_HOST', 'localhost' );

/** Setul de caractere al bazei de date utilizat la crearea tabelelor. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Tipul de colație al bazei de date. Nu schimba dacă nu ești sigur. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chei unice de autentificare și săruri.
 * Generează-le de la: https://api.wordpress.org/secret-key/1.1/salt/
 */
define( 'AUTH_KEY',         'pune-valori-unice-aici' );
define( 'SECURE_AUTH_KEY',  'pune-valori-unice-aici' );
define( 'LOGGED_IN_KEY',    'pune-valori-unice-aici' );
define( 'NONCE_KEY',        'pune-valori-unice-aici' );
define( 'AUTH_SALT',        'pune-valori-unice-aici' );
define( 'SECURE_AUTH_SALT', 'pune-valori-unice-aici' );
define( 'LOGGED_IN_SALT',   'pune-valori-unice-aici' );
define( 'NONCE_SALT',       'pune-valori-unice-aici' );

/**#@-*/

/**
 * Prefixul tabelelor WordPress.
 * Modifică dacă rulezi mai multe instalări WordPress în aceeași bază de date.
 */
$table_prefix = 'wp_';

/**
 * Pasul 1 - Activarea modului de depanare (WP_DEBUG).
 *
 * Se recomandă EXCLUSIV pentru mediul local de dezvoltare.
 * NU activa pe un site de producție.
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', true );
@ini_set( 'display_errors', '1' );

/** Activează actualizările automate pentru pluginuri și teme. */
define( 'WP_AUTO_UPDATE_CORE', false );

/** Calea absolută către directorul WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** Setează variabilele WordPress și fișierele incluse. */
require_once ABSPATH . 'wp-settings.php';
