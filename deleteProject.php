<?php
include($_SERVER['DOCUMENT_ROOT'] . 'includes/database.php');
$id = $_GET['id'];
$db->query("DELETE FROM 'projects' WHERE id = $id");

header("Location: /dash.php?action=deleted"); 