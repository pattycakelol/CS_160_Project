<?php
$file_name = basename($_FILES["logFile"]["name"]); // saved to db
// Changed from uniqid() to a cookie based on the user's Google Account
//$unique_id = uniqid();
if (isset($_COOKIE["id_number"])){
    $unique_id = $_COOKIE["id_number"];
}
else{
    displayError("Please log in to upload files.");
    $uploadOk = 0;
    die();
}
$file_dir = 'uploads/'.$unique_id.'/';
$file_path = $file_dir.$file_name; // saved to db
$uploadOk = 1;
$fileExtension = strtolower(pathinfo($file_path,PATHINFO_EXTENSION));

/* don't want to deal with this right now
// FILE RESTRICTIONS

// Check file size
if ($_FILES["logFile"]["size"] > 500000) {
    echo "File too large.<br>";
    $uploadOk = 0;
}
*/

// change to switch statement for easy reading
// Allow certain file formats
if(!is_numeric($fileExtension)) { // because we're only given .1, .2, .3, .4, and .5 file extensions...
    displayError("Uploaded log file must have the correct file extension.");
    $uploadOk = 0;
}


if ($uploadOk == 0) {
    echo "File not uploaded.<br>";
// if everything is ok, try to upload file
} else {

    // if directory doesnt exist, create it
    if (! is_dir($file_dir)) {
        mkdir($file_dir);
    }

    // upload file to directory $file_path
    if (move_uploaded_file($_FILES["logFile"]["tmp_name"], $file_path)) {

        // file successfully uploaded to server, insert file into database
        // connect to mysql database
        $host = 'localhost';
        $user = 'root';
        $pass = 'root';
        $db = 'testdb';
        $conn = new mysqli($host, $user, $pass, $db);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $statement = "Select * from logFiles where owner = '$unique_id' and file_name = '$file_name'";
        $result = $conn->query($statement);
        if ($result->num_rows == 0) { // disallow uploading files of the same name
            // insertion into db
            $statement = "insert into logFiles (file_name, file_path, owner) 
            values ('$file_name', '$file_path', $unique_id)";
            //'$_COOKIE['id_number]'
            if ($conn->query($statement) === TRUE) {
                echo "New log inserted successfully<br>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
            }
            $conn->close();

            // confirmation
            echo "The file ".$file_name. " has been uploaded to $file_dir.<br>";
            echo "<a href='/uploadtest/files.php'>See your files</a><br>";
            
            // moved inside database stuff so nothing has to be processed if an error exists
            // Process the file after uploading it
            $output = shell_exec('python format.py ' . escapeshellarg($file_dir) . " " . escapeshellarg($file_path) . " " . escapeshellarg($file_name));
            unlink($file_path);

            // file successfully uploaded, redirect to files
            header("Location: files.php");
            die();

        } else {
            displayError("You have already uploaded a file of the name: '$file_name'.");
            die();
        }
    } else {
        displayError("There was a system error when uploading your file.");
        die();
    }

}
function displayError($error){
    echo "<!doctype html>
    <html>
    <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=no'>
    <title>Upload</title>
    <link href='eggplant.css' rel='stylesheet' type='text/css'>
    <script src='eggplant.js'></script>
    <meta name='google-signin-scope' content='profile email'>
    <meta name='google-signin-client_id' content='773730468254-82509noo29h6q37nbepago8ksko4a2as.apps.googleusercontent.com'>
    <script src='https://apis.google.com/js/platform.js' async defer></script>
    </head>

    <body>
    <div class='container'>
        <div class='nav'>
            <a href='index.html'>HOME</a>
            <a href='#about'>ABOUT</a>
            <div class = 'drop'>
                <a onclick='drop()'>ACCOUNT</a>
                <div id='dropdown' class='drop-menu'>
                  <a href='sign-in.html'>Sign In</a>
                  <a href='sign-out.html'>Sign Out</a>
                </div>
            </div>
        </div>
    <div class='header'>
        <div class='image'><img src='header.jpg'/></div>
        <h2 class='txt1'>THIS IS <span class='txt2'>EGGPLANT</span></h2>
        <p class='txt3'>A FREE LOG PROCESSING TOOL</p>
    </div>
    <div class='list'>"
        . $error .
        "<h4><a href='upload.html'>Return to Uploads</a></h4>
    </div>
    <section class='about' id='about'>
    <h2 class='parallax'>ABOUT EGGPLANT</h2>
    <p class='parallax_description'>Eggplant is a free tool written in Python 3.0 for analyzing log files. It is a web-based tool, so the frontend is developed with html. It is only for educational use.</p>
    </section>
    <section class='footer_banner'>
    <h4>Team Eggplant</h4>
    <p>(Blanchy Polancos, Gabriella Qiu, Henry Ngo, Patrick Leung)</p>
    <h4><a href='https://github.com/pattycakelol/CS_160_Project/'>Explore on Github</a></h4>
    </section>

    <!-- Copyrights Section -->
    <div class='copyright'>&copy;2018 - Team eggplant<strong></strong></div>
    </div>
    </body>
    </html>";
}
?>