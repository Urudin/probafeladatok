<?php

class DatabaseGroups extends Database
{

    protected $table_name = 'groups';

    public function __construct()
    {

    }

    public function insert($group_name, $group_code){
        // prepare and bind
        $stmt = self::$sql_link->prepare("INSERT INTO {$this->table_name} (group_name, group_code) VALUES (?, ?)");
        $stmt->bind_param("ss", $group_name, $group_code);

        // set parameters and execute
        $stmt->execute();
    }

}