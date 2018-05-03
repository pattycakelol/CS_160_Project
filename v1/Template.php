<!doctype html>
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
        <a href="../../index.html">HOME</a>
        <a href="#about">ABOUT</a>
        <div class = "drop">
            <a onclick="drop()">ACCOUNT</a>
            <div id="dropdown" class="drop-menu">
                <div class="g-signin2" data-onsuccess="onSignIn"></div>
                <a href="" onclick="signOut();">Sign Out</a>
            </div>
        </div>
    </div>
<div class="header">
    <div class="image"><img src="header.jpg"/></div>
    <h2 class="txt1">THIS IS <span class="txt2">EGGPLANT</span></h2>
    <p class="txt3">A FREE LOG PROCESSING TOOL</p>
</div>

<div class="list">
    <?php echo $content ?>
</div>

<section class="about" id="about">
  <h2 class="parallax">ABOUT EGGPLANT</h2>
  <p class="parallax_description">Eggplant is a free tool written in Python 3.0 for analyzing log files. It is a web-based tool, so the frontend is developed with html. It is only for educational use.</p>
</section>
<section class="footer_banner">
  <h2>A TOOL CREATED BY </h2>
  <h4>Team Eggplant</h4>
  <p>(Gabriella Qiu, Patrick Leung, Henry Ngo, Blanchy Polancos)</p>
  <h4><a href="https://github.com/liamsjsu/CS_160_Project/">Explore on Github</a></h4>
</section>

<!-- Copyrights Section -->
<div class="copyright">&copy;2018 - Team eggplant<strong></strong></div>
</div>
</body>
</html>