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

    $tool_uuid = $_POST['tool_uuid'];
    $column = $_POST['column'];
    $value = $_POST['value'];
    
    if ($tool_uuid != null && $column != null) {
      $queryString = "UPDATE tbl_tool SET " . $column . " = '" . $value . "' WHERE tool_uuid = " . $tool_uuid . ";";
      mysqli_query($connection, $queryString);
    }

?>