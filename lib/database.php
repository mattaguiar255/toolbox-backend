
<?php

    function database_connect(string $host, string $username, string $password, string $schema) {

      $connection = mysqli_init();
      mysqli_real_connect($connection, $host, $username, $password, $schema, 3306, 0);

      if (mysqli_connect_errno())
          die('Failed to connect to MySQL: '.mysqli_connect_errno().": ".mysqli_connect_error());

      return $connection;

    }

?>