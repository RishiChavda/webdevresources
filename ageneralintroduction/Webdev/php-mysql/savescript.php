<?php // - This line is used to add PHP code. It's ended by the a '?' and a '>'.

require("dbconn.php"); // Import the script to connect to the DB. IMPORTANT: Make sure you enter your details exactly as they appear on your server (case-sensitive).

// The following lines are declaring variables.
// The $_POST is calling the POST variables set by the HTML form (you may remember the method="post" line). There are other types of variables in PHP (see W3Schools/Tizag link for more details)
$fname = $_POST['fname'];
$sname = $_POST['sname'];
$email = $_POST['email'];

// This next line is where the actual 'saving' happens. Just like Access, we've got the table you've created and we've got fields/rows to populate.
// The INSERT INTO statement in SQL is going to INSERT a new row/record INTO the table_name we provide.
// Then in the brackets I'll give all of the required fields (if you set them as NOT NULL).
// We'll add some values (or variables which point to values) which is where all of the HTML form data goes.
// So to summarise... The first set of brackets is pointing to the field names and the second set are pointing towards the values.
// NOTE: As we have given the 'fieldid' ID field an auto_increment, we don't need to save that in PHP as when a new record is created in MySQL, a new unique ID is created.
mysql_query("INSERT INTO basicinfo(fname, sname, email) VALUES('$fname','$sname','$email',)") or die(mysql_error()); // The 'die' bit is a failsafe if there's an error in the query. The 'mysql_error()' will tell you what went wrong.

/* A MORE IN-DEPTH DEPTH VIEW

mysql_query("
INSERT INTO // Starting the function to INSERT data
basicinfo( // name of table
fname, // fname field
sname, // sname field
email // email field
) // End field names
VALUES( // [WHAT] to put in the field names
'$fname', // fname data
'$sname', // sname data
'$email' // email data
,) // End values
") // End mysql_query
or // Very similar to ELSE
die(mysql_error()); // Failsafe for displaying errors

*/
?>