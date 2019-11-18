<?php
include($_SERVER['DOCUMENT_ROOT'] . 'includes/database.php');

echo $_SESSION["user"];
session_unset();
session_destroy();
echo $_SESSION["user"];

header('Location: login.php?action=loggedout');
exit;