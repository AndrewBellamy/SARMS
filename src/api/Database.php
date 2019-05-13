<?php
class Database {

    function __construct() {
        $this->setupConnection();
    }

    private function setupConnection() {
        $dbuser = "abellamy";
        $dbpass = "84LP728X";
        $db = "SSID";
        $connect = oci_connect($dbuser, $dbpass, $db);

        /* Error handling for connection */
        if (!$connect) {
            echo "An error occurred connecting to the database";
            exit;
        }
    }

    
}
?>