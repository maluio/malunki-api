<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../app/autoload.php';

// dot env
$path = realpath(__DIR__ . '/..');
if (file_exists($path . '/.env')){
    $dotenv = new Dotenv\Dotenv($path);
    $dotenv->load();
}

if (
      getenv('SYMFONY_ENV') === 'dev'
      || getenv('SYMFONY_ENV') === 'test'
    )
{
    Debug::enable();
    $kernel = new AppKernel('dev', true);
}
else {
    include_once __DIR__.'/../var/bootstrap.php.cache';
    $kernel = new AppKernel('prod', false);
}

// Enable APC for autoloading to improve performance.
// You should change the ApcClassLoader first argument to a unique prefix
// in order to prevent cache key conflicts with other applications
// also using APC.
/*
$apcLoader = new Symfony\Component\ClassLoader\ApcClassLoader(sha1(__FILE__), $loader);
$loader->unregister();
$apcLoader->register(true);
*/

$kernel->loadClassCache();
//$kernel = new AppCache($kernel);

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
