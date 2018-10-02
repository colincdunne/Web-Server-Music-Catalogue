<!DOCTYPE html>
<head>
<title>Update Album Details</title>
<meta charset="utf-8"/>
</head>
<body>
<h1>Update Album Details</h1>
<?php
//Connects to the database, it does this by using the dbconnection.php file. This prevents rewriting of code.    
include 'dbconnection.php';
    
//echo "------------------CALL TO UPDATEALBUM.PHP----------------------------<br/>\n";
$ShowForm=FALSE; 

$fields = array('albumID','title', 'artist', 'country', 'company', 'price', 'year');
$report=array(); 
foreach ($fields as $field)
	$report[$field]=""; 
if (isset($_POST['albumID']))
{
	$albumID=$_POST['albumID']; 
}
else if (isset($_GET['albumID']))
{
	$albumID=$_GET['albumID']; 
}

//Creates a query that selects all data that is associated with the albumID chosen to update.
$result = mysqli_query($DBConnection,"select * from albums where albumID = '$albumID'")  or die ('Failed to get album data.<br>
 Error:'.mysqli_errno($DBConnection).'<br>Reason:'.mysqli_error($DBConnection));
$row = mysqli_fetch_array($result);
foreach ($fields as $field)
    $report[$field]=$row[$field];

//Once the user submits the form, the database is updated with the changed data.
if(isset($_POST['albumID']) && isset($_POST['title']) && isset($_POST['artist']) && isset($_POST['country']) && isset($_POST['company']) && isset($_POST['price']) && isset($_POST['year']) && isset($_POST['submit'])) {
        $title = $_POST['title'];
        $artist = $_POST['artist'];
        $country = $_POST['country'];
        $company = $_POST['company'];
        $price = $_POST['price'];
        $year = $_POST['year'];
        mysqli_query($DBConnection, "update albums set title='$title' , artist = '$artist' , country = '$country' , company = '$company'
 , price ='$price' , year = '$year' where albumID = '$albumID' ") or die ('Failed to update album data.<br>
 Error:' . mysqli_errno($DBConnection) . '<br>Reason:' . mysqli_error($DBConnection));
        //When the update is finished a success message is displayed.
        echo 'Album updated successfully';




        echo '<br><a href="ViewAlbums.php">View Albums</a>';
        // TODO: check if sticky update form needs to be displayed
        //following die function will only run when the update form will be submitted.
        // and it will stop the form to be displayed when the form have already been submitted once
        die();
    }
//////////////////////NOTE: STICKY FORM CODE BELOW ASSUMES DATA FETCHED INTO ARRAY CALLED $report[]///////////////////////////////

?>
<form action='UpdateAlbum.php' method='POST'>
<table>
<tr><td align='right'>Album ID</td><td align='left'><?php echo $report['albumID']; ?>
	<input type='hidden' name='albumID' value='<?php echo $report['albumID']; ?>' /></td></tr>
<tr><td align='right'>Title</td><td align='left'>
	<input type='text' size='80' name='title' value='<?php echo $report['title']; ?>' />
	</td></tr>
<tr><td align='right'>Artist</td><td align='left'>
	<input type='text' size='80' name='artist' value='<?php echo $report['artist']; ?>' />
	</td></tr>	
<tr><td align='right'>Country</td><td align='left'>
	<input type='text' size='80' name='country' value='<?php echo $report['country']; ?>' />
	</td></tr>
<tr><td align='right'>Company</td><td align='left'>
	<input type='text' size='20' name='company' value='<?php echo $report['company']; ?>' />
	</td></tr>
<tr><td align='right'>Price</td><td align='left'>
	<input type='text' size='40' name='price' value='<?php echo $report['price']; ?>' />
	</td></tr>
<tr><td align='right'>Year</td><td align='left'>
	<input type='text' size='40' name='year' value='<?php echo $report['year']; ?>' />
	</td></tr>
<tr><td align='center' colspan='2'>
	<input type='reset' name='reset' value='Clear Form' /> &nbsp; 
	<input type='submit' name='submit' value='Save Album' /> 
	</td></tr>
</table>
<?php
//Closes the database connection.
mysqli_close($DBConnection); 
?>
<a href="ViewAlbums.php">View Albums</a>
</body>
</html>