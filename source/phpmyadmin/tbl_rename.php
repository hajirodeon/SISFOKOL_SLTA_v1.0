<?php
/* $Id: tbl_rename.php,v 1.15 2001/10/11 22:25:28 loic1 Exp $ */


/**
 * Gets some core libraries
 */
require('./libraries/grab_globals.lib.php');
$js_to_run = 'functions.js';
require('./libraries/common.lib.php');


/**
 * Defines the url to return to in case of error in a sql statement
 */
$err_url = 'tbl_properties.php'
         . '?lang=' . $lang
         . '&amp;server=' . $server
         . '&amp;db=' . urlencode($db)
         . '&amp;table=' . urlencode($table);


/**
 * A new name has been submitted -> do the work
 */
if (isset($new_name) && trim($new_name) != '') { 
    $old_name     = $table;
    $table        = $new_name;
    if (get_magic_quotes_gpc()) {
        $new_name = stripslashes($new_name);
    }

    // Ensure the target is valid
    if (count($dblist) > 0 && pmaIsInto($db, $dblist) == -1) {
        exit();
    }
    if (MYSQL_INT_VERSION < 32306) {
        check_reserved_words($new_name, $err_url);
    }

    include('./header.inc.php');
    mysql_select_db($db);
    $sql_query = 'ALTER TABLE ' . backquote($old_name) . ' RENAME ' . backquote($new_name);
    $result    = mysql_query($sql_query) or mysql_die('', '', '', $err_url);
    $message   = sprintf($strRenameTableOK, $old_name, $table);
    $reload    = 1;
} 


/**
 * No new name for the table!
 */
else { 
    include('./header.inc.php');
    mysql_die($strTableEmpty, '', '', $err_url); 
} 


/**
 * Back to the calling script
 */
require('./tbl_properties.php');
?>
