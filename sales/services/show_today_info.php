<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/hardware_pos_system/util/path_config/LinkGenerator.php";
require_once LinkGenerator::getFilePath("add_sales");
require_once LinkGenerator::getFilePath("sales_db_works");


$resultset = SalesDbWorks::show_info_today();
$count = count($resultset);

$cement_sales = 0;
$total_sales = 0;
$other_sales = 0;
$card_sales = 0;

for ($i = 0; $i < $count; $i++) {
    $amount = $resultset[$i]["amount"];
    if ($resultset[$i]["item_type_name"] === "cement") {
        $cement_sales += $amount;
    }
    if ($resultset[$i]["item_type_name"] === "other") {
        $other_sales += $amount;
    }
    if ($resultset[$i]["payment_type_name"] === "card") {

        $card_sales += $amount;
    }
    $total_sales += $amount;
}

$sale_array = array(
    "total_sales" => $total_sales,
    "other_sales" => $other_sales,
    "cement_sales" => $cement_sales,
    "card_sales" => $card_sales
);
echo json_encode($sale_array);
