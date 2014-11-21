<?php

include_once(MODELS_INC.'Group.class.php');

$groups = getGroups();

include(VIEWS_INC.'groups.php');

?>