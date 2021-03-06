<?php
/**
 * @package Newscoop
 * @author Paweł Mikołajczuk <pawel.mikolajczuk@sourcefabric.org>
 * @copyright 2012 Sourcefabric o.p.s.
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

if (!file_exists(__DIR__ . '/../vendor')) {
    echo "Missing dependency! Please install all dependencies with composer.";
    echo "<pre>curl -s https://getcomposer.org/installer | php <br/>php composer.phar install</pre>";
    die;
}

require_once __DIR__ . '/../constants.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

error_reporting(error_reporting() & ~E_STRICT & ~E_DEPRECATED);

$subdir = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/', -2));

// check if this is upgrade
if (php_sapi_name() !== 'cli' &&
    file_exists(APPLICATION_PATH . '/../conf/configuration.php') &&
    file_exists(APPLICATION_PATH . '/../conf/database_conf.php') &&
    file_exists(APPLICATION_PATH . '/../conf/upgrading.php') &&
    file_exists(APPLICATION_PATH . '/../conf/installation.php')
) {
    // it's old installation
    // remove installation mark
    @unlink(APPLICATION_PATH . '/../conf/installation.php');
}

// check if this is installation
if (php_sapi_name() !== 'cli' &&
    !defined('INSTALL') &&
    (file_exists(APPLICATION_PATH . '/../conf/installation.php'))
) {
    if (strpos($subdir, 'install') === false) {
        header("Location: $subdir/install/");
        exit;
    }
}

require_once __DIR__ . '/../application/bootstrap.php.cache';
require_once __DIR__ . '/../application/AppKernel.php';

/**
 * Create Symfony kernel
 */
if (APPLICATION_ENV === 'production') {
    $kernel = new AppKernel('prod', false);
} else if (APPLICATION_ENV === 'development' || APPLICATION_ENV === 'dev') {
    $kernel = new AppKernel('dev', true);
} else {
    $kernel = new AppKernel(APPLICATION_ENV, true);
}

$kernel->loadClassCache();
$request = Request::createFromGlobals();

try {
    if (strpos($_SERVER['REQUEST_URI'], '/api') !== false) {
        $response = $kernel->handle($request);
    } else {
        $response = $kernel->handle($request, \Symfony\Component\HttpKernel\HttpKernelInterface::MASTER_REQUEST, false);
    }

    $response->send();
    $kernel->terminate($request, $response);
} catch (NotFoundHttpException $e) {
    $container = \Zend_Registry::get('container');

    // Fill zend application options
    $config = $container->getParameterBag()->all();
    $application = new \Zend_Application(APPLICATION_ENV);
    $iniConfig = APPLICATION_PATH . '/configs/application.ini';
    if (file_exists($iniConfig)) {
        $userConfig = new \Zend_Config_Ini($iniConfig, APPLICATION_ENV);
        $config = $application->mergeOptions($config, $userConfig->toArray());
    }

    $application->setOptions($config);
    $application->bootstrap();
    $application->run();
}