<?php
/**
 * @package Campsite
 *
 * @author Holman Romero <holman.romero@gmail.com>
 * @copyright 2007 MDLF, Inc.
 * @license http://www.gnu.org/licenses/gpl.txt
 * @version $Revision$
 * @link http://www.sourcefabric.org
 */

// some installation parts tend to take long time
set_time_limit(0);

define('INSTALL', TRUE);
define('DONT_BOOTSTRAP_ZEND', TRUE);

require_once __DIR__ . '/../constants.php';

$templates_cache = dirname(dirname(__FILE__)) . '/cache';
$logs = dirname(dirname(__FILE__)) . '/log';
$proxy = dirname(dirname(__FILE__)) . '/library/Proxy';
$themes = dirname(dirname(__FILE__)) . '/themes';

$templates_cache_not_writable = !is_writable($templates_cache);
$logs_not_writable = !is_writable($logs);
$proxy_not_writable = !is_writable($proxy);
$themes_not_writable = !is_writable($themes);

if ($templates_cache_not_writable || $logs_not_writable || $proxy_not_writable || $themes_not_writable) {
    echo '<!DOCTYPE html>';
    echo '<html><head><meta charset="utf-8" />';
    echo '<title>Install requirement</title>';
    echo '<link rel="shortcut icon" href="' . $GLOBALS['g_campsiteDir'] . '/admin-style/images/7773658c3ccbf03954b4dacb029b2229.ico" />';
    echo '</head><body>';
    echo '<h1>Install requirement</h1>';

    if ($templates_cache_not_writable) {
        echo "<p>Directory '$templates_cache' is not writable.</p>";
        echo "<p>Please make it writable in order to continue. (i.e. <code>$ sudo chmod -R 777 $templates_cache</code> on linux)</p>";
    }

    if ($logs_not_writable) {
        echo "<p>Directory '$logs' is not writable.</p>";
        echo "<p>Please make it writable in order to continue. (i.e. <code>$ sudo chmod -R 777 $logs</code> on linux)</p>";
    }

    if ($proxy_not_writable) {
        echo "<p>Directory '$proxy' is not writable.</p>";
        echo "<p>Please make it writable in order to continue. (i.e. <code>$ sudo chmod -R 777 $proxy</code> on linux)</p>";
    }

    if ($themes_not_writable) {
        echo "<p>Directory '$themes' is not writable.</p>";
        echo "<p>Please make it writable in order to continue. (i.e. <code>$ sudo chmod -R 777 $themes</code> on linux)</p>";
    }

    echo '</body></html>';
    exit;
}

unset($templates_cache);

require_once __DIR__ . '/../application.php';
require_once($GLOBALS['g_campsiteDir'].'/include/campsite_constants.php');
require_once($GLOBALS['g_campsiteDir'].'/install/classes/CampInstallation.php');
require_once(CS_PATH_CONFIG.'/install_conf.php');

if (!file_exists(APPLICATION_PATH . '/../conf/configuration.php') &&
    !file_exists(APPLICATION_PATH . '/../conf/database_conf.php') &&
    file_exists(APPLICATION_PATH . '/../conf/upgrading.php') &&
    file_exists(APPLICATION_PATH . '/../conf/installation.php')
) {
    // it's clear installation - remove upgrading
    @unlink(APPLICATION_PATH . '/../conf/upgrading.php');
}

// installation is done - redirect to main page.
if (!file_exists(APPLICATION_PATH . '/../conf/installation.php')) {
    header("Location: ". CS_PATH_BASE_URL . str_replace('/install', '', $Campsite['SUBDIR']));
}

$install = new CampInstallation();
$install->initSession();

$step = $install->execute();
$install->dispatch($step);
$install->render();

if ($step == 'finish') {
    $template = CampTemplate::singleton();
    $template->clearCache();
}