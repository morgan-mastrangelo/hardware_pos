<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/hardware_pos_system/util/path_config/LinkGenerator.php";
require_once LinkGenerator::getFilePath("db");
require_once LinkGenerator::getFilePath("util_methods");
class SalesDbWorks extends Db
{
    static $ownObject;
    public static function loadOwnObject()
    {
        if (self::$ownObject == null) {
            self::$ownObject = new SalesDbWorks();
        }
        return self::$ownObject;
    }
    public static function addSales($amount, $payment_type_id, $item_type_id)
    {
        $date = Util::getDate("now");
        $ownObject = self::loadOwnObject();
        $query = "INSERT INTO `sales` (`amount`,`created_at`,`payment_type_id`,`item_type_id` ) VALUES (?,?,?,?)";
        $statement = $ownObject->connect()->prepare($query);
        $state = $statement->execute([$amount, $date, $payment_type_id, $item_type_id]);

        unset($ownObject);
        unset($statement);
        return $state;
    }

    public static function show_info_today()
    {
        $date = Util::getDate("today");
        $from = $date . " 00:00:00";
        $to = $date . " 23:59:59";
        $ownObject = self::loadOwnObject();
        $query = "SELECT * FROM `sales`
        INNER JOIN `payment_type`
        ON `payment_type`.`payment_type_id` = `sales`.`payment_type_id` 
        INNER JOIN `item_type`
        ON `item_type`.`item_type_id` = `sales`.`item_type_id`
        WHERE  `created_at`BETWEEN ? AND ?";
        $statement = $ownObject->connect()->prepare($query);
        $state = $statement->execute([$from, $to]);
        $resultset = $statement->fetchAll();
        unset($ownObject);
        unset($statement);
        return $resultset;
    }
    public static function show_info_on_date($date)
    {
        $from = $date . " 00:00:00";
        $to = $date . " 23:59:59";
        $ownObject = self::loadOwnObject();
        $query = "SELECT * FROM `sales`
        INNER JOIN `payment_type`
        ON `payment_type`.`payment_type_id` = `sales`.`payment_type_id` 
        INNER JOIN `item_type`
        ON `item_type`.`item_type_id` = `sales`.`item_type_id`
        WHERE  `created_at`BETWEEN ? AND ?";
        $statement = $ownObject->connect()->prepare($query);
        $state = $statement->execute([$from, $to]);
        $resultset = $statement->fetchAll();
        unset($ownObject);
        unset($statement);
        return $resultset;
    }
    public static function show_sales_info_by_names($amount, $date, $item_type_name, $payment_type_name)
    :array{


        $query = "SELECT * FROM `sales`  INNER JOIN `payment_type`
        ON `payment_type`.`payment_type_id` = `sales`.`payment_type_id` 
        INNER JOIN `item_type`
        ON `item_type`.`item_type_id` = `sales`.`item_type_id`";
        $no_attachments = $query;
        $where_query = " ";
        $ownObject = self::loadOwnObject();
        $executing_values = array();

        if(empty($date)){
            $date = Util::getDate("today");
        }
        $date_from = $date." 00:00:00";
        $date_to = $date." 23:59:59";

        if (!empty($amount)) {
            $where_query = " WHERE ";
            array_push($executing_values,$amount);
        }
        if (!empty($date_from) && !empty($date_to)) {
            $where_query = " WHERE ";
            array_push($executing_values,$date_from);
            array_push($executing_values,$date_to);
        }
        if (!empty($item_type_name)) {
            $where_query = " WHERE ";
            array_push($executing_values,$item_type_name);
        }
        if (!empty($payment_type_name)) {
            $where_query = " WHERE ";
            array_push($executing_values,$payment_type_name);
        }
        $item_type_id= "";
        $payment_type_id= "";
        $query = $query . $where_query;


        $query_array = array();
        //////////////////////
        if (!empty($amount)) {
            $sub_query = " `amount` > ?";
            array_push($query_array, $sub_query);
        }
        if (!empty($date_from) && !empty($date_to)) {
            $sub_query = " (`created_at` BETWEEN ? AND ?)";
            array_push($query_array, $sub_query);
        }
        if (empty($date_from) || empty($date_to)) {
            $date = Util::getDate("today");
            $from = $date . " 00:00:00";
            $to = $date . " 23:59:59";

            $sub_query = " (`created_at` BETWEEN " . $from . " AND " . $to . ")";
            array_push($query_array, $sub_query);
        }

        if (!empty($item_type_name)) {
            $sub_query = " `item_type`.`item_type_name`=?";
            array_push($query_array, $sub_query);
        }
        if (!empty($payment_type_name)) {
            $sub_query = " `payment_type`.`payment_type_name`=?";
            array_push($query_array, $sub_query);
        }

        $columns = array($amount, $date_from, $date_to, $item_type_name, $payment_type_name);
        $state = Util::checkAllEmpty($columns);

        if (Util::checkAllEmpty($columns)) {
            $query = $no_attachments;
        } else {

            for ($i = 0; $i < count($query_array); $i++) {
                $query = $query . $query_array[$i];
                if ($i != count($query_array) - 1) {
                    $query = $query . " AND ";
                }
            }
        }



        $statement = $ownObject->connect()->prepare($query);
        $state = $statement->execute($executing_values);
        $resultset = $statement->fetchAll();

        return $resultset;

    }
    public static function show_sales_info($amount, $date, $item_type_id, $payment_type_id)
    :array{


        $query = "SELECT * FROM `sales`  INNER JOIN `payment_type`
        ON `payment_type`.`payment_type_id` = `sales`.`payment_type_id` 
        INNER JOIN `item_type`
        ON `item_type`.`item_type_id` = `sales`.`item_type_id`";
        $no_attachments = $query;
        $where_query = " ";
        $ownObject = self::loadOwnObject();
        $executing_values = array();

        if(empty($date)){
            $date = Util::getDate("today");
        }
        $date_from = $date." 00:00:00";
        $date_to = $date." 23:59:59";

        if (!empty($amount)) {
            $where_query = " WHERE ";
            array_push($executing_values,$amount);
        }
        if (!empty($date_from) && !empty($date_to)) {
            $where_query = " WHERE ";
            array_push($executing_values,$date_from);
            array_push($executing_values,$date_to);
        }
        if (!empty($item_type_id)) {
            $where_query = " WHERE ";
            array_push($executing_values,$item_type_id);
        }
        if (!empty($payment_type_id)) {
            $where_query = " WHERE ";
            array_push($executing_values,$payment_type_id);
        }

        $query = $query . $where_query;


        $query_array = array();
        //////////////////////
        if (!empty($amount)) {
            $sub_query = " `amount` > ?";
            array_push($query_array, $sub_query);
        }
        if (!empty($date_from) && !empty($date_to)) {
            $sub_query = " (`created_at` BETWEEN ? AND ?)";
            array_push($query_array, $sub_query);
        }
        if (empty($date_from) || empty($date_to)) {
            $date = Util::getDate("today");
            $from = $date . " 00:00:00";
            $to = $date . " 23:59:59";

            $sub_query = " (`created_at` BETWEEN " . $from . " AND " . $to . ")";
            array_push($query_array, $sub_query);
        }

        if (!empty($item_type_id)) {
            $sub_query = " `item_type`.`item_type_id`=?";
            array_push($query_array, $sub_query);
        }
        if (!empty($payment_type_id)) {
            $sub_query = " `payment_type`.`payment_type_id`=?";
            array_push($query_array, $sub_query);
        }

        $columns = array($amount, $date_from, $date_to, $item_type_id, $payment_type_id);
        $state = Util::checkAllEmpty($columns);

        if (Util::checkAllEmpty($columns)) {
            $query = $no_attachments;
        } else {

            for ($i = 0; $i < count($query_array); $i++) {
                $query = $query . $query_array[$i];
                if ($i != count($query_array) - 1) {
                    $query = $query . " AND ";
                }
            }
        }



        $statement = $ownObject->connect()->prepare($query);
        $state = $statement->execute($executing_values);
        $resultset = $statement->fetchAll();

        return $resultset;

    }
}


