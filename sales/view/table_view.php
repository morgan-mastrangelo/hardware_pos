<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/hardware_pos_system/util/path_config/LinkGenerator.php";
require_once LinkGenerator::getFilePath("sales_db_works");
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
    <div>
        <span>Type</span>

        <select onchange="loadTable();" name="" id="item_type">

            <?php
            $db = new Db();
            $query = "SELECT * FROM `item_type`";
            $statement = $db->connect()->prepare($query);
            $statement->execute([]);
            $resultset = $statement->fetchAll();
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
        <select onchange="loadTable();" name="" id="payment_type">

            <?php
            $query = "SELECT * FROM `payment_type`";
            $statement = $db->connect()->prepare($query);
            $statement->execute([]);
            $resultset = $statement->fetchAll();
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
        <br>
        <span>From Date</span>
        <input onchange="loadTable();" type="date" id="date">



        <div id="table_container">

        </div>

        <script src="table_view.js" ></script>
    </div>

</body>

</html>