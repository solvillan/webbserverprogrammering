<?php

/**
 * Created by PhpStorm.
 * User: Rickard
 * Date: 2016-09-09
 * Time: 11:53
 */

/**
 * Class Database
 * Handles database connections
 */
class Database
{

    private $connection;

    /**
     * Database constructor.
     */
    public function __construct($host, $user, $pass, $db)
    {
        $this->connection = new mysqli($host, $user, $pass, $db);

        if (!$this->connection->set_charset("utf8")) {
            echo "Kunde inte sätta teckentabell.";
        }

        if ($this->connection->connect_errno) {
            echo "Databasfel: " . $this->connection->connect_errno . ": " . $this->connection->connect_error;
        }

    }

    /**
     * Execute a SELECT query on the database.
     *
     * @param string $whatSelect
     * @param string $fromSelect
     * @param int|string $whereSelect
     * @return bool|mysqli_result
     */
    public function select($whatSelect, $fromSelect, $whereSelect = -1) {
        if (gettype($whereSelect) !== "string") {
            $result = $this->connection->query("SELECT $whatSelect FROM $fromSelect");
            print_r($this->connection->error);
            return $result;
        } else {
            $result = $this->connection->query("SELECT $whatSelect FROM $fromSelect WHERE $whereSelect");
            print_r($this->connection->error);
            return $result;
        }
    }

    /**
     * Escape string to only contain a number
     *
     * @param string $input
     * @return string
     */
    public function number_format($input) {
        $output_array = [];
        preg_match("/^([0-9])+/", $input, $output_array);
        return $output_array[0];
    }

    /**
     * Escape string
     * @param $input
     * @return string
     */
    public function escape_string($input) {
        $output_array = [];
        preg_match("/(['].+['])/", $input, $output_array);
        if (isset($output_array[0])) {
            return $this->connection->real_escape_string($output_array[0]);
        } else {
            $output_array = preg_split("/;/", $input);
            return $this->connection->real_escape_string($output_array[0]);
        }
    }

    /**
     * Execute a SELECT query on the database ordered by $by.
     *
     * @param $whatOrdered
     * @param $fromOrdered
     * @param $by
     * @param int|string $whereOrdered
     * @return bool|mysqli_result
     */
    public function selectOrdered($whatOrdered, $fromOrdered, $by, $whereOrdered= -1)
    {
        if (gettype($whereOrdered) !== "string") {
            $result = $this->connection->query("SELECT $whatOrdered FROM $fromOrdered ORDER BY $by");
            print_r($this->connection->error);
            return $result;
        } else {
            $result = $this->connection->query("SELECT $whatOrdered FROM $fromOrdered WHERE $whereOrdered ORDER BY $by");
            print_r($this->connection->error);
            return $result;
        }
    }

    /**
     * @param $what
     * @param $from
     * @param $where
     * @return mysqli_stmt
     */
    public function createSelect($what, $from, $where) {
        $stmt = $this->connection->prepare("SELECT $what FROM $from WHERE $where");
        return $stmt;
    }

    /**
     * @param $col
     * @param $from
     * @param $where
     * @return mysqli_stmt
     */
    public function createUpdate($col, $from, $where) {
        $query = "UPDATE $from SET ".$col[0]."=?";

        for ($i = 1; $i < count($col); $i++) {
            $query = $query.", ".$col[$i]."=?";
        }



        $query = $query." WHERE $where";
        $stmt = $this->connection->prepare($query);
        return $stmt;
    }

    public function createInsert($table, $cols) {
        $query = "INSERT INTO $table (".$cols[0];

        for ($i = 1; $i < count($cols); $i++) {
            $query = $query.", ".$cols[$i];
        }
        $query = $query.") VALUES (?";
        for ($i = 1; $i < count($cols); $i++) {
            $query = $query.", ?";
        }
        $query = $query.")";

        $stmt = $this->connection->prepare($query);
        return $stmt;
    }


    /**
     * Execute a UPDATE query on the database.
     * @param $col
     * @param $whatUpdate
     * @param $fromUpdate
     * @param $whereUpdate
     * @deprecated
     */
    public function update($col, $whatUpdate, $fromUpdate, $whereUpdate){
        $this->connection->query("UPDATE $fromUpdate SET $col=$whatUpdate WHERE $whereUpdate");
        print_r($this->connection->error);
    }
}