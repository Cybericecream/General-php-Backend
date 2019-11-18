<?php

    include($_SERVER['DOCUMENT_ROOT'] . 'includes/database.php');

    $result = $db->query("SELECT demo FROM test");

    echo '<br />';

    foreach($result as $row)
    {
        print $row['demo'] . "\n";
    }

    echo '<br />';
    ?>

<ul>
    <li><a href="/">Home</a></li>
    <li><a href="/addUser.php">Add User</a></li>
</ul>
