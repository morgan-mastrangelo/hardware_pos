<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/hardware_pos_system/util/path_config/LinkGenerator.php";
require_once LinkGenerator::getFilePath("expenses_db_works");
if (isset($_POST["description"])) {
    if (empty($_POST["description"])) {
        echo "1";
    } else {
        $description = $_POST["description"];
        $result = ExpensesDbWorks::getCategoryTypeId($description);
        if($result == "new one"){
            echo "new one";
        }else{
            echo $result;
        }
    }
}
