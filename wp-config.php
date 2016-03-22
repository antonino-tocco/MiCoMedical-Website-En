<?php
/**
 * Il file base di configurazione di WordPress.
 *
 * Questo file viene utilizzato, durante l’installazione, dallo script
 * di creazione di wp-config.php. Non è necessario utilizzarlo solo via
 * web, è anche possibile copiare questo file in «wp-config.php» e
 * riempire i valori corretti.
 *
 * Questo file definisce le seguenti configurazioni:
 *
 * * Impostazioni MySQL
 * * Prefisso Tabella
 * * Chiavi Segrete
 * * ABSPATH
 *
 * È possibile trovare ultetriori informazioni visitando la pagina del Codex:
 *
 * @link https://codex.wordpress.org/it:Modificare_wp-config.php
 *
 * È possibile ottenere le impostazioni per MySQL dal proprio fornitore di hosting.
 *
 * @package WordPress
 */

// ** Impostazioni MySQL - È possibile ottenere queste informazioni dal proprio fornitore di hosting ** //
/** Il nome del database di WordPress */
define('DB_NAME', 'micomedical-website-en');

/** Nome utente del database MySQL */
define('DB_USER', 'root');

/** Password del database MySQL */
define('DB_PASSWORD', '121190*et');

/** Hostname MySQL  */
define('DB_HOST', 'localhost');

/** Charset del Database da utilizzare nella creazione delle tabelle. */
define('DB_CHARSET', 'utf8');

/** Il tipo di Collazione del Database. Da non modificare se non si ha idea di cosa sia. */
define('DB_COLLATE', '');

/**#@+
 * Chiavi Univoche di Autenticazione e di Salatura.
 *
 * Modificarle con frasi univoche differenti!
 * È possibile generare tali chiavi utilizzando {@link https://api.wordpress.org/secret-key/1.1/salt/ servizio di chiavi-segrete di WordPress.org}
 * È possibile cambiare queste chiavi in qualsiasi momento, per invalidare tuttii cookie esistenti. Ciò forzerà tutti gli utenti ad effettuare nuovamente il login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'e->}+s`P1ESj7P9ZA=&/Jn@):S,vZyi(U4^}30AoT-y/[+7$9,]nP:5uGM(B;;$]');
define('SECURE_AUTH_KEY',  'G!YtB!C$KXej|y{A[`zf[ur(0pdRpQa@is&[+pPK:ws*j@78Ar2dm$sNL;s1Y qh');
define('LOGGED_IN_KEY',    'z+^50h]Q^R=1/-9Q6J{|(o`8X-C|ba:a7?&/N}&N}+M8CsvyaCYi{f+CH&V40&Hv');
define('NONCE_KEY',        '<][jv&*h 6Ry)c+!3.ddyg?w1*A=T#t[nh8So+mgl6_&v/v)we+<5+zWf?.zLUf$');
define('AUTH_SALT',        '-!<(mdPl00>#l6O#ySLs Vm<k^UXH)bI;NF I}<NApaH)/z]_ytpffiv[9i!0Mv:');
define('SECURE_AUTH_SALT', '1hd+``WvS`S9&5pxxCR} v3Y2S=D}A[XzYBOH_/z]FLj#-{F*f!8|S=o5(MF*a1]');
define('LOGGED_IN_SALT',   '?K;Ne_*vbZ}3%d!3E]~5jwH!@>w_R%9;S4r-@ry.r52-)7)r-/+3~d`U]J|j*!NB');
define('NONCE_SALT',       'MsbRqZ0.2l]8<]s>f7$d9[7D&G(|0Kyt@w+;%)+hJ~|!^,`s#+G|B>8]+G}Xo5Q^');

/**#@-*/

/**
 * Prefisso Tabella del Database WordPress.
 *
 * È possibile avere installazioni multiple su di un unico database
 * fornendo a ciascuna installazione un prefisso univoco.
 * Solo numeri, lettere e sottolineatura!
 */
$table_prefix  = 'wp_';

/**
 * Per gli sviluppatori: modalità di debug di WordPress.
 *
 * Modificare questa voce a TRUE per abilitare la visualizzazione degli avvisi
 * durante lo sviluppo.
 * È fortemente raccomandato agli svilupaptori di temi e plugin di utilizare
 * WP_DEBUG all’interno dei loro ambienti di sviluppo.
 */
define('WP_DEBUG', false);

/* Finito, interrompere le modifiche! Buon blogging. */

/** Path assoluto alla directory di WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Imposta le variabili di WordPress ed include i file. */
require_once(ABSPATH . 'wp-settings.php');