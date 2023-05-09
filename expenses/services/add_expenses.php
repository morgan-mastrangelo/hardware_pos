<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/hardware_pos_system/util/path_config/LinkGenerator.php";
require_once LinkGenerator::getFilePath("expenses_db_works");
require_once LinkGenerator::getFilePath("util_methods");
if(isset($_POST["description"]) && isset($_POST["amount"]) && isset($_POST["category"])){
    $description = $_POST["description"];
    $amount = $_POST["amount"];
    $category = $_POST["category"];
    if(!Util::isInputsEmpty(array($description,$amount,$category))){
        $category_id = ExpensesDbWorks::getCategoryTypeId($description);
        if($category_id== $category || $category_id== "new one"){
            echo "ok ok ";
            ExpensesDbWorks::addExpenses($description,$category,$amount);

        }
        
    }else{
        echo "input is empyt";
    }
    
}

?>