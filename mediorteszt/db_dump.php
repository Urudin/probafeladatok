<?php

include('constants.php');
require('vendor/autoload.php');

Spatie\DbDumper\Databases\MySql::create()
    ->setDbName(MYSQL_DATABASE)
    ->setUserName(MYSQL_USER)
    ->setPassword(MYSQL_PASSWORD)
    ->dumpToFile('dump.sql');