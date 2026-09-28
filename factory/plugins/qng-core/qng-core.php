<?php
/**
 * Plugin Name: QNG Core
 * Plugin URI: https://github.com/lvsang78/qng-webfactory
 * Description: Core functionality for QNG WebFactory.
 * Version: 1.0.0
 * Author: QNG WebFactory
 * Author URI: https://github.com/lvsang78
 * License: GPL-2.0-or-later
 * Text Domain: qng-core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/src/Core/Bootstrap.php';

\QNG\Core\Core\Bootstrap::boot();