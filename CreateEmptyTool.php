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

    // Build the MySQL query string for retrieving all tools.
    $queryString = "
      INSERT INTO tbl_tool (icon_link, title, short_desc, docs_link, long_desc) VALUES (
        '<Image URL>',
        '<Title>',
        '<Short Description>',
        '<Reference Link>',
        '<Long Description>'
      );
    ";

    // Execute the query
    $query = mysqli_query($connection, $queryString);

?>