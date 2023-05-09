<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/hardware_pos_system/util/path_config/LinkGenerator.php";
require_once LinkGenerator::getFilePath("sales_db_works");
require_once LinkGenerator::getFilePath("util_methods");

$resultset = "";


if (
    (empty($_POST["item_type_id"]) || !isset($_POST["item_type_id"])) &&
    (empty($_POST["payment_type_id"]) || !isset($_POST["payment_type_id"]))
) {

    $resultset = SalesDbWorks::show_sales_info("", "",  "", "");
  
} else {

    echo "date is " . $_POST["date"];
    $resultset = SalesDbWorks::show_sales_info("", $_POST["date"],  $_POST["item_type_id"], $_POST["payment_type_id"]);
}
?>
<table>
    <tr>
        <td>no</td>
        <td>item type</td>
        <td>amount</td>
        <td>date</td>
        <td>payment type</td>
    </tr>

    <?php

    $length = count($resultset);
    for ($i = 0; $i < $length; $i++) {
    ?>
        <tr>

            <td><?php echo $i + 1; ?></td>
            <td><?php echo $resultset[$i]["item_type_name"]; ?></td>
            <td><?php echo $resultset[$i]["amount"]; ?></td>
            <td><?php echo $resultset[$i]["created_at"]; ?></td>
            <td><?php echo $resultset[$i]["payment_type_name"]; ?></td>
        </tr>
    <?php
    }

    ?>
</table>
<?php
$cement_sales = 0;
$total_sales = 0;
$other_sales = 0;
$card_sales = 0;

if(empty($_POST["date"])){
    $_POST["date"] = Util::getDate("today");
}
$resultset = SalesDbWorks::show_info_today($_POST["date"]);
$length = count($resultset);
for ($i = 0; $i < $length; $i++) {
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
//process to separately show cement and other sales
$resultset_cement_cash = SalesDbWorks::show_sales_info_by_names("",$_POST["date"],"cement","cash");
$resultset_cement_card = SalesDbWorks::show_sales_info_by_names("",$_POST["date"],"cement","card");
$resultset_cement_cheque = SalesDbWorks::show_sales_info_by_names("",$_POST["date"],"cement","cheque");

$resultset_other_cash = SalesDbWorks::show_sales_info_by_names("",$_POST["date"],"other","cash");
$resultset_other_card = SalesDbWorks::show_sales_info_by_names("",$_POST["date"],"other","card");
$resultset_other_cheque = SalesDbWorks::show_sales_info_by_names("",$_POST["date"],"other","cheque");



$other_cash_total = Util::sumUpResultset($resultset_other_cash,"amount");
$other_card_total = Util::sumUpResultset($resultset_other_card,"amount");
$other_cheque_total = Util::sumUpResultset($resultset_other_cheque,"amount");



$cement_cash_total = Util::sumUpResultset($resultset_cement_cash,"amount");
$cement_card_total = Util::sumUpResultset($resultset_cement_card,"amount");
$cement_cheque_total = Util::sumUpResultset($resultset_cement_cheque,"amount");
?>
<br>
<div>
    <span>other</span>
    <span>Cash : <?php echo $other_cash_total ?></span>
    <span>Card : <?php echo $other_card_total ?></span>
    <span>Cheque :<?php echo $other_cheque_total ?> </span>
</div>
<br>
<div>
    <span>cement</span>
    <span>Cash : <?php echo $cement_card_total ?></span>
    <span>Card : <?php echo $cement_card_total ?></span>
    <span>Cheque :<?php echo $cement_cheque_total ?> </span>
</div>
<br>
<div>
    <span>Total</span>
    <span><?php echo $total_sales;?></span>
</div>
<?php

?>