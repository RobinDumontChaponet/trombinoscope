<?php

include(dirname(__FILE__).'/../models/group.class.php');

$students = getStudentsById($_GET['id']);

include(dirname(__FILE__).'/../views/group.php');

?>