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
    private $select, $selectWhere, $selectOrder, $selectOrderWhere, $update;

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
            $this->select = $this->connection->prepare("SELECT $whatSelect FROM $fromSelect");
            $result = $this->select->fetch();
            print_r($this->connection->error);
            return $result;
        } else {
            $this->selectWhere = $this->connection->prepare("SELECT $whatSelect FROM $fromSelect WHERE :where");
            $this->selectWhere->bind_param(':where', $whereSelect);
            $result = $this->selectWhere->fetch();
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
            $this->selectOrder = $this->connection->prepare();
            //$this->selectOrder->bind_param(':by', $by);
            $result = $this->connection->query("SELECT $whatOrdered FROM $fromOrdered ORDER BY $by");
            print_r($this->connection->error);
            return $result;
        } else {
            $this->selectOrderWhere = $this->connection->prepare("SELECT $whatOrdered FROM $fromOrdered WHERE :where ORDER BY :by");
            $this->selectOrderWhere->bind_param(':by', $by);
            $this->selectOrderWhere->bind_param(':where', $whereOrdered);
            $result = $this->selectOrderWhere->fetch();
            print_r($this->connection->error);
            return $result;
        }
    }

    /**
     * Execute a UPDATE query on the database.
     * @param $col
     * @param $whatUpdate
     * @param $fromUpdate
     * @param $whereUpdate
     */
    public function update($col, $whatUpdate, $fromUpdate, $whereUpdate){
        $this->update = $this->connection->prepare("UPDATE $fromUpdate SET $col=:what WHERE :where");
        $this->update->bind_param(':what', $whatUpdate);
        $this->update->bind_param(':where', $whereUpdate);
        $this->update->execute();
        print_r($this->connection->error);
    }
}