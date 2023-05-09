<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/hardware_pos_system/util/path_config/LinkGenerator.php";
require_once LinkGenerator::getFilePath("expenses_db_works");

$expenseDescription = Db::loadFromTable("expense_details");
$expenseNames = array();
$count = count($expenseDescription);
if($count>0){
    for ($i=0; $i <$count ; $i++) { 
       array_push($expenseNames, $expenseDescription[$i]["description"]);
    }
}
echo json_encode($expenseNames);
?>