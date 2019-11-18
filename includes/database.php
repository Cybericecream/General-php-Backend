<?php

session_start();

$db = new PDO('sqlite:' . $_SERVER['DOCUMENT_ROOT'] . '/sql/database.sqlite');