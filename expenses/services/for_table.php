<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/hardware_pos_system/util/path_config/LinkGenerator.php";
require_once LinkGenerator::getFilePath("expenses_db_works");

if (isset($_POST["description"]) && isset($_POST["category"]) && isset($_POST["date"])) {
    $description = $_POST["description"];
    $category = $_POST["category"];
    $date = $_POST["date"];
    // $description ="";
    // $category ="";
    // $date = "";
    $resultset = ExpensesDbWorks::loadExpenses($description, $category, $date);

?>
    <table>
        <tr>
            <td>no</td>
            <td>created_at</td>
            <td>amount</td>
            <td>description</td>
            <td>category</td>
        </tr>

        <?php

        $length = count($resultset);
        for ($i = 0; $i < $length; $i++) {
        ?>
            <tr>

                <td><?php echo $i + 1; ?></td>
                <td><?php echo $resultset[$i]["created_at"]; ?></td>
                <td><?php echo $resultset[$i]["amount"]; ?></td>
                <td><?php echo $resultset[$i]["description"]; ?></td>
                <td><?php echo $resultset[$i]["expense_category_name"]; ?></td>
            </tr>
        <?php
        }

        ?>
    </table>
<?php
}
