<!--
For the purpose of this tutorial I will not be adding any styles to the page but feel free to play around with these tutorial scripts to familiarise yourself with web programming.
If order for it to work, this should be run on a server running PHP and MySQL.
A couple of things to do beforehand:
	- Check all the PHP comments to make sure it works flawlessly.
    - Add your SQL connection details to the file marked "dbconn.php".
    - Check the SQL-Help text file on how to setup the database table.
    - This is only a basic script for understanding the basics of saving to a SQL database using PHP which means that there haven't been any security measures put in place. If you would like to know more about security measures, I'll add a section in the SQL-Help.txt file on a few functions.

-->
<html>
<head>
<title>Saving to DB</title>
<style>
#main{margin:50px 20%; width:60%; height:auto; padding:10px; background-color:#336ca6; text-align:center;}
#main #title{width:auto; height:auto; padding:5px; font-size:20px; font-family:Arial; color:#ffffff; text-align:center;}
#main form{width:auto; height:auto; padding:20px 5px; border-radius:1000px;}
#main input{width:auto; height:auto; padding:5px; font-size:15px; font-family:Arial; border:none;}
</style>
</head>
<body>
<div id="main"><div id="title">The following information will be saved to a database.</div><form action="savescript.php" method="post">
<input type="text" name="fname" placeholder="Forename"/><br><br>
<input type="text" name="sname" placeholder="Surname"/><br><br>
<input type="email" name="email" placeholder="Email address"/><br><br>
<input type="submit" value="Save Information"/>
</form></div>
</body>
</html>