<?php

class DatabaseUsers extends Database
{

    protected $table_name = 'users';

    public function __construct()
    {

    }

    public function insert($firstname, $lastname, $email){
        // prepare and bind
        $stmt = self::$sql_link->prepare("INSERT INTO users (firstname, lastname, email) VALUES (?, ?, ?)");

        $stmt->bind_param("sss", $firstname, $lastname, $email);

        // set parameters and execute
        $stmt->execute();
    }


}