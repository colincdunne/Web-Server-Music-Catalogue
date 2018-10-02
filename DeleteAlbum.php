<!DOCTYPE html>
<html>
<head>
<title>Delete an Album</title>
<meta charset="utf-8"/>
</head>
<body>
<h1>Delete an Album</h1>
<?php
//Connects to the database, it does this by using the dbconnection.php file. This prevents rewriting of code.
include 'dbconnection.php';

//TODO : check if albumID is set 
if(isset($_POST['albumId']) && !isset($_POST['no']) && !isset($_POST['yes'])) {
    $albumId = $_POST['albumId'];
    ?>
    <!-- This form provides two buttons, a "Yes" and a "No" button. This will act as a confirmation for deleting an album. -->
    <form method="post" action="DeleteAlbum.php">
        <h4>Are you sure you want to delete this album?</h4>
        <input type="hidden" name="albumId" value="<?php echo $albumId ?>">
        <button type="submit" name="yes">Yes</button>
        <button type="submit" name="no">No</button>
    </form>

<?php
}

    //If the user selects yes, it will begin the deletion process.
    if(isset($_POST['yes']) && isset($_POST['albumId'])) {
        //Gets the albumID for the selected album.
        $albumId = $_POST['albumId'];
        //Creates a query that Deletes the album that has the given albumID. If there is none with that albumID, then an error message is displayed
        $result = mysqli_query($DBConnection, "delete from albums where albumID = '$albumId' ") or die ('Failed to delete album.<br> Error:' . mysqli_errno($DBConnection) . '<br>Reason:' . mysqli_error($DBConnection));
        //Displays message once album is deleted.
        echo 'Successfully deleted album';
    }
    //If the user selects no, the below message will appear and the album will not be deleted.
    else if (isset($_POST['no']))
        echo 'Album not deleted';

?>  
    
<?php
//Closes the database connection.
mysqli_close($DBConnection); 
?>
    
<br><a href="ViewAlbums.php">View Albums</a>
</body>
</html>