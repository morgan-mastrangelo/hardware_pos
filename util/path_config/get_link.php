<?php

require $_SERVER['DOCUMENT_ROOT'] . "/hardware_pos_system/util/path_config/LinkGenerator.php";

if (isset($_POST["url_name"])) {
    //not root but the relative from the project
    //example /hardware_pos_system/sales/db/Util.php
 
    echo  LinkGenerator::getRelativePath($_POST["url_name"]);
}
