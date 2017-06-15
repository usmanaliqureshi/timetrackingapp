<?php

/**
 * Class timeApp
 */
class timeApp
{

    /**
     * @var private $connection
     */
    private $connection;

    /**
     * Construction of the MySQL Connection
     */
    function __construct()
    {

        $this->establish_connection();

    }

    /**
     * Connection to be established
     */
    public function establish_connection()
    {

        /**
         * MySQL Configuration
         */
        define("HOSTNAME", "localhost");
        define("USERNAME", "root");
        define("PASSWORD", "");
        define("DATABASE", "timer");

        /**
         * Establishing MySQL Connection
         */
        $this->connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

        if (!$this->connection) {

            die(mysqli_error());

        }

    }

    /**
     * Escaping the string for security
     * @param $string
     * @return string
     */
    public function escape_string($string)
    {

        $escaped_string = mysqli_real_escape_string($this->connection, $string);

        return $escaped_string;

    }

    /**
     * Saving the task details for the user
     * @param $task_description
     * @param $total_time
     * @param $date
     */
    public function save_the_task($task_description, $total_time, $date)
    {

        /**
         * Escaping the input data
         */
        $task = $this->escape_string($task_description);
        $time = $this->escape_string($total_time);

        /**
         * Inserting the data into the Database
         */
        $query = mysqli_query($this->connection, "INSERT INTO times (date, task_desc, time) VALUES ('$date', '$task', '$time')");

        if ($query) {

            echo "Successfully Inserted";

        } else {

            echo "Insertion Failed";

        }

    }

}