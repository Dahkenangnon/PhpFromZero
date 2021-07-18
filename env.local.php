<?php

// This file is required because the core config class
// uses it to load your params and environments variables
// The entries defined by default here is required
// You can add any entry you want in the ["params"] section
return [
    "env" => "prod",
    "enableLog" => true,
    "baseurl" => "http://localhost:9000",
    "params" => [
        "maintenance" => false
    ],
    "database" => [
        "host" => "localhost",
        "user" => "root",
        "password" => "",
        "driver" => "mysql",
        "database" => "php_from_zero",
    ]
];
