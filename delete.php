<?php

//Set owner to Google id
if (isset($_COOKIE["id_number"])){
    $owner = $_COOKIE["id_number"];
}
else{
    echo "Sorry, an error has occured.";
    die();
}

$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'testdb';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$statement = "select * from logfiles where owner = $owner";
$result = $conn->query($statement);

if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        // print_r($_POST['data']); //for testing purposes
        // $_POST['data'][$row['file_name']] <- this took me soooo long to get right
        // the issue was that PHP converts the name field's special characters (such as periods and spaces) to underscores
        // the work-around used was turning the name into an array so that the periods and spaces in file name in $_POST are left untouched
        // and can be used in sql statements without further string parsing
        $statement = "delete from logfiles where file_path = '".$_POST['savemefromthishell']."'";
        echo "Row: ".$_POST['savemefromthishell']."<br>";
        echo "statement: ".$statement."<br>";
        if ($conn->query($statement) === TRUE) {
            echo "File deleted from database successfully<br>";

            // misspelled a directory and almost deleted everything in my computer... thank god for permissions.
            echo "Deleting file from server:...<br>";
            $dir = dirname($row['file_path']); // get the directory the file is in
            // array_map('unlink', glob("$dir/*.*")); // delete everything within that directory

            // when a delete button other than the first one is pressed, $_POST['data'][$row['file_name']] becomes equal to '', which does not delete anything/causes an error. If we just try to unlink $row['file_path'], then it will delete the wrong file, so... gotta pick the lesser of two evils here
            // unlink($row['file_path']);
            // unlink(dirname($row['file_path'])."/results/".basename($row['file_path']).".html");
            // echo $row['file_path']."<br>".dirname($row['file_path'])."/results/".basename($row['file_path']).".html<br>";
            unlink($_POST['savemefromthishell']);
            unlink(dirname($_POST['savemefromthishell'])."/results/".basename($_POST['data'][$row['file_name']]).".html");

            // with uniqueid's for files gone, we dont need below code, but it's nice to have t show progress

            // Need to delete the results htmls
            // array_map('unlink', glob("$dir/results/*.*")); // delete everything within that directory

            // rmdir($dir."/results"); // Delete the results folder
            // rmdir($dir); // delete the directory itself
            // if (!file_exists($dir)) {
            //     echo "File deleted from server successfully<br>"; // nice B)
            // }

        } else {
            echo "Error deleting file from database: " . $conn->error . "<br>";
        }
    }
} else { // no data found to delete
  echo "Nothing to delete.<br>";
}
echo "<a href='files.php'>Back to Files</a>";
// Once file is deleted, go back to file manager
header("Location: files.php");
die();




function console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}
?>