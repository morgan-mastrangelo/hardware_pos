<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/hardware_pos_system/util/path_config/LinkGenerator.php";
require_once LinkGenerator::getFilePath("db");
require_once LinkGenerator::getFilePath("optionGenerate");

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
    <span>Description</span>
    <input type="text" id="description" placeholder="Description"></input>
    <ul id="results"></ul>

    <span>Category</span>
    <select value="" id="category">
        <?php
        $resultset = Db::loadFromTable("expense_category");
        OptionGenerate::generate($resultset, "expense_category_name", "expense_category_id");
        ?>
    </select>
    <span>Amount</span>
    <input type="text" id="amount">
    <button id="add_expenses_btn">Add Expense </button>
    <!-- <script src="Export.js" type="module"></script> -->
    <script src="add_expenses.js" type="module"></script>
</body>

</html>