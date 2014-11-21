<?php

include_once(MODELS_INC.'Group.class.php');

$group = getGroupById($_GET['id']);

include(VIEWS_INC.'group.php');

?>