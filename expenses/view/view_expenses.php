<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/hardware_pos_system/util/path_config/LinkGenerator.php";
require_once LinkGenerator::getFilePath("db");
require_once LinkGenerator::getFilePath("optionGenerate");
require_once LinkGenerator::getFilePath("util_methods");

$today = Util::getDate("today");
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
    <span>Date</span>
    <input type="date" id="date" value="<?php echo $today ;?>">
    <button id="search">Show expenses </button>
    <div id="table"></div>
    <!-- <script src="Export.js" type="module"></script> -->
    <script src="view_expenses.js" type="module"></script>
</body>

</html>