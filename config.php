<?php
// config.php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'u685273696_apiU');
define('DB_PASSWORD', 'gwTzHhefZ5+');
define('DB_DATABASE', 'u685273696_apiU');

/*************  ✨ Codeium Command ⭐  *************/
/**
 * Returns a PDO connection to the database.
 *
 * @return PDO|null The PDO connection if successful, otherwise null.
 */
/******  4387fe48-f25d-4f8e-8d15-96319777872a  *******/function getDB() {
    $dbConnection = null;
    try {
        $dbConnection = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return $dbConnection;
}
?>
