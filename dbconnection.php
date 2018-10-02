<?php
//TODO: set to match your database connection details
$host = "localhost";
$DBName = "cdcatalog";
$password = "";

//Connects to the database.
$DBConnection=mysqli_connect($host,'root',$password,$DBName);
    //If the database connection cannot be established an error message is displayed.
	if (!$DBConnection)
		{
            $error ="<p>Unable to connect to the database server.</p>\n"
                    ."<p>Connection error code".mysqli_connect_errno()."</p> \n";
            include 'error.html.php'; 
            exit();
        }
        //If the connection is established, it sets the database to "cdcatalog"
		else 
            $DBName ="cdcatalog";
?>