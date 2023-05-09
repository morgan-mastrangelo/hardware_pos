<?php
class  Db
{
    private $servername;
    private $dbname;
    private $password;
    private $port;
    private $username;

    public function connect()
    {

        $this->servername = "localhost";
        $this->dbname = "hardware_pos_system";
        $this->password = "ragJN100Mania";
        $this->port = 3306;
        $this->username = "root";


        try {
            $dsn = "mysql:host=" . $this->servername . ";dbname=" . $this->dbname;
            $pdo = new PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            return $pdo;
        } catch (PDOException $th) {
            echo "Connection Failed" . "" . $th->getMessage();
        }
    }
    public static function loadFromTable($table_name): array
    {
        $ownObject = new Db();
        $query = "SELECT * FROM `" . $table_name . "`";
        $statement = $ownObject->connect()->prepare($query);
        $statement->execute([]);
        $resultset = $statement->fetchAll();
        return $resultset;
    }
    public static function queryExecution($ownObject, $query, $array_of_values)
    {
        $statement = $ownObject->connect()->prepare($query);
        $statement->execute($array_of_values);
        return $statement;
    }
}
