<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/hardware_pos_system/util/path_config/LinkGenerator.php";
require_once LinkGenerator::getFilePath("db");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Add Sales</h1>
    <div>
        <span>Type</span>

        <select name="" id="item_type">

            <?php

            $resultset = Db::loadFromTable("item_type");
            $rowCount = count($resultset);
            if ($rowCount > 0) {
                for ($i = 0; $i < $rowCount; $i++) {
                    $item = $resultset[$i];
            ?>

                    <option value=<?php echo $item["item_type_id"] ?>><?php echo $item["item_type_name"]; ?></option>
            <?php
                }
            }

            ?>
        </select>
        <span>Payment type</span>
        <select name="" id="payment_type">

            <?php

            $resultset = Db::loadFromTable("payment_type");
            $rowCount = count($resultset);
            if ($rowCount > 0) {
                for ($i = 0; $i < $rowCount; $i++) {
                    $item = $resultset[$i];
            ?>

                    <option value=<?php echo $item["payment_type_id"] ?>><?php echo $item["payment_type_name"]; ?></option>
            <?php
                }
            }

            ?>
        </select>

        <span>Amount</span>
        <input type="text" id="amount" placeholder="amount">
        <button id="add_btn">Add</button>

        <div>
            <span>Total sales</span>
            <input disabled type="text" id="total_sales">
            <br>
            <span>other</span>
            <input disabled type="text" id="other_sales">
            <br>
            <span>cement</span>
            <input disabled type="text" id="cement_sales">
            <br>
            <span>card</span>
            <input disabled type="text" id="card_sales">
        </div>

        <script src="add_sales.js"></script>
    </div>
</body>

</html>