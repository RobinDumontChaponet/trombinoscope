<?php

include(dirname(__FILE__).'/../models/group.class.php');

$group = getGroupById($_GET['id']);

include(dirname(__FILE__).'/../views/group.php');

?>