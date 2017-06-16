<?php

require_once("configuration.php");

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
         * Establishing MySQL Connection
         */
        $this->connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

        if (!$this->connection) {

            die(mysqli_error($this->connection));

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
     * Sending the query to the MySQL Database
     * @param $sql_query
     * @return bool|mysqli_result
     */
    public function query($sql_query)
    {

        $sql_query = mysqli_query($this->connection, $sql_query);

        return $sql_query;

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
        $query = $this->query("INSERT INTO times (date, task_desc, time) VALUES ('$date', '$task', '$time')");

        if ($query) {

            echo "Successfully Inserted";

        } else {

            echo "Insertion Failed";

        }

    }

    public function login($username, $password)
    {

        $username = $this->escape_string($username);

        $password = $this->escape_string($password);

        $password_md5 = md5($password);

        $query = $this->query("SELECT * FROM users WHERE username = '$username'");

        $user_info = mysqli_fetch_array($query);

        if ($user_info['password'] === $password_md5) {

            header("location: tracktime.php");

        } else {

            header('location: index.php');

        }

    }

}