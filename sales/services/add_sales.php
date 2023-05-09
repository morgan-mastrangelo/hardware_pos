<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/hardware_pos_system/util/path_config/LinkGenerator.php";
require_once LinkGenerator::getFilePath("sales_db_works");


if (isset($_POST["item_type"]) && isset($_POST["payment_type"]) && isset($_POST["amount"])) {

    $item_type = $_POST["item_type"];
    $payment_type = $_POST["payment_type"];
    $amount = $_POST["amount"];
    
    if ((intval($item_type) && $item_type > 0)  && (intval($payment_type) && $payment_type > 0) && (intval($amount) && $amount > 0)) {
        $add_status  =  SalesDbWorks::addSales($amount, $payment_type, $item_type);
        if($add_status){
            echo "success";
        }else{
            echo "failed";
        }
    }else{
        echo "not valid inputs";
    }
}
