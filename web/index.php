<?php
require_once "templates/header.php";
require_once "templates/footer.php";

$header = new Header();
$header->addStyle("/styles/style.css");
$header->addStyle("/styles/home.css");
$header->addScript("/js/jquery.min.js");
$header->addScript("/js/search.js");
$header->output();
?>
<input type="text" placeholder="Name" id="searchbox" name="searchbox" value="" />
<div id="results"></div>
<?php
$footer = new Footer();
$footer->output();
