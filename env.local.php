<?php

// This file is required because the core config class
// uses it to load your params and environments variables
// The entries defined by default here is required
// You can add any entry you want in the ["params"] section

//Warning: This file may normally be ignored by git (listed in .gitignore file) but to allow you to edit it, it's left here, so in real project don't forget to remove it

return [
    "env" => "dev",
    "enableLog" => false,
    "baseurl" => "http://localhost:9000",
    "params" => [
        "maintenance" => false,
        "maintenance_msg" => "We are now working on the site. Please see you later"
    ],
    "database" => [
        "host" => "localhost",
        "user" => "root",
        "password" => "",
        "driver" => "mysql",
        "database" => "php_from_zero",
    ]
];
