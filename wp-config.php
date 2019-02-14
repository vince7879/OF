<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'onefootball');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'IlN}D(]ZSYP`^PSYmZG8_^D?&sz`!vcD^[hwLIe:ivuNR?[q ODH#!Un(=]tcDmJ');
define('SECURE_AUTH_KEY',  '{Ev0c7,ysmfh`*fLQK/otl+7@XSbD*-w8 a ^(T2>.AViTVQwJbtMy=dt5lOY>!>');
define('LOGGED_IN_KEY',    ',zdZW7]BB`DUFaRM`cmq3hU6}O*)>]F3@u{J[Oe[UcuZi-QBCiEWbyEn{;Eql.K#');
define('NONCE_KEY',        'x!;kZAQf;>9jshVA,yl^IDG}4PTj5.D[2sryuAr%/yE[CC~zC}tT$il`6Wbptg;)');
define('AUTH_SALT',        'c=.OP~/L`8WHagf:bq.-Wr|,Xxd_Yir6y@oXw/,RDxe;p7&gSoEW WGT*tS8~@L^');
define('SECURE_AUTH_SALT', '1;1p3G&-K~8-&7SXlt.&_2PdIv~x;MnE%P5!|,V}Nc&;:@yy92Wcx=fQlzw`f_n$');
define('LOGGED_IN_SALT',   'm m]+;!-mRxOKB,4+*ydVW;~KJ(,51Gbn6i<+ PN4Kv>Ru&f6$,,ef.`=LpY48Z(');
define('NONCE_SALT',       'X_E{Se%gzN.HDx^6Mg2sk_h7R#LN]KhKWMy?gFBv)b3?88ck3gj,Y{P;VDpL|>}T');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');