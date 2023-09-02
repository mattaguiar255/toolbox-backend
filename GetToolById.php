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

    $tool_uuid = $_GET["tool_uuid"];

    if ($tool_uuid != null) {

      // Build the MySQL query string for retrieving all tools.
      $queryString = "
        SELECT
            tbl_tool.tool_uuid,
            tbl_tool.icon_link,
            tbl_tool.title,
            tbl_tool.short_desc,
            tbl_tool.docs_link,
            tbl_tool.long_desc,
            GROUP_CONCAT(tbl_links.link_name) AS link_names,
            GROUP_CONCAT(tbl_links.link) AS links
        FROM tbl_tool
        INNER JOIN tbl_links ON tbl_tool.tool_uuid = tbl_links.tool_uuid
        WHERE tbl_tool.tool_uuid = ${tool_uuid}
        GROUP BY 
            tbl_tool.tool_uuid,
            tbl_tool.icon_link,
            tbl_tool.title,
            tbl_tool.short_desc,
            tbl_tool.docs_link,
            tbl_tool.long_desc;
      ";

      // Execute the query
      $query = mysqli_query($connection, $queryString);
      $row = mysqli_fetch_all($query, MYSQLI_ASSOC);

      // Send back the response as stringified JSON
      echo json_encode($row);

    }

?>