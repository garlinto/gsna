<?php
// bootstrap.php
use Doctrine\ORM\Tools\Setup,
		Doctrine\ORM\EntityManager,
		Doctrine\ORM\Configuration;


require_once "vendor/autoload.php";

$isDevMode = true;

$config = Setup::createAnnotationMetadataConfiguration(array("/home/pi/gsna/src/Entities"), $isDevMode);

if (true === $isDevMode) {
	$cache = new \Doctrine\Common\Cache\ApcCache;
} else {
  $cache = new \Doctrine\Common\Cache\ArrayCache;
}

$config = new Configuration;
$config->setMetadataCacheImpl($cache);
$driverImpl = $config->newDefaultAnnotationDriver('/home/pi/gsna/src/Entities');
$config->setMetadataDriverImpl($driverImpl);
$config->setQueryCacheImpl($cache);
$config->setProxyDir('/home/pi/gsna/src/Proxies');
$config->setProxyNamespace('gsna\src\Proxies');
$config->setAutoGenerateProxyClasses($isDevMode);

// database connection parameters
$dbConn = array(
    'driver'   => 'pdo_pgsql',
    'user'     => 'www-data',
    'password' => 'li77ybu9',
    'dbname'   => 'garlinto',
    'schema'   => 'public',
);

// obtaining the entity manager
$entityManager = EntityManager::create($dbConn, $config);
