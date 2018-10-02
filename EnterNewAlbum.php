<!DOCTYPE html>
<head>
<title>Add a new Album</title>
<meta charset="utf-8" />
</head>
<body>
<h1>Enter New Album</h1>
<?php
$ShowForm=FALSE;
$fields = array('title', 'artist', 'country', 'company', 'price', 'year'); 
$report=array(); 
foreach ($fields as $field)
	$report[$field]=""; 
	
//TODO: check if user selected submit button
if(isset($_POST['submit'])) {
    $ShowForm = FALSE;

    //If any of the text fields are empty, the below error will appear prompting the user to fill out all fields.
    if(empty($_POST['title']) || empty($_POST['artist'])  || empty($_POST['country']) || empty($_POST['company']) || empty($_POST['price']) || empty($_POST['year'])){
        echo 'Fill all fields <br>';
        $ShowForm = TRUE;
    }
    
    if ($ShowForm === FALSE)// if we do not need to show form for data entry
    {
        //Data that user entered is sanitised.
        $title = addslashes($_POST['title']);
        $artist = addslashes($_POST['artist']);
        $country = addslashes($_POST['country']);
        $company = addslashes($_POST['company']);
        $price = addslashes($_POST['price']);
        $year = addslashes($_POST['year']);

        //Connects to the database, it does this by using the dbconnection.php file. This prevents rewriting of code.
        include 'dbconnection.php';

        //Creats a query that add the inputted data for a new album into a new entry in ther database.
        $result = mysqli_query($DBConnection,"insert into albums (title,artist,country,company,price,year)
 values ('$title','$artist','$country','$company','$price','$year') ") or die ('Failed to add new album.<br>
 Error:' . mysqli_errno($DBConnection) . '<br>Reason:' . mysqli_error($DBConnection));
//Success message once the action is complete.
echo 'Successfully added album <br>';

    } //showForm
}
else
{
	$ShowForm=TRUE; 
}
if ($ShowForm===TRUE) {
//TODO: display form to enter new data
    ?>

<!-- A replica of the form on the updatealbum.php file. Except the displayed albumID is no longer there (as a new ID is given in the database.) -->    
<form action='EnterNewAlbum.php' method='POST'>
    <table>
        <tr><td align='right'>Title</td><td align='left'>
                <input type='text' size='80' name='title' />
            </td></tr>
        <tr><td align='right'>Artist</td><td align='left'>
                <input type='text' size='80' name='artist' />
            </td></tr>
        <tr><td align='right'>Country</td><td align='left'>
                <input type='text' size='80' name='country' />
            </td></tr>
        <tr><td align='right'>Company</td><td align='left'>
                <input type='text' size='20' name='company' />
            </td></tr>
        <tr><td align='right'>Price</td><td align='left'>
                <input type='text' size='40' name='price' />
            </td></tr>
        <tr><td align='right'>Year</td><td align='left'>
                <input type='text' size='40' name='year' />
            </td></tr>
        <tr><td align='center' colspan='2'>
                <input type='reset' name='reset' value='Clear Form' /> &nbsp;
                <input type='submit' name='submit' value='Save Album' />
            </td></tr>
    </table></form>

<?php
}
//Closes the database connection.
mysqli_close($DBConnection);
?>
<a href="ViewAlbums.php">View Albums</a>
</body>
</html>