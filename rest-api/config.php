<?php
$config = array(
    'database_name' => 'hotel',
    'database_host' => 'hotel.loc',
    'database_user' => 'root',
    'database_password' => 'q12wE#$R',
    'database_prefix' => '',
    'database_engine' => 'InnoDB'
);

define('_DB_SERVER_', $config['database_host']);
define('_DB_NAME_', $config['database_name']);
define('_DB_USER_', $config['database_user']);
define('_DB_PASS_', $config['database_password']);
define('_DB_PREFIX_', $config['database_prefix']);
define('_MYSQL_ENGINE_', $config['database_engine']);
