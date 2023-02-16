<?php
// This file/script is used for connection to the database.
// The following line is used for connecting to the server.
// The "mysql_connect" line is self explanitory however the way it works is... You sign on to a server (HOSTNAME), with a login (USERNAME) and a password (PASSWORD).
// If you're using your own computer as a server you may be able to use 'localhost' (without quotes).
mysql_connect("HOSTNAME", "USERNAME", "PASSWORD");

// Whilst setting up the database/server you will have given a database name (may be called "schema"). That goes here.
mysql_select_db("DATABASE NAME");
?>