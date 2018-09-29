<?php
/**
 *  ITEC 370: Spring 2018
 *	Final Code: Database Connection
 *  Andrew McGuiness, Andrew Albanese, Ryan Kelley, Michael Hall
*/

/**
 * Establish the initial DB connection
 */
function ConnectToDB()
{
    // Define some data to log in to the database
    $db_host = "localhost";
    $db_name = "target_game_data";
    $user = "local_script";
    $pass = "qKfXAsHEHBw0ZxBx";

    // Connect to the DB
    $connection = new mysqli($db_host, $user, $pass, $db_name)
    or die($connection->connect_error);

    // Return the connection object
    return $connection;
}

?>