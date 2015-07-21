<?php
/**
 * Bring together the MQTT client, doctrine2 entities and business logic to handle subsriptions on
 * topics pushed out from sensor network over MQTT.
 *
 * With included doctrine2-orm/bootstrap.php file,
 *	the doctrine2-orm EntityManager [$entityManager] is available to this scope.
 */
namespace gsna;

use gsna\mqtt\Client;

require_once("./bootstrap.php");

// set error reporting
error_reporting(E_ALL);

$subs = "topic_id/#";
$qos = 2;

// create mqtt client instance for each substription to monitor
// pass to the constructor the subscription id
$c = new Client($entityManager, "gsna-MQTT-msgs"); // subscription id is passed to constructor
$c->connect('localhost', 1883, 50);
$c->subscribe($subs, $qos);

$c->loopForever();

//for ($i = 0; $i < 5; $i++) {
//	$c->loop(10);
//}
