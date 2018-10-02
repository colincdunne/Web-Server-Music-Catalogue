<!DOCTYPE html>
<html>
<head>
<title>View Albums</title>
<meta charset="utf-8" />
</head>
<body>
<h1>Album List</h1>
<?php
//Connects to the database, it does this by using the dbconnection.php file. This prevents rewriting of code.    
include 'dbconnection.php'; 

//Sets the table name to a variable.    
$TableName = "albums"; 
//Creates an sql query that will select all from the table in order of their albumID. It then adds this query to a variable.
$SQLString="SELECT * FROM $TableName ORDER By albumID";
//Connects to the database to retireve the data so it can be displayed. If it fails or there is no data an error message is displayed.
$result = mysqli_query($DBConnection,$SQLString) or die ('Failed to get album data.<br> Error:'.mysqli_errno($DBConnection).'<br>Reason:'.mysqli_error($DBConnection));

//TODO:  FETCH records from database - provide delete(DeleteAlbum.php) and update(UpdateAlbum.php) hyperlinks with albumID
?>
<!-- Creates a table that will display all of the album data in the database. -->
<table width="100%" border='1' cellspacing='0'>
    <thead>
    <tr>
        <!-- Creates headers for the table. -->
        <th width="20%">Title</th>
        <th width="20%">Artist</th>
        <th width="10%">Country</th>
        <th width="20%">Company</th>
        <th width="10%">Price</th>
        <th width="10%">Year</th>
        <th width="5%"></th>
        <th width="5%"></th>
    </tr>
    </thead>
    <tbody>
    <?php
    if(mysqli_num_rows($result) == 0)
    echo '<td colspan="6">No Albums Added</td>';
    else
    while($row = mysqli_fetch_array($result)){
        ?>
        <tr>
            <!-- Each field is filled by using the echo command. -->
            <td><?php echo ucfirst($row['title']) ?></td>
            <td><?php echo ucfirst($row['artist']) ?></td>
            <td><?php echo ucfirst($row['country']) ?></td>
            <td><?php echo ucfirst($row['company']) ?></td>
            <td><?php echo ucfirst($row['price']) ?></td>
            <td><?php echo ucfirst($row['year']) ?></td>
            <td>
                <!-- An update button is added to allow the user to update information of an album.  -->
                <form method="post" action="UpdateAlbum.php">
                    <input type="hidden" name="albumID" value="<?php echo $row['albumID'] ?>">
                    <button name="update" type="submit" value="Update">Update</button>
                </form>
            </td>
            <td>
                <!-- A delete button is added to allow the user to delete an entire album. -->
                <form method="post" action="DeleteAlbum.php">
                    <input type="hidden" name="albumId" value="<?php echo $row['albumID'] ?>">
                    <button name="delete" type="submit" value="Delete">Delete</button>
                </form>
            </td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>

<?php
//Closes the database connection.
mysqli_close($DBConnection); 
?>
<a href="EnterNewAlbum.php">Enter a new Album</a>
</body>
</html>