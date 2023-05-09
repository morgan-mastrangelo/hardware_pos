<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/hardware_pos_system/util/path_config/LinkGenerator.php";
require_once LinkGenerator::getFilePath("db");
require_once LinkGenerator::getFilePath("util_methods");
class ExpensesDbWorks extends Db
{
    public static function getCategoryTypeId($description)
    {
        $ownObject = self::loadOwnObject();
        $query = "SELECT * FROM `expense_details` 
        INNER JOIN `expense_category`
        ON `expense_details`.`expense_category_id` = `expense_category`.`expense_category_id`
        WHERE `expense_details`.`description`=?
        ";
        $statement = $ownObject->connect()->prepare($query);
        $statement->execute([$description]);
        $resultset = $statement->fetchAll();
        $rowCount = count($resultset);
        if ($rowCount == 1) {
            return $resultset[0]["expense_category_id"];
        } else {
            return "new one";
        }
    }
    public static function addExpenses($description, $category, $amount)
    {
        $currentDate = Util::getDate("now");
        $ownObject = self::loadOwnObject();
        $category_id = ExpensesDbWorks::getCategoryTypeId($description);
        //new desscription and category
        $newOne = false;

        if ($category_id == "new one") {
            $newOne = true;
            $addExpenseDetails = self::addExpensesDetails($description, $category);
            $expenseDetailsId = self::getExpensesDetailsId($description, $category);
            $query = "INSERT INTO `expenses` (`amount`,`created_at`,`expense_details_id`) VALUES (?,?,?)";
            $statement = $ownObject->connect()->prepare($query);
            $statement->execute([$amount, $currentDate, $expenseDetailsId]);
        }
        if (!$newOne) {
            //description is already exists in the table
            $expenseDetailsId = self::getExpensesDetailsId($description, $category);
            $query = "INSERT INTO `expenses` (`amount`,`created_at`,`expense_details_id`) VALUES (?,?,?)";
            $statement = $ownObject->connect()->prepare($query);
            $statement->execute([$amount, $currentDate, $expenseDetailsId]);
        }
    }
    static $ownObject;
    public static function loadOwnObject()
    {
        if (self::$ownObject == null) {
            self::$ownObject = new ExpensesDbWorks();
        }
        return self::$ownObject;
    }
    public static function getExpensesDetailsId($description, $category)
    {
        $ownObject = self::loadOwnObject();
        $query = "SELECT * FROM `expense_details` WHERE `description`=? AND `expense_category_id`=?";
        $statement = Db::queryExecution($ownObject, $query, array($description, $category));
        $resultset = $statement->fetchAll();
        $rowCount = count($resultset);
        $expenseDetailsId = null;
        if ($rowCount == 1) {
            $expenseDetailsId = $resultset[0]["expense_details_id"];
        }

        return $expenseDetailsId;
    }
    public static function addExpensesDetails($description, $category)
    {
        $status = false;
        $ownObject = self::loadOwnObject();
        $query = "INSERT INTO `expense_details` (`description`,`expense_category_id`) VALUES (?,?)";
        $statement = $ownObject->connect()->prepare($query);
        $state = $statement->execute([$description, $category]);
        if ($state) {
            $status = true;
        }
        return $status;
    }

    public static function loadExpenses($description, $expense_category_id,$date)
    {

    
        $ownObject = self::loadOwnObject();
        $wildCard = "%";

        if(empty($date)){
            $date = Util::getDate("today");
        }
        if(empty($expense_category_id)){
        
            $expense_category_id = "1";
        }
        $date_from = $date." 00:00:00";
        $date_to = $date." 23:59:59"; 

        $query = "SELECT * FROM `expenses`
        INNER JOIN `expense_details` ON 
        `expense_details`.`expense_details_id`= `expenses`.`expense_details_id`
        INNER JOIN `expense_category` ON
        `expense_details`.`expense_category_id` = `expense_category`.`expense_category_id` 
        WHERE `expense_details`.`description` LIKE  '%' ? '%' AND `expense_category`.`expense_category_id` = ?
        AND (`expenses`.`created_at` BETWEEN ? AND ? )";

        $statement = Db::queryExecution($ownObject, $query, array($description, $expense_category_id,$date_from,$date_to));
        $resultset = $statement->fetchAll();
        
        return $resultset;
    }
}
