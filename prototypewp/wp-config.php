<?php
# Database Configuration
define( 'DB_NAME', 'wp_alumniuia' );
define( 'DB_USER', 'alumniuia' );
define( 'DB_PASSWORD', 'rvqXj1TqHMT7Aqerr2Hh' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         'V.7Y^6|MM_G+O[q^i<1:Od@ 33=~g-3IlN@.B2Lr|>2k7Ejn2~u=X|<j}&xbbWLV');
define('SECURE_AUTH_KEY',  'Vecz{77t8N.bG6T0u-icB}]<^OaUXelh|,|Nz&D}+S1((fWm2O{~+FeI#!4$0WTL');
define('LOGGED_IN_KEY',    '?OUZNY8k)hMiuH>3r-&xv=UGuk-D2$`niQ}gsv}tp[GX 5}w4y3kp`ruy$Ut?UfH');
define('NONCE_KEY',        '>IetoGS0C,meBmC2n+PPM^*CQrL}>?h*KN6Nq~hl#nWQv;Bt5^+RIK~uIYiv8u!-');
define('AUTH_SALT',        'fE>SVtm{N|-x89L+IOao$5_et)5wY]aLQGKnI|c%09iR]DR}8ltkzh&6,RM?e>1W');
define('SECURE_AUTH_SALT', '@p5r*0CWEw*RX2Yri ;L[k4ZOD%OpFc#k6Y$crqxuB$ (`{,-_t=a|-RG+L6eHb^');
define('LOGGED_IN_SALT',   ':R[A?j|Q6BG,fq|ey;G{V(v.jaHpGq|^y;O$)I2L-k[&pz4kD53)xT!-Wn0O[fH^');
define('NONCE_SALT',       ',glR~}q5v|qypCQ6k(PE.B.vbL3fq5b:Rx|q#84.rbmCJPzmi}2,Cg)5BL1~KcCH');


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'alumniuia' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'PWP_ROOT_DIR', '/nas/wp' );

define( 'WPE_APIKEY', '3bf86522850a01bbbfbe79e01b0a6a6bd98878b3' );

define( 'WPE_CLUSTER_ID', '101398' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '' );

define( 'WPE_CDN_DISABLE_ALLOWED', true );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'alumniuia.wpengine.com', );

$wpe_varnish_servers=array ( 0 => 'pod-101398', );

$wpe_special_ips=array ( 0 => '35.189.124.249', );

$wpe_ec_servers=array ( );

$wpe_largefs=array ( );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings






# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}
