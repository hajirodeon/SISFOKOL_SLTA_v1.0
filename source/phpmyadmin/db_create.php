<?php
/* $Id: db_create.php,v 1.13 2001/10/11 22:25:28 loic1 Exp $ */


/**
 * Gets some core libraries
 */
require('./libraries/grab_globals.lib.php');
$js_to_run = 'functions.js';
require('./header.inc.php');


/**
 * Defines the url to return to in case of error in a sql statement
 */
$err_url = 'main.php'
         . '?lang=' . $lang
         . '&amp;server=' . $server;


/**
 * Ensures the db name is valid
 */
if (get_magic_quotes_gpc()) {
    $db      = stripslashes($db);
}
if (MYSQL_INT_VERSION < 32306) {
    check_reserved_words($db, $err_url);
}


/**
 * Executes the db creation sql query
 */
$local_query = 'CREATE DATABASE ' . backquote($db);
$result      = mysql_query('CREATE DATABASE ' . backquote($db)) or mysql_die('', $local_query, FALSE, $err_url);


/**
 * Displays the result and moves back to the calling page
 */
$message = $strDatabase . ' ' . htmlspecialchars($db) . ' ' . $strHasBeenCreated;
require('./db_details.php');

?>
