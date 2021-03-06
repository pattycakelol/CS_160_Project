<?php
echo 
'<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<title>Files</title>
<link href="eggplant.css" rel="stylesheet" type="text/css">
<script src="eggplant.js"></script>
<meta name="google-signin-scope" content="profile email">
<meta name="google-signin-client_id" content="773730468254-82509noo29h6q37nbepago8ksko4a2as.apps.googleusercontent.com">
<script src="https://apis.google.com/js/platform.js" async defer></script>
</head>

<body>
<div class="container">
    <div class="nav">
        <a href="index.html">HOME</a>
        <a href="#about">ABOUT</a>
        <div class = "drop">
            <a onclick="drop()">ACCOUNT</a>
            <div id="dropdown" class="drop-menu">
              <a href="sign-in.html">Sign In</a>
              <a href="sign-out.html">Sign Out</a>
            </div>
        </div>
    </div>
<div class="header">
    <div class="image"><img src="header.jpg"/></div>
    <h2 class="txt1">THIS IS <span class="txt2">EGGPLANT</span></h2>
    <p class="txt3">A FREE LOG PROCESSING TOOL</p>
</div>

<div class="list">';

//Set owner to Google id
if (isset($_COOKIE["id_number"])){
    $owner = $_COOKIE["id_number"];
}
else{
    // User not logged in. Display error text and complete the rest of the page early.
    echo 'Please sign in to view your log files.
    </div>
    <section class="about" id="about">
    <h2 class="parallax">ABOUT EGGPLANT</h2>
    <p class="parallax_description">Eggplant is a free tool written in Python 3.0 for analyzing log files. It is a web-based tool, so the frontend is developed with html. It is only for educational use.</p>
    </section>
    <section class="footer_banner">
    <h4>Team Eggplant</h4>
    <p>(Blanchy Polancos, Gabriella Qiu, Henry Ngo, Patrick Leung)</p>
    <h4><a href="https://github.com/pattycakelol/CS_160_Project/">Explore on Github</a></h4>
    </section>

    <!-- Copyrights Section -->
    <div class="copyright">&copy;2018 - Team eggplant<strong></strong></div>
    </div>
    </body>
    </html>';
    die();
}

echo "Logs belonging to " . $_COOKIE["user_name"] . ":<br>";
echo "<form action='delete.php' method='post'>";
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'CS160';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$statement = "select * from logfiles where owner = '" . $owner . "'";
$result = $conn->query($statement);

if ($result->num_rows > 0) { // data found (at least 1 row)
  echo "<table border='1' align='center'>"; 
  while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>".$row["file_name"]."</td>";
      echo "<td><a href='".dirname($row['file_path']).'/results/'.$row['file_name'].'.html'."'>View Analysis</a></td>";
      echo "<td><button type='submit' value='".$row['file_path']."' name='savemefromthishell'>Delete File</button></td>";
      echo "</tr>";
      // echo $row['file_path']."<br>".$row['file_name']."<br><br>";
  }
  echo "</table>";
} else {
  echo "No log files uploaded yet.<br>";
}

echo "<p><a href='upload.html'>Upload New Log Files</a><p><br><br>";

$conn->close();
echo "</form>";

echo
'<section class="about" id="about">
<h2 class="parallax">ABOUT EGGPLANT</h2>
<p class="parallax_description">Eggplant is a free tool written in Python 3.0 for analyzing log files. It is a web-based tool, so the frontend is developed with html. It is only for educational use.</p>
</section>
<section class="footer_banner">
<h4>Team Eggplant</h4>
<p>(Blanchy Polancos, Gabriella Qiu, Henry Ngo, Patrick Leung)</p>
<h4><a href="https://github.com/pattycakelol/CS_160_Project/">Explore on Github</a></h4>
</section>

<!-- Copyrights Section -->
<div class="copyright">&copy;2018 - Team eggplant<strong></strong></div>
</div>
</body>
</html>';

?>
