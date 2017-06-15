<?php

/**
 * Class timeApp
 */
class timeApp
{

    private $connection;

    function __construct()
    {

        $this->establish_connection();

    }

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

    public function save_the_task($task_description, $total_time, $date)
    {

        /**
         * Escaping the input data
         */
        $task = mysqli_real_escape_string($this->connection, $task_description);
        $time = mysqli_real_escape_string($this->connection, $total_time);

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