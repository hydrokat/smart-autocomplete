<?php

/* Smart autocomplete
by: Argie Bacani (about.me/abacani)

Bla bla bla...

*/

require_once('smac.class.php'); //require the smac class. duh!

/*Here's some sample entries*/
$field = "Name";
$entry = "Mike Doe";

$smac = new SmartAutoComplete; //instantiate it, baby!

$smac -> setDatabase('localhost', 'db_smac', 'tbl_smartautocomplete', 'root', 'root'); //db config
echo $smac -> receiveField($field, $entry); //string entries for field and entry
$rows = $smac -> fetchField($field, 'DESC'); //string entry for field. ASC or DESC determines order

echo "<br />";
echo "<pre>" . $rows . "</pre>";