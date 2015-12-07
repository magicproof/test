<?php

return array(
    'database'     => array(
        'name'     => 'MySql',
        'host'     => 'sql302.byethost9.com',
        'dbName'   => 'b9_15681362_final',
        'login'    => 'b9_15681362',
        'password' => 'winlocker',
        'options'  => array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        )
    ),
);
