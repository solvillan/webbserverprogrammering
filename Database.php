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
    public function __construct()
    {
        $this->connection = new mysqli("localhost", "root", "", "School");

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
     * @param string $what
     * @param string $from
     * @param int|string $where
     * @return bool|mysqli_result
     */
    public function select($what, $from, $where = -1) {
        if (gettype($where) !== "string") {
            //echo "SELECT $what FROM $from;";
            $result = $this->connection->query("SELECT $what FROM $from;");
            print_r($this->connection->error);
            return $result;
        } else {
            //echo "SELECT $what FROM $from WHERE $where;";
            $result = $this->connection->query("SELECT $what FROM $from WHERE $where;");
            print_r($this->connection->error);
            return $result;
        }
    }

    /**
     * @param string $input
     * @return string
     */
    public function escape_string($input) {
        $output_array = [];
        preg_match("/^([0-9])+/", $input, $output_array);
        return $output_array[0];
    }

    public function selectOrdered($what, $from, $by, $where = -1)
    {
        if (gettype($where) !== "string") {
            //echo "SELECT $what FROM $from;";
            $result = $this->connection->query("SELECT $what FROM $from ORDER BY $by;");
            print_r($this->connection->error);
            return $result;
        } else {
            //echo "SELECT $what FROM $from WHERE $where;";
            $result = $this->connection->query("SELECT $what FROM $from WHERE $where ORDER BY $by;");
            print_r($this->connection->error);
            return $result;
        }
    }
}