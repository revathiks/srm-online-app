<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Config for Rabbit MQ Library
 */
$config['rabbitmq_client'] = array(
    'host' => '172.16.5.227',     // <- Your Host       (default: localhost)
   // 'host' => '172.16.5.22',     // <- Your Host       (default: localhost)
   // 'host' => '172.16.0.103',     // <- Your Host       (default: localhost)
    // 'host' => '172.16.5.227',     // <- Your Host       (default: localhost)
    //'host' => '172.16.5.227',     // <- Your Host       (default: localhost)
   // 'host' => 'localhost',     // <- Your Host       (default: localhost)
    'port' => 5672,            // <- Your Port       (default: 5672)
    'user' => 'srmuser',      // <- Your User       (default: guest)
    'pass' => 'srmuser@123',      // <- Your Password   (default: guest)
	/*'user' => 'guest', 
    'pass' => 'guest', */
    'vhost' => '/',            // <- Your Vhost      (default: /)
    'allowed_methods' => null, // <- Allowed methods (default: null)
    'non_blocking' => false,   // <- Your Host       (default: false)
    'timeout' => 10             // <- Timeout         (default: 0)     
);
// $config['show_output'] = 1;