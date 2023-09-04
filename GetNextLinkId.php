<?php

    include "./lib/headers.php";
    include "./lib/database.php";

    // The database_connect function is defined in lib/database.php
    // The $_SERVER variable is a PHP superglobal that contains information about the server
    // including environment variables.
    // The environment variables are defined in the Apache VirtualHost configuration file
    // which should be located at /etc/apache2/sites-available/toolbox.conf.
    $connection = database_connect(
        $_SERVER["DB_HOST"],
        $_SERVER["DB_USERNAME"],
        $_SERVER["DB_PASSWORD"],
        $_SERVER["DB_SCHEMA"]
    );
    
    $queryString = "
      SELECT AUTO_INCREMENT as link_id
      FROM information_schema.TABLES
      WHERE TABLE_SCHEMA = 'toolbox' AND TABLE_NAME = 'tbl_links';
    ";
    
    $query = mysqli_query($connection, $queryString);
    $row = mysqli_fetch_all($query, MYSQLI_ASSOC);

    echo json_encode($row);

?>